<?php

namespace App\Core;

use App\Config\Database;

class Router
{
    private array $routes = [];
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function get(string $uri, callable|array $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, callable|array $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch()
    {
        ob_start(); // evita "headers already sent"

        $method = $_SERVER["REQUEST_METHOD"];
        $uri = strtok($_SERVER["REQUEST_URI"], "?");

        // ---------------- ROTAS EXATAS ----------------
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            $controller = new $action[0]($this->db);
            return $controller->{$action[1]}();
        }

        // ------------- ROTAS COM {id} -----------------
        if (!empty($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $action) {

                if (strpos($route, "{") !== false) {

                    $regex = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_-]+)', $route);
                    $regex = "#^" . $regex . "$#";

                    if (preg_match($regex, $uri, $params)) {
                        array_shift($params);

                        $controller = new $action[0]($this->db);
                        return $controller->{$action[1]}(...$params);
                    }
                }
            }
        }

        // ----- SE NÃO ACHAR ROTA >> CHAMA O 404 -----
        return $this->notFound();
    }

    // 🔥 AQUI entra seu método
    public function notFound()
    {
        http_response_code(404); // cabeçalho primeiro

        $file = __DIR__ . "/../Views/404.php";

        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "<h2 style='color:#b30000;font-family:Arial'>404 - Página não encontrada</h2>";
        }
        exit;
    }
}

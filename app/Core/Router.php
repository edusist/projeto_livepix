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

        // var_dump($this->routes['POST'][$uri] = $action);
    }

    public function dispatch()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = strtok($_SERVER["REQUEST_URI"], "?");

        // Verifica rotas normais primeiro
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];

            $controllerClass = $action[0];
            $methodName = $action[1];

            $controller = new $controllerClass($this->db);
            return $controller->$methodName();
        }

        // Agora verifica rotas com parâmetros {id}
        foreach ($this->routes[$method] as $route => $action) {

            // Se a rota tiver um placeholder {algo}
            if (strpos($route, "{") !== false) {

                // Transforma a rota em REGEX
                $regex = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_-]+)', $route);
                $regex = "#^" . $regex . "$#";

                // Verifica se a URI atual bate com o regex
                if (preg_match($regex, $uri, $matches)) {

                    array_shift($matches); // remove o match completo
                    $params = $matches;    // parametros extraídos

                    $controllerClass = $action[0];
                    $methodName = $action[1];

                    $controller = new $controllerClass($this->db);

                    // Chama o método passando o ID como argumento
                    return $controller->$methodName(...$params);
                }
            }
        }

        // Se nada bater → 404
        http_response_code(404);
        echo "404 - Página não encontrada";
    }
}

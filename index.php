<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Core\Router;
use App\Controllers\ClienteController;
use App\config\Database;


require __DIR__ . "/vendor/autoload.php";

// Carrega o header global
require __DIR__ . "/app/Views/layout/header.php";

// Carrega o arquivo de rotas
require_once __DIR__ . "/routes/web.php";

// Pega a URL acessada
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Dispara a rota correta
// $router->dispatch($uri);

// Carrega footer global
require __DIR__ . "/app/Views/layout/footer.php";

<?php

use App\Core\Router;
use App\Controllers\ClienteController;
use App\Controllers\AssistenciaController;
use App\config\Database;

$router = new Router(new Database());


//
// ROTAS -----------------------------
$router->get("/", [ClienteController::class, "listar"]);

$router->get("/cliente/listar", [ClienteController::class, "listar"]);
$router->get("/cliente/cadastrar", [ClienteController::class, "create"]);
$router->post("/cliente/salvar", [ClienteController::class, "store"]);
$router->get("/cliente/editar/{id}", [ClienteController::class, "editar"]);
$router->post("/cliente/atualizar/{id}", [ClienteController::class, "update"]);
$router->get("/cliente/excluir/{id}", [ClienteController::class, "excluir"]);
$router->get("/cliente/pesquisar", [ClienteController::class, "pesquisar"]);
$router->post("/cliente/pesquisar", [ClienteController::class, "pesquisar"]);


$router->get("/assistencia/listar", [AssistenciaController::class, "listar"]);
$router->get("/assistencia/cadastrar", [AssistenciaController::class, "create"]);
$router->post("/assistencia/salvar", [AssistenciaController::class, "store"]);  
$router->get("/assistencia/editar/{id}", [AssistenciaController::class, "editar"]);
$router->post("/assistencia/atualizar/{id}", [AssistenciaController::class, "update"]);
$router->get("/assistencia/excluir/{id}", [AssistenciaController::class, "excluir"]);
$router->get("/assistencia/pesquisar", [AssistenciaController::class, "pesquisar"]);
$router->post("/assistencia/pesquisar", [AssistenciaController::class, "pesquisar"]);


// ------------------------------------------
// PEGAR A ROTA ATUAL
// ------------------------------------------
$uri = strtok($_SERVER["REQUEST_URI"], "?");

// // ------------------------------------------
// // CHAMAR O CONTROLADOR CORRETO
// // ------------------------------------------
$router->dispatch($uri);

// // echo "<pre>";
// // var_dump($uri);
// // echo "<br>";
// // // var_dump($action);
// // echo "</pre>";

return $router;



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema LivePix</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">
    
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4 navbar-custom">
  <div class="container-fluid">

    <a class="navbar-brand" href="/">LivePix</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <!-- MENU CLIENTES -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownClientes" role="button" data-bs-toggle="dropdown">
            Clientes
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownClientes">
            <li><a class="dropdown-item" href="/cliente/listar">Listar Clientes</a></li>
            <li><a class="dropdown-item" href="/cliente/cadastrar">Cadastrar Cliente</a></li>
          </ul>
        </li>

        <!-- MENU ASSISTÊNCIA -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownAssistencia" role="button" data-bs-toggle="dropdown">
            Assistência
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownAssistencia">
            <li><a class="dropdown-item" href="/assistencia/listar">Listar Assistências</a></li>
            <li><a class="dropdown-item" href="/assistencia/cadastrar">Cadastrar Assistência</a></li>
          </ul>
        </li>

      </ul>
    </div>

  </div>
</nav>

<div class="container">
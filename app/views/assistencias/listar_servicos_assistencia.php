<?php

// session_start();
if (isset($_SESSION["msg"])) {

    $msg = $_SESSION["msg"] ?? '';
    $msg_tipo = $_SESSION["msg_tipo"] ?? '';
?>
    <div class="alert alert-<?= $msg_tipo ?>">
        <?= $msg ?>
    </div>
<?php
    unset($_SESSION["msg"]);
    unset($_SESSION["msg_tipo"]);
}
?>
<h1 class="text-center">Assistências</h1>

<div class="card">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="/assistencia/cadastrar" class="btn btn-success">
            + Nova Assistência
        </a>
    </div>
</div>

<div class="table-responsive">
    <h1 class="text-center">Lista de Serviços da Assistência </h1>
    <table class="table table-striped">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Situação</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($assistencias as $assistencia): ?>
            <tr>
                <td><?= $assistencia['cod'] !== "" ?  $assistencia['cod'] : NULL  ?></td>
                <td><?= $assistencia['nome_assistencia']  !== "" ? $assistencia['nome_assistencia'] : NULL ?></td>
                <td><?= $assistencia['situacao']  !== "" ? $assistencia['situacao'] : NULL ?></td>


                <td>
                    <a class="btn btn-primary btn-sm" href="/assistencia/editar/<?= $assistencia['cod'] ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" href="/assistencia/excluir/<?= $assistencia['cod'] ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
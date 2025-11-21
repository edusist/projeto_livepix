<?php

session_start();
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
<h1 class="text-center">Clientes</h1>
<div class="card">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a  href="/cliente/cadastrar" class="btn btn-success">
           + Novo Cliente
        </a>
    </div>
</div>

<div class="table-responsive">

    <table class="table table-striped">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Serviço da Assistência</th>
            <th>Endereço</th>
              <th>Ações</th>
        </tr>

        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente['cod'] !== "" ?  $cliente['cod'] : NULL  ?></td>
                <td><?= $cliente['nome']  !== "" ?  $cliente['nome'] : NULL ?></td>
                <td><?= $cliente['nome_assistencia']  ?></td>

                <td>
                    <?=
                    $cliente['logradouro'] . ", Nº" .  $cliente['numero'] . " - " . $cliente['bairro'] . " - " .
                        $cliente['localidade'] . "/" .  $cliente['uf'] . "  Cep: " .
                        $cliente['cep']
                    ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/cliente/editar/<?= $cliente['cod'] ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" href="/cliente/excluir/<?= $cliente['cod'] ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
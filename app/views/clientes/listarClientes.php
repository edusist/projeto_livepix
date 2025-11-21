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
<div class="card mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="/cliente/cadastrar" class="btn btn-success">
            + Novo Cliente
        </a>
    </div>
    <!-- Pesquisar -->
    <div class="card-body mt-4">
        <form method="POST" action="/cliente/pesquisar" class="row g-3">

            <div class="col-md-4">
                <!-- <label class="form-label">ID do Cliente</label> -->
                <input type="number" class="form-control" name="id" placeholder="Digite o ID ou deixe vazio">
            </div>

            <div class="col-md-2 align-self-end">
                <button class="btn btn-primary w-100">Pesquisar</button>
            </div>
            <div class="col-md-2 align-self-end">
                <a href="/cliente/listar" class="btn btn-secondary w-100">Limpar</a>
            </div>

        </form>
    </div>
</div>
<hr>

<!-- TABELA DE RESULTADOS -->
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Resultado da Pesquisa</h4>
    </div>

    <div class="card-body">

        <table class="table table-striped table-bordered mb-0">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Serviço da Assistência</th>
                <th>Endereço</th>
                <th style="width: 150px;">Ações</th>
            </tr>
            <?php if (!empty($clientes)): ?>
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
                <?php endforeach;

            endif; ?>


        </table>
    </div>
</div>
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

<div class="card mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="/assistencia/cadastrar" class="btn btn-success">
            + Nova Assistência
        </a>
    </div>
    <!-- Pesquisar -->
    <div class="card-body mt-4">
        <form method="POST" action="/assistencia/pesquisar" class="row g-3">

            <div class="col-md-4">
                <!-- <label class="form-label">ID do Cliente</label> -->
                <input type="number" class="form-control" name="id" placeholder="Digite o ID ou deixe vazio">
            </div>

            <div class="col-md-2 align-self-end">
                <button class="btn btn-primary w-100">Pesquisar</button>
            </div>
            <div class="col-md-2 align-self-end">
                <a href="/assistencia/listar" class="btn btn-secondary w-100">Limpar</a>
            </div>

        </form>
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
        <?php if (!empty($assistencias)): ?>
            <?php foreach ($assistencias as $assistencia):
                // if (!is_array($assistencia)) continue;
            ?>
                <tr>
                    <td><?=  $assistencia['cod'] ?></td>
                    <td><?= $assistencia['nome_assistencia']  !== "" ? $assistencia['nome_assistencia'] : NULL ?></td>
                    <td><?= $assistencia['situacao']  !== "" ? $assistencia['situacao'] : NULL ?></td>


                    <td>
                        <a class="btn btn-primary btn-sm" href="/assistencia/editar/<?= $assistencia['cod'] ?>">Editar</a>
                        <a class="btn btn-danger btn-sm" href="/assistencia/excluir/<?= $assistencia['cod'] ?>">Excluir</a>
                    </td>
                </tr>
        <?php endforeach;
        endif; ?>

    </table>
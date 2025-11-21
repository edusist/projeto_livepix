<?php
require __DIR__ . "/../../../vendor/autoload.php";

// $path = __DIR__ . "/../../../vendor/autoload.php";
// var_dump($path, file_exists($path));
// exit;

?>

<div class="container mt-5">
    <h3 class="text-left voltar"><a href="/">Voltar </a>
    </h3>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Cadastro de Assistência</h4>
        </div>

        <div class="card-body">
            <?php

            $modoEdicao = isset($assistencia);
            //   var_dump($assistencia["cod"]);
            $action = $modoEdicao
                ? "/assistencia/atualizar/" . $assistencia["cod"]
                : "/assistencia/salvar";
            //   var_dump($assistencia["cod"]);
            ?>

            <form action="<?= $action ?>" method="POST">

                <div class="row">
                    <div class="mb-6">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome_assistencia" id="nome_assistencia" class="form-control" value="<?= $assistencia['nome_assistencia'] ?? '' ?>" required>
                    </div>

                    <div class="mb-6">
                        <label class="form-label">Situação</label>
                        <select class="form-select" name="situacao" id="situacao">
                            <option value="">Selecione...</option>
                            <option value="ativo" <?= ($assistencia['situacao'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="inativo" <?= ($assistencia['situacao'] ?? '') === 'inativo' ? 'selected' : '' ?>>Inativo</option>

                        </select>
                    </div>

                </div>


                <button class="btn btn-success mt-3" type="submit">
                    Salvar
                </button>

                <a href="/" class="btn btn-secondary mt-3">
                    Voltar
                </a>

            </form>
        </div>
    </div>
</div>
<?php

require __DIR__ . "/../layout/footer.php";

?>
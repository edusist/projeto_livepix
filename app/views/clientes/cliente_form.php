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

            <h4 class="text-center">Cadastro de Cliente</h4>
        </div>

        <div class="card-body">
            <?php

            $modoEdicao = isset($cliente);
            //   var_dump($modoEdicao);
            $action = $modoEdicao
                ? "/cliente/atualizar/" . $cliente["cod"]
                : "/cliente/salvar";

// var_dump($cliente) 
            ?>

            <form action="<?= $action ?>" method="POST">

                <div class="row">
                    <div class="mb">
                        <label class="form-label"><strong>Nome</strong></label>
                        <input type="text" name="nome" class="form-control"  value="<?=  $cliente['nome'] ?? '' ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-6">
                        <label class="form-label"><strong>Serviço da Assistência</strong></label>
                        <select id="cod_assistencia" class="form-control text-center" name="cod_assistencia">
                            <option value="">Selecione</option>
                            <?php foreach ($assistencias as $assistencia): ?>
                                <option   
                                     value="<?= $assistencia['cod'] ?>"
                                    <?= (isset($cliente) && $cliente['cod_assistencia'] == $assistencia['cod']) ? 'selected' : '' ?>
                                >
                                    <?= $assistencia['nome_assistencia'] ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>CEP</strong></label>
                        <input type="text" class="form-control" name="cep" id="cep" placeholder="99990-000" value="<?=  $cliente['cep'] ?? '' ?>" >
                    </div>
                </div>

                <div class="row">
                    <div class="mb-9">
                        <label class="form-label"><strong>Logradouro</strong></label>
                        <input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Rua/Av" value="<?=  $cliente['logradouro'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Número</strong></label>
                        <input type="text" class="form-control" name="numero" id="numero" placeholder="9999" value="<?=  $cliente['numero'] ?? '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-4">
                        <label class="form-label"><strong>Bairro</strong></label>
                        <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="<?=  $cliente['bairro'] ?? '' ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label"><strong>Cidade</strong></label>
                        <input type="text" class="form-control" id="localidade" name="localidade" placeholder="Cidade" value="<?=  $cliente['localidade'] ?? '' ?>">
                    </div>


                    <div class="mb-4">
                        <label class="form-label"><strong>Estado</strong></label>
                        <input type="text" class="form-control" name="uf" id="uf" placeholder="UF" value="<?=  $cliente['uf'] ?? '' ?>">
                    </div>

                </div>


                <button class="btn btn-success" type="submit">
                    Enviar
                </button>

                <a href="/" class="btn btn-secondary">
                    Voltar
                </a>

            </form>
        </div>
    </div>
</div>
<script src="/../../../public/js/buscaCep.js"></script>
<?php

require __DIR__ . "/../layout/footer.php";

?>
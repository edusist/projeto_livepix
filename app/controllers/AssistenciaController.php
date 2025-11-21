<?php

namespace App\Controllers;

use App\config\Database;
use App\models\Assistencia;

class AssistenciaController
{

    private Database $db;
    private Assistencia $assistenciaModel;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->assistenciaModel = new Assistencia($db);
    }

    public function listar()
    {
        // $pdo = $this->db->connect();

        //  $this->assistenciaModel = new Assistencia($this->db);

        $assistencias =  $this->assistenciaModel->getAllAssistencias();


        // echo "<pre>";
        // var_dump($assistencias);
        // echo "listar";
        // echo "<br>";
        // // var_dump($action);
        // echo "</pre>";
        // die();
        // Carrega a view
        require __DIR__ . "/../views/assistencias/listar_servicos_assistencia.php";
    }

    public function create()
    {
        // Apenas exibe o formulário
        require __DIR__ . "/../views/assistencias/assistencia_form.php";
    }

    public function store()
    {

        $nome_assistencia = $_POST["nome_assistencia"] ?? null;
        $situacao = $_POST["situacao"] ?? null;
        // echo "<pre>";
        // var_dump($nome_assistencia);
        // echo "listar";
        // echo "<br>";
        // var_dump($situacao);
        // echo "</pre>";
        // die();


        // Validações simples
        if (!$nome_assistencia || !$situacao) {
            echo "Campos são obrigatórios!";
            return;
        }



        $resultado =  $this->assistenciaModel->save($nome_assistencia, $situacao);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // var_dump(session_status());
        if ($resultado) {
            $_SESSION["msg"] = "Assistência salva com sucesso!";
            $_SESSION["msg_tipo"] = "success";
        } else {
            $_SESSION["msg"] = "Erro ao salvar Assistência!";
            $_SESSION["msg_tipo"] = "danger";
        }
        header("Location: /assistencia/listar");
        exit;
    }

    public function editar($id)
    {
        $assistencia =  $this->assistenciaModel->findById($id);

        // echo "<pre>";
        // var_dump($status_situacao['ina']);      
        // echo "<br>";
        // // var_dump($situacao);
        // echo "</pre>";
        // die();

        require __DIR__ . "/../views/assistencias/assistencia_form.php";
    }

    public function update($id)
    {

        // echo "<pre>";
        // var_dump($id);
        // var_dump($_POST["nome_assistencia"]);
        // echo "</pre>";
        // die();

        $nome_assistencia = $_POST["nome_assistencia"] ?? null;
        $situacao = $_POST["situacao"] ?? null;

        $dados = [
            'nome_assistencia'  => $nome_assistencia,
            'situacao'          => $situacao,
        ];

        $resultado = $this->assistenciaModel->atualizar($id, $dados);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // var_dump(session_status());

        if ($resultado) {
            $_SESSION["msg"] = "Assistência atualizada com sucesso!";
            $_SESSION["msg_tipo"] = "success";
        } else {
            $_SESSION["msg"] = "Erro ao atualizar à Assistência!";
            $_SESSION["msg_tipo"] = "danger";
        }

        header("Location: /assistencia/listar");
        exit;
    }

     public function excluir($id)
    {
        $resultado = $this->assistenciaModel->delete($id);       
        // echo "<pre>";
        // var_dump($resultado);
        // echo "</pre>";
        // die();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($resultado) {
            $_SESSION["msg"] = "Assistência excluído com sucesso!";
            $_SESSION["msg_tipo"] = "success";
        } else {
            $_SESSION["msg"] = "Erro ao excluir à Assistência!";
            $_SESSION["msg_tipo"] = "danger";
        }

          header("Location: /assistencia/listar");
        exit;
    }

}

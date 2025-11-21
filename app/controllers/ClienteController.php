<?php

namespace App\Controllers;

use App\Config\Database;
use App\models\Cliente;
use App\models\Assistencia;

class ClienteController
{
    private Database $db;
    private Cliente $clienteModel;
    private Assistencia $assistenciaModel;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->clienteModel = new Cliente($db);
        $this->assistenciaModel = new Assistencia($db);
    }

    public function listar()
    {
        $clientes = $this->clienteModel->getAllClietes();

        // echo "<pre>";
        // var_dump($clientes);   
        // echo "<br>";

        // echo "</pre>";
        // die();


        // Carrega a view
        require __DIR__ . "/../Views/clientes/listarClientes.php";
    }

    public function pesquisar()
    {
        $id = $_POST["id"];

        if ($id == "") {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["msg"] = "Campo de pesquisa não pode ficar vazio!";
            $_SESSION["msg_tipo"] = "danger";
            header("Location: /cliente/listar");
            exit;
        }

        // Converte para número ou NULL

        $clientes = $this->clienteModel->search($id);

        // echo "<pre>";
        // var_dump($clientes);   
        // echo "<br>";

        // echo "</pre>";
        // die();


        require __DIR__ . "/../Views/clientes/listarClientes.php";
    }

    public function create()
    {
        // $objAssistencia = new Assistencia($this->db);
        $assistencias =   $this->assistenciaModel->getAllAssistencias();

        // Apenas exibe o formulário
        require __DIR__ . "/../views/clientes/cliente_form.php";
    }

    public function store()
    {
        $nome = $_POST["nome"] ?? null;
        $cod_assistencia = $_POST["cod_assistencia"] == "" ? null  : $_POST["cod_assistencia"];
        $cep = $_POST["cep"] ?? null;
        $logradouro = $_POST["logradouro"] ?? null;
        $numero = $_POST["numero"] ?? null;
        $bairro = $_POST["bairro"] ?? null;
        $localidade = $_POST["localidade"] ?? null; //cidade
        $uf = $_POST["uf"] ?? null;
        // echo "<pre>";
        // var_dump($cod_assistencia);
        // // var_dump($_REQUEST);
        // echo "</pre>";
        // die();



        // Validações simples
        if (!$nome || !$cep) {
            echo "Campos são obrigatórios!";
            return;
        }

        // $objCliente = new Cliente($this->db);

        $resultado = $this->clienteModel->save($nome, $cod_assistencia, $logradouro, $numero, $bairro, $localidade, $uf, $cep);


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // var_dump(session_status());

        if ($resultado) {
            $_SESSION["msg"] = "Cliente salvo com sucesso!";
            $_SESSION["msg_tipo"] = "success";
        } else {
            $_SESSION["msg"] = "Erro ao salvar cliente!";
            $_SESSION["msg_tipo"] = "danger";
        }

        header("Location: /cliente/listar");
        exit;
    }

    public function editar($id)
    {
        $cliente = $this->clienteModel->findById($id);
        $assistencias =   $this->assistenciaModel->getAllAssistencias();

        require __DIR__ . "/../views/clientes/cliente_form.php";
    }

    public function update($id)
    {

        // echo "<pre>";
        // var_dump($id);
        // var_dump($_POST["nome"]);
        // echo "</pre>";
        // die();

        $nome = $_POST["nome"] ?? null;
        $cod_assistencia = $_POST["cod_assistencia"] == "" ? null  : $_POST["cod_assistencia"];
        $cep = $_POST["cep"] ?? null;
        $logradouro = $_POST["logradouro"] ?? null;
        $numero = $_POST["numero"] ?? null;
        $bairro = $_POST["bairro"] ?? null;
        $localidade = $_POST["localidade"] ?? null; //cidade
        $uf = $_POST["uf"] ?? null;

        $dados = [
            "nome"            => $nome ?? null,
            "cod_assistencia" => $cod_assistencia ?? null,
            "cep"             => $cep ?? null,
            "logradouro"      => $logradouro ?? null,
            "numero"          => $numero ?? null,
            "bairro"          => $bairro ?? null,
            "localidade"      =>  $localidade  ?? null,
            "uf"              =>  $uf ?? null
        ];



        $resultado = $this->clienteModel->atualizar($id, $dados);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // var_dump(session_status());

        if ($resultado) {
            $_SESSION["msg"] = "Cliente atualizado com sucesso!";
            $_SESSION["msg_tipo"] = "success";
        } else {
            $_SESSION["msg"] = "Erro ao atualizar o cliente!";
            $_SESSION["msg_tipo"] = "danger";
        }

        header("Location: /cliente/listar");
        exit;
    }

    public function excluir($id)
    {
        $resultado = $this->clienteModel->delete($id);

        // echo "<pre>";
        // var_dump($resultado);
        // echo "</pre>";
        // die();


        if ($resultado) {
            $_SESSION["msg"] = "Cliente excluído com sucesso!";
            $_SESSION["msg_tipo"] = "success";
        } else {
            $_SESSION["msg"] = "Erro ao excluir cliente!";
            $_SESSION["msg_tipo"] = "danger";
        }

        header("Location: /cliente/listar");
        exit;
    }
}

<?php

namespace App\models;

use App\Config\Database;
use Pdo;

class Assistencia
{

    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function findById(int $id): ?array
    {
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("SELECT * FROM assistencias WHERE cod = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAssistencias()
    {
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("SELECT cod, nome_assistencia, situacao FROM assistencias");
        $stmt->execute();

        // echo "<pre>";
        // var_dump($retorno );
        // echo "listar";
        // echo "<br>";

        // echo "</pre>";
        // die();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($nome_assistencia, $situacao)
    {

        // die();
        $pdo = $this->db->connect();
        $sql = "INSERT INTO assistencias (nome_assistencia, situacao) 
            VALUES (:nome_assistencia, :situacao)";

        // 2. Prepara a query
        $stmt = $pdo->prepare($sql);

        return  $stmt->execute([
            ':nome_assistencia'  => $nome_assistencia,
            ':situacao'          => $situacao,

        ]);
    }

    //Editar
    public function atualizar(int $id, array $dados): bool
    {

        $pdo = $this->db->connect();
        $stmt = $pdo->prepare(
            "UPDATE assistencias
                SET                 
                    nome_assistencia = :nome_assistencia,
                    situacao = :situacao            
                 
                WHERE cod = $id"
        );

        return $stmt->execute([
            ":nome_assistencia" => $dados["nome_assistencia"],
            ":situacao" => $dados["situacao"]
        ]);
    }

    // excluir
    public function delete(int $id): bool
    {
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("DELETE FROM assistencias WHERE cod = :cod");


        return $stmt->execute([":cod" => $id]);
    }
}

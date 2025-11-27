<?php

namespace App\models;

use App\Config\Database;
use Pdo;

class Cliente
{

    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findById(int $id): ?array
    {
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE cod = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function search(?int $id = null): array
    {
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("SELECT c.cod, c.cod_assistencia, a.nome_assistencia, c.nome, c.logradouro, c.numero, c.bairro, c.localidade, c.uf, c.cep 
                                    FROM clientes c
                                    LEFT JOIN assistencias a 
                                    ON c.cod_assistencia = a.cod     
                                    WHERE  c.cod = $id
                            ");

        $stmt->execute();
        // echo "<pre>";
        // var_dump( $stmt["queryString"]);        
        // echo "<br>";
        // // var_dump($action);
        // echo "</pre>";
        // die();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Editar
    public function atualizar(int $id, array $dados): bool
    {

        $pdo = $this->db->connect();
        $stmt = $pdo->prepare(
            "UPDATE clientes SET                 
                    nome = :nome,
                    cod_assistencia = :cod_assistencia,
                    cep = :cep,
                    logradouro = :logradouro,
                    bairro = :bairro,
                    localidade = :localidade,
                    uf = :uf
                WHERE cod = $id"
        );

        return $stmt->execute([
            ":nome" => $dados["nome"],
            ":cod_assistencia" => $dados["cod_assistencia"],
            ":cep" => $dados["cep"],
            ":logradouro" => $dados["logradouro"],
            ":bairro" => $dados["bairro"],
            ":localidade" => $dados["localidade"],
            ":uf" => $dados["uf"]
        ]);
    }

    // excluir
    public function delete(int $id): bool
    {

        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE cod = :cod");


        return $stmt->execute([":cod" => $id]);
    }

    public function getAllClietes()
    {
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare("SELECT c.cod, c.cod_assistencia, a.nome_assistencia, c.nome, c.logradouro, c.numero, c.bairro, c.localidade, c.uf, c.cep 
        FROM clientes c
        LEFT JOIN assistencias a 
        ON c.cod_assistencia = a.cod      
        ");
        $stmt->execute();
        // echo "<pre>";
        // var_dump( $stmt["queryString"]);        
        // echo "<br>";
        // // var_dump($action);
        // echo "</pre>";
        // die();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($nome, $cod_assistencia, $logradouro, $numero, $bairro, $localidade, $uf, $cep)
    {

        // die();
        $pdo = $this->db->connect();
        $sql = "INSERT INTO clientes (nome, cod_assistencia, logradouro, numero, bairro, localidade, uf, cep) 
            VALUES (:nome, :cod_assistencia, :logradouro, :numero, :bairro, :localidade, :uf, :cep)";

        // 2. Prepara a query
        $stmt = $pdo->prepare($sql);

        return  $stmt->execute([
            ':nome'       => $nome,
            ':cod_assistencia' => $cod_assistencia,
            ':logradouro' => $logradouro,
            ':bairro'     => $bairro,
            ':localidade' => $localidade,
            ':uf'         => $uf,
            ':numero'     => $numero,
            ':cep'        => $cep
        ]);
    }
}
<?php

namespace App\config;

use PDO;
use PDOException;

class Database
{
    private string $host = "localhost";
    private string $dbname;
    private string $user = "root";
    private string $password = "";

    // 1. Construtor aceita credenciais (Injeção de Dependência de Configuração)
    public function __construct(string $dbname = "assistencia")
    {

        $this->dbname = $dbname;
    }

    /**
     * Tenta conectar-se ao banco de dados se a conexão ainda não existir.
     * @return PDO A instância da conexão PDO.
     */
    public function connect(): PDO
    {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            throw new \RuntimeException("Erro na conexão com o DB: " . $e->getMessage());
        }
    }
    
    // 2. Método Setter Essencial para Testes de Mock (Injeção de Dependência de Conexão)
    /**
     * Define uma conexão PDO externa. Útil para injetar Mocks ou Stubs do PDO no teste.
     * @param PDO $pdo A instância PDO a ser injetada.
     */
    public function setConnection(PDO $pdo): void
    {
        $this->conn = $pdo;
    }
}

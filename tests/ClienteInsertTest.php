<?php

use PHPUnit\Framework\TestCase;
use App\Config\Database;

class ClienteInsertTest extends TestCase
{
    private PDO $db;

    protected function setUp(): void
    {
        // Conecta ao banco de TESTES
        $this->db = new PDO(
            'mysql:host=localhost;dbname=assistencia;charset=utf8',
            'root',
            ''
        );

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inicia uma transação para não mexer no banco de verdade
        $this->db->beginTransaction();
    }

    protected function tearDown(): void
    {
        // Desfaz tudo o que foi inserido
        $this->db->rollBack();
    }

    public function testInserirCliente()
    {
        $stmt = $this->db->prepare("
            INSERT INTO clientes (cod_assistencia, nome)
            VALUES (:cod_assistencia, :nome)
        ");

        $stmt->execute([
            // ":cod" => "001",
            ":cod_assistencia" => null,
            ":nome" => "José"
        ]);

        // Verifica se inseriu
        $id = $this->db->lastInsertId();

        // $this->assertIsNumeric($id);

        // Busca o cliente inserido
        $stmt = $this->db->prepare("
            SELECT * FROM clientes WHERE cod= :id
        ");
        $stmt->execute([":id" => $id]);

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($cliente);
        $this->assertEquals("José", $cliente['nome']);
        // var_dump($clienteId);

    }
}

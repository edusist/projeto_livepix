<?php

use PHPUnit\Framework\TestCase;
use App\config\Database;

class DatabaseTest extends TestCase
{
    public function testSeConexaoRetornaObjPDO()
    {
        $db = new Database();
        $conexao = $db->connect();

        // Verifica se o retorno é um objeto PDO
        $this->assertInstanceOf(PDO::class, $conexao);
    }

    public function testSeConexaoNaoEhNula()
    {
        $db = new Database();
        $conexao = $db->connect();

        $this->assertNotNull($conexao);
    }
}

<?php
try {
    $pdo = new PDO("mysql:host=db;dbname=assistencia;port=3306", "root", "");
    $result = $pdo->query("SELECT COUNT(*) AS total FROM clientes")->fetch();
    echo "Conectou ✔ — total clientes: {$result['total']}";
} catch (Exception $e) {
    echo "ERRO ❌: " . $e->getMessage();
}

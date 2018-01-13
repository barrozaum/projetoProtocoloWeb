<?php

try {

    $servidor = 'localhost';
    $usuario_banco = "root";
    $senha_usuario_banco = "";
    $porta = '3306';
    $banco = 'protocolocodeni';
//       instancia objeto PDO, conectando no Mysql
    $pdo = new PDO("mysql:host={$servidor}; port={$porta}; dbname={$banco}", "{$usuario_banco}", "{$senha_usuario_banco}");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {

//caso ocorra uma exceção, exibe na tela
    print $_SESSION['MENSAGEM'] = "USUARIO / SENHA INVÁLIDA BANCO!!!";
    header("Location: ../../../../");
    $pdo = null;
    exit();
}
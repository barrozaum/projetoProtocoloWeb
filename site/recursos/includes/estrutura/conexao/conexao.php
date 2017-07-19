<?php

try {
//    $servidor = '186.202.152.241';
//    $usuario_banco = 'codeni_proto';
//    $senha_usuario_banco = 'Prvm911329';
//    $porta= '3306';
//    $banco = 'codeni_proto';
    $servidor = '179.188.16.161';
    $usuario_banco = "bimed1";
    $senha_usuario_banco = "Prvm911329";
    $porta = '3306';
    $banco = 'bimed1';
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
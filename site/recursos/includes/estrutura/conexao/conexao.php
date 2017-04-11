<?php
try {
    $servidor = 'localhost';
    $usuario_banco = 'root';
    $senha_usuario_banco = '';
    $porta = '3306';
    $banco = 'protocoloweb';

//       instancia objeto PDO, conectando no Mysql
    $pdo = new PDO("mysql:host={$servidor}; port={$porta}; dbname={$banco}", "{$usuario_banco}", "{$senha_usuario_banco}");

//    print "conectdo com sucesso";
} catch (PDOException $ex) {
//caso ocorra uma exceção, exibe na tela
    print "Erro !" . $ex->getMessage();
    die();
}
<?php
if(!isset($_SESSION))
{
   session_start();
}

if($_POST['cmd'] == '1'){
    include_once '../estrutura/conexao/conexao.php';
    include_once '../funcoes/function_letraMaiscula.php';
    $login_novo_usuario = letraMaiuscula($_POST['login']);
    fun_validar_existencia_login($pdo, $login_novo_usuario);
    exit();
}


//função para saber se o assunto encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_validar_existencia_login($pdo, $login_novo_usuario) {
    $sql_novo_login= "SELECT * FROM usuario WHERE login = '{$login_novo_usuario}'";
    $query_novo_login = $pdo->prepare($sql_novo_login);
    $query_novo_login->execute();
    $resultado = $query_novo_login->fetchColumn();
  
    if ($resultado > 0) {
        $achou = 1;
    } else {
        $achou = 0;
    }
    
    print $achou;
}
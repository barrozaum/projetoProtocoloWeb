<?php
//abrindo seção no servidor 
session_start();
// 1 - verifico se o login se encotra no sistema
// 2 - verifico se a senha informada é a mesma do login
// chamo a conexao com o banco de dados
include_once '../conexao/conexao.php';

//biblioteca do setor
include_once '../../funcoes/func_retorna_setor.php';

// trato os valores passados pelos usuários
$login_informado = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['txtlogin']);
$senha_informada = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['txtsenha']);
$senha_criptografada = sha1($senha_informada);
//comando sql para buscar usuario
$sql_login = "SELECT * FROM usuario WHERE login = '{$login_informado}' LIMIT 1";
$query_login = $pdo->prepare($sql_login);
$query_login->execute();

//verifico se encontrou algum resultado
if ($query_login->fetchColumn() > 0) {
    $sql_login_senha = " SELECT * FROM usuario ";
    $sql_login_senha = $sql_login_senha . " WHERE login = '{$login_informado}'";
    $sql_login_senha = $sql_login_senha . " AND  senha = '{$senha_criptografada}'";
    $query_login_senha = $pdo->prepare($sql_login_senha);
    $query_login_senha->execute();
    if ($query_login_senha->fetchColumn() > 0) {
        $query_login_senha->execute();
        $dados = $query_login_senha->fetch();

        if ($dados['status'] == 1) {
            $_SESSION['MENSAGEM'] = "USUÁRIO BLOQUEADO NO SISTEMA !!!";
            $pdo = null;
            header("Location: ../../../../");
            exit();
        } else {
            
            $_SESSION['LOGADO_SISTEMA'] = "OK";
            $_SESSION['LOGIN_ID_USUARIO'] = $dados['idUsuario'];
            $_SESSION['LOGIN_USUARIO'] = $login_informado;
            $_SESSION['LOGIN_CODIGO_SETOR_USUARIO'] = $dados['idSetor'];
            $_SESSION['LOGIN_DESCRICAO_SETOR_USUARIO'] = func_retorna_descricao_setor($pdo, $dados['idSetor']);
            $pdo = null;
            header("Location: carrega_paramtros.php");
        }
    } else {
        $_SESSION['MENSAGEM'] = "SENHA INVÁLIDA !!!";
        header("Location: ../../../../");
        $pdo = null;
        exit();
    }
} else {
    $_SESSION['MENSAGEM'] = "LOGIN INVÁLIDO !!!";
    header("Location: ../../../../");
    $pdo = null;
    exit();
}
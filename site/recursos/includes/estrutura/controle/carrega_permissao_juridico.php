<?php

//validar seção
include_once './validar_secao.php';

function fun_carrega_permissao_juridico() {

    try {
        // biblioteca de conexao
        include_once '../conexao/conexao.php';
        $sql_carrega_permissao_juridico = "SELECT * FROM permissao_juridico WHERE id_usuario = '{$_SESSION['LOGIN_ID_USUARIO']}'";
        $query_permissao_juridico = $pdo->prepare($sql_carrega_permissao_juridico);
        if ($query_permissao_juridico->execute()) {

//            passando perfil de acesso
            $dados_permissao_juridico = $query_permissao_juridico->fetch();
            $_SESSION['PERMISSAO_MENU_JURIDICO'] = $dados_permissao_juridico['nivel_acesso'];



//        retornavalor 
            $retorno = true;
        } else {
            $retorno = false;
        }
        $pdo = null;
        return $retorno;
    } catch (Exception $ex) {
        $ex->getMessage();
        return FALSE;
    }
}

if (isset($_SESSION['VALIDA_LOGIN']) && isset($_SESSION['VALIDA_PARAMETROS'])) {
    if ($_SESSION['VALIDA_LOGIN'] !== "parte1" || $_SESSION['VALIDA_PARAMETROS'] !== "parte2") {
        $_SESSION['MENSAGEM_ERRO_MENU_SISTEMA'];
        header("Location:../error.php");
        exit();
    } else {


        if (fun_carrega_permissao_juridico()) {
            header("Location:../../../../inicial.php");
        } else {
            $_SESSION['MENSAGEM_ERRO_MENU_SISTEMA'];
            header("Location:../error.php");
            exit();
        }
    }
} else {
    $_SESSION['MENSAGEM_ERRO_MENU_SISTEMA'];
    header("Location:../error.php");
    exit();
}

<?php

//validar seção
include_once './validar_secao.php';

function fun_carrega_permissao() {

    try {
        // biblioteca de conexao
        include_once '../conexao/conexao.php';
        $sql_carrega_permissao = "SELECT * FROM permissao WHERE idUsuario = '{$_SESSION['LOGIN_ID_USUARIO']}'";
        $query_permissao = $pdo->prepare($sql_carrega_permissao);
        if ($query_permissao->execute()) {

//            array de permissoes
            $array_permissoes = array();
            while($dados_permissao = $query_permissao->fetch()){
                $array_permissoes[] = $dados_permissao['id_programa_menu'];
            }
            
            $_SESSION['PERMISSAO_MENU'] = $array_permissoes;
            

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


        if (fun_carrega_permissao()) {
            if($_SESSION['LOGIN_CODIGO_SETOR_USUARIO']==='14'){
                header("Location: carrega_permissao_juridico.php");
            }else{
                header("Location:../../../../inicial.php");
            }
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

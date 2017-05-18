<?php

//validar seção
include_once './validar_secao.php';
function fun_carrega_parametros() {

    try {
        // biblioteca de conexao
        include_once '../conexao/conexao.php';
        $sql_carrega_parametros_sistema = "SELECT * FROM configuracao_sistema";
        $query_parametros = $pdo->prepare($sql_carrega_parametros_sistema);
        if ($query_parametros->execute()) {

            $dados_parametros = $query_parametros->fetch();
            $_SESSION['VALIDA_PARAMETROS']= "parte2";
            $_SESSION['CONFIG_CAMINHO_LOGO'] = $dados_parametros['caminho_logo'];
            $_SESSION['CONFIG_NOME_CLIENTE'] = $dados_parametros['nome_cliente'];
            $_SESSION['CONFIG_SECRETARIA'] = $dados_parametros['secretaria'];
            $_SESSION['CONFIG_NUMERO_ENDERECO'] = $dados_parametros['numero_endereco'];
            $_SESSION['CONFIG_COMPLEMENTO'] = $dados_parametros['complemento'];
            $_SESSION['CONFIG_CIDADE'] = $dados_parametros['cidade'];
            $_SESSION['CONFIG_UF'] = $dados_parametros['uf'];
            $_SESSION['CONFIG_CNPJ'] = $dados_parametros['cnpj'];
            $_SESSION['CONFIG_ENDERECO'] = $dados_parametros['endereco'];
            $_SESSION['CONFIG_BAIRRO'] = $dados_parametros['bairro'];
            $_SESSION['CONFIG_CEP'] = $dados_parametros['cep'];

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

if (fun_carrega_parametros()) {
     header("Location: carrega_permissao.php");
} else {
    $_SESSION['MENSAGEM_ERRO_SISTEMA'];
    header("Location:../error.php");
    exit();
}
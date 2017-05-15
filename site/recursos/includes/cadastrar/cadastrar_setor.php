<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';


//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $secretaria_Letra_Maiscula = letraMaiuscula($_POST['txt_secretaria']);
    $descricao_secretaria_Letra_Maiscula = letraMaiuscula($_POST['txt_descricao_secretaria']);
    $coordenadoria_Letra_Maiscula = letraMaiuscula($_POST['txt_coordenadoria']);
    $descricao_coordenadoria_Letra_Maiscula = letraMaiuscula($_POST['txt_descricao_coordenadoria']);
    $departamento_Letra_Maiscula = letraMaiuscula($_POST['txt_departamento']);
    $descricao_departamento_Letra_Maiscula = letraMaiuscula($_POST['txt_descricao_departamento']);


// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($secretaria_Letra_Maiscula) > 2 && strlen($secretaria_Letra_Maiscula) < 51) {
        $secretaria = $secretaria_Letra_Maiscula;
    } else {
        $array_erros['txt_secretaria'] = 'POR FAVOR ENTRE COM A SECRETARIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_secretaria_Letra_Maiscula) > 2 && strlen($descricao_secretaria_Letra_Maiscula) < 51) {
        $descricao_secretaria = $descricao_secretaria_Letra_Maiscula;
    } else {
        $array_erros['txt_descricao_secretaria'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO SECRETARIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($coordenadoria_Letra_Maiscula) > 2 && strlen($coordenadoria_Letra_Maiscula) < 51) {
        $coordenadoria = $coordenadoria_Letra_Maiscula;
    } else {
        $array_erros['txt_coordenadoria'] = 'POR FAVOR ENTRE COM A COORDENADORIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_coordenadoria_Letra_Maiscula) > 2 && strlen($descricao_coordenadoria_Letra_Maiscula) < 51) {
        $descricao_coordenadoria = $descricao_coordenadoria_Letra_Maiscula;
    } else {
        $array_erros['txt_descricao_coordenadoria'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO COORDENADORIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($departamento_Letra_Maiscula) > 2 && strlen($departamento_Letra_Maiscula) < 51) {
        $departamento = $departamento_Letra_Maiscula;
    } else {
        $array_erros['txt_departamento'] = 'POR FAVOR ENTRE COM O DEPARTAMENTO VÁLIDO \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_departamento_Letra_Maiscula) > 2 && strlen($descricao_departamento_Letra_Maiscula) < 51) {
        $descricao_departamento = $descricao_departamento_Letra_Maiscula;
    } else {
        $array_erros['txt_descricao_departamento'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO DEPARTAMENTO VÁLIDO \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

        try {


//      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "INSERT INTO setor ";
            $sql = $sql . "(idSetor, setor, secretaria, descSecretaria, coordenadoria, descCoordenadoria, departamento, descDepartamento, usuario)";
            $sql = $sql . " VALUES ";
            $sql = $sql . " (null, '{$secretaria}','{$secretaria}','{$descricao_secretaria}', '{$coordenadoria}', '{$descricao_coordenadoria}', '{$departamento}', '{$descricao_departamento}','{$_SESSION['LOGIN_USUARIO']}')";
//        print $sql;
//      execução com comando sql    
            $executa = $pdo->query($sql);

//        mensagem de sucesso
            $msg = "CADASTRADO COM SUCESSO !!!";

//          salvo alteração no banco de dados
            $pdo->commit();
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        } 
//                FECHO CONEXAO
            $pdo = null;
//                EMITO MENSAGEM
            echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_secretaria.php";
                     </script>';
        



//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = //"../../../cadastro_secretaria.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    //die(header("Location: ../../../logout.php"));
}
?>
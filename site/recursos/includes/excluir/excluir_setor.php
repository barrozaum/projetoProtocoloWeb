<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_setor.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_codigo']);
    $secretaria_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_secretaria']);
    $descricao_secretaria_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_descricao_secretaria']);
    $coordenadoria_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_coordenadoria']);
    $descricao_coordenadoria_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_descricao_coordenadoria']);
    $departamento_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_departamento']);
    $descricao_departamento_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_descricao_departamento']);


// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($secretaria_Letra_Maiscula) > 2) {
        $secretaria = $secretaria_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_secretaria'] = 'POR FAVOR ENTRE COM A SECRETARIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_secretaria_Letra_Maiscula) > 2) {
        $descricao_secretaria = $descricao_secretaria_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_descricao_secretaria'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO SECRETARIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($coordenadoria_Letra_Maiscula) > 2) {
        $coordenadoria = $coordenadoria_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_coordenadoria'] = 'POR FAVOR ENTRE COM A COORDENADORIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_coordenadoria_Letra_Maiscula) > 2) {
        $descricao_coordenadoria = $descricao_coordenadoria_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_descricao_coordenadoria'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO COORDENADORIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($departamento_Letra_Maiscula) > 2) {
        $departamento = $departamento_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_departamento'] = 'POR FAVOR ENTRE COM O DEPARTAMENTO VÁLIDO \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_departamento_Letra_Maiscula) > 2) {
        $descricao_departamento = $descricao_departamento_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_descricao_departamento'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO DEPARTAMENTO VÁLIDO \n';
    }


// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//        tenho que verificar se o assunto está presente em algum processo
        if (fun_retorna_setor_processo($pdo, $codigo_Letra_Maiscula)) {
            die('<script>window.alert("Setor Não Pode ser Excluído, Pois existem processos que já tramitaram para ele !!!");location.href = "../../../cadastro_secretaria.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else {

            try {

//      Inicio a transação com o banco        
                $pdo->beginTransaction();

//      Comando sql a ser executado  
                $sql = "UPDATE setor ";
                $sql = $sql . " SET usuario = '{$_SESSION['LOGIN_USUARIO']}' ";
                $sql = $sql . " WHERE idSetor = '{$codigo_Letra_Maiscula}'";

//      execução com comando sql    
                $executa = $pdo->query($sql);
                
//      Comando sql a ser executado  
                $sql_1 = "DELETE FROM  setor WHERE idSetor = '{$codigo_Letra_Maiscula}'";
//      execução com comando sql    
                $executa_1 = $pdo->query($sql_1);

//      salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */

                $msg = "EXCLUIDO COM SUCESSO!!!";
            } catch (Exception $ex) {
                $msg = "ERRO AO EXCLUIR !!!";
            } finally {
//                FECHO CONEXAO
                $pdo = null;
//                EMITO MENSAGEM
                echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_secretaria.php";
                     </script>';
            }
        }


//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_secretaria.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';

//biblioteca de cargas
include_once '../funcoes/func_carga_processo.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_carga = letraMaiuscula($_POST['txt_carga']);

// verifico se tem erro na validação
    if (empty($array_erros)) {

        try {
//      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//          comando sql            
            fun_excluir_carga_apenso($pdo, $codigo_carga);
            fun_excluir_carga_processo($pdo, $codigo_carga);
           

//       persistindo no banco     
            $pdo->commit();

            $msg = "DELETADO COM SUCESSO";
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
//      FECHO CONEXAO
        $pdo = null;

        echo '<script>window.alert("' . $msg . '");
               location.href = "../../../excluir_carga.php";
        </script>';



//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../excluir_carga.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
<?php

//die(print_r($_POST));
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_carga_processo.php';
include_once '../funcoes/funcao_formata_data.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    


    if (empty($array_erros)) {
        try {

//      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

            $data_recebimento_americana = dataAmericano(date('d/m/Y'));
//      Comando sql a ser executado 
            foreach ($_POST['txt_op'] as $key => $id_carga_processo) {
                cadastro_recebimento_apenso_processo($pdo, $id_carga_processo, $data_recebimento_americana);
                cadastro_recebimento_processo($pdo, $id_carga_processo, $data_recebimento_americana);
            }
          
            //            mensagem de sucesso
            $msg = "PROCESSOS RECEBIDOS COM SUCESSO";

//            persistindo no banco de dados
            $pdo->commit();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }

//                EMITO MENSAGEM
        echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_recebimento_coletivo.php";
                     </script>';

//            fecho conexao
        $pdo = NULL;
//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_recebimento_coletivo.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
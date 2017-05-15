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
    $codigo_processo = letraMaiuscula($_POST['txt_codigo_processo']);
    $id_carga_processo = letraMaiuscula($_POST['txt_carga']);
    $data_recebimento = letraMaiuscula($_POST['txt_data']);

    if ($codigo_processo < 1) {
        $array_erros['txt_codigo'] = "POR FAVOR ENTRE COM UM PROCESO VÁLIDO !!! \n";
    }
    if ($id_carga_processo < 1) {
        $array_erros['txt_codigo'] = "POR FAVOR ENTRE COM CARGA DO PROCESO VÁLIDA !!! \n";
    }

    if (!validar_estrutura_data($data_recebimento)) {
        $array_erros['txt_data_carga'] = "POR FAVOR INFORME UMA DATA VÁLIDA !!! \n";
    }


    if (empty($array_erros)) {
        try {

//      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

            $data_recebimento_americana = dataAmericano($data_recebimento);
//      Comando sql a ser executado  
            cadastro_recebimento_processo($pdo, $id_carga_processo, $data_recebimento_americana);
            //            mensagem de sucesso
            $msg = "CADASTRADO COM SUCESSO";

//            persistindo no banco de dados
            $pdo->commit();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }

//                EMITO MENSAGEM
        echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_recebimento_individual.php";
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
               location.href = "../../../cadastro_recebimento_individual.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
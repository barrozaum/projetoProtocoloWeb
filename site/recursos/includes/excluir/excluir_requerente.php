<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_requerente.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_Letra_Maiscula = (int) letraMaiuscula($_POST['txt_excluir_codigo']);
    $requerente_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_requerente']);
    $tel_fixo_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_tel_fixo']);
    $tel_celular_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_tel_cel']);
    $cep_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_cep_requerente']);
    $logradouro_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_logradouro_requerente']);
    $bairro_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_bairro_requerente']);
    $cidade_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_cidade_requerente']);
    $uf_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_uf_requerente']);
    $numero_endereco_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_numero_requerente']);
    $complemento_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_complemento_requerente']);

// filtro pra validar
    if (strlen($requerente_Letra_Maiscula) > 2) {
        $requerente = $requerente_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_requerente'] = 'POR FAVOR ENTRE COM A REQUERENTE VÁLIDO \n';
    }

    if (strlen($cep_Letra_Maiscula) === 8) {
        $cep = $cep_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_cep'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($logradouro_Letra_Maiscula) > 2) {
        $logradouro = $logradouro_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_logradouro'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($numero_endereco_Letra_Maiscula) > 0 && strlen($numero_endereco_Letra_Maiscula) < 11) {
        $numero_endereco = $numero_endereco_Letra_Maiscula;
    } else {
        $array_erros['txt_excluir_logradouro'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($tel_celular_Letra_Maiscula) < 11 && strlen($tel_fixo_Letra_Maiscula) < 11) {
        $array_erros['txt_excluir_cep'] = 'POR FAVOR ENTRE COM TELEFONE (FIXO/CELULAR) VÁLIDO \n';
    }




// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//        tenho que verificar se o assunto está presente em algum processo
        if (fun_retorna_requerente_processo($pdo, $codigo_Letra_Maiscula)) {
            die('<script>window.alert("Requerente Não Pode ser Excluído, Pois ja está cadastrado em Processo !!!");location.href = "../../../cadastro_requerente.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else {
            try {
//      Inicio a transação com o banco        
                $pdo->beginTransaction();


//      Comando sql a ser executado  
                $sql = "UPDATE requerente SET";
                $sql = $sql . " usuario = '{$_SESSION['LOGIN_USUARIO']}' ";
                $sql = $sql . " WHERE idRequerente = '{$codigo_Letra_Maiscula}' ";


//      execução com comando sql    
                $executa = $pdo->query($sql);

                $sql1 = "DELETE FROM  requerente WHERE idRequerente = '{$codigo_Letra_Maiscula}'";
//      execução com comando sql    
                $executa1 = $pdo->query($sql1);

                $msg = "EXCLUIDO COM SUCESSO!!!";

//          salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
            } catch (Exception $ex) {
                $msg = "ERRO AO EXCLUIR !!!";
            } finally {
//                FECHO CONEXAO
                $pdo = null;
//                EMITO MENSAGEM
                echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_requerente.php";
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
               location.href = "../../../cadastro_requerente.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
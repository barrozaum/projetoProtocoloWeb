<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_documento.php';
include_once '../funcoes/func_retorna_observacao.php';
include_once '../funcoes/func_carga_processo.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/funcao_formata_data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

    $codigo_processo = letraMaiuscula($_POST['txt_codigo_processo']);
    $cad_tipo_processo = letraMaiuscula($_POST['txt_tipo_processo']);
    $cad_data_processo = letraMaiuscula($_POST['txt_data']);
    $cad_numero_processo = letraMaiuscula($_POST['txt_numero_processo']);
    $cad_ano_processo = letraMaiuscula($_POST['txt_ano_processo']);
    $cad_assunto = letraMaiuscula($_POST['txt_assunto']);
    $cad_codigo_assunto = letraMaiuscula($_POST['txt_codigo_assunto']);
    $cad_origem = letraMaiuscula($_POST['txt_origem']);
    $cad_codigo_origem = letraMaiuscula($_POST['txt_codigo_origem']);
    $cad_requerente = letraMaiuscula($_POST['txt_requerente']);
    $cad_codigo_requerente = letraMaiuscula($_POST['txt_codigo_requerente']);
    $cad_tel_fixo = letraMaiuscula($_POST['txt_tel_fixo']);
    $cad_tel_cel = letraMaiuscula($_POST['txt_tel_cel']);
    $cad_cep_requerente = letraMaiuscula($_POST['txt_cep_requerente']);
    $cad_logradouro_requerente = letraMaiuscula($_POST['txt_logradouro_requerente']);
    $cad_bairro_requerente = letraMaiuscula($_POST['txt_bairro_requerente']);
    $cad_cidade_requerente = letraMaiuscula($_POST['txt_cidade_requerente']);
    $cad_uf_requerente = letraMaiuscula($_POST['txt_uf_requerente']);
    $cad_numero_end_requerente = letraMaiuscula($_POST['txt_numero_requerente']);
    $cad_complemento_requerente = letraMaiuscula($_POST['txt_complemento_requerente']);
    $observacao_processo = letraMaiuscula($_POST['txt_obs_processo']);
    // campo solicitado para implementação, pois os colaboradores gostam de saber o valor do processo
    $valor_processo = letraMaiuscula($_POST['txt_valor_processo']); 
 
//    VALIDACAO
    if (strlen($codigo_processo) < 1 && strlen($codigo_processo) > 11) {
        $array_erros['txt_tipo_processo'] = "POR FAVOR ENTRE COM O CODIGO PROCESSO VÁLIDO \n";
    }
    if (strlen($cad_tipo_processo) < 1 && strlen($cad_tipo_processo) > 11) {
        $array_erros['txt_tipo_processo'] = "POR FAVOR ENTRE COM O TIPO PROCESSO VÁLIDO \n";
    }

    if (!validar_estrutura_data($cad_data_processo)) {
        $array_erros['txt_data'] = 'POR FAVOR ENTRE COM DATA PROCESSO VÁLIDA \n';
    } else {
        $cad_data_processo = dataAmericano($cad_data_processo);
    }

    if (strlen($cad_numero_processo) < 1 && strlen($cad_numero_processo) > 11) {
        $array_erros['txt_numero_processo'] = "POR FAVOR ENTRE COM O NUMERO PROCESSO VÁLIDO \n";
    }

    if (strlen($cad_ano_processo) != 4) {
        $array_erros['txt_numero_processo'] = "POR FAVOR ENTRE COM O ANO PROCESSO VÁLIDO \n";
    }

    if (strlen($cad_assunto) < 3 && strlen($cad_assunto) > 51) {
        $array_erros['txt_numero_processo'] = "POR FAVOR ENTRE COM O ASSUNTO PROCESSO VÁLIDO \n";
    }

    if (strlen($cad_origem) < 3 && strlen($cad_origem) > 51) {
        $array_erros['txt_numero_processo'] = "POR FAVOR ENTRE COM ORIGEM PROCESSO VÁLIDO \n";
    }

    if (strlen($cad_requerente) < 3 && strlen($cad_requerente) > 51) {
        $array_erros['txt_numero_processo'] = "POR FAVOR ENTRE COM REQUERENTE PROCESSO VÁLIDO \n";
    }

    if (strlen($cad_tel_cel) !== 11 && strlen($cad_tel_fixo) !== 10) {
        $array_erros['txt_telefone'] = 'POR FAVOR ENTRE COM TELEFONE (FIXO/CELULAR) VÁLIDO \n';
    }


    if (empty($array_erros)) {

        try {
            include "../estrutura/conexao/conexao.php";

//           inicia transação
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "UPDATE cadastro_processo ";
            $sql = $sql . " SET dataProcesso = '{$cad_data_processo}',";
            $sql = $sql . " dataProcesso = '{$cad_data_processo}',";
            $sql = $sql . " idAssunto = '{$cad_codigo_assunto}',";
            $sql = $sql . " descricao_assunto = '{$cad_assunto}',";
            $sql = $sql . " idOrigem = '{$cad_codigo_origem}',";
            $sql = $sql . " descricao_origem = '{$cad_origem}',";
            $sql = $sql . " idRequerente = '{$cad_codigo_requerente}',";
            $sql = $sql . " descricao_requerente = '{$cad_requerente}',";
            $sql = $sql . " logradouro = '{$cad_logradouro_requerente}',";
            $sql = $sql . " numero = '{$cad_numero_end_requerente}',";
            $sql = $sql . " complemento = '{$cad_complemento_requerente}',";
            $sql = $sql . " bairro = '{$cad_bairro_requerente}',";
            $sql = $sql . " cidade = '{$cad_cidade_requerente}',";
            $sql = $sql . " uf = '{$cad_uf_requerente}',";
            $sql = $sql . " cep = '{$cad_cep_requerente}',";
            $sql = $sql . " telefone = '{$cad_tel_fixo}',";
            $sql = $sql . " celular = '{$cad_tel_cel}',";
            $sql = $sql . " usuario = '{$_SESSION['LOGIN_USUARIO']}',";
            $sql = $sql . " valor = '{$valor_processo}'";
            $sql = $sql . " WHERE idProcesso = " . $codigo_processo;

            $executa = $pdo->query($sql);

//          inserindo observacao
            fun_limpar_documentos_processo($pdo, $codigo_processo);

//            inserindo_documentos
            fun_alterar_observacao_processo($pdo, $codigo_processo, $observacao_processo);

//            mensagem de sucesso
            $msg = "ALTERADO COM SUCESSO";

//            persiste no banco de dados
            $pdo->commit();
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        } 

//                EMITO MENSAGEM
            echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../alterar_processo.php";
                     </script>';
//            volta o estado anterior do banco de dados
//            fecho conexao
            $pdo = NULL;
        




//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../alterar_processo.php";
        </script>';
    }

// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}

function alterando_proximo_processo($pdo, $tipo_processo, $numero_processo, $numero_processo_banco) {

    if ($numero_processo < $numero_processo_banco) {
        return true;
    } else {
        $sql_tipo = "UPDATE tipo_processo SET numero_proximo_processo = ($numero_processo + 1) WHERE id_tipo_processo  = {$tipo_processo}";
        $executa = $pdo->query($sql_tipo);
    }
}

?>
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

    $cad_tipo_processo = letraMaiuscula($_POST['txt_tipo_processo']);
    $cad_data_processo = letraMaiuscula($_POST['txt_data']);
    $cad_numero_processo = letraMaiuscula($_POST['txt_numero_processo']);
//    saber qua o proximo numero no banco de dados
    $cad_numero_banco_processo = letraMaiuscula($_POST['txt_numero_processo_banco']);
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
//    VALIDACAO
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
//            inserindo dados no cadastro de processo
            $sql = "INSERT INTO cadastro_processo (idProcesso, numeroProcesso, tipoProcesso, anoProcesso, dataProcesso, idAssunto, descricao_assunto, idOrigem, descricao_origem, idRequerente,  descricao_requerente,logradouro, numero,complemento, bairro, cidade, uf, cep,telefone,celular, usuario)";
            $sql = $sql . " VALUES ";
            $sql = $sql . " (null, {$cad_numero_processo}, {$cad_tipo_processo}, {$cad_ano_processo}, '{$cad_data_processo}', '{$cad_codigo_assunto}', '{$cad_assunto}','{$cad_codigo_origem}', '{$cad_origem}', '{$cad_codigo_requerente}','{$cad_requerente}','{$cad_logradouro_requerente}','{$cad_numero_end_requerente}','{$cad_complemento_requerente}','{$cad_bairro_requerente}','{$cad_cidade_requerente}','{$cad_uf_requerente}','{$cad_cep_requerente}','{$cad_tel_fixo}','{$cad_tel_cel}','{$_SESSION['LOGIN_USUARIO']}') ";

            $executa = $pdo->query($sql);
//          retorna ultmia id inserida
            $id_proceso = $pdo->lastInsertId();


//          inserindo observacao
            inserindo_observacao($pdo, $id_proceso, $observacao_processo);

//            inserindo_documentos
            inserindo_documentos($pdo, $id_proceso);

//            inserindo carga do processo
            inserindo_carga($pdo, $id_proceso);

//            alterando proximo numero_processo banco
            alterando_proximo_processo($pdo, $cad_tipo_processo, $cad_numero_processo, $cad_numero_banco_processo);
//            mensagem de sucesso
            $msg = "CADASTRADO COM SUCESSO";

//            persiste no banco de dados
            $pdo->commit();
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }

            //                EMITO MENSAGEM
            echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_processo.php";
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
               location.href = "../../../cadastro_processo.php";
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
<?php

include_once '../estrutura/controle/validar_secao.php';
include_once './function_letraMaiscula.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once '../estrutura/conexao/conexao.php';

    if ($_POST['op'] == 1) {
        func_retorna_proximo_numero_protocolo($pdo);
        exit();
    }
    if ($_POST['op'] == 2) {

//    aplica filtro na string enviada (LetraMaiuscula)
        $numero_protocolo = letraMaiuscula($_POST['numero_protocolo']);
        $ano_protocolo = letraMaiuscula($_POST['ano_protocolo']);

        func_retorna_dados_protocolo($pdo, $numero_protocolo, $ano_protocolo);
        exit();
    }
}

function func_retorna_proximo_numero_protocolo($pdo) {

    try {
        $ano_atual = date('Y');
        $sql = "SELECT numero_protocolo FROM protocolo WHERE ano_protocolo = '{$ano_atual}' ORDER BY numero_protocolo DESC";
        $executa = $pdo->prepare($sql);
        $executa->execute();

        if ($dados = $executa->fetch()) {
            $proximo_numero = str_pad( ++$dados['numero_protocolo'], 6, "0", STR_PAD_LEFT);
        } else {
            $proximo_numero = str_pad(1, 6, "0", STR_PAD_LEFT);
        }


        $var = Array(
            "numero_protocolo" => $proximo_numero,
            "ano_protocolo" => $ano_atual
        );
// convertemos em json e colocamos na tela
        echo json_encode($var);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}

function func_retorna_dados_protocolo($pdo, $numero_protocolo, $ano_protocolo) {

    try {

      
        $sql = "SELECT * ";
        $sql = $sql . " FROM protocolo ";
        $sql = $sql . " WHERE numero_protocolo = '{$numero_protocolo}' AND  ano_protocolo = '{$ano_protocolo}' Limit 1";
        $executa = $pdo->prepare($sql);
        $executa->execute();
//        echo $sql;

        if ($dados = $executa->fetch()) {
            $observacao_protocolo = $dados['observacao_protocolo'];
            $origem_protocolo = $dados['origem_protocolo'];
            $assunto_protocolo = $dados['assunto_protocolo'];
            $requerente_protocolo = $dados['requerente_protocolo'];
            $tipo_processo = $dados['tipo_processo_protocolo'];
            $numero_processo = $dados['numero_processo_protocolo'];
            $ano_processo = $dados['ano_processo_protocolo'];

            $var = Array(
                "achou" => 1,
                "numero_protocolo" => $numero_protocolo,
                "ano_protocolo" => $ano_protocolo,
                "observacao_protocolo" => $observacao_protocolo,
                "origem_protocolo" => $origem_protocolo,
                "assunto_protocolo" => $assunto_protocolo,
                "requerente_protocolo" => $requerente_protocolo,
                "tipo_processo" => $tipo_processo,
                "numero_processo" => $numero_processo,
                "ano_processo" => $ano_processo
            );
        } else {
            $var = Array(
                "achou" => "0",
                "sql " =>$sql
            );
        }
        
      

// convertemos em json e colocamos na tela
        echo json_encode($var);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}

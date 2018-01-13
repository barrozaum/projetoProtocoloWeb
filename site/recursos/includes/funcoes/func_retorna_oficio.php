<?php

include_once '../estrutura/controle/validar_secao.php';
include_once './function_letraMaiscula.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once '../estrutura/conexao/conexao.php';

    if ($_POST['op'] == 1) {
        func_retorna_proximo_numero_oficio($pdo);
        exit();
    }
    if ($_POST['op'] == 2) {

//    aplica filtro na string enviada (LetraMaiuscula)
        $numero_oficio = letraMaiuscula($_POST['numero_oficio']);
        $ano_oficio = letraMaiuscula($_POST['ano_oficio']);

        func_retorna_dados_oficio($pdo, $numero_oficio, $ano_oficio);
        exit();
    }
}

function func_retorna_proximo_numero_oficio($pdo) {

    try {
        $ano_atual = date('Y');
        $sql = "SELECT numero_oficio FROM oficio WHERE ano_oficio = '{$ano_atual}' ORDER BY numero_oficio DESC";
        $executa = $pdo->prepare($sql);
        $executa->execute();

        if ($dados = $executa->fetch()) {
            $proximo_numero = str_pad( ++$dados['numero_oficio'], 6, "0", STR_PAD_LEFT);
        } else {
            $proximo_numero = str_pad(1, 6, "0", STR_PAD_LEFT);
        }


        $var = Array(
            "numero_oficio" => $proximo_numero,
            "ano_oficio" => $ano_atual
        );
// convertemos em json e colocamos na tela
        echo json_encode($var);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}

function func_retorna_dados_oficio($pdo, $numero_oficio, $ano_oficio) {

    try {

      
        $sql = "SELECT * ";
        $sql = $sql . " FROM oficio ";
        $sql = $sql . " WHERE numero_oficio = '{$numero_oficio}' AND  ano_oficio = '{$ano_oficio}' Limit 1";
        $executa = $pdo->prepare($sql);
        $executa->execute();
//        echo $sql;

        if ($dados = $executa->fetch()) {
            $observacao_oficio = $dados['observacao_oficio'];
            $origem_oficio = $dados['origem_oficio'];
            $assunto_oficio = $dados['assunto_oficio'];
            $requerente_oficio = $dados['requerente_oficio'];
            $tipo_processo = $dados['tipo_processo_oficio'];
            $numero_processo = $dados['numero_processo_oficio'];
            $ano_processo = $dados['ano_processo_oficio'];

            $var = Array(
                "achou" => 1,
                "numero_oficio" => $numero_oficio,
                "ano_oficio" => $ano_oficio,
                "observacao_oficio" => $observacao_oficio,
                "origem_oficio" => $origem_oficio,
                "assunto_oficio" => $assunto_oficio,
                "requerente_oficio" => $requerente_oficio,
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

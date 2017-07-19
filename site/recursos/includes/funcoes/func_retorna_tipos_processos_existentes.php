<?php

if(!isset($_SESSION))
{
   session_start();
}

if (isset($_POST['cmd'])) {

    if ($_POST['cmd'] === 'proximo_valor') {
        include_once '../estrutura/conexao/conexao.php';
        include_once '../funcoes/function_letraMaiscula.php';
        $tipo = letraMaiuscula($_POST['tipo']);
        fun_retorna_proximo_numero_processo($pdo, $tipo);
    }
    
    if ($_POST['cmd'] === 'validar_processo') {
        include_once '../estrutura/conexao/conexao.php';
        include_once '../funcoes/function_letraMaiscula.php';
      
        $tipo = letraMaiuscula($_POST['tipo_processo']);
        $numero = letraMaiuscula($_POST['numero_processo']);
        $ano = letraMaiuscula($_POST['ano_processo']);
        fun_valida_existencia_processo($pdo, $tipo, $numero, $ano);
    }
}

// retorna os tipos de processos que posso cadastrar

function fun_retorna_tipo_processo_existente($pdo) {

    $array_retorno[0] = "SELECIONE O TIPO DO PROCESSO";


    $sql_tipo_processo = "SELECT * FROM tipo_processo order by descricao_tipo_processo";
    $query_consulta = $pdo->query($sql_tipo_processo);
    if ($query_consulta->execute()) {
        while ($dados = $query_consulta->fetch()) {
            $array_retorno[$dados['id_tipo_processo']] = $dados['descricao_tipo_processo'];
        }
    }

    return $array_retorno;
}

//função retorna descricao tipo_processo
function fun_retorna_descricao_tipo_processo($pdo, $codigo_tipo_processo) {
    $sql_tipo_processo_processo = "SELECT * FROM tipo_processo WHERE id_tipo_processo = '{$codigo_tipo_processo}'";
    $query_tipo_processo_processo = $pdo->prepare($sql_tipo_processo_processo);
    $query_tipo_processo_processo->execute();
    if ($dados = $query_tipo_processo_processo->fetch()) {
        return $dados['descricao_tipo_processo'];
    } else {
        return "";
    }
}

function fun_retorna_proximo_numero_processo($pdo, $codigo_tipo_processo) {
   $sql_tipo_processo_processo = "SELECT * FROM tipo_processo WHERE id_tipo_processo = '{$codigo_tipo_processo}'";
    $query_tipo_processo_processo = $pdo->prepare($sql_tipo_processo_processo);
    $query_tipo_processo_processo->execute();
    if ($dados = $query_tipo_processo_processo->fetch()) {
        print str_pad( $dados['numero_proximo_processo'], 6, "0", STR_PAD_LEFT);
    }
}


function fun_valida_existencia_processo($pdo, $tipo, $numero, $ano){
   $sql = "SELECT * FROM cadastro_processo ";
   $sql = $sql . " WHERE tipoProcesso = '{$tipo}'";
   $sql = $sql . " AND numeroProcesso = '{$numero}'";
   $sql = $sql . " AND anoProcesso = '{$ano}'";

   
   $query_processo = $pdo->prepare($sql);
    $query_processo->execute();
    if ($query_processo->fetchColumn() > 0) {
        print "TRUE";
    } else {
        print "FALSE";
    }
}


//função para saber se o tipo_processo encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_valida_tipo_no_processo($pdo, $tipoProcesso) {
    $sql_tipo_processo_processo = "SELECT * FROM cadastro_processo WHERE tipoProcesso = '{$tipoProcesso}'";
    $query_tipo_processo_processo = $pdo->prepare($sql_tipo_processo_processo);
    $query_tipo_processo_processo->execute();
    if ($query_tipo_processo_processo->fetchColumn() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}
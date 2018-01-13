<?php

if (!isset($_SESSION)) {
    session_start();
}

//função para saber se o documento encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_retorna_documento_processo($pdo, $codigo_documento) {
    $sql_documento_processo = "SELECT * FROM documento_processo WHERE idDocumento = '{$codigo_documento}'";
    $query_documento_processo = $pdo->prepare($sql_documento_processo);
    $query_documento_processo->execute();
    if ($query_documento_processo->fetchColumn() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//função retorna descricao documento
function fun_retorna_descricao_documento($pdo, $codigo_documento) {
    $sql_documento_processo = "SELECT * FROM documento WHERE idDocumento = '{$codigo_documento}'";
    $query_documento_processo = $pdo->prepare($sql_documento_processo);
    $query_documento_processo->execute();
    if ($dados = $query_documento_processo->fetch()) {
        return $dados['descricao_documento'];
    } else {
        return "";
    }
}

//função retornar documentos no processo
function fun_retorna_documento_presente_processo($pdo, $id_processo) {
    $sql_documento_processo = "SELECT * FROM documento_processo WHERE idProcesso= '{$id_processo}'";
    $query_documento_processo = $pdo->prepare($sql_documento_processo);
    $query_documento_processo->execute();

    $linha = array();
    for ($i = 0; $dados = $query_documento_processo->fetch(); $i++) {


        $linha[$i] = array("codigo_documento" => "{$dados['idDocumento']}", "documento" => "{$dados['descricao_documento']}", "numero" => "{$dados['numeroDocumento']}", "ano" => "{$dados['anoDocumento']}");
    }


// convertemos em json e colocamos na tela
    return $linha;
}

/// inserindo documentos no processo
function inserindo_documentos($pdo, $id_proceso) {

    if (isset($_POST['txt_id_doc'])) {
        $codigo_documento = $_POST['txt_id_doc'];
        $numero_documento = $_POST['txt_numero_doc'];
        $ano_documento = $_POST['txt_ano_doc'];
        $descricao_documento = $_POST['txt_doc'];


//      die(print_r($_POST));
        $quant_linhas = count($codigo_documento);
        for ($i = 0; $i < $quant_linhas; $i++) {
            $codigo_documento[$i];
            $numero_documento[$i];
            $descricao_documento[$i];
            $ano_documento[$i];

            if (empty($codigo_documento[$i])) {
                $codigo_documento[$i] = 0;
            }
            $sql_doc = "INSERT INTO documento_processo (idProcesso, idDocumento, anoDocumento, numeroDocumento, descricao_documento, usuario)";
            $sql_doc = $sql_doc . " VALUES ";
            $sql_doc = $sql_doc . "('{$id_proceso}', '{$codigo_documento[$i]}', {$ano_documento[$i]}, {$numero_documento[$i]}, '{$descricao_documento[$i]}' , '{$_SESSION['LOGIN_USUARIO']}')";

            $executa = $pdo->query($sql_doc);
        }
    }
}

function fun_limpar_documentos_processo($pdo, $id_proceso) {
    $sql_limpa_doc = "DELETE FROM documento_processo WHERE idProcesso = " . $id_proceso;
    if ($executa = $pdo->query($sql_limpa_doc)) {
        return inserindo_documentos($pdo, $id_proceso);
    } else {
        return false;
    }
}

//função retornar todos os tipos de documentos
function fun_retorna_tipos_documentos($pdo) {
   
    $array_retorno[0] = "SELECIONE O TIPO DO DOCUMENTO";


    $sql_tipo_processo = "SELECT * FROM documento ORDER BY descricao_documento ASC";
    $query_consulta = $pdo->query($sql_tipo_processo);
    if ($query_consulta->execute()) {
        while ($dados = $query_consulta->fetch()) {
             $array_retorno[$dados['idDocumento']] = $dados['descricao_documento'];
        }
    }


// convertemos em json e colocamos na tela
    return $array_retorno;
}

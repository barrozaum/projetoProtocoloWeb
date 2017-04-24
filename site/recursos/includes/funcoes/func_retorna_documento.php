<?php

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
        $desc_doc = fun_retorna_descricao_documento($pdo, $dados['idDocumento']);

        $linha[$i] = array("codigo_documento" => "{$dados['idDocumento']}", "documento" => "{$desc_doc}", "numero" => "{$dados['numeroDocumento']}", "ano" => "{$dados['anoDocumento']}");
    }


// convertemos em json e colocamos na tela
    return $linha;
}

/// inserindo documentos no processo
function inserindo_documentos($pdo, $id_proceso) {
    if (isset($_POST['txt_id_doc'])) {
        $codigo_documento = $_POST['txt_id_doc'];
        $nume_documento = $_POST['txt_numero_doc'];
        $ano_documento = $_POST['txt_ano_doc'];


//      die(print_r($_POST));
        $quant_linhas = count($codigo_documento);
        for ($i = 0; $i < $quant_linhas; $i++) {
            $codigo_documento[$i];
            $nume_documento[$i];
            $ano_documento[$i];

            $sql_doc = "INSERT INTO documento_processo (idProcesso, idDocumento, anoDocumento, numeroDocumento, idUsuario)";
            $sql_doc = $sql_doc . " VALUES ";
            $sql_doc = $sql_doc . "({$id_proceso}, {$codigo_documento[$i]}, {$ano_documento[$i]}, {$nume_documento[$i]}, {$_SESSION['LOGIN_ID_USUARIO']})";



            if ($executa = $pdo->query($sql_doc)) {
                $retorna = 1;
            } else {
                $retorna = 0;
            }
        }
    }
    if ($retorna === 1) {
        return true;
    } else {
        return false;
    }
    
}


function fun_limpar_documentos_processo($pdo, $id_proceso){
    $sql_limpa_doc = "DELETE FROM documento_processo WHERE idProcesso = " .$id_proceso;
       if ($executa = $pdo->query($sql_limpa_doc)) {
            return inserindo_documentos($pdo, $id_proceso);  
        } else {
            return false;
        }
}
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
    if($dados = $query_documento_processo->fetch()){
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
    for ($i = 0; $dados = $query->fetch(); $i++) {
        $desc_doc = fun_retorna_descricao_documento($pdo, $dados['idDocumento']);
        
        $linha[$i] = array("Documento => '{$desc_doc}', Numero => '{$dados['numeroDocumento']} , Ano => '{$dados['anoDocumento']}'");   
                
    }
    

// convertemos em json e colocamos na tela
    return $linha;
    
    
}
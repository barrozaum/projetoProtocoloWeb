<?php

//função para saber se o documento encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_retorna_documento_processo($pdo, $codigo_documento) {
    $sql_documento_processo = "SELECT * FROM documentoprocesso WHERE idDocumento = '{$codigo_documento}'";
    $query_documento_processo = $pdo->prepare($sql_documento_processo);
    $query_documento_processo->execute();
    if ($query_documento_processo->fetchColumn() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

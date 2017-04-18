<?php

//função para saber se o assunto encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_retorna_requerente_processo($pdo, $codigo_requerente) {
    $sql_requerente_processo = "SELECT * FROM cadastro_processo WHERE idRequerente = '{$codigo_requerente}'";
    $query_requerente_processo = $pdo->prepare($sql_requerente_processo);
    $query_requerente_processo->execute();
    if ($query_requerente_processo->fetchColumn() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

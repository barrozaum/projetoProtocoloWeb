<?php

if(!isset($_SESSION))
{
   session_start();
}


// função para saber se o assunto encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
// senão for encontrado vai retornar falso
function fun_retorna_setor_processo($pdo, $codigo_setor) {
    $sql_setor_processo = "SELECT * FROM carga_processo WHERE idSetorEntrada = '{$codigo_setor}' or  idSetorOrigem = '{$codigo_setor}'";
    $query_setor_processo = $pdo->prepare($sql_setor_processo);
    $query_setor_processo->execute();
    $resultado = $query_setor_processo->fetchColumn();
  
    if ($resultado > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//------------------------------------------------------------------------------------------------------
// função serve para retorna a descricao do setor presente
function func_retorna_descricao_setor($pdo, $codigo_setor) {
    $sql_desc_setor = "SELECT * FROM setor WHERE idSetor = {$codigo_setor} LIMIT 1";
    $query_desc_setor = $pdo->prepare($sql_desc_setor);
    if ($query_desc_setor->execute()) {
        $dados = $query_desc_setor->fetch();
        return $dados['descDepartamento'];
    } else {
        return "";
    }
}

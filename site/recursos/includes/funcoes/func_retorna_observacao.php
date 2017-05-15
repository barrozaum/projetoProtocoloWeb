<?php

if(!isset($_SESSION))
{
   session_start();
}

//função retorna descricao observacao
function fun_retorna_descricao_observacao($pdo, $id_processo) {
    $sql_observacao_processo = "SELECT * FROM obs WHERE idProcesso = '{$id_processo}'";
    $query_observacao_processo = $pdo->prepare($sql_observacao_processo);
    $query_observacao_processo->execute();
    if ($dados = $query_observacao_processo->fetch()) {
        return $dados['obs'];
    } else {
        return "";
    }
}

/// inserindo observacao no processo
function inserindo_observacao($pdo, $id_processo, $observacao) {
    $sql_obs = "INSERT INTO obs (idObs, idProcesso, obs)";
    $sql_obs = $sql_obs . " VALUES ";
    $sql_obs = $sql_obs . "(null, {$id_processo}, '{$observacao}') ";

    $executa = $pdo->query($sql_obs);
    
}

/// inserindo observacao no processo
function fun_alterar_observacao_processo($pdo, $id_proceso, $observacao_processo) {
    $sql_obs = "UPDATE obs ";
    $sql_obs = $sql_obs . " SET obs = '{$observacao_processo}' ";
    $sql_obs = $sql_obs . " WHERE idProcesso = " . $id_proceso;

    if ($executa = $pdo->query($sql_obs)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

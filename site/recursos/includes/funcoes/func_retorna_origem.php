<?php

if(!isset($_SESSION))
{
   session_start();
}

//função para saber se o origem encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_retorna_origem_processo($pdo, $codigo_origem) {
    $sql_origem_processo = "SELECT * FROM cadastro_processo WHERE idOrigem = '{$codigo_origem}'";
    $query_origem_processo = $pdo->prepare($sql_origem_processo);
    $query_origem_processo->execute();
    if ($query_origem_processo->fetchColumn() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}



//função retorna descricao origem
function fun_retorna_descricao_origem($pdo, $codigo_origem) {
    $sql_origem_processo = "SELECT * FROM origem WHERE idOrigem = '{$codigo_origem}'";
    $query_origem_processo = $pdo->prepare($sql_origem_processo);
    $query_origem_processo->execute();
    if($dados = $query_origem_processo->fetch()){
        return $dados['descricao_origem'];
    } else {
        return "";
    }
}
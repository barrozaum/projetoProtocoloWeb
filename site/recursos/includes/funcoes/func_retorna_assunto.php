<?php

if(!isset($_SESSION))
{
   session_start();
}

//função para saber se o assunto encontra-se em alum processo
// se for encotrado,  vai retornar verdadeiro
//senão for encontrado vai retornar falso
function fun_retorna_assunto_processo($pdo, $codigo_assunto) {
    $sql_assunto_processo = "SELECT * FROM cadastro_processo WHERE idAssunto = '{$codigo_assunto}'";
    $query_assunto_processo = $pdo->prepare($sql_assunto_processo);
    $query_assunto_processo->execute();
    $resultado = $query_assunto_processo->fetchColumn();
  
    if ($resultado > 0) {
        return true;
    } else {
        return false;
    }
}


//função retorna descricao assunto
function fun_retorna_descricao_assunto($pdo, $codigo_assunto) {
    $sql_assunto_processo = "SELECT * FROM assunto WHERE idAssunto = '{$codigo_assunto}'";
    $query_assunto_processo = $pdo->prepare($sql_assunto_processo);
    $query_assunto_processo->execute();
    if($dados = $query_assunto_processo->fetch()){
        return $dados['descricao_assunto'];
    } else {
        return "";
    }
}
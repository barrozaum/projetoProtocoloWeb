<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/fun_log.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/func_retorna_assunto.php';
include_once '../funcoes/func_retorna_origem.php';
include_once '../funcoes/func_retorna_requerente.php';
include_once '../funcoes/func_retorna_documento.php';
include_once '../funcoes/func_retorna_observacao.php';




//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo = letraMaiuscula($_POST['tipo']);
    $numero = letraMaiuscula($_POST['numero']);
    $ano = letraMaiuscula($_POST['ano']);


    $sql = "SELECT * FROM cadastro_processo ";
    $sql = $sql . " WHERE tipoProcesso = {$tipo}";
    $sql = $sql . " AND numeroProcesso = {$numero}";
    $sql = $sql . " AND anoProcesso = {$ano}";
    $sql = $sql . " LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();


    if ($dados = $query->fetch()) {
        $id_processo = $dados['idProcesso'];
//        assunto
        $codigo_assunto = $dados['idAssunto'];
        $descricao_assunto = fun_retorna_descricao_assunto($pdo, $codigo_assunto);
        $complemento_assunto =  $dados['complemento_assunto'];
//        origem
        $codigo_origem = $dados['idOrigem'];
        $descricao_origem = fun_retorna_descricao_origem($pdo, $codigo_origem);
//      requerente
        $dados_requerente = fun_retorna_dados_requerente($pdo, $dados['idRequerente']);
//      documentos
        $documentos_processo = fun_retorna_documento_presente_processo($pdo, $id_processo);

//        observacao
        $observacao_processo = fun_retorna_descricao_observacao($pdo, $id_processo);
        $var = Array(
            "achou" => 1,
            "codigo_processo" => "$id_processo",
            "codigo_assunto" => "$codigo_assunto",
            "descricao_assunto" => "$descricao_assunto",
            "complemento_assunto" => "$complemento_assunto",
            "codigo_origem" => "$codigo_origem",
            "descricao_origem" => "$descricao_origem",
            "requerente" => $dados_requerente,
            "documentos" => $documentos_processo,
            "observacao" => $observacao_processo,
        );
    } else {
        $var = Array(
            "achou" => 0,
            "msg" => "PROCESSO NÃO ENCONTRADO NA BASE DE DADOS",
            "sql" => $sql
        );
    }

// convertemos em json e colocamos na tela
    echo json_encode($var);



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}




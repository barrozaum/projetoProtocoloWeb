<?php

if (!isset($_SESSION)) {
    session_start();
}

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/funcao_formata_data.php';
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
        $valor_processo = $dados['valor'];
        $data_processo = dataBrasileiro($dados['dataProcesso']);
//        assunto
        $codigo_assunto = $dados['idAssunto'];
        $descricao_assunto = $dados['descricao_assunto'];

//        origem
        $codigo_origem = $dados['idOrigem'];
        $descricao_origem = $dados['descricao_origem'];
//      requerente
        $dados_requerente_id = $dados['idRequerente'];
        $dados_requerente_nome = $dados['descricao_requerente'];
        $dados_requerente_logradouro = $dados['logradouro'];
        $dados_requerente_numero_end = $dados['numero'];
        $dados_requerente_complemento = $dados['complemento'];
        $dados_requerente_bairro = $dados['bairro'];
        $dados_requerente_cidade = $dados['cidade'];
        $dados_requerente_uf = $dados['uf'];
        $dados_requerente_cep = $dados['cep'];
        $dados_requerente_telefone = "(" . substr($dados['telefone'], 0, 2) . ")" . substr($dados['telefone'], 2, 8);
        $dados_requerente_celular = "(" . substr($dados['celular'], 0, 2) . ")" . substr($dados['telefone'], 2, 9);
//      documentos
        $documentos_processo = fun_retorna_documento_presente_processo($pdo, $id_processo);

//        observacao
        $observacao_processo = fun_retorna_descricao_observacao($pdo, $id_processo);
        $var = Array(
            "achou" => 1,
            "codigo_processo" => "$id_processo",
            "valor_processo" => "$valor_processo",
            "data_processo" => "$data_processo",
            "codigo_assunto" => "$codigo_assunto",
            "descricao_assunto" => "$descricao_assunto",
            "codigo_origem" => "$codigo_origem",
            "descricao_origem" => "$descricao_origem",
            "codigo_requerente" => $dados_requerente_id,
            "requerente" => $dados_requerente_nome,
            "requerente_logradouro" => $dados_requerente_logradouro,
            "requerente_numero_end" => $dados_requerente_numero_end,
            "requerente_complemento" => $dados_requerente_complemento,
            "requerente_bairro" => $dados_requerente_bairro,
            "requerente_cidade" => $dados_requerente_cidade,
            "requerente_uf" => $dados_requerente_uf,
            "requerente_cep" => $dados_requerente_cep,
            "requerente_telefone" => $dados_requerente_telefone,
            "requerente_celular" => $dados_requerente_celular,
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




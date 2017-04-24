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

//função retorna descricao requerente
function fun_retorna_descricao_requerente($pdo, $codigo_requerente) {
    $sql_requerente_processo = "SELECT * FROM requerente WHERE idRequerente = '{$codigo_requerente}'";
    $query_requerente_processo = $pdo->prepare($sql_requerente_processo);
    $query_requerente_processo->execute();
    if ($dados = $query_requerente_processo->fetch()) {
        return $dados['requerente'];
    } else {
        return "";
    }
}

//função retorna descricao requerente
function fun_retorna_dados_requerente($pdo, $codigo_requerente) {
    $sql_requerente_processo = "SELECT * FROM requerente WHERE idRequerente = '{$codigo_requerente}'";
    $query_requerente_processo = $pdo->prepare($sql_requerente_processo);
    $query_requerente_processo->execute();
    if ($dados = $query_requerente_processo->fetch()) {
        $codigo_requerente = $dados['idRequerente'];
        $requerente = $dados['requerente'];
        $logradouro = $dados['logradouro'];
        $numero_end = $dados['numeroEnd'];
        $complemento = $dados['complemento'];
        $bairro = $dados['bairro'];
        $cidade = $dados['cidade'];
        $uf = $dados['uf'];
        $cep = $dados['cep'];
        $tel = $dados['tel'];
        $cel = $dados['cel'];
    } else {
        $id_requerente = "";
        $requerente = "";
        $logradouro = "";
        $numero_end = "";
        $complemento = "";
        $bairro = "";
        $cidade = "";
        $uf = "";
        $cep = "";
        $tel = "";
        $cel = "";
        
    }

    $var = Array(
        "codigo_requerente" => "$codigo_requerente",
        "requerente" => "$requerente",
        "logradouro" => "$logradouro",
        "numero_end" => "$numero_end",
        "complemento" => "$complemento",
        "bairro" => "$bairro",
        "cidade" => "$cidade",
        "uf" => "$uf",
        "cep" => "$cep",
        "tel" => "$tel",
        "cel" => "$cel"
    );


// convertemos em json e colocamos na tela
    return $var;
}

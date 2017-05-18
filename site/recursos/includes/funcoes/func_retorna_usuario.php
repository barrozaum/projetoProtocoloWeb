<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['id'])) {
    if ($_POST['id'] == 1) {
        $codigo_usuario = $_POST['txt_cod_usu'];
        func_retorna_dados_permissao($codigo_usuario);
    }
}

function func_retorna_usuario($pdo, $codigo_usuario) {
    $sql_usuario_sistema = "SELECT * FROM usuario WHERE idUsuario = '{$codigo_usuario}'";
    $query_usuario_sistema = $pdo->prepare($sql_usuario_sistema);
    $query_usuario_sistema->execute();
    if ($dados = $query_usuario_sistema->fetch()) {
        return $dados['login'];
    } else {
        return "";
    }
}

function func_retorna_dados_permissao($codigo_usuario) {
//    incluindo conexao
    include_once '../estrutura/conexao/conexao.php';
//incluindo setor
    include_once './func_retorna_setor.php';

    $sql = "SELECT idSetor FROM usuario WHERE idUsuario = '{$codigo_usuario}'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $dados = $query->fetch();
    $setor = func_retorna_descricao_setor($pdo, $dados['idSetor']);



//    consultando permissões do usuario
    $sql_p = "SELECT * FROM permissao WHERE idUsuario = '{$codigo_usuario}'";
    $query_p = $pdo->prepare($sql_p);
    $query_p->execute();

//    array de permissoes
    for ($i = 0; $dados_p = $query_p->fetch(); $i++) {
        $array[$i] = $dados_p['id_programa_menu'];
    }

    if (isset($array)) {


        $array = array(
            "achou" => "s",
            "setor" => $setor,
            "permissao" => $array
        );
    } else {
        $array = array(
            "achou" => 'n',
            "setor" => $setor,
            "permissao" => array()
        );
    }
    print json_encode($array);
    $pdo = null;
}

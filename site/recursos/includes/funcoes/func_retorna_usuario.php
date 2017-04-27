<?php
function func_retorna_usuario($pdo, $codigo_usuario){
    $sql_usuario_sistema = "SELECT * FROM usuario WHERE idUsuario = '{$codigo_usuario}'";
    $query_usuario_sistema = $pdo->prepare($sql_usuario_sistema);
    $query_usuario_sistema->execute();
    if ($dados = $query_usuario_sistema->fetch()) {
        return $dados['login'];
    } else {
        return "";
    }
}
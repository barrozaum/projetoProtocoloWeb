<?php 
//insere permissao sistema de procotocolo
function func_insere_permissoes_protocolo($pdo, $id_colaborador, $perfil) {

    if ($perfil === "0") {
        $permissoes = array(4, 6, 13, 14, 15, 16, 17, 18, 19, 20, 26, 31, 36, 37);
    } else {
        $permissoes = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37);
    }

    foreach ($permissoes as $valores) {

        $sql_inserir_permissao = "INSERT INTO permissao (idUsuario, id_programa_menu, usuario) VALUES ('$id_colaborador', '$valores', '{$_SESSION['LOGIN_USUARIO']}')";
        $query_inserir = $pdo->prepare($sql_inserir_permissao);
        $query_inserir->execute();
    }
}
//insere permissao sistema de procotocolo
function func_insere_permissoes_juridico($pdo, $id_colaborador) {

        $sql_inserir_permissao_juridico =  $sql = "INSERT INTO permissao_juridico (id_usuario, nivel_acesso) VALUES ('{$id_colaborador}', '0')";
        $query_inserir_juridico = $pdo->prepare($sql_inserir_permissao_juridico);
        $query_inserir_juridico->execute();
    
}

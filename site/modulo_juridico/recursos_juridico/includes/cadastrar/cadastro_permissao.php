<?php

include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../../../../recursos/includes/funcoes/function_letraMaiscula.php';

    $id_usuario_selecionado = letraMaiuscula($_POST['txt_colaborador']);
    $perfil_acesso = letraMaiuscula($_POST['txt_perfil']);
    try {
        include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';
        $pdo->beginTransaction();
        $sql = "UPDATE permissao_juridico SET nivel_acesso = '{$perfil_acesso}' WHERE id_usuario = '{$id_usuario_selecionado}'";
        $query = $pdo->prepare($sql);
        $query->execute();
        $pdo->commit();
//        mensagem
        $msg = " ALTERADO COM SUCESSO !!!";
        $_SESSION['PERMISSAO_MENU_JURIDICO'] = $perfil_acesso;
    } catch (Exception $exc) {
        $msg = $exc->getMessage();
    }


    echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../man_permissao.php";
                     </script>';



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../../logout.php"));
}
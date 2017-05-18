<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
//        validacao
        include '../funcoes/function_letraMaiscula.php';
        $colaborador = letraMaiuscula($_POST['txt_colaborador']);
        if ($colaborador < 1 || strlen($colaborador) > 2) {
            echo '<script>window.alert("Colaborador Inválido");
               location.href = "../../../man_permissao.php";
        </script>';
            exit();
        }

//        conexao
        include_once '../estrutura/conexao/conexao.php';

        $pdo->beginTransaction();

        $sql_deleta = "DELETE FROM permissao WHERE idUsuario = '{$colaborador}'";
        $query_del = $pdo->prepare($sql_deleta);
        $query_del->execute();

        if (isset($_POST['permissao'])) {
            $permissoes = $_POST['permissao'];
            foreach ($permissoes as $valores) {
                
                $sql_inserir_permissao = "INSERT INTO permissao (idUsuario, id_programa_menu, usuario) VALUES ('$colaborador', '$valores', '{$_SESSION['LOGIN_USUARIO']}')";
                $query_inserir = $pdo->prepare($sql_inserir_permissao);
                $query_inserir->execute();
            }
            
        }else{
            $permissoes = array();
        }
            
//        isso só vai acontecer se o usuario logado for o mesmo que está colocando permissao
        if($colaborador === $_SESSION['LOGIN_ID_USUARIO']){
            $_SESSION['PERMISSAO_MENU'] = $permissoes;
        }
        $pdo->commit();
        //          mensagem de sucesso
        $msg = "CADASTRADO COM SUCESSO !!!";
    } catch (Exception $ex) {
        $msg = $ex->getMessage();
    }
    //        fecho conexao
    $pdo = null;
    echo '<script>window.alert("' . $msg . '");
               location.href = "../../../man_permissao.php";
             </script>';







// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
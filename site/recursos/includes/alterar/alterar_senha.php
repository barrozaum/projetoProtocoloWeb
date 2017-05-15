<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// ARMAZENAR ERROS
    $msg;

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');

    $senha_atual = letraMaiuscula($_POST['senha_atual']);
    $nova_senha = letraMaiuscula($_POST['nova_senha']);
    $conf_nova_senha = letraMaiuscula($_POST['conf_nova_senha']);

    if (strlen($senha_atual) < 2) {
        $msg .= " SENHA ATUAL INVÁLIDA!!! <br />";
    }
    if (strlen($nova_senha) < 2) {
        $msg.= " NOVA SENHA INVÁLIDA !!! <br />";
    }
    if (strlen($conf_nova_senha) < 2) {
        $msg.= " CONFIRMA NOVA SENHA INVÁLIDA !!! <br />";
    }

    if (empty($msg)) {
//        critografo a senha
        $senha_criptografada_nova = md5($nova_senha); // nova senha
        $senha_criptografada_atual = md5($senha_atual); // senha antiga
        try {
            include_once '../estrutura/conexao/conexao.php';

            $sql = "SELECT senha FROM usuario WHERE idUsuario = '{$_SESSION['LOGIN_ID_USUARIO']}' AND senha = '{$senha_criptografada_atual}'";
            $query = $pdo->prepare($sql);
            $query->execute();
            $resultado = $query->fetchColumn();

            if ($resultado > 0) {
                $sql_altera = "UPDATE usuario  SET criado_por = '{$_SESSION['LOGIN_USUARIO']}', senha = '{$senha_criptografada_nova}' WHERE idUsuario = '{$_SESSION['LOGIN_ID_USUARIO']}'";
                $query_altera = $pdo->prepare($sql_altera);
                $query_altera->execute();
                   $msg = "<div class='alert alert-success'> ALTERADO COM SUCESSO  </div>";
                
            } else {
               $msg = "<div class='alert alert-danger'> SENHA ATUAL INVÁLIDA  </div>";
            }

            
        } catch (Exception $exc) {
            $msg = $exc->getMessage();
        } 

            print $msg;
            $pdo = null;
        
    } else {
        print "<div class='alert alert-danger'>{$msg}</div>";
    }

// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>

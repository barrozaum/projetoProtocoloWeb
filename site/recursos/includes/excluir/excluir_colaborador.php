<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_codigo']);
    $colaborador_login = letraMaiuscula($_POST['txt_excluir_colaborador_login']);
    $colaborador_nome = letraMaiuscula($_POST['txt_excluir_colaborador_nome']);
    $colaborador_sobrenome = letraMaiuscula($_POST['txt_excluir_colaborador_sobrenome']);
    $colaborador_email = letraMaiuscula($_POST['txt_excluir_colaborador_email']);
    $colaborador_permissao = letraMaiuscula($_POST['txt_excluir_colaborador_permissao']);
    $colaborador_setor = letraMaiuscula($_POST['txt_excluir_colaborador_setor']);


// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($colaborador_login) < 3 && strlen($colaborador_login) > 50) {
        $array_erros['txt_novo_login'] = 'POR FAVOR ENTRE COM LOGIN VÁLIDO \n';
    }


    if (strlen($colaborador_email) < 3 && strlen($colaborador_email) > 50) {
        $array_erros['txt_novo_email'] = 'POR FAVOR ENTRE COM EMAIL VÁLIDO \n';
    }

    if (strlen($colaborador_nome) < 3 && strlen($colaborador_nome) > 50) {
        $array_erros['txt_novo_nome'] = 'POR FAVOR ENTRE COM NOME VÁLIDO \n';
    }

    if (strlen($colaborador_sobrenome) < 2 && strlen($colaborador_sobrenome) > 50) {
        $array_erros['txt_novo_sobrenome'] = 'POR FAVOR ENTRE COM SOBRENOME VÁLIDO \n';
    }

    if (strlen($colaborador_permissao) < 0 && strlen($colaborador_permissao) > 2) {
        $array_erros['txt_permissao'] = 'POR FAVOR ENTRE COM PERMISSÃO VÁLIDA \n';
    }

    if (strlen($colaborador_setor) < 3 && strlen($colaborador_setor) > 50) {
        $array_erros['txt_codigo_setor'] = 'POR FAVOR ENTRE COM SETOR VÁLIDO \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';


        try {
//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "UPDATE usuario SET criado_por = '{$_SESSION['LOGIN_USUARIO']}', status = 1 WHERE idUsuario = '{$codigo_Letra_Maiscula}'";
            $executa = $pdo->query($sql);
         
            $msg = "BLOQUEADO COM SUCESSO!!!";

//          salvo alteração no banco de dados
            $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        } 
//                FECHO CONEXAO
            $pdo = null;
//                EMITO MENSAGEM
            echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../novo_usuario.php";
                     </script>';
        
//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../novo_usuario.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
        ?>
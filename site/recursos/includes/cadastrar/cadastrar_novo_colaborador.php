<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    incluindo programa pra dar permissões
    include ('../funcoes/func_permissoes.php');
    
    
//    aplica filtro na string enviada (LetraMaiuscula)
    $colaborador_login = letraMaiuscula($_POST['txt_novo_login']);
    $colaborador_email = letraMaiuscula($_POST['txt_novo_email']);
    $colaborador_nome = letraMaiuscula($_POST['txt_novo_nome']);
    $colaborador_sobrenome = letraMaiuscula($_POST['txt_novo_sobrenome']);
    $colaborador_setor = letraMaiuscula($_POST['txt_setor']);
    $colaborador_codigo_setor = letraMaiuscula($_POST['txt_codigo_setor']);
    $colaborador_permissao = letraMaiuscula($_POST['txt_novo_permissao']);
    $colaborador_senha = letraMaiuscula($_POST['txt_novo_senha']);
    $colaborador_conf_senha = letraMaiuscula($_POST['txt_novo_conf_senha']);


// filtro pra validar DADOS FORMULARIO
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

    if (strlen($colaborador_codigo_setor) < 1 && strlen($colaborador_codigo_setor) > 12) {
        $array_erros['txt_codigo_setor'] = 'POR FAVOR ENTRE COM SETOR VÁLIDO \n';
    }

    if (strlen($colaborador_permissao) < 0 && strlen($colaborador_permissao) > 2) {
        $array_erros['txt_permissao'] = 'POR FAVOR ENTRE COM PERMISSÃO VÁLIDA \n';
    }

    if (strlen($colaborador_senha) < 2 && strlen($colaborador_senha) > 12) {
        $array_erros['txt_senha'] = 'POR FAVOR ENTRE COM SENHA VÁLIDA \n';
    }
    if (strlen($colaborador_conf_senha) < 2 && strlen($colaborador_conf_senha) > 12) {
        $array_erros['txt_conf_senha'] = 'POR FAVOR ENTRE COM CONFIRMAÇÃO SENHA VÁLIDA \n';
    }

    if ($colaborador_conf_senha !== $colaborador_senha) {
        $array_erros['txt_senhas_invalidas'] = "SENHAS NÃO CONFEREM ";
    } else {
        $colaborador_senha = md5($colaborador_conf_senha);
    }



// verifico se tem erro na validação
    if (empty($array_erros)) {

        try {
//      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  

            $sql = "INSERT INTO usuario (login, nome, email, idSetor, senha, sobrenome, perfil, criado_por) ";
            $sql = $sql . " VALUES";
            $sql = $sql . " ('{$colaborador_login}', '{$colaborador_nome}', '{$colaborador_email}','{$colaborador_codigo_setor}', '{$colaborador_senha}', '{$colaborador_sobrenome}', '{$colaborador_permissao}','{$_SESSION['LOGIN_USUARIO']}')";
//      execução com comando sql    
            $executa = $pdo->query($sql);

            $id_colaborador = $pdo->lastInsertId();

//            insere permissões de acordo com o nivel
            func_insere_permissoes_protocolo($pdo, $id_colaborador, $colaborador_permissao);

//            insere permissão consulta no modulo juridico caso o usuário seja do setor juridico
            if($colaborador_codigo_setor === '14'){
                func_insere_permissoes_juridico($pdo, $id_colaborador);
            }
            
            
//          salvo alteração no banco de dados
            $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */

            $msg = "CADASTRADO COM SUCESSO ";
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
//        fecho conexao
        $pdo = null;

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
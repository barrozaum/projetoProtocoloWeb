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
    $codigo_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_codigo']);
    $colaborador_login = letraMaiuscula($_POST['txt_alterar_colaborador_login']);
    $colaborador_email = letraMaiuscula($_POST['txt_alterar_colaborador_email']);
    $colaborador_nome = letraMaiuscula($_POST['txt_alterar_colaborador_nome']);
    $colaborador_sobrenome = letraMaiuscula($_POST['txt_alterar_colaborador_sobrenome']);
    $colaborador_setor = letraMaiuscula($_POST['txt_alterar_colaborador_setor']);
    $colaborador_codigo_setor = letraMaiuscula($_POST['txt_alterar_colaborador_codigo_setor']);
    $colaborador_permissao = letraMaiuscula($_POST['txt_alterar_colaborador_permissao']);
    $colaborador_senha = letraMaiuscula($_POST['txt_alterar_novo_senha']);
    $colaborador_conf_senha = letraMaiuscula($_POST['txt_alterar_novo_conf_senha']);



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
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';


        try {
//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "UPDATE usuario SET criado_por = '{$_SESSION['LOGIN_USUARIO']}', ";
            if ($colaborador_conf_senha !== "INFORME_SUA_SENHA") {
                   $colaborador_senha = md5($colaborador_conf_senha);

                $sql = $sql . "senha = '{$colaborador_senha}',  ";
            }
            $sql = $sql . "nome = '{$colaborador_nome}',  ";
            $sql = $sql . "email = '{$colaborador_email}',  ";
            $sql = $sql . "idSetor = '{$colaborador_codigo_setor}',  ";
            $sql = $sql . "sobrenome = '{$colaborador_sobrenome}',  ";
            $sql = $sql . "perfil = '{$colaborador_permissao}'  ";
            $sql = $sql . " WHERE idUsuario = '{$codigo_Letra_Maiscula}'";
            $executa = $pdo->query($sql);

            $msg = "ALTERADO COM SUCESSO!!!";

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
        
?>
        <?php

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
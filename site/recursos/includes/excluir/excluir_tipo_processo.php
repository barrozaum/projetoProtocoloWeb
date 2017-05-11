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
    $descricao_Letra_Maiscula = letraMaiuscula($_POST['txt_excluir_descricao']);


// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_Letra_Maiscula) > 2) {
        $descricao = $descricao_Letra_Maiscula;
    } else {
        $array_erros['txt_descricao'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO VÁLIDA \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//        tenho que verificar se o assunto está presente em algum processo
        if (fun_valida_tipo_no_processo($pdo, $codigo_Letra_Maiscula)) {
            die('<script>window.alert("TIPO PROCESSO Não Pode ser Excluido, Pois ja está cadastrado em Processo !!!");location.href = "../../../cadastro_tipo_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else {

            try {
//      Inicio a transação com o banco        
                $pdo->beginTransaction();

//      Comando sql a ser executado  
                $sql = "UPDATE tipo_processo SET usuario = '{$_SESSION['LOGIN_USUARIO']}' WHERE id_tipo_processo = '{$codigo_Letra_Maiscula}'";
                $executa = $pdo->query($sql);
                $sql1 = "DELETE FROM  tipo_processo WHERE id_tipo_processo = '{$codigo_Letra_Maiscula}'";
                $executa1 = $pdo->query($sql1);

                $msg = "EXCLUIDO COM SUCESSO!!!";

//          salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
            } catch (Exception $ex) {
                $msg = "ERRO AO EXCLUIR !!!";
            } finally {
//                FECHO CONEXAO
                $pdo = null;
//                EMITO MENSAGEM
                echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_tipo_processo.php";
                     </script>';
            }
        }
        ?>
        <?php

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_tipo_processo.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
<?php
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_origem.php';

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

//        tenho que verificar se o origem está presente em algum processo
        if (fun_retorna_origem_processo($pdo, $codigo_Letra_Maiscula)) {
            die('<script>window.alert("Origem Não Pode ser Excluido, Pois ja está cadastrado em Processo !!!");location.href = "../../../cadastro_origem.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else {

            try{
//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "UPDATE origem SET usuario = '{$_SESSION['LOGIN_USUARIO']}' WHERE idOrigem = '{$codigo_Letra_Maiscula}'";
            $executa = $pdo->query($sql);

            $sql_1 = "DELETE FROM  origem WHERE idOrigem = '{$codigo_Letra_Maiscula}'";
            $executa1 = $pdo->query($sql_1);

//            mensagem de sucesso
                $msg = "DELETADO COM SUCESSO";

//            PERSISTO NO BANCO DE DADOS
                $pdo->commit();
            } catch (Exception $e) {
                $msg = $e->getMessage();
            }

//                FECHO CONEXAO
            $pdo = null;
//                EMITO MENSAGEM
            echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_origem.php";
                     </script>';
        }

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_origem.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
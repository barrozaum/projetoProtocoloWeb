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
//    aplica filtro na string enviada (LetraMaiuscula)
    $descricao_Letra_Maiscula = letraMaiuscula($_POST['txt_descricao']);


// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_Letra_Maiscula) > 2 && strlen($descricao_Letra_Maiscula) < 51) {
        $descricao = $descricao_Letra_Maiscula;
    } else {
        $array_erros['txt_descricao'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO VÁLIDA \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

        try {
            //      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "INSERT INTO origem (idOrigem, descricao_origem, usuario) VALUES (null, '$descricao', '{$_SESSION['LOGIN_USUARIO']}')";
//      execução com comando sql    
            $executa = $pdo->query($sql);

//            mensagem de sucesso
            $msg = "CADASTRADO COM SUCESSO !!!";
            
//            salvando no banco de dados
            $pdo->commit();
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        } 
//        fecho conexao
            $pdo = null;

//        emitir menssagem
            echo '<script>window.alert("' . $msg . '");
               location.href = "../../../cadastro_origem.php";
        </script>';
        

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
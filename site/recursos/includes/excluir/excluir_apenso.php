<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once '../funcoes/function_letraMaiscula.php';
//   dados processo pai
     $id_processo_pai = letraMaiuscula($_POST['txt_codigo_processo']);
    
    try {
//        conexao 
        include_once '../estrutura/conexao/conexao.php';

//        funcao de apenso
        include_once '../funcoes/func_apenso_processo.php';

        $pdo->beginTransaction();

//        LIMPANDO OS APENSOS
        fun_excluindo_apenso($pdo, $id_processo_pai);
        
        
//       descobrindo os processos filhos
        if (isset($_POST['txt_array_codigo_anexo'])) {

            $codigo_apenso = $_POST['txt_array_codigo_anexo'];
            
            $quant_linhas = count($codigo_apenso);
            for ($i = 0; $i < $quant_linhas; $i++) {
             $id_processo_filho = letraMaiuscula($codigo_apenso[$i]);
            
              
              fun_inserindo_apenso($pdo, $id_processo_pai, $id_processo_filho, $_SESSION['LOGIN_USUARIO']);
              
            }
        }

        $pdo->commit();



        $msg = "DESAPENSADO COM SUCESSO !!!";
    } catch (Exception $exc) {
        $msg = $exc->getMessage();
    }

    //        fecho conexao
        $pdo = null;

        echo '<script>window.alert("' . $msg . '");
               location.href = "../../../excluir_apenso.php";
             </script>';

//  dados do filho 
// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
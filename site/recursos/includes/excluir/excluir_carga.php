<?php
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/fun_log.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_carga = letraMaiuscula($_POST['txt_carga']);
   
// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "DELETE FROM carga_processo WHERE idCarga = '{$codigo_carga}'";
//      execução com comando sql    
            $executa = $pdo->query($sql);

//      Verifico se comando foi realizado      
            if (!$executa) {
//          Caso tenha errro 
//          lanço erro na tela
                die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../excluir_carga.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
            }else{//          die();
//          salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
            }
        


        $pdo = null;
        ?>
  <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Carga Excluída com Sucesso !!!"; ?> ");
            location.href = "../../../excluir_carga.php";
        </script>
        <?php

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../excluir_carga.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
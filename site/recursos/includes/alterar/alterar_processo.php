<?php

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/fun_log.php';
include_once '../funcoes/func_retorna_documento.php';
include_once '../funcoes/func_retorna_observacao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_processo = (int) letraMaiuscula($_POST['txt_codigo_processo']);
    $tipo_processo = (int) letraMaiuscula($_POST['txt_tipo_processo']);
    $numero_processo = (int) letraMaiuscula($_POST['txt_numero_processo']);
    $ano_processo = (int) letraMaiuscula($_POST['txt_ano_processo']);
    $codigo_assunto_processo = (int) letraMaiuscula($_POST['txt_codigo_assunto']);
    $complemento_assunto_processo = letraMaiuscula($_POST['txt_complemento_assunto']);
    $codigo_origem_processo = (int) letraMaiuscula($_POST['txt_codigo_origem']);
    $codigo_requerente_processo = (int) letraMaiuscula($_POST['txt_codigo_requerente']);
    $observacao_processo = letraMaiuscula($_POST['txt_obs_processo']);



// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
        $pdo->beginTransaction();

//      Comando sql a ser executado  
        $sql = "UPDATE cadastro_processo ";
        $sql = $sql . " SET idAssunto = '{$codigo_assunto_processo}',";
        $sql = $sql . "  complemento_assunto = '{$complemento_assunto_processo}',";
        $sql = $sql . "  idOrigem = '{$codigo_origem_processo}',";
        $sql = $sql . "  idRequerente = '{$codigo_requerente_processo}'";
        $sql = $sql . " WHERE idProcesso = " . $codigo_processo;
//        die($sql);

//      execução com comando sql    
        $executa = $pdo->query($sql);

//      Verifico se comando foi realizado      
        if (!$executa) {
//          Caso tenha errro 
//          lanço erro na tela
            die('<script>window.alert("Erro ao Alterar  !!!");location.href = "../../../alterar_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else if(!fun_limpar_documentos_processo($pdo, $codigo_processo)){
            die('<script>window.alert("Erro ao Alterar Documentos  !!!");location.href = "../../../alterar_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
            
        } else if(!fun_alterar_observacao_processo($pdo, $codigo_processo, $observacao_processo)){
            die('<script>window.alert("Erro ao Alterar Observacao  !!!");location.href = "../../../alterar_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        }else{    
            
//          die();
//          salvo alteração no banco de dados
            $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
        }
//        fecho conexao
        $pdo = null;
        ?>
        <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Processo Alterado com Sucesso !!!"; ?> ");
            location.href = "../../../alterar_processo.php";
        </script>

        <?php
//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../alterar_processo.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
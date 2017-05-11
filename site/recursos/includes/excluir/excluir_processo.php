<?php
//die(print_r($_POST));
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_anexos.php';

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

// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';


//      Inicio a transação com o banco        
        $pdo->beginTransaction();


//        verifico se o processo tem algum anexo

        if (fun_limpar_anexos_processo($pdo, $codigo_processo)) {
//            caso comando para limpar anexo seja concluido com sucesso
            $sql_del_proc = "DELETE FROM cadastro_processo WHERE idProcesso = " . $codigo_processo;
            //      execução com comando sql    
            $executa = $pdo->query($sql_del_proc);

//      Verifico se comando foi realizado      
            if (!$executa) {
//          Caso tenha errro 
//          lanço erro na tela
                $pdo->rollback();   
                die('<script>window.alert("Erro ao Excluir Anexos  !!!");location.href = "../../../excluir_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
            }
        } else {
            $pdo->rollback();
            die('<script>window.alert("Erro ao Excluir Processo  !!!");location.href = "../../../excluir_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        }

        $pdo->commit();
        $pdo = null;
        ?>
        <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Processo Excluído com Sucesso !!!"; ?> ");
            location.href = "../../../excluir_processo.php";
        </script>
        <?php
//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_processo.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
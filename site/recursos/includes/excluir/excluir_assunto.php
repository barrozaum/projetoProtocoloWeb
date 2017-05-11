<?php
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_retorna_assunto.php';

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
        if (fun_retorna_assunto_processo($pdo, $codigo_Letra_Maiscula)) {
            die('<script>window.alert("Assunto Não Pode ser Excluido, Pois ja está cadastrado em Processo !!!");location.href = "../../../cadastro_assunto.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else {

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "UPDATE assunto SET  usuario ='{$_SESSION['LOGIN_USUARIO']}'  WHERE idAssunto = '{$codigo_Letra_Maiscula}'";
            $executa = $pdo->query($sql);

            $sql_1 = "DELETE FROM  assunto WHERE idAssunto = '{$codigo_Letra_Maiscula}'";
//      execução com comando sql    
            $executa_1 = $pdo->query($sql_1);

//      Verifico se comando foi realizado      
             if (!$executa || !$executa_1) {
//          Caso tenha errro 
//          lanço erro na tela
                die('<script>window.alert("Erro ao Excluir  !!!");location.href = "../../../cadastro_assunto.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
            } else {

//          die();
//          salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
            }
        }


        $pdo = null;
        ?>
        <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Assunto Excluído com Sucesso !!!"; ?> ");
            location.href = "../../../cadastro_assunto.php";
        </script>
        <?php
//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_assunto.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
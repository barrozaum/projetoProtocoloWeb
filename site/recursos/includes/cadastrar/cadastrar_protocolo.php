<?php
//die(print_r($_POST));
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/funcao_formata_data.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
    
    $numero_protocolo = letraMaiuscula($_POST['txt_numero_protocolo']);
    $ano_protocolo = letraMaiuscula($_POST['txt_ano_protocolo']);
    $requerente_protocolo = letraMaiuscula($_POST['txt_requerente']);
    $assunto_protocolo = letraMaiuscula($_POST['txt_assunto']);
    $origem_protocolo = letraMaiuscula($_POST['txt_origem']);
    $obs_protocolo= letraMaiuscula($_POST['txt_obs_protocolo']);
    $tipo_processo_protocolo= letraMaiuscula($_POST['txt_tipo_processo']);
    $data_protocolo= dataAmericano(date('d/m/Y'));
    $numero_processo_protocolo= letraMaiuscula($_POST['txt_numero_processo_protocolo']);
    $ano_processo_protocolo= letraMaiuscula($_POST['txt_ano_processo_protocolo']);
    
    
// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($numero_protocolo) !== 6) {
         $array_erros['txt_numero_protocolo'] = 'POR FAVOR ENTRE COM O NUMERO DO OFICIO VÁLIDO \n';
    }
    if (strlen($ano_protocolo) !== 4) {
         $array_erros['txt_ano_protocolo'] = 'POR FAVOR ENTRE COM O ANO DO OFICIO VÁLIDO \n';
    }
    if (strlen($requerente_protocolo) < 3 || strlen($requerente_protocolo) > 50) {
         $array_erros['txt_requerente_protocolo'] = 'POR FAVOR ENTRE COM O REQUERENTE DO OFICIO VÁLIDO \n';
    }
    if (strlen($assunto_protocolo) < 3 || strlen($assunto_protocolo) > 50) {
         $array_erros['txt_assunto_protocolo'] = 'POR FAVOR ENTRE COM O ASSUNTO DO OFICIO VÁLIDO \n';
    }
    if (strlen($origem_protocolo) < 3 || strlen($origem_protocolo) > 50) {
         $array_erros['txt_origem_protocolo'] = 'POR FAVOR ENTRE COM A ORIGEM DO OFICIO VÁLIDO \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

       try {
            //      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "INSERT INTO protocolo (numero_protocolo, 	ano_protocolo, data_protocolo, requerente_protocolo, observacao_protocolo,origem_protocolo, assunto_protocolo, numero_processo_protocolo, ano_processo_protocolo, tipo_processo_protocolo, usuario)";
            $sql = $sql . " VALUES ";
            $sql = $sql . "  ('{$numero_protocolo}', '{$ano_protocolo}', '{$data_protocolo}','{$requerente_protocolo}', '{$obs_protocolo}', '{$origem_protocolo}', '{$assunto_protocolo}', '{$numero_processo_protocolo}', '{$ano_processo_protocolo}', '{$tipo_processo_protocolo}', '{$_SESSION['LOGIN_USUARIO']}')"; 
           
//      execução com comando sql    
            $executa = $pdo->query($sql);

//            mensagem de sucesso
            $msg = "OFICIO CADASTRADO COM SUCESSO !!!";
            
//            salvando no banco de dados
            $pdo->commit();
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        } 
//        fecho conexao
            $pdo = null;

//        emitir menssagem
            echo '<script>window.alert("' . $msg . '");
               location.href = "../../../cadastro_protocolo.php";
        </script>';
        

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_protocolo.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
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
    
    $numero_oficio = letraMaiuscula($_POST['txt_numero_oficio']);
    $ano_oficio = letraMaiuscula($_POST['txt_ano_oficio']);
    $requerente_oficio = letraMaiuscula($_POST['txt_requerente']);
    $assunto_oficio = letraMaiuscula($_POST['txt_assunto']);
    $origem_oficio = letraMaiuscula($_POST['txt_origem']);
    $obs_oficio= letraMaiuscula($_POST['txt_obs_oficio']);
    $tipo_processo_oficio= letraMaiuscula($_POST['txt_tipo_processo']);
    $data_oficio= dataAmericano(date('d/m/Y'));
    $numero_processo_oficio= letraMaiuscula($_POST['txt_numero_processo_oficio']);
    $ano_processo_oficio= letraMaiuscula($_POST['txt_ano_processo_oficio']);
    
    
// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($numero_oficio) !== 6) {
         $array_erros['txt_numero_oficio'] = 'POR FAVOR ENTRE COM O NUMERO DO OFICIO VÁLIDO \n';
    }
    if (strlen($ano_oficio) !== 4) {
         $array_erros['txt_ano_oficio'] = 'POR FAVOR ENTRE COM O ANO DO OFICIO VÁLIDO \n';
    }
    if (strlen($requerente_oficio) < 3 || strlen($requerente_oficio) > 50) {
         $array_erros['txt_requerente_oficio'] = 'POR FAVOR ENTRE COM O REQUERENTE DO OFICIO VÁLIDO \n';
    }
    if (strlen($assunto_oficio) < 3 || strlen($assunto_oficio) > 50) {
         $array_erros['txt_assunto_oficio'] = 'POR FAVOR ENTRE COM O ASSUNTO DO OFICIO VÁLIDO \n';
    }
    if (strlen($origem_oficio) < 3 || strlen($origem_oficio) > 50) {
         $array_erros['txt_origem_oficio'] = 'POR FAVOR ENTRE COM A ORIGEM DO OFICIO VÁLIDO \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

       try {
            //      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
            $sql = "INSERT INTO oficio (numero_oficio, 	ano_oficio, data_oficio, requerente_oficio, observacao_oficio,origem_oficio, assunto_oficio, numero_processo_oficio, ano_processo_oficio, tipo_processo_oficio, usuario)";
            $sql = $sql . " VALUES ";
            $sql = $sql . "  ('{$numero_oficio}', '{$ano_oficio}', '{$data_oficio}','{$requerente_oficio}', '{$obs_oficio}', '{$origem_oficio}', '{$assunto_oficio}', '{$numero_processo_oficio}', '{$ano_processo_oficio}', '{$tipo_processo_oficio}', '{$_SESSION['LOGIN_USUARIO']}')"; 
           
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
               location.href = "../../../cadastro_oficio.php";
        </script>';
        

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_oficio.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
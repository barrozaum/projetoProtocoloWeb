<?php
//die(print_r($_POST));

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
    $requerente_Letra_Maiscula = letraMaiuscula($_POST['txt_requerente']);
    $tel_fixo_Letra_Maiscula = letraMaiuscula($_POST['txt_tel_fixo']);
    $tel_celular_Letra_Maiscula = letraMaiuscula($_POST['txt_tel_cel']);
    $cep_Letra_Maiscula = letraMaiuscula($_POST['txt_cep_requerente']);
    $logradouro_Letra_Maiscula = letraMaiuscula($_POST['txt_logradouro_requerente']);
    $bairro_Letra_Maiscula = letraMaiuscula($_POST['txt_bairro_requerente']);
    $cidade_Letra_Maiscula = letraMaiuscula($_POST['txt_cidade_requerente']);
    $uf_Letra_Maiscula = letraMaiuscula($_POST['txt_uf_requerente']);
    $numero_endereco_Letra_Maiscula = letraMaiuscula($_POST['txt_numero_requerente']);
    $complemento_Letra_Maiscula = letraMaiuscula($_POST['txt_complemento_requerente']);


// filtro pra validar
    if (strlen($requerente_Letra_Maiscula) > 2 && strlen($requerente_Letra_Maiscula) < 51) {
        $requerente = $requerente_Letra_Maiscula;
    } else {
        $array_erros['txt_requerente'] = 'POR FAVOR ENTRE COM A REQUERENTE VÁLIDO \n';
    }

    if (strlen($cep_Letra_Maiscula) === 8) {
        $cep = $cep_Letra_Maiscula;
    } else {
        $array_erros['txt_cep'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($logradouro_Letra_Maiscula) > 2 && strlen($logradouro_Letra_Maiscula) < 51) {
        $logradouro = $logradouro_Letra_Maiscula;
    } else {
        $array_erros['txt_logradouro'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($numero_endereco_Letra_Maiscula) > 0 && strlen($numero_endereco_Letra_Maiscula) < 11) {
        $numero_endereco = $numero_endereco_Letra_Maiscula;
    } else {
        $array_erros['txt_logradouro'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($tel_celular_Letra_Maiscula) != 11 && strlen($tel_fixo_Letra_Maiscula) != 10) {
        $array_erros['txt_telefon'] = 'POR FAVOR ENTRE COM TELEFONE (FIXO/CELULAR) VÁLIDO \n';
    }


// verifico se tem erro na validação
    if (empty($array_erros)) {

         try{
//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
        $pdo->beginTransaction();

//      Comando sql a ser executado  
        $sql = "INSERT INTO requerente ";
        $sql = $sql . "(idRequerente, requerente, logradouro, numeroEnd, complemento, bairro, cidade, uf, cep, tel, cel,usuario)";
        $sql = $sql . " VALUES ";
        $sql = $sql . " (null, '{$requerente}','{$logradouro}','{$numero_endereco}', '{$complemento_Letra_Maiscula}', '{$bairro_Letra_Maiscula}', '{$cidade_Letra_Maiscula}', '{$uf_Letra_Maiscula}', '{$cep}', '{$tel_fixo_Letra_Maiscula}', '{$tel_celular_Letra_Maiscula}','{$_SESSION['LOGIN_USUARIO']}')";

//      execução com comando sql    
        $executa = $pdo->query($sql);
        
//      mensagem de sucesso
           $msg = "CADASTRADO COM SUCESSO !!!";
//          salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
            } catch (Exception $ex) {
            
                 $msg = $ex->getMessage();
            } 
//                FECHO CONEXAO
                $pdo = null;
//                EMITO MENSAGEM
                echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../cadastro_requerente.php";
                     </script>';
            
        

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_requerente.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
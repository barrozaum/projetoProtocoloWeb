<?php
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/fun_log.php';
include_once '../funcoes/func_retorna_requerente.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_Letra_Maiscula = (int) letraMaiuscula($_POST['txt_alterar_codigo']);
    $requerente_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_requerente']);
    $tel_fixo_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_tel_fixo']);
    $tel_celular_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_tel_cel']);
    $cep_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_cep_requerente']);
    $logradouro_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_logradouro_requerente']);
    $bairro_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_bairro_requerente']);
    $cidade_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_cidade_requerente']);
    $uf_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_uf_requerente']);
    $numero_endereco_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_numero_requerente']);
    $complemento_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_complemento_requerente']);

// filtro pra validar
    if (strlen($requerente_Letra_Maiscula) > 2) {
        $requerente = $requerente_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_requerente'] = 'POR FAVOR ENTRE COM A REQUERENTE VÁLIDO \n';
    }

    if (strlen($cep_Letra_Maiscula) === 8) {
        $cep = $cep_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_cep'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($logradouro_Letra_Maiscula) > 2) {
        $logradouro = $logradouro_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_logradouro'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($numero_endereco_Letra_Maiscula) > 0 && strlen($numero_endereco_Letra_Maiscula) < 11) {
        $numero_endereco = $numero_endereco_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_logradouro'] = 'POR FAVOR ENTRE COM A CEP VÁLIDO \n';
    }

    if (strlen($tel_celular_Letra_Maiscula) < 11 && strlen($tel_fixo_Letra_Maiscula) < 11) {
        $array_erros['txt_alterar_cep'] = 'POR FAVOR ENTRE COM TELEFONE (FIXO/CELULAR) VÁLIDO \n';
    }




// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

//      Comando sql a ser executado  
             $sql = "UPDATE requerente SET";
            $sql = $sql  . " requerente = '{$requerente}', ";
            $sql = $sql  . " logradouro = '{$logradouro}', ";
            $sql = $sql  . " numeroEnd = '{$numero_endereco}', ";
            $sql = $sql  . " complemento = '{$complemento_Letra_Maiscula}', ";
            $sql = $sql  . " bairro = '{$bairro_Letra_Maiscula}', ";
            $sql = $sql  . " cidade = '{$cidade_Letra_Maiscula}', ";
            $sql = $sql  . " uf= '{$uf_Letra_Maiscula}', ";
            $sql = $sql  . " cep = '{$cep}', ";
            $sql = $sql  . " tel= '{$tel_fixo_Letra_Maiscula}', ";
            $sql = $sql  . " cel = '{$tel_celular_Letra_Maiscula}' ";
            $sql = $sql  . " WHERE idRequerente = '{$codigo_Letra_Maiscula}' ";
            
            
//      execução com comando sql    
            $executa = $pdo->query($sql);

//      Verifico se comando foi realizado      
            if (!$executa) {
//          Caso tenha errro 
//          lanço erro na tela
                die('<script>window.alert("Erro ao Alterar  !!!");location.href = "../../../cadastro_requerente.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
            } else if (fun_log_requerente($pdo, 'A', $sql) == FALSE) {
                die('<script>window.alert("Erro ao Alterado Log !!!");location.href = "../../../cadastro_requerente.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
            } else {

//          die();
//          salvo alteração no banco de dados
                $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
            }
        


        $pdo = null;
        ?>
        <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Requerente Alterado com Sucesso !!!"; ?> ");
            location.href = "../../../cadastro_requerente.php";
        </script>
        <?php
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
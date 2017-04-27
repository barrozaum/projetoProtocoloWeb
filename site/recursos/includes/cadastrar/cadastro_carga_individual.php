<?php

//die(print_r($_POST));

//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/func_carga_processo.php';
include_once '../funcoes/funcao_formata_data.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_processo = letraMaiuscula($_POST['txt_codigo_processo']);
    $data_carga = letraMaiuscula($_POST['txt_data']);
    $parecer_carga = letraMaiuscula($_POST['txt_parecer']);
    $codigo_setor_carga = letraMaiuscula($_POST['txt_codigo_setor']);
    $sequencia_carga = (int) letraMaiuscula($_POST['txt_num_sequencia_carga']);

    if ($codigo_processo < 1) {
        $array_erros['txt_codigo'] = "POR FAVOR ENTRE COM UM PROCESO VÁLIDO !!! \n";
    }

    if (!validar_estrutura_data($data_carga)) {
        $array_erros['txt_data_carga'] = "POR FAVOR INFORME UMA DATA VÁLIDA !!! \n";
    }

    if ($parecer_carga > 240) {
        $array_erros['txt_parecer_carga'] = "POR FAVOR INFORME UM PARECER VÁLIDO !!! \n";
    }

    if ($codigo_setor_carga < 1) {
        $array_erros['txt_setor_carga'] = "POR FAVOR ENTRE COM UM SETOR VÁLIDO !!! \n";
    }

    if (empty($array_erros)) {
        
        
//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
        $pdo->beginTransaction();

        $data_carga_americana = dataAmericano($data_carga);
//      Comando sql a ser executado  
       if(!cadastro_carga_processo($pdo, $codigo_processo, $data_carga_americana, $parecer_carga, $codigo_setor_carga, $sequencia_carga)){
               die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../cadastro_carga_individual.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
       }else{
 //          salvo alteração no banco de dados
            $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
        }
//        fecho conexao
        $pdo = null;
        ?>
        <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Carga Cadastrada com Sucesso !!!"; ?> ");
            location.href = "../../../cadastro_carga_individual.php";
        </script>


        <?php

//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
              location.href = "../../../cadastro_carga_individual.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
        ?>
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
    $data_carga = letraMaiuscula($_POST['txt_data']);
    $codigo_setor_origem_processo = letraMaiuscula($_POST['txt_alterar_colaborador_codigo_setor']); // origem
    $codigo_setor_carga = letraMaiuscula($_POST['txt_codigo_setor']); // destino


    if (!validar_estrutura_data($data_carga)) {
        $array_erros['txt_data_carga'] = "POR FAVOR INFORME UMA DATA VÁLIDA !!! \n";
    }

    if ($codigo_setor_origem_processo < 1) {
        $array_erros['txt_setor_carga_origem'] = "POR FAVOR ENTRE COM UM SETOR ORIGEM VÁLIDO !!! \n";
    }
    if ($codigo_setor_carga < 1) {
        $array_erros['txt_setor_carga_destino'] = "POR FAVOR ENTRE COM UM SETOR ENTRADA VÁLIDO !!! \n";
    }

    if (empty($array_erros)) {

        try {

//      Conexao com o banco de dados  
            include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
            $pdo->beginTransaction();

            $data_carga_americana = dataAmericano($data_carga);
//      Comando sql a ser executado  

            
           if (isset($_POST['txt_array_codigo_processo'])) {
                $id_processo = $_POST['txt_array_codigo_processo'];
                $ultima_carga = $_POST['txt_array_ultima_carga'];
                $sequencia_carga = $_POST['txt_array_sequencia_carga'];
                $parecer_carga = $_POST['txt_array_parecer_processo'];


        //      die(print_r($_POST));
                $quant_linhas = count($id_processo);
                for ($i = 0; $i < $quant_linhas; $i++) {
                   
                    cadastro_carga_processo($pdo, letraMaiuscula($id_processo[$i]), $data_carga_americana,  letraMaiuscula($parecer_carga[$i]),$codigo_setor_origem_processo, $codigo_setor_carga,  letraMaiuscula($sequencia_carga[$i]), 0);
                    cadastro_carga_apensos($pdo,  letraMaiuscula($id_processo[$i]), $data_carga_americana,  letraMaiuscula($parecer_carga[$i]), $codigo_setor_origem_processo, $codigo_setor_carga, 1);

                }
            }
   
            
       
//            mensagem de sucesso
            $msg = "CADASTRADO COM SUCESSO !!!";
            
            
//          salvo alteração no banco de dados
            $pdo->commit();
            } catch (Exception $e) {
            $msg = $e->getMessage();
        }
//            fecho conexao
        $pdo = null;

        echo '<script>window.alert("' . $msg . '");
               location.href = "../../../cadastro_carga_coletiva.php";
        </script>';



//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
              location.href = "../../../cadastro_carga_coletiva.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
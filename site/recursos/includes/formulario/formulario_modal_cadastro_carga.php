<?php
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/func_telas_de_erros.php';
include_once '../funcoes/func_carga_processo.php';
include_once '../funcoes/func_apenso_processo.php';
//macete para nao aparecer setor do usuario
$_SESSION['NAO_MOSTRAR_SETOR'] = "";

if ($_POST['id'] === '1') {
    $tipo_processo = letraMaiuscula($_POST['txt_tipo_processo']);
    $numero_processo = letraMaiuscula($_POST['txt_numero_processo']);
    $ano_processo = letraMaiuscula($_POST['txt_ano_processo']);
    $codigo_setor_usuario_carga = letraMaiuscula($_POST['codigo_setor_usuario_carga']); // SETOR DO USUARIO 

    mostrar_formulario($pdo, $tipo_processo, $numero_processo, $ano_processo, $codigo_setor_usuario_carga);
    $pdo = null;
}

function mostrar_formulario($pdo, $tipo_processo, $numero_processo, $ano_processo, $codigo_setor_usuario_carga) {
//   buscando dados do processo
//    consulta para saber se o processo existe
    $sql = "SELECT * FROM cadastro_processo ";
    $sql = $sql . " WHERE tipoProcesso = '{$tipo_processo}'";
    $sql = $sql . " AND numeroProcesso = {$numero_processo}";
    $sql = $sql . " AND anoProcesso = '{$ano_processo}'";
    $sql = $sql . " LIMIT 1";
    $query = $pdo->query($sql);
    $query->execute();
    if (($dados = $query->fetch()) == true) {
        $id_processo = $dados['idProcesso'];
        $descricao_assunto = $dados['descricao_assunto'];
        $descricao_origem = $dados['descricao_origem'];
        $requerente = $dados['descricao_requerente'];
        $apensado = fun_verifica_apenso($pdo, $id_processo);
    } else {
        criar_modal_erros("ERROR !!!", "Desculpe, porém não encotramos o processo desejado !!!");
        die();
    }
    ?>

    <form name="formulario_carga" id="id_formulario_carga" action="recursos/includes/cadastrar/cadastro_carga_individual.php" method="POST">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <p class="text-info">ADICIONAR PROCESSO !!!</p></h4>
            <div id="error_modal"></div>
        </div>
        <div class="modal-body">
           <?php 
                criar_input_hidden("conf_id_processo", array(), $id_processo);
                criar_input_hidden("conf_numero_processo", array(), $numero_processo);
                criar_input_hidden("conf_ano_processo", array(), $ano_processo);
                criar_input_hidden("conf_tipo_processo", array(), $tipo_processo);
                criar_input_hidden("conf_apenso_processo", array(), $apensado);
           
           ?>

            <div class="row">
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Requerente', 'requerente', 'requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), $requerente);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Assunto', 'assunto', 'assunto', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Assunto'), $descricao_assunto);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Origem', 'origem', 'origem', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Origem'), $descricao_origem);
                    ?>
                </div>
            </div>

            <?php
            $processo_pode_apensar = "nao";
            if ($apensado == 1) { // 1 processo filho, 3 processo que é pai e filho 
                mostrar_mensagem("PROCESSO NÃO PODE SOFRER CARGA, O MESMO ENCONTRA-SE APENSADO !!!");
            } else {
                global $id_ultima_carga;
                global $seq_carga;
                $processo_pode_apensar = processo_pode_dar_carga($pdo, $id_processo, $codigo_setor_usuario_carga);
                if ($processo_pode_apensar !== "sim") {
                    mostrar_mensagem($processo_pode_apensar);
                }else{
                      mostrar_parecer($id_ultima_carga, $seq_carga);
                }
            }
            ?>


        </div>

        <div class="modal-footer">
            <?php
            
            if ($processo_pode_apensar !== "sim") {
                print '<button type="button" class="btn btn-default"  data-dismiss="modal" >SAIR </button>';
            } else {
                print '<button type="button" class="btn btn-success" id="id_btn_enviar_processo" data-dismiss="modal">ADICIONAR </button>';
            }
            ?>
        </div>
    </form>
    <?php
}
?>


<?php

function mostrar_mensagem($msg) {
    print "<p class='text-danger'>{$msg}</p>";
}


function mostrar_parecer($id_ultima_carga, $seq_carga) {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?php
            //   INPUT -                              
            criar_textarea('PARECER', 'parecer', 'parecer', '', array('required' => 'true', 'maxlength' => '240', 'placeholder' => 'Informe o Parecer do Processo'));
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            //   INPUT -                              
            criar_input_hidden('ultima_carga_processo', array(), $id_ultima_carga);
            criar_input_hidden('num_sequencia_carga', array(), $seq_carga);
            ?>
        </div>
    </div>
    <?php
}
?>
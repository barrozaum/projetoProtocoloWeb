<?php
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/func_telas_de_erros.php';
include_once '../funcoes/func_retorna_assunto.php';
include_once '../funcoes/func_retorna_origem.php';
include_once '../funcoes/func_retorna_requerente.php';
include_once '../funcoes/func_carga_processo.php';


if ($_POST['id'] === '1') {
    $tipo_processo = letraMaiuscula($_POST['txt_tipo_processo']);
    $numero_processo = letraMaiuscula($_POST['txt_numero_processo']);
    $ano_processo = letraMaiuscula($_POST['txt_ano_processo']);

    mostrar_formulario($pdo, $tipo_processo, $numero_processo, $ano_processo);
    $pdo = null;
}

function mostrar_formulario($pdo, $tipo_processo, $numero_processo, $ano_processo) {
//   buscando dados do processo
//    consulta para saber se o processo existe
    $sql = "SELECT * FROM cadastro_processo ";
    $sql = $sql . " WHERE tipoProcesso = '{$tipo_processo}'";
    $sql = $sql . " AND numeroProcesso = '{$numero_processo}'";
    $sql = $sql . " AND anoProcesso = '{$ano_processo}'";
    $sql = $sql . " LIMIT 1";
    $query = $pdo->query($sql);
    $query->execute();
    if (($dados = $query->fetch()) == true) {
        $id_processo = $dados['idProcesso'];
        $descricao_assunto = fun_retorna_descricao_assunto($pdo, $dados['idAssunto']) . ' ' . $dados['complemento_assunto'];
        $descricao_origem = fun_retorna_descricao_origem($pdo, $dados['idOrigem']);
        $requerente = fun_retorna_descricao_requerente($pdo, $dados['idRequerente']);
        $idAnexado = $dados['idAnexo'];
    } else {
        criar_modal_erros("ERROR !!!", "Desculpe, porém não encotramos o processo desejado !!!");
        die();
    }
    ?>

    <form name="formulario_carga" id="id_formulario_carga" action="recursos/includes/cadastrar/cadastro_recebimento_individual.php" method="POST">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <p class="text-info">RECEBENDO PROCESSO !!!</p></h4>
            <div id="error_modal"></div>
        </div>
        <div class="modal-body">
            <?php
//                código do processo
            criar_input_hidden('codigo_processo', array(), $id_processo);
            ?>


            <div class="row">
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Requerente', 'requerente', 'requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), $requerente);
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    criar_input_data('Data Recebimento', 'data', 'data', array('required' => 'true', 'placeholder' => '00/00/0000'), date('d/m/Y'));
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
            global $id_ultima_carga;
            $posso_receber_processo = fun_posso_receber_processo_por_numero($pdo, $id_processo);
            if ($posso_receber_processo !== "sim") {
                mostrar_mensagem($posso_receber_processo);
            } else {
                criar_input_hidden('carga', array('required' => 'true'), $id_ultima_carga);
            }
            ?>

        </div>

        <div class="modal-footer">
            <?php
            if ($posso_receber_processo !== "sim") {
                print '<button type="button" class="btn btn-default"  data-dismiss="modal" >SAIR </button>';
            } else {
                print '<button type="button" class="btn btn-success" id="id_btn_enviar_carga">ENVIAR </button>';
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
?>
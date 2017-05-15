<?php
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/func_telas_de_erros.php';
include_once '../funcoes/func_carga_processo.php';
//macete para nao aparecer setor do usuario
$_SESSION['NAO_MOSTRAR_SETOR'] = "";

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
        $descricao_assunto = $dados['descricao_assunto'];
        $descricao_origem = $dados['descricao_origem'] ;
        $requerente = $dados['descricao_requerente'];
        $idAnexado = 0;
    } else {
        criar_modal_erros("ERROR !!!", "Desculpe, porém não encotramos o processo desejado !!!");
        die();
    }
    ?>

<form name="formulario_carga" id="id_formulario_carga" action="recursos/includes/cadastrar/cadastro_carga_individual.php" method="POST">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <p class="text-info">CARGA PROCESSO !!!</p></h4>
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
                    criar_input_data('Data Carga', 'data', 'data', array('required' => 'true', 'placeholder' => '00/00/0000'), date('d/m/Y'));
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
            if ($idAnexado != 0) {
                mostrar_mensagem("PROCESSO NÃO PODE RECEBER CARGA, O MESMO ENCONTRA-SE ANEXADO !!!");
            } else {
                global $id_ultima_carga;
                global $seq_carga;
                $processo_pode_dar_carga = processo_pode_dar_carga($pdo, $id_processo, $id_ultima_carga);
                if ($processo_pode_dar_carga !== "sim") {
                    mostrar_mensagem($processo_pode_dar_carga);
                } else {
                    mostrar_parecer($id_ultima_carga, $seq_carga);
                }
            }
            ?>


        </div>

        <div class="modal-footer">
            <?php
            if ($processo_pode_dar_carga !== "sim") {
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
            criar_input_text_com_lupa('SETOR', 'setor', 'setor', array('required' => 'true', 'readonly' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Setor'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]', 'lupa_setor');
            criar_input_hidden('codigo_setor', array(), '');
            criar_input_hidden('ultima_carga_processo', array(), $id_ultima_carga);
            criar_input_hidden('num_sequencia_carga', array(), $seq_carga);
            ?>
        </div>
    </div>
    <?php
}
?>
<?php

function mostrar_mensagem($msg) {
    print "<p class='text-danger'>{$msg}</p>";
}
?>
<?php
//valido seção
include_once '../estrutura/controle/validar_secao.php';
//validacao
include_once '../funcoes/function_letraMaiscula.php';
//incluo função para listar obs
include_once '../funcoes/func_retorna_observacao.php';
// criar input
include_once '../funcoes/funcaoCriacaoInput.php';
//funcao para saber o setor do processo
include_once '../funcoes/func_carga_processo.php';

//processo pai é o processo que vai ser o apenso

try {

// abrindo conexao com o banco 
    include_once '../estrutura/conexao/conexao.php';
    
//    incluindo validador apenso
    include_once '../funcoes/func_apenso_processo.php';

    $tipo = letraMaiuscula($_POST['tipo']);
    $numero = letraMaiuscula($_POST['numero']);
    $ano = letraMaiuscula($_POST['ano']);


    $sql = "SELECT * FROM cadastro_processo ";
    $sql = $sql . " WHERE tipoProcesso = {$tipo}";
    $sql = $sql . " AND numeroProcesso = {$numero}";
    $sql = $sql . " AND anoProcesso = {$ano}";
    $sql = $sql . " LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();


    if ($dados = $query->fetch()) {
        $id_processo = $dados['idProcesso'];
        $apensado = 0;
        $descricao_assunto = $dados['descricao_assunto'];
        $descricao_requerente = $dados['descricao_requerente'];
        $observacao_processo = fun_retorna_descricao_observacao($pdo, $id_processo);

        fun_mostrar_dados_processo_pai($pdo, $apensado, $id_processo, $numero, $tipo, $ano, $descricao_assunto, $descricao_requerente, $observacao_processo);
    } else {
        fun_mostrar_erro('PROCESSO NÃO ENCONTRADO !!!');
    }
} catch (Exception $ex) {
    print $ex->getMessage();
}

$pdo = null;

function fun_mostrar_dados_processo_pai($pdo, $apensado,  $id_processo, $numero_processo, $tipo_processo, $ano_processo, $descricao_assunto, $descricao_requerente, $observacao_processo) {
    ?>
    <form  method="post" action="adicionar_apenso.php">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div id="msg_erro"></div>
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CONFIRME DADOS PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                criar_input_hidden("apensado", array(), $apensado);
                                criar_input_hidden("processo", array(), $id_processo);
                                criar_input_hidden("numero_processo", array(), $numero_processo);
                                criar_input_hidden("tipo_processo", array(), $tipo_processo);
                                criar_input_hidden("ano_processo", array(), $ano_processo);
                                criar_input_text('ASSUNTO', 'assunto', 'assunto', array('required' => 'true', 'readonly' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Assunto'), $descricao_assunto, '');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                criar_input_text('Requerente', 'requerente', 'requerente', array('required' => 'true', 'readonly' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), $descricao_requerente, '');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                criar_textarea('OBSERVAÇÃO', 'obs_processo', 'obs_processo', $observacao_processo, array('readonly' => 'true', 'maxlength' => '254', 'rows' => '9'));
                                ?>
                            </div>
                        </div>
                        <?php
                        if (processo_pode_dar_carga($pdo, $id_processo, 1) === "sim") {
                            ?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-success" id="id_prosseguir_com_apenso">Prosseguir</button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
}

function fun_mostrar_erro($msg) {
    ?>
    <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
        <div class="alert alert-danger text-center"><?php print $msg; ?></div>
    </div>
    <?php
}

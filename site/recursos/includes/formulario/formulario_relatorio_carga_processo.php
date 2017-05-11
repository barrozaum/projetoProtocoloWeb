<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
//inclusao da conexao com o banco de dados
include_once '../estrutura/conexao/conexao.php';

?>
<?php
if (empty($_POST['id'])) {
    formulario($pdo);
}
?>

<?php

function formulario($pdo) {
    ?>


<form  method="post" action="recursos/includes/relatorio/relatorio_cargas_processo.php" id="id_formulario_processo" target="_blank">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div id="msg_erro"></div>
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">RELATÓRIO ANDAMENTO DO PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_select('Tipo Processo', 'tipo_processo', 'tipo_processo', array('required' => 'true'), fun_retorna_tipo_processo_existente($pdo), '');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Número', 'numero_processo', 'numero_processo', array('required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Ano', 'ano_processo', 'ano_processo', array('required' => 'true', 'maxlength' => '4', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), date('Y'));
                                ?>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="id_gerar_relatorio">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>

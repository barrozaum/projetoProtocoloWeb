<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../../../../recursos/includes/funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
include_once '../../../../recursos/includes/funcoes/func_retorna_tipos_processos_existentes.php';
?>
<?php
if (empty($_POST['id'])) {
    formulario();
}
?>

<?php

function formulario() {
    ?>


    <form  method="post" action="#">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div id="msg_erro"></div>
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CONSULTA RÉU PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text('REU-PROCESSO', 'reu_processo', 'reu_processo', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Réu do Processo'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                criar_input_data('Data Inicial', 'dt_inicial', 'dt_inicial', array('required' => 'true', 'placeholder' => '00/00/0000'), '', 'somente numeros');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                criar_input_data('Data Final', 'dt_final', 'dt_final', array('required' => 'true', 'placeholder' => '00/00/0000'), date('d/m/Y'), 'somente numeros');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="id_buscar_reu">Procurar</button>
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


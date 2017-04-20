<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
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
                    <div class="panel-heading text-center">CONSULTA REQUERENTE PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa('REQUERENTE', 'requerente', 'requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]', 'lupa_requerente');
                                criar_input_hidden('codigo_requerente', array(), '');
//                              campos nao utilizaveis
                                criar_input_hidden('tel_fixo', array(), '');
                                criar_input_hidden('tel_cel', array(), '');
                                criar_input_hidden('cep_requerente', array(), '');
                                criar_input_hidden('logradouro_requerente', array(), '');
                                criar_input_hidden('bairro_requerente', array(), '');
                                criar_input_hidden('cidade_requerente', array(), '');
                                criar_input_hidden('uf_requerente', array(), '');
                                criar_input_hidden('numero_requerente', array(), '');
                                criar_input_hidden('complemento_requerente', array(), '');
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
                                <button type="button" class="btn btn-success" id="id_buscar_requerente">Procurar</button>
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


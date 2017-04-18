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
                    <div class="panel-heading text-center">CONSULTA DOCUMENTO PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa('DOCUMENTO', 'documento', 'documento', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Documento'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]', 'lupa_documento');
                                criar_input_hidden('codigo_documento', array(), '');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                criar_input_text('Número', 'numero_documento', 'numero_documento', array('required' => 'true', 'placeholder' => '000', 'onkeypress'=>'return SomenteNumero(event)'), '', 'somente numeros');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                criar_input_text('Ano', 'ano_documento', 'ano_documento', array('required' => 'true', 'placeholder' => '0000' , 'onkeypress'=>'return SomenteNumero(event)'), '', 'somente numeros');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="id_buscar_documento">Procurar</button>
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


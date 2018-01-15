<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
// RETORNA TIPOS PROCESSO
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
//abrindo conexao
include_once '../estrutura/conexao/conexao.php';
?>
<?php
if (empty($_POST['id'])) {
    formularioCadastro($pdo);
}
?>

<?php

function formularioCadastro($pdo) {
    ?>


    <form  method="post" id="formularioConsultaProtocolado" action="#">    
        <div class="mainbox col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    
                    <div class="panel-heading text-center">CONSULTA PROTOCOLO</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="msg_erro"></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('NUMERO', 'consulta_numero_protocolo', 'consulta_numero_protocolo', array('required' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('ANO', 'consulta_ano_protocolo', 'consulta_ano_protocolo', array('required' => 'true', 'maxlength' => '4', 'placeholder' => 'xxxx', 'onkeypress' => 'return SomenteNumero(event)'),'');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa_e_com_adicionar('REQUERENTE', 'requerente', 'requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]', 'lupa_requerente');
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
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa_e_com_adicionar('ASSUNTO', 'assunto', 'assunto', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'Informe o Assunto'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                criar_input_hidden('codigo_assunto', array(), '');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                criar_textarea('OBSERVAÇÃO', 'obs_protocolo', 'obs_protocolo', '', array('required' => 'true', 'maxlength' => '240', 'rows' => '5'));
                                ?>
                            </div>
                        </div> 
                    </div>

                    <div class="row text-center">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info" id="btn_consultar_protocolado">Consultar</button>
                            <br /><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    

    <?php
}
?>

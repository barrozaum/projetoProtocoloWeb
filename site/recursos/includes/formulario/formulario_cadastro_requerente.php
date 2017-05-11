<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
?>
<?php
if (empty($_POST['id'])) {
    formularioCadastro();
} else if ($_POST['id'] == 1) {
    formularioAlterar();
} else if ($_POST['id'] == 2) {
    formularioExcluir();
}
?>

<?php

function formularioCadastro() {
    ?>

    <form  method="post" action="recursos/includes/cadastrar/cadastrar_requerente.php">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CADASTRO REQUERENTE</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Requerente', 'requerente', 'requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text_telefone('Tel(fixo)', 'tel_fixo', 'tel_fixo', array('required' => 'true', 'maxlength' => '12', 'placeholder' => '(xx)xxxxxxx'), '', 'somente os numeros');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text_telefone('Tel(Celular)', 'tel_cel', 'tel_cel', array('required' => 'true', 'maxlength' => '13', 'placeholder' => '(xx)xxxxxxxx'), '', 'somente os numeros');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text_cep('CEP', 'cep_requerente', 'cep_requerente', array('required' => 'true', 'maxlength' => '8', 'placeholder' => 'xx.xxx-xxx'), '', 'somente os numeros', ' this.id, txt_cep_requerente, txt_logradouro_requerente, txt_bairro_requerente, txt_cidade_requerente, txt_uf_requerente');
                                ?>
                            </div>
                            <div class="col-sm-8">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Logradouro', 'logradouro_requerente', 'logradouro_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Logradouro'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-5">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Bairro', 'bairro_requerente', 'bairro_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Bairro'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>
                            <div class="col-sm-5">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Cidade', 'cidade_requerente', 'cidade_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Cidade'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>
                            <div class="col-sm-2">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Uf', 'uf_requerente', 'uf_requerente', array('required' => 'true', 'maxlength' => '2', 'placeholder' => 'Informe a Uf'), '', 'Conter 2 caracteres [a-z A-Z]');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-2">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Número End', 'numero_requerente', 'numero_requerente', array('required' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx'), '', 'somente os numeros');
                                ?>
                            </div>
                            <div class="col-sm-8">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Complemento', 'complemento_requerente', 'complemento_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Complemento'), '', 'caracteres [a-z A-Z]');
                                ?>
                            </div>
                        </div> 
                        <!-- bloco dos dados do requerente-->
                    </div>
                </div> 

                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success" >Cadastrar</button>
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


<?php

function formularioAlterar() {
//   pega o valor vindo pela url
//   explode em array 
//    passa vetor nos campos

    $campos = explode("|", $_POST['codigo']);
    ?>


    <form method="post" action="recursos/includes/alterar/alterar_requerente.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ALTERAR REQUERENTE</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    //   INPUT - Codigo Bairro                             
                    criar_input_text('Codigo', 'alterar_codigo', 'alterar_codigo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $campos[0]);
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Requerente', 'alterar_requerente', 'alterar_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), $campos[1], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_text_telefone('Tel(fixo)', 'alterar_tel_fixo', 'alterar_tel_fixo', array('required' => 'true', 'maxlength' => '12', 'placeholder' => '(xx)xxxxxxx'), $campos[2], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_text_telefone('Tel(Celular)', 'alterar_tel_cel', 'alterar_tel_cel', array('required' => 'true', 'maxlength' => '13', 'placeholder' => '(xx)xxxxxxxx'), $campos[3], 'somente os numeros');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text_cep('CEP', 'alterar_cep_requerente', 'alterar_cep_requerente', array('required' => 'true', 'maxlength' => '8', 'placeholder' => 'xx.xxx-xxx'), $campos[4], 'somente os numeros', ' this.id, txt_alterar_cep_requerente, txt_alterar_logradouro_requerente, txt_alterar_bairro_requerente, txt_alterar_cidade_requerente, txt_alterar_uf_requerente');
                    ?>
                </div>
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Logradouro', 'alterar_logradouro_requerente', 'alterar_logradouro_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Logradouro'), $campos[5], 'somente os numeros');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-5">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Bairro', 'alterar_bairro_requerente', 'alterar_bairro_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Bairro'), $campos[6], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-5">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Cidade', 'alterar_cidade_requerente', 'alterar_cidade_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Cidade'), $campos[7], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-2">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Uf', 'alterar_uf_requerente', 'alterar_uf_requerente', array('required' => 'true', 'maxlength' => '2', 'placeholder' => 'Informe a Uf'), $campos[8], 'somente os numeros');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Número End', 'alterar_numero_requerente', 'alterar_numero_requerente', array('required' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx'), $campos[9], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Complemento', 'alterar_complemento_requerente', 'alterar_complemento_requerente', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Complemento'), $campos[10], 'caracteres [a-z A-Z]');
                    ?>
                </div>
            </div> 
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Alterar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
    <?php
}
?>



<?php

function formularioExcluir() {
//   pega o valor vindo pela url
//   explode em array 
//    passa vetor nos campos

    $campos = explode("|", $_POST['codigo']);
    ?>



    <form method="post" action="recursos/includes/excluir/excluir_requerente.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">EXCLUIR REQUERENTE</h4>
        </div>

        <div class="modal-body">
            <p style="color: red">Deseja Prosseguir com a Exclusão do Requerente ?</p>

            <div class="row">
                <div class="col-sm-2">
                    <?php
                    //   INPUT - Codigo Bairro                             
                    criar_input_text('Codigo', 'excluir_codigo', 'excluir_codigo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $campos[0]);
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Requerente', 'excluir_requerente', 'excluir_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), $campos[1], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_text_telefone('Tel(fixo)', 'excluir_tel_fixo', 'tel_fixo', array('readonly' => 'true','required' => 'true', 'maxlength' => '12', 'placeholder' => '(xx)xxxxxxx'),  $campos[2], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_text_telefone('Tel(Celular)', 'excluir_tel_cel', 'tel_cel', array('readonly' => 'true','required' => 'true', 'maxlength' => '13', 'placeholder' => '(xx)xxxxxxxx'),  $campos[3], 'somente os numeros');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text_cep('CEP', 'excluir_cep_requerente', 'excluir_cep_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '8', 'placeholder' => 'xx.xxx-xxx'), $campos[4], 'somente os numeros', ' this.id, txt_cep_requerente, txt_logradouro_requerente, txt_bairro_requerente, txt_cidade_requerente, txt_uf_requerente');
                    ?>
                </div>
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Logradouro', 'excluir_logradouro_requerente', 'logradouro_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Logradouro'),  $campos[5], 'somente os numeros');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-5">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Bairro', 'excluir_bairro_requerente', 'bairro_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Bairro'),  $campos[6], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-5">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Cidade', 'excluir_cidade_requerente', 'excluir_cidade_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Cidade'),  $campos[7], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-2">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Uf', 'excluir_uf_requerente', 'excluir_uf_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '2', 'placeholder' => 'Informe a Uf'),  $campos[8], 'somente os numeros');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Número End', 'excluir_numero_requerente', 'excluir_numero_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx'),  $campos[9], 'somente os numeros');
                    ?>
                </div>
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Complemento', 'excluir_complemento_requerente', 'excluir_complemento_requerente', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Complemento'),  $campos[10], 'somente os numeros');
                    ?>
                </div>
            </div> 
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-danger" >Excluir</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
    <?php
}
?>
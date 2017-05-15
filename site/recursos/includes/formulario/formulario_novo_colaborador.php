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
} else if ($_POST['id'] == 3) {
    formularioDesbloquear();
}
?>

<?php

function formularioCadastro() {
    ?>


    <form  method="post" action="recursos/includes/cadastrar/cadastrar_novo_colaborador.php" onsubmit="return valida_form(this)">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">NOVO COLABORADOR</div>
                    <div class="panel-body">
                        <div class="row"> 
                            <div class="col-sm-12">
                                <div id="msg_error"></div>
                            </div>
                        </div>
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Login', 'novo_login', 'novo_login', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Login',), '', '');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_email('Email', 'novo_email', 'novo_email', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o E-mail'), '', '');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Nome', 'novo_nome', 'novo_nome', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome'), '', '');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Sobrenome', 'novo_sobrenome', 'novo_sobrenome', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Sobrenome'), '', '');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa('SETOR', 'setor', 'setor', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Setor'), '', '', 'lupa_setor');
                                criar_input_hidden('codigo_setor', array(), '');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_select('PERMISSÃO', 'novo_permissao', 'novo_permissao', array('readonly' => 'true', 'required' => 'true'), array('' => 'SELECIONE O NIVEL PERMISSÃO'), '');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_password('Senha', 'novo_senha', 'novo_senha', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe Senha'), '', '');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_password('Confirme Senha', 'novo_conf_senha', 'novo_conf_senha', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Confirme Senha'), '', '');
                                ?>
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


    <form method="post" action="recursos/includes/alterar/alterar_colaborador.php" onsubmit="return valida_form_alterar(this)">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ALTERAR COLABORADOR</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="msg_error_alterar"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    //   INPUT -                             
                    criar_input_text('Codigo', 'alterar_codigo', 'alterar_codigo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $campos[0]);
                    ?>
                </div>
                <div class="col-sm-10">
                    <?php
                    //   INPUT -                             
                    criar_input_text('Login', 'alterar_colaborador_login', 'alterar_colaborador_login', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Login'), $campos[1], '');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_email('Email', 'alterar_colaborador_email', 'alterar_colaborador_email', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o E-mail'), $campos[4], '');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                             
                    criar_input_text('Nome', 'alterar_colaborador_nome', 'alterar_colaborador_nome', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome'), $campos[2], '');
                    ?>
                </div>
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                             
                    criar_input_text('Sobrenome', 'alterar_colaborador_sobrenome', 'alterar_colaborador_sobrenome', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Sobrenome'), $campos[3], '');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_text_com_lupa('SETOR', 'alterar_colaborador_setor', 'alterar_colaborador_setor', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Setor'), $campos['6'], '', 'lupa_setor_usuario');
                    criar_input_hidden('alterar_colaborador_codigo_setor', array(), $campos['5']);
                    ?>
                </div>
                <div class="col-sm-6">
                    <label for="id_permissoa">PERMISSÃO :</label>
                    <select name="txt_alterar_colaborador_permissao" id="id_alterar_colaborador_permissao" class="form-control">
                        <option value="0" <?php if ($campos[8] == "USUARIO") echo "selected'"; ?>> USUARIO </option>
                        <option value="1" <?php if ($campos[8] == "ADMINISTRADOR") echo "selected"; ?>> ADMINISTRADOR </option>
                    </select>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_password('Senha', 'alterar_novo_senha', 'alterar_novo_senha', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe Senha'), 'informe_sua_senha', '');
                    ?>
                </div>
                <div class="col-sm-6">
                    <?php
                    //   INPUT -                              
                    criar_input_password('Confirme Senha', 'alterar_novo_conf_senha', 'alterar_novo_conf_senha', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Confirme Senha'), 'informe_sua_senha', '');
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



    <form method="post" action="recursos/includes/excluir/excluir_colaborador.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">BLOQUEAR COLABORADOR</h4>
        </div>

        <div class="modal-body">
            <p style="color: red">Deseja Prosseguir com o Bloqueio do Colaborador ?</p>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Codigo', 'excluir_codigo', 'excluir_codigo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $campos[0]);
                        ?>
                    </div>
                    <div class="col-sm-10">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Login', 'excluir_colaborador_login', 'excluir_colaborador_login', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Login'), $campos[1]);
                        ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Nome', 'excluir_colaborador_nome', 'excluir_colaborador_nome', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[2], '');
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Sobrenome', 'excluir_colaborador_sobrenome', 'excluir_colaborador_sobrenome', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[3], '');
                        ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('E-mail', 'excluir_colaborador_email', 'excluir_colaborador_email', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[4], '');
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('PERMISSÃO', 'excluir_colaborador_permissao', 'excluir_colaborador_permissao', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[8], '');
                        ?>
                    </div>
                </div> 
                <div class="row">

                    <div class="col-sm-12">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Setor', 'excluir_colaborador_setor', 'excluir_colaborador_setor', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[6], '');
                        ?>
                    </div>
                </div> 


            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-danger" >Bloquear</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
    <?php
}
?>


<?php

function formularioDesbloquear() {
//   pega o valor vindo pela url
//   explode em array 
//    passa vetor nos campos

    $campos = explode("|", $_POST['codigo']);
    ?>



    <form method="post" action="recursos/includes/cadastrar/cadastra_desbloqueio_colaborador.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">DESBLOQUEIO DO COLABORADOR</h4>
        </div>

        <div class="modal-body">
            <p style="color: red">Deseja Prosseguir com o Desbloqueio do Colaborador ?</p>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Codigo', 'excluir_codigo', 'excluir_codigo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $campos[0]);
                        ?>
                    </div>
                    <div class="col-sm-10">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Login', 'excluir_colaborador_login', 'excluir_colaborador_login', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Login'), $campos[1]);
                        ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Nome', 'excluir_colaborador_nome', 'excluir_colaborador_nome', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[2], '');
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Sobrenome', 'excluir_colaborador_sobrenome', 'excluir_colaborador_sobrenome', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[3], '');
                        ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('E-mail', 'excluir_colaborador_email', 'excluir_colaborador_email', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[4], '');
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        //   INPUT -                             
                        criar_input_text('PERMISSÃO', 'excluir_colaborador_permissao', 'excluir_colaborador_permissao', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[8], '');
                        ?>
                    </div>
                </div> 
                <div class="row">

                    <div class="col-sm-12">
                        <?php
                        //   INPUT -                             
                        criar_input_text('Setor', 'excluir_colaborador_setor', 'excluir_colaborador_setor', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[6], '');
                        ?>
                    </div>
                </div> 


            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-danger" >Desbloquear</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
    <?php
}
?>
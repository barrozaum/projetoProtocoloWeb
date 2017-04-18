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


    <form  method="post" action="recursos/includes/cadastrar/cadastrar_setor.php">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CADASTRO SETOR</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('SECRETARIA', 'secretaria', 'secretaria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Secretaria'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>

                            <div class="col-sm-8">
                                <?php
                                //   INPUT -                              
                                criar_input_text('DESC-SECRETARIA', 'descricao_secretaria', 'descricao_secretaria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descrição da Secretaria'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('COORDENADORIA', 'coordenadoria', 'coordenadoria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Coordenadoria '), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>

                            <div class="col-sm-8">
                                <?php
                                //   INPUT -                              
                                criar_input_text('DESC-COORDENADORIA', 'descricao_coordenadoria', 'descricao_coordenadoria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descrição da Coordenadoria '), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('DEPARTAMENTO', 'departamento', 'departamento', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Departamento'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                ?>
                            </div>

                            <div class="col-sm-8">
                                <?php
                                //   INPUT -                              
                                criar_input_text('DESC-DEPATAMENTO', 'descricao_departamento', 'descricao_departamento', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descricao do Departamento'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
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


    <form method="post" action="recursos/includes/alterar/alterar_setor.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ALTERAR SETOR</h4>
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
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text('SECRETARIA', 'alterar_secretaria', 'alterar_secretaria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Secretaria'),  $campos[1], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>

                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DESC-SECRETARIA', 'alterar_descricao_secretaria', 'alterar_descricao_secretaria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descrição da Secretaria'),  $campos[2], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text('COORDENADORIA', 'alterar_coordenadoria', 'alterar_coordenadoria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Coordenadoria '),  $campos[3], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>

                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DESC-COORDENADORIA', 'alterar_descricao_coordenadoria', 'alterar_descricao_coordenadoria', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descrição da Coordenadoria '),  $campos[4], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DEPARTAMENTO', 'alterar_departamento', 'alterar_departamento', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Departamento'),  $campos[5], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>

                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DESC-DEPATAMENTO', 'alterar_descricao_departamento', 'alterar_descricao_departamento', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descricao do Departamento'), $campos[6], 'Conter no Minimo 3 caracteres [a-z A-Z]');
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



    <form method="post" action="recursos/includes/excluir/excluir_setor.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">EXCLUIR SETOR</h4>
        </div>

        <div class="modal-body">
            <p style="color: red">Deseja Prosseguir com a Exclusão do Setor ?</p>

             <div class="modal-body">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    //   INPUT - Codigo Bairro                             
                    criar_input_text('Codigo', 'excluir_codigo', 'excluir_codigo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '3', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $campos[0]);
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text('SECRETARIA', 'excluir_secretaria', 'excluir_secretaria', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Secretaria'),  $campos[1], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>

                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DESC-SECRETARIA', 'excluir_descricao_secretaria', 'excluir_descricao_secretaria', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descrição da Secretaria'),  $campos[2], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text('COORDENADORIA', 'excluir_coordenadoria', 'excluir_coordenadoria', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Coordenadoria '),  $campos[3], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>

                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DESC-COORDENADORIA', 'excluir_descricao_coordenadoria', 'excluir_descricao_coordenadoria', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descrição da Coordenadoria '),  $campos[4], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DEPARTAMENTO', 'excluir_departamento', 'excluir_departamento', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Departamento'),  $campos[5], 'Conter no Minimo 3 caracteres [a-z A-Z]');
                    ?>
                </div>

                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('DESC-DEPATAMENTO', 'excluir_descricao_departamento', 'excluir_descricao_departamento', array('readonly' => 'true','required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Descricao do Departamento'), $campos[6], 'Conter no Minimo 3 caracteres [a-z A-Z]');
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
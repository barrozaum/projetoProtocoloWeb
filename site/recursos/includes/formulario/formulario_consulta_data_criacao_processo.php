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
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CONSULTA DATA CRIAÇÃO DO PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
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
                                <button type="button" class="btn btn-success" id="id_consulta_data_criacao_processo">Consultar</button>
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


    <form method="post" action="recursos/includes/alterar/alterar_assunto.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ALTERAR ASSUNTO</h4>
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
                    //   INPUT - Codigo Bairro                             
                    criar_input_text('Descrição-Assunto', 'alterar_descricao', 'alterar_descricao', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[1], 'Conter no Minimo 3 caracteres [a-z A-Z]');
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



    <form method="post" action="recursos/includes/excluir/excluir_assunto.php">    

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">EXCLUIR ASSUNTO</h4>
        </div>

        <div class="modal-body">
            <p style="color: red">Deseja Prosseguir com a Exclusão do Assunto ?</p>

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
                    //   INPUT - Descricao Bairro                             
                    criar_input_text('Descrição-Assunto', 'excluir_descricao', 'excluir_descricao', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Nome do Assunto'), $campos[1], 'Conter no Minimo 3 caracteres [a-z A-Z]');
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
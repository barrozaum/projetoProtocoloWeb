<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
?>
<?php
if (empty($_POST['id'])) {
    formulario();
}
?>

<?php

function formulario() {
    ?>


    <form  method="post" action="recursos/includes/relatorio/relacao_protocolados.php" target="_blank">
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">RELAÇÃO DE PROTOCOLADOS</div>
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
                                <button type="submit" class="btn btn-success" id="">Consultar</button>
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

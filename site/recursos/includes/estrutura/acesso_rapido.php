<?php
include_once './controle/validar_secao.php';
//lembre-se não pode alterar a ordem do menu
// cada código representa uma parte do menu
//
?>

<div class="container">
    

    <div class="row">
         <?php if (in_array("1", $_SESSION['PERMISSAO_MENU']) || in_array("4", $_SESSION['PERMISSAO_MENU']) ||in_array("6", $_SESSION['PERMISSAO_MENU']) || in_array("7", $_SESSION['PERMISSAO_MENU']) )  { ?>
        <div class="col-sm-4">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#"> 
                            <h4 class="panel-title" style="color: black">
                                PROCESSO
                            </h4>
                        </a>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php if (in_array("1", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="cadastro_processo.php" title="Cadastro novo processo"><li class="list-group-item" >NOVO</li></a>
                                </ul>
                            <?php } if (in_array("4", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="cadastro_carga_individual.php" title="Cadastro carga do processo"><li class="list-group-item" >CARGA</li></a>
                                </ul>
         
                            <?php } if (in_array("6", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="cadastro_recebimento_individual.php" title="Cadastra recebimento do processo Individual"><li class="list-group-item" >RECEBIMENTO INDIVIDUAL</li></a>
                                </ul>
                            <?php } if (in_array("31", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="cadastro_recebimento_coletivo.php" title="Cadastra recebimento do processo Individual"><li class="list-group-item" >RECEBIMENTO COLETIVO</li></a>
                                </ul>
                            <?php } ?>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>

        </div>
           <?php } ?>
        
        <?php if (in_array("13", $_SESSION['PERMISSAO_MENU']) || in_array("14", $_SESSION['PERMISSAO_MENU']) ||in_array("16", $_SESSION['PERMISSAO_MENU']) || in_array("18", $_SESSION['PERMISSAO_MENU']) )  { ?>
        <div class="col-sm-4">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#"> 
                            <h4 class="panel-title" style="color: black">
                                CONSULTA
                            </h4>
                        </a>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php if (in_array("13", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="consulta_numero.php" title="Consulta Número do processo"><li class="list-group-item" >NÚMERO</li></a>
                                </ul>
                            <?php } if (in_array("14", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a  href="consulta_assunto.php"><li class="list-group-item"  title="Consulta Assunto processo" >ASSUNTO</li></a>
                                </ul>
                            
                            <?php } if (in_array("18", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a  href="consulta_requerente.php"><li class="list-group-item" title="Consulta Requerente processo" >REQUERENTE</li></a>
                                </ul>
                            <?php } if (in_array("16", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a  href="consulta_data_criacao_processo.php"><li class="list-group-item"  title="Consulta Data criação processo">DATA PROCESSO</li></a>
                                </ul>
                            <?php }?>
                            </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>

        <?php if (in_array("21", $_SESSION['PERMISSAO_MENU']) || in_array("22", $_SESSION['PERMISSAO_MENU']) ||in_array("22", $_SESSION['PERMISSAO_MENU']) || in_array("24", $_SESSION['PERMISSAO_MENU']) )  { ?>
        <div class="col-sm-4">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#"> 
                            <h4 class="panel-title" style="color: black">
                                RELATÓRIO
                            </h4>
                        </a>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php if (in_array("21", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="relatorio_setor_presente_processo.php" title="Cadastro de Itbi"><li class="list-group-item" style="background-color: #F0F5FF">SETOR</li></a>
                                </ul>
                           <?php } if (in_array("22", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="relatorio_remessa_processo.php" title="RELATÓRIO PROCESSO REMESSA"><li class="list-group-item" style="background-color: #F0F5FF">REMESSA</li></a>
                                </ul>
                            <?php } if (in_array("23", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="relatorio_tramitacao_processo.php" title="RELATÓRIO PROCESSO ENVIADOS PARA O SETOR"><li class="list-group-item" style="background-color: #F0F5FF">TRÂMITE</li></a>
                                </ul>
                            <?php } if (in_array("24", $_SESSION['PERMISSAO_MENU'])) { ?>
                                <ul class="list-group">
                                    <a href="relatorio_carga_processo.php" title="RELATÓRIO ANDAMENTO DO PROCESSO"><li class="list-group-item" style="background-color: #F0F5FF">ANDAMENTO DE PROCESSO</li></a>
                                </ul>
                            <?php } ?>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php }  ?>

    </div>
</div>


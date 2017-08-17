<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';
include_once '../../../../recursos/includes/funcoes/function_letraMaiscula.php';
include_once '../../../../recursos/includes/funcoes/funcaoCriacaoInput.php';
include_once '../../../../recursos/includes/funcoes/func_retorna_tipos_processos_existentes.php';
include_once '../../../../recursos/includes/funcoes/func_retorna_observacao.php';
include_once '../../../../recursos/includes/funcoes/funcao_formata_data.php';
include_once '../../../../recursos/includes/funcoes/func_retorna_setor.php';
include_once '../../../../recursos/includes/funcoes/func_retorna_usuario.php';

if ($_POST['id'] === '2') {
    consulta_id_processo($pdo);
} else if ($_POST['id'] === '99') {
    consulta_numero_ano_processo($pdo);
} else {
    mostrar_pagina_de_erro();
}

function consulta_numero_ano_processo($pdo) {



    $numero_processo = $_POST['txt_numero_processo'];
    $ano_processo = $_POST['txt_ano_processo'];

    $sql_conulta_numero_ano = "SELECT * FROM processo_judicial ";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " WHERE jud_numero = '$numero_processo'";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " AND jud_ano_processo = '$ano_processo'";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " Limit 1";

    $query_consulta_numero_ano = $pdo->prepare($sql_conulta_numero_ano);
    $query_consulta_numero_ano->execute();
    if ($query_consulta_numero_ano->fetchColumn() > 0) {
        $query_consulta_numero_ano->execute();
        $dados = $query_consulta_numero_ano->fetch();
        mostrar_dados_processo($pdo, $dados, $_SESSION['PERMISSAO_MENU_JURIDICO']);
    } else {
        mostrar_pagina_de_erro("Desculpe, porém não encotramos o processo desejado !!!");
    }
}
?>




<?php

function consulta_id_processo($pdo) {
    $codigo = letraMaiuscula($_POST['codigo']);

    $sql_conulta_codigo = "SELECT * FROM processo_judicial ";
    $sql_conulta_codigo = $sql_conulta_codigo . " WHERE id_processo_judicial = '$codigo'";
    $sql_conulta_codigo = $sql_conulta_codigo . " Limit 1";

    $query_consulta_codigo = $pdo->prepare($sql_conulta_codigo);
    $query_consulta_codigo->execute();
    if ($query_consulta_codigo->fetchColumn() > 0) {
        $query_consulta_codigo->execute();
        $dados = $query_consulta_codigo->fetch();
        mostrar_dados_processo($pdo, $dados, $_SESSION['PERMISSAO_MENU_JURIDICO']);
    } else {
        mostrar_pagina_de_erro("Desculpe, porém não encotramos o processo desejado !!!");
    }
}

//caso exista algum erro na validação da id
// mostrar página de erro
function mostrar_pagina_de_erro($mensagem = 'Desculpe, porém algo deu errado. Tente Novamente !!!') {
    ?>


    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ERROR !!!</h4>
    </div>
    <div class="modal-body">
        <p class="text-danger"><?php print $mensagem; ?></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>

    <?php
}
?>






<?php

function mostrar_dados_processo($pdo, $dados, $alterar) {
    ?>
    <form name="mostra_dados_processo" id="id_mostra_dados_processo" action="alterar_dados_processo_judicial.php" method="post">
        <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal">&times;
            </button>
            <h4 class = "modal-title">CONSULTA DADOS PROCESSO</h4>
        </div>

        <div class = "modal-body ">

            <div class = "row">
                <ul class = "nav nav-tabs"> <!--menu das abas -->
                    <li><a data-toggle="tab" href="#home">INFORMAÇÕES JUDICIAIS</a></li>
                    <li><a data-toggle="tab" href="#menu2">DOCUMENTO-JUDICIAIS</a></li>
                    <li><a data-toggle="tab" href="#menu3">HISTORICO-OBSERVACAO</a></li>
                </ul> <!--fim dos menu das abas -->


                <div class = "tab-content"><!--abertura das abas do formulário -->

                    <div id = "home" class = "tab-pane fade in active"> <!--primeira aba -->
                        <div class = "panel panel-default">
                            <!--INICIO Dados do imóvel -->
                            <div class = "panel-heading text-center"> 
                                <h4 class="panel-title">DADOS - JUDICIAIS  </h4>
                            </div>
                            <div class = "panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Número Processo Judicial', 'numero_processo_judicial', 'numero_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'NÚMERO PROCESSO JUDICIAL'), $dados['jud_numero']);
                                        criar_input_hidden("jud_cod_processo", array(), $dados['id_processo_judicial']);
                                        ?>
                                    </div> 
                                    <div class="col-sm-4">
                                        <?php
                                        criar_input_text('Ano Processo', 'ano_processo_judicial', 'ano_processo_judicial', array('required' => 'true', 'placeholder' => '00/00/0000'),$dados['jud_ano_processo']);
                                        ?>
                                    </div> 
                                    <div class="col-sm-4">
                                        <?php
                                        criar_input_data('Data Inicial', 'dt_inicial', 'dt_inicial', array('required' => 'true', 'placeholder' => '00/00/0000'), dataBrasileiro($dados['jud_data_inicio']));
                                        ?>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('AÇÃO', 'acao_processo_judicial', 'acao_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'AÇÃO JUDICIAL'), $dados['jud_acao'], '');
                                        ?>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('AUTOR', 'autor_processo_judicial', 'autor_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'INFORME O AUTOR DO PROCESSO'), $dados['jud_autor']);
                                        ?>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('RÉU', 'reu_processo_judicial', 'reu_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'INFORME O RÉU DO PROCESSO'), $dados['jud_reu']);
                                        ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div id="menu2" class="tab-pane fade"> <!-- segunda aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title text-center">DADOS DOCUMENTO </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="msg_doc_erro"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-offset-0 col-sm-12 col-sm-offset-0">
                                            <div style='max-height: 450px; overflow: auto;'>
                                                <table id="tabela-contrato" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>DESCRIÇÃO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php
                                                        $sql_upload = "SELECT * FROM upload_judiciais WHERE id_processo_judicial = '{$dados['id_processo_judicial']}' AND ativo = 1";
                                                        $query_upload = $pdo->prepare($sql_upload);
                                                        $query_upload->execute();
                                                        while ($dados_arquivo = $query_upload->fetch()) {
                                                            ?>
                                                            <tr>
                                                                <th><a href="recursos_juridico/includes/documentos_uploader/<?php echo $dados_arquivo['arquivo']; ?>" target="_blank"><?php echo $dados_arquivo['descricao']; ?></a></th>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="menu3" class="tab-pane fade"> <!-- segunda aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title text-center">OBSERVAÇÕES DO PROCESSO </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="msg_doc_erro"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-offset-0 col-sm-12 col-sm-offset-0">
                                            <div style='max-height: 450px; overflow: auto;'>
                                                <table class="table table-striped table-hover" >
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3">OBSERVAÇÃO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 

                                                        <?php
                                                        $sql_obs = "SELECT * FROM prazo_processo_judicial WHERE id_processo_judicial = '{$dados['id_processo_judicial']}' ORDER BY id_observacao_judicial DESC";
                                                        $query_obs = $pdo->prepare($sql_obs);
                                                        $query_obs->execute();
                                                        while ($dados_obs = $query_obs->fetch()) {
                                                            ?>
                                                            <tr>
                                                                <th>Usuário : <?php echo $dados_obs['usuario']; ?></th>
                                                                <th>Dt Obs: <?php echo dataBrasileiro($dados_obs['data_observacao']); ?></th>
                                                                <th>Prox Prazo : <?php echo dataBrasileiro($dados_obs['prazo_processo']); ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3"><?php echo $dados_obs['observacao_processo_judicial']; ?></th>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- fim da primeira aba -->

                </div>
            </div>

            <div class="modal-footer">
                <?php
                if ($alterar === '1') {
                    ?>
                    <button type="submit" class="btn btn-success" >ALTERAR DADOS</button>

                    <?php
                }
                ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </form>


    <?php
}
?>
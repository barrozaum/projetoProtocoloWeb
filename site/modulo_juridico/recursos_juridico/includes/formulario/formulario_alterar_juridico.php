<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../../../../recursos/includes/funcoes/funcaoCriacaoInput.php';
include_once '../../../../recursos/includes/funcoes/funcao_formata_data.php';

if (isset($_SESSION['SESSION_ALTERAR_JUDICIAL']) && ($_SESSION['SESSION_ALTERAR_JUDICIAL'] === 'true')) {
    include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';

    fun_pesquisa_processo_juridico($pdo, $_SESSION['SESSION_JUDICIAL_COD_PROCESSO']);
    $pdo = null;
}

function fun_pesquisa_processo_juridico($pdo, $id_processo_judicial) {

    $sql_conulta_numero_ano = "SELECT * FROM processo_judicial ";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " WHERE id_processo_judicial = '$id_processo_judicial'";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " Limit 1";

    $query_consulta_numero_ano = $pdo->prepare($sql_conulta_numero_ano);
    $query_consulta_numero_ano->execute();
    if ($query_consulta_numero_ano->fetchColumn() > 0) {
        $query_consulta_numero_ano->execute();
        $dados = $query_consulta_numero_ano->fetch();

        func_mostrar_informacao($pdo, $dados);
    } else {
        mostrar_pagina_de_erro("Desculpe, porém não encotramos o processo desejado !!!");
    }
}

function func_mostrar_informacao($pdo, $dados) {
    ?>

    <!-- nao posso apagar, motivo carregamento do campo observação melhorado-->
    <script>

        tinymce.init({
            selector: 'textarea',
            height: 300

        });
    </script>


    <form  method="post" action="recursos_juridico/includes/alterar/alterar_juridico.php" name="formulario_processo" id="id_formulario_processo" enctype="multipart/form-data">   <!-- inicio do formulário --> 
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <P ALIGN="CENTER">INFORMAÇÕES PROCESSOS JUDICIAIS</P>
                <div id="msg_erro"></div>
                <HR >
                <ul class="nav nav-tabs"> <!-- menu das abas -->
                    <li class="active"><a data-toggle="tab" href="#home">INFORMAÇÕES JUDICIAIS</a></li>
                    <li><a data-toggle="tab" href="#menu2">DOCUMENTO-JUDICIAIS</a></li>
                    <li><a data-toggle="tab" href="#menu3">PRAZO-JUDICIAIS</a></li>
                    <li><a data-toggle="tab" href="#menu4">HISTÓRICO-JUDICIAIS</a></li>
                </ul> <!-- fim dos menu das abas -->


                <div class="tab-content"><!-- abertura das abas do formulário -->
                    <div id="home" class="tab-pane fade in active"> <!-- primeira aba -->


                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">DADOS - JUDICIAIS  </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
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
                                                criar_input_text('Ano Processo', 'ano_processo_judicial', 'ano_processo_judicial', array('required' => 'true', 'placeholder' => '00/00/0000'), $dados['jud_ano_processo']);
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
                        </div><!-- fim da segunda aba -->
                    </div>
                    <div id="menu2" class="tab-pane fade"> <!-- segunda aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">DADOS DOCUMENTO </h4>
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
                                                            <th>    
                                                                <?php
                                                                //   INPUT -                              
                                                                criar_input_hidden("MAX_FILE_SIZE", array(), "30000");
                                                                criar_input_file('DOCUMENTO', 'documento[]', 'documento', array('placeholder' => 'Informe o Documento'), '');
                                                                ?>
                                                            </th>
                                                            <th>    
                                                                <?php
                                                                //   INPUT -                              
                                                                criar_input_text('DESCRIÇÃO DOCUMENTO', 'descricao_documento[]', 'descricao_documento', array('maxlength' => '50', 'placeholder' => 'DESCRIÇÃO DOCUMENTO', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                                                ?>
                                                            </th>
                                                            <th>  
                                                                <button onclick="btn_AddTableRow()" type="button" class="btn btn-large btn-primary">Adicionar</button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="id_tabela_documentos"> 
                                                        <!-- será preenchido quando o botão adicionar foir clicado -->
                                                    </tbody>
                                                </table>
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
                    </div><!-- fim da Terceira aba -->
                    <div id="menu3" class="tab-pane fade"> <!-- terceira aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">DADOS - JUDICIAIS  </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php
                                                criar_input_data('PRAZO', 'dt_final', 'dt_final', array('required' => 'true', 'placeholder' => '00/00/0000'), '', '');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php
                                                //   INPUT -                              
                                                criar_textarea("OBSERVAÇÃO", "observacao_judicial", "observacao_judicial", "", array());
                                                ?>
                                            </div> 
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- fim da terceira aba -->
                    <div id="menu4" class="tab-pane fade"> <!-- QUARTA aba -->
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
                    </div><!-- fim da QUARTA aba -->
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" id="id_transforma_judicial">ENVIAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
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

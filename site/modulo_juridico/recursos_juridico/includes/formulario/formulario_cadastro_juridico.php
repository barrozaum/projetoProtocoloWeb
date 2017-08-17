<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../../../../recursos/includes/funcoes/funcaoCriacaoInput.php';
//die(print_r($_SESSION));
?>
<!-- nao posso apagar, motivo carregamento do campo observação melhorado-->
<script>

    tinymce.init({
        selector: 'textarea',
        height: 300
       
    });
</script>


<form  method="post" action="recursos_juridico/includes/cadastrar/cadastra_juridico.php" name="formulario_processo" id="id_formulario_processo" enctype="multipart/form-data">   <!-- inicio do formulário --> 
    <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
        <div class="well"><!-- div que coloca a cor no formulário -->
            <P ALIGN="CENTER">INFORMAÇÕES PROCESSOS JUDICIAIS</P>
            <div id="msg_erro"></div>
            <HR >
            <ul class="nav nav-tabs"> <!-- menu das abas -->
                <li class="active"><a data-toggle="tab" href="#home">PROCESSO-PROTOCOLADO</a></li>
                <li><a data-toggle="tab" href="#menu1">INFORMAÇÕES JUDICIAIS</a></li>
                <li><a data-toggle="tab" href="#menu2">DOCUMENTO-JUDICIAIS</a></li>
                <li><a data-toggle="tab" href="#menu3">PRAZO-JUDICIAIS</a></li>
            </ul> <!-- fim dos menu das abas -->


            <div class="tab-content"><!-- abertura das abas do formulário -->
                <div id="home" class="tab-pane fade in active"> <!-- primeira aba -->
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">DADOS PROCESSO-PROTOCOLADO </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('Tipo Processo', 'tipo_processo', 'numero_processo', array('readonly' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx', 'onkeypress' => 'return SomenteNumero(event)'), $_SESSION['PROTOCOLO_DESCRICAO_TIPO_PROCESSO']);
                                            criar_input_hidden('cod_tipo_processo', array(), $_SESSION['PROTOCOLO_COD_TIPO_PROCESSO']);
                                            ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?php
                                            criar_input_text('Valor R$', 'valor_processo', 'valor_processo', array('readonly' => 'true', 'maxlength' => '11', 'placeholder' => 'R$000.00', 'onKeyPress' => "return formatarValor(this, '.', ',', event)"), $_SESSION['PROTOCOLO_VALOR_PROCESSO'], '');
                                            ?>
                                        </div>

                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('Número', 'numero_processo', 'numero_processo', array('readonly' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx', 'onkeypress' => 'return SomenteNumero(event)'), $_SESSION['PROTOCOLO_NUMERO_PROCESSO']);
                                            criar_input_hidden( 'cod_processo',  array(), $_SESSION['PROTOCOLO_ID_PROCESSO']);
                                            ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('Ano', 'ano_processo', 'ano_processo', array('readonly' => 'true', 'maxlength' => '4', 'placeholder' => 'xxxx', 'onkeypress' => 'return SomenteNumero(event)'), $_SESSION['PROTOCOLO_ANO_PROCESSO']);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('ASSUNTO', 'assunto', 'assunto', array('readonly' => 'true', 'maxlength' => '50', 'placeholder' => 'Informe o Assunto'), $_SESSION['PROTOCOLO_ASSUNTO_PROCESSO'], '');
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('REQUERENTE', 'requerente', 'requerente', array('readonly' => 'true', 'maxlength' => '50', 'placeholder' => 'Informe o Requerente'), $_SESSION['PROTOCOLO_REQUERENTE_PROCESSO'], '');
                                            ?>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- fim da primeira aba -->

                <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                <div id="menu1" class="tab-pane fade"> <!-- segunda aba -->
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
                                            criar_input_text('Número Processo Judicial', 'numero_processo_judicial', 'numero_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'NÚMERO PROCESSO JUDICIAL'), "", '');
                                            ?>
                                        </div> 
                                        <div class="col-sm-4">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('Ano Processo Judicial', 'ano_processo_judicial', 'ano_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'ANO PROCESSO JUDICIAL'), "", '');
                                            ?>
                                        </div> 
                                        <div class="col-sm-4">
                                            <?php
                                            criar_input_data('Data Inicial', 'dt_inicial', 'dt_inicial', array('required' => 'true', 'placeholder' => '00/00/0000'), '', '');
                                            ?>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('AÇÃO', 'acao_processo_judicial', 'acao_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'AÇÃO JUDICIAL'), $_SESSION['PROTOCOLO_ASSUNTO_PROCESSO'], '');
                                            ?>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('AUTOR', 'autor_processo_judicial', 'autor_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'INFORME O AUTOR DO PROCESSO'), '', '');
                                            ?>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            //   INPUT -                              
                                            criar_input_text('RÉU', 'reu_processo_judicial', 'reu_processo_judicial', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'INFORME O RÉU DO PROCESSO'), '', '');
                                            ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fim da segunda aba -->
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
//limpando dados da sessao
unset($_SESSION['SESSION_TORNAR_JUDICIAL']);
unset($_SESSION['PROTOCOLO_ID_PROCESSO']);
unset($_SESSION['PROTOCOLO_DESCRICAO_TIPO_PROCESSO']);
unset($_SESSION['PROTOCOLO_COD_TIPO_PROCESSO']);
unset($_SESSION['PROTOCOLO_VALOR_PROCESSO']);
unset($_SESSION['PROTOCOLO_NUMERO_PROCESSO']);
unset($_SESSION['PROTOCOLO_ANO_PROCESSO']);
unset($_SESSION['PROTOCOLO_ORIGEM_PROCESSO']);
unset($_SESSION['PROTOCOLO_ASSUNTO_PROCESSO']);
unset($_SESSION['PROTOCOLO_REQUERENTE_PROCESSO']);
?>


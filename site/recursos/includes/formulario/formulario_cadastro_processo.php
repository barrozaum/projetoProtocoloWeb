<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//abrindo conexao
include_once '../estrutura/conexao/conexao.php';
// RETORNA TIPOS PROCESSO
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
?>
<?php
if (isset($_GET['cmd'])) {
    if ($_GET['cmd'] == "alterar") {
        $titulo_pagina = "ALTERAR PROCESSO";
        $acao_formulario = "recursos/includes/alterar/alterar_processo.php";
        formulario($pdo, $titulo_pagina, $acao_formulario);
    }
    if ($_GET['cmd'] == "excluir") {
        $titulo_pagina = "EXCLUIR PROCESSO";
        $acao_formulario = "recursos/includes/excluir/excluir_processo.php";
        formulario($pdo, $titulo_pagina, $acao_formulario);
    }
} else {
    $titulo_pagina = "CADASTRO PROCESSO";
    $acao_formulario = "recursos/includes/cadastrar/cadastro_processo.php";
    formulario($pdo, $titulo_pagina, $acao_formulario);
}
?>

<?php

function formulario($pdo, $titulo_pagina, $acao_formulario) {
    ?>

    <!-- bloco para mostrar mensagens retornados do sistema -->
    <div class="row">
        <div class="col-sm-12">
            <div  id="msg"></div>
            <div  id="msg_erro"></div>
        </div>
    </div>
    <!-- fim do bloco mensagens retornadas pelo sistema -->
    <form  method="post" action="<?php print $acao_formulario; ?>" name="formulario_processo" id="id_formulario_processo">   <!-- inicio do formulário --> 
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <P ALIGN="CENTER"><?php print $titulo_pagina; ?></P>


                <ul class="nav nav-tabs"> <!-- menu das abas -->
                    <li class="active"><a data-toggle="tab" href="#home">PROCESSO</a></li>
                    <li><a data-toggle="tab" href="#menu1">REQUERENTE</a></li>
                    <li><a data-toggle="tab" href="#menu2">DOCUMENTO</a></li>
                    <li><a data-toggle="tab" href="#menu3">OBSERVACAO</a></li>
                </ul> <!-- fim dos menu das abas -->


                <div class="tab-content"><!-- abertura das abas do formulário -->
                    <div id="home" class="tab-pane fade in active"> <!-- primeira aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">DADOS PROCESSO </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_select('Tipo Processo', 'tipo_processo', 'tipo_processo', array('required' => 'true'), fun_retorna_tipo_processo_existente($pdo), '');
//                                              incluo o campo com a id_processo
//                                              se o formulario não for de cadastro      
                                                if ($titulo_pagina !== "CADASTRO PROCESSO") {
                                                    criar_input_hidden('codigo_processo', array('require' => 'true'), '');
                                                }
                                                ?>
                                            </div>

                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Número', 'numero_processo', 'numero_processo', array('required' => 'true', 'maxlength' => '3', 'placeholder' => 'xxxxx', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                                if ($titulo_pagina === "CADASTRO PROCESSO") {
                                                    criar_input_hidden('numero_processo_banco', array('require' => 'true'), '');
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Ano', 'ano_processo', 'ano_processo', array('required' => 'true', 'maxlength' => '4', 'placeholder' => 'xxxx', 'onkeypress' => 'return SomenteNumero(event)'), date('Y'));
                                                ?>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text_com_lupa_e_com_adicionar('ASSUNTO', 'assunto', 'assunto', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Assunto'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                criar_input_hidden('codigo_assunto', array(), '');
                                                ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('COMPLEMENTO ASSUNTO', 'complemento_assunto', 'complemento_assunto', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'COMPLEMENTO ASSUNTO'), '');
                                                ?>
                                            </div>

                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text_com_lupa_e_com_adicionar('ORIGEM', 'origem', 'origem', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Origem'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                criar_input_hidden('codigo_origem', array(), '');
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
                                    <h4 class="panel-title">DADOS REQUERENTE </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text_com_lupa_e_com_adicionar('Requerente', 'requerente', 'requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                criar_input_hidden('codigo_requerente', array(), '');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text_telefone('Tel(fixo)', 'tel_fixo', 'tel_fixo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '12', 'placeholder' => '(xx)xxxxxxx'), '', 'somente os numeros');
                                                ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text_telefone('Tel(Celular)', 'tel_cel', 'tel_cel', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '13', 'placeholder' => '(xx)xxxxxxxx'), '', 'somente os numeros');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text_cep('CEP', 'cep_requerente', 'cep_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '8', 'placeholder' => 'xx.xxx-xxx'), '', 'somente os numeros', ' this.id, txt_cep_requerente, txt_logradouro_requerente, txt_bairro_requerente, txt_cidade_requerente, txt_uf_requerente');
                                                ?>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Logradouro', 'logradouro_requerente', 'logradouro_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Logradouro'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                ?>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Bairro', 'bairro_requerente', 'bairro_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Bairro'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                ?>
                                            </div>
                                            <div class="col-sm-5">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Cidade', 'cidade_requerente', 'cidade_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Cidade'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Uf', 'uf_requerente', 'uf_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '2', 'placeholder' => 'Informe a Uf'), '', 'Conter 2 caracteres [a-z A-Z]');
                                                ?>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Número End', 'numero_requerente', 'numero_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '6', 'placeholder' => 'xxxxxx'), '', 'somente os numeros');
                                                ?>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php
                                                //   INPUT -                              
                                                criar_input_text('Complemento', 'complemento_requerente', 'complemento_requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Complemento'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]');
                                                ?>
                                            </div>
                                        </div> 

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- fim da segunda aba -->
                    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                    <div id="menu2" class="tab-pane fade"> <!-- segunda aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">DADOS DOCUMENTO </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-sm-12 col-md-offset-0 col-sm-12 col-sm-offset-0">
                                            <div style='max-height: 450px; overflow: auto;'>
                                                <table id="tabela-contrato" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>    

                                                                <?php
                                                                //   INPUT -                              
                                                                criar_input_text_com_lupa_e_com_adicionar('DOCUMENTO', 'documento', 'documento', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Documento'), '');
                                                                criar_input_hidden('codigo_documento', array(), '');
                                                                ?>
                                                            </th>
                                                            <th>    
                                                                <?php
                                                                //   INPUT -                              
                                                                criar_input_text('NÚMERO', 'numero_documento', 'numero_documento', array('maxlength' => '30', 'placeholder' => 'Informe o Documento'), '');
                                                                ?>
                                                            </th>
                                                            <th>   
                                                                <?php
                                                                //   INPUT -                              
                                                                criar_input_text('ANO', 'ano_documento', 'ano_documento', array('maxlength' => '30', 'placeholder' => 'Informe o Documento'), '');
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
                    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                    <div id="menu3" class="tab-pane fade"> <!-- terceira aba -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">DADOS OBSERVAÇÃO</h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <?php
                                            criar_textarea('OBSERVAÇÃO', 'obs_processo', 'obs_processo', '', array('required' => 'true', 'maxlength' => '254', 'rows' => '9'));
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fim da Quarta aba -->
                <!-- Buttons do formulário -->
                <div id="divButonn">
                    <?php if($titulo_pagina === "CADASTRO PROCESSO"){ ?>
                    <button type="button" name="btn_enviar_processo" id="id_btn_enviar_processo" class="btn btn-success">Enviar </button>
                    <?php } ?>
                </div>
                <!-- Fim dos Buttons do formulário -->
            </div><!-- fim da abertura das abas do formulário -->
        </div><!-- div que coloca a cor no formulário -->
    </div><!-- div que posiciona o formulário na tela -->
    </form> <!-- fim do Formulário -->
    <?php
}
?>
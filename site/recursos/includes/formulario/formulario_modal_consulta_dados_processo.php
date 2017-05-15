<?php
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
include_once '../funcoes/func_retorna_observacao.php';
include_once '../funcoes/funcao_formata_data.php';
include_once '../funcoes/func_retorna_setor.php';
include_once '../funcoes/func_retorna_usuario.php';


if ($_POST['id'] === '7') {
    consulta_id_processo($pdo);
} else if ($_POST['id'] === '99') {
    consulta_numero_ano_processo($pdo);
} else {
    mostrar_pagina_de_erro();
}
?>




<?php
function consulta_id_processo($pdo){
    $codigo = letraMaiuscula($_POST['codigo']);
    
    $sql_conulta_codigo = "SELECT * FROM cadastro_processo ";
    $sql_conulta_codigo = $sql_conulta_codigo . " WHERE idProcesso = '$codigo'";
    $sql_conulta_codigo = $sql_conulta_codigo . " Limit 1";

    $query_consulta_codigo = $pdo->prepare($sql_conulta_codigo);
    $query_consulta_codigo->execute();
    if ($query_consulta_codigo->fetchColumn() > 0) {
        $query_consulta_codigo->execute();
        $dados = $query_consulta_codigo->fetch();
        mostrar_dados_processo($pdo, $dados);
    } else {
        mostrar_pagina_de_erro("Desculpe, porém não encotramos o processo desejado !!!");
    }
    
}
function consulta_numero_ano_processo($pdo) {



    $tipo_processo = letraMaiuscula($_POST['txt_tipo_processo']);
    $numero_processo = $_POST['txt_numero_processo'];
    $ano_processo = $_POST['txt_ano_processo'];

    $sql_conulta_numero_ano = "SELECT * FROM cadastro_processo ";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " WHERE tipoProcesso = '$tipo_processo'";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " AND numeroProcesso = '$numero_processo'";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " AND anoProcesso = '$ano_processo'";
    $sql_conulta_numero_ano = $sql_conulta_numero_ano . " Limit 1";

    $query_consulta_numero_ano = $pdo->prepare($sql_conulta_numero_ano);
    $query_consulta_numero_ano->execute();
    if ($query_consulta_numero_ano->fetchColumn() > 0) {
        $query_consulta_numero_ano->execute();
        $dados = $query_consulta_numero_ano->fetch();
        mostrar_dados_processo($pdo, $dados);
    } else {
        mostrar_pagina_de_erro("Desculpe, porém não encotramos o processo desejado !!!");
    }
}
?>




<?php

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

function mostrar_dados_processo($pdo, $dados) {
    ?>
    <div class = "modal-header">
        <button type = "button" class = "close" data-dismiss = "modal">&times;
        </button>
        <h4 class = "modal-title">CONSULTA DADOS PROCESSO</h4>
    </div>

    <div class = "modal-body ">
        <div class = "row">


            <ul class = "nav nav-tabs"> <!--menu das abas -->
                <li class = "active"><a data-toggle = "tab" href = "#home">Processo</a></li>
                <li><a data-toggle = "tab" href = "#menu1">Requerente</a></li>
                <li><a data-toggle = "tab" href = "#menu2">Documentos</a></li>
                <li><a data-toggle = "tab" href = "#menu4">Observações</a></li>
                <li><a data-toggle = "tab" href = "#menu5">Cargas</a></li>
            </ul> <!--fim dos menu das abas -->


            <div class = "tab-content"><!--abertura das abas do formulário -->

                <div id = "home" class = "tab-pane fade in active"> <!--primeira aba -->
                    <div class = "panel panel-default">
                        <!--INICIO Dados do imóvel -->
                        <div class = "panel-heading text-center">PROCESSO</div>
                        <div class = "panel-body">
                            <!--inicio dados inscrição-->
                            <div class = "row">
                                <div class="col-sm-6">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_text('Tipo Processo', 'tipo_processo', 'tipo_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), fun_retorna_descricao_tipo_processo($pdo, 1));
                                    ?>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-sm-6">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Número ', 'numero_processo', 'numero_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['numeroProcesso']);
                                    ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Ano ', 'ano_processo', 'ano_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['anoProcesso']);
                                    ?>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-sm-2">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Cod_Origem ', 'cod_origem_processo', 'cod_origem_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['idOrigem']);
                                    ?>
                                </div>
                                <div class="col-sm-10">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Origem ', 'desricao_origem_processo', 'desricao_origem_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['descricao_origem']);
                                    ?>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-sm-2">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Cod_Assunto ', 'cod_origem_processo', 'cod_origem_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['idAssunto']);
                                    ?>
                                </div>
                                <div class="col-sm-10">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Assunto ', 'desricao_origem_processo', 'desricao_origem_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['descricao_assunto']);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div><!-- fim da primeira aba -->

                <div id="menu1" class="tab-pane"> <!-- segunda aba -->
                    <div class="panel panel-default">
                        <!-- INICIO Dados do imóvel -->
                        <div class="panel-heading text-center" >REQUERENTE</div>
                        <div class="panel-body">
                            <!-- inicio dados inscrição-->
                            <div class="row">
                                <div class="col-sm-2">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Cod_Requerente ', 'cod_requerente_processo', 'cod_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['idRequerente']);
                                    ?>
                                </div>
                                <div class="col-sm-10">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Requerente ', 'desricao_requerente_processo', 'desricao_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['descricao_requerente']);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Logradouro ', 'logradouro_requerente_processo', 'logradouro_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['logradouro']);
                                    ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Número ', 'numero_endereco_requerente_processo', 'numero_endereco_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['numero']);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Complemento ', 'complemento_requerente_processo', 'complemento_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['complemento']);
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Bairro ', 'bairro_requerente_processo', 'bairro_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['bairro']);
                                    ?>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Cidade ', 'cidade_requerente_processo', 'cidade_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['cidade']);
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('Cep ', 'cep_endereco_requerente_processo', 'cep_endereco_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['cep']);
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    //   INPUT -                              
                                    criar_input_data('UF ', 'uf_endereco_requerente_processo', 'uf_endereco_requerente_processo', array('required' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['uf']);
                                    ?>
                                </div>
                            </div>
                            <!-- fim dados inscrição-->
                        </div>
                        <!-- FIM Dados do imóvel -->
                    </div>
                </div><!-- Fim segunda aba -->

                <div id="menu2" class="tab-pane"> <!-- segunda aba -->
                    <div class="panel panel-default">
                        <!-- INICIO Dados do imóvel -->
                        <div class="panel-heading text-center" >DOCUMENTOS </div>
                        <div class="panel-body">
                            <div style='max-height: 200px; overflow: auto;'>
                                <table class='table table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Número</th>
                                            <th>Ano</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_documento = "SELECT * FROM documento_processo WHERE idProcesso ='{$dados['idProcesso']}' ";
                                        $query_doc = $pdo->prepare($sql_documento);
                                        $query_doc->execute();
                                        for ($i = 0; $dados_doc = $query_doc->fetch(); $i++) {
                                            ?>   	


                                            <tr>
                                                <td><?php echo $dados_doc['descricao_documento']; ?></td>
                                                <td><?php echo $dados_doc['numeroDocumento']; ?></td>
                                                <td><?php echo $dados_doc['anoDocumento']; ?></td>
                                           
                                            </tr>


                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div><!-- Fim segunda aba -->



                <div id="menu4" class="tab-pane"> <!-- Quarta aba -->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center" >OBSERVAÇÕES</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    //   INPUT -                              
                                    criar_textarea('Observação ', 'observacao_processo', 'observacao_processo', fun_retorna_descricao_observacao($pdo, $dados['idProcesso']), array('required' => 'true',  'maxlength' => '254', 'rows' => '9'));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="menu5" class="tab-pane"> <!-- Quarta aba -->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center" >CARGAS</div>
                        <div class="panel-body">
                            <div style='max-height: 200px; overflow: auto;'>
                                <table class='table table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Data Carga</th>
                                            <th>Setor Carga</th>
                                            <th>Usuario Carga</th>
                                            <th>Data Recebimento</th>
                                            <th>Setor Recebimento</th>
                                            <th>Usuario Recebimento</th>
                                            <th>Parecer Carga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_carga = "SELECT * FROM carga_processo WHERE idProcesso ='{$dados['idProcesso']}' ORDER BY seq_carga DESC ";
                                        $query_carga= $pdo->prepare($sql_carga);
                                        $query_carga->execute();
                                        for ($i = 0; $dados_carga = $query_carga->fetch(); $i++) {
                                            ?>   	


                                            <tr>
                                                <td><?php echo dataBrasileiro($dados_carga['dataCarga']); ?></td>
                                                <td><?php echo func_retorna_descricao_setor($pdo, $dados_carga['idSetorOrigem']); ?></td>
                                                <td><?php echo func_retorna_usuario($pdo, $dados_carga['idUsuarioCarga']);; ?></td>
                                                <td><?php echo dataBrasileiro($dados_carga['dataRecebimento']); ?></td>
                                                <td><?php echo func_retorna_descricao_setor($pdo, $dados_carga['idSetorEntrada']); ?></td>
                                                <td><?php echo func_retorna_usuario($pdo, $dados_carga['idUsuarioRecebimento']);; ?></td>
                                                <td><?php echo $dados_carga['parecer']; ?></td>
                                                
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

            <div class="row">
                <div class="col-sm-12 text-right">
                    <div id="buttons"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    <?php
}
?>
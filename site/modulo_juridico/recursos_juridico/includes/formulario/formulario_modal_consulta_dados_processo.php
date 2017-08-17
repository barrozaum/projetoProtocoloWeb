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

if ($_POST['id'] === '10') {
    consulta_id_processo($pdo, 1);
} else if ($_POST['id'] === '7') {
    consulta_id_processo($pdo);
} else if ($_POST['id'] === '99') {
    consulta_numero_ano_processo($pdo);
} else {
    mostrar_pagina_de_erro();
}
?>




<?php

function consulta_id_processo($pdo, $addicionar = 0) {
    $codigo = letraMaiuscula($_POST['codigo']);

    $sql_conulta_codigo = "SELECT * FROM cadastro_processo ";
    $sql_conulta_codigo = $sql_conulta_codigo . " WHERE idProcesso = '$codigo'";
    $sql_conulta_codigo = $sql_conulta_codigo . " Limit 1";

    $query_consulta_codigo = $pdo->prepare($sql_conulta_codigo);
    $query_consulta_codigo->execute();
    if ($query_consulta_codigo->fetchColumn() > 0) {
        $query_consulta_codigo->execute();
        $dados = $query_consulta_codigo->fetch();
        mostrar_dados_processo($pdo, $dados, $addicionar);
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

function mostrar_dados_processo($pdo, $dados, $addicionar) {
    ?>
<form name="mostra_dados_processo" id="id_mostra_dados_processo" action="cadastra_juridico.php" method="post">
        <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal">&times;
            </button>
            <h4 class = "modal-title">CONSULTA DADOS PROCESSO</h4>
        </div>

        <div class = "modal-body ">
            <div class="row">
                <?php echo fun_verificar_apensado($pdo, $dados['idProcesso']); ?>

            </div>

            <div class = "row">
                <ul class = "nav nav-tabs"> <!--menu das abas -->
                    <li class = "active"><a data-toggle = "tab" href = "#home">Processo</a></li>
                    <li><a data-toggle = "tab" href = "#menu1">Requerente</a></li>
                    <li><a data-toggle = "tab" href = "#menu2">Documentos</a></li>
                    <li><a data-toggle = "tab" href = "#menu3">Apensos</a></li>
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
                                        criar_input_text('Tipo Processo', 'tipo_processo', 'tipo_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), fun_retorna_descricao_tipo_processo($pdo, $dados['tipoProcesso']));
                                        criar_input_hidden('cod_tipo_processo', array(), $dados['tipoProcesso']);
                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Valor R$', 'valor_processo', 'valor_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['valor']);
                                        ?>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-sm-6">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Número ', 'numero_processo', 'numero_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['numeroProcesso']);
                                        criar_input_hidden( 'cod_processo',  array(), $dados['idProcesso']);
                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Ano ', 'ano_processo', 'ano_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['anoProcesso']);
                                        ?>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-sm-10">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Origem ', 'desricao_origem_processo', 'desricao_origem_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['descricao_origem']);
                                        criar_input_hidden( 'cod_origem_processo',  array(), $dados['idOrigem']);
                                        ?>
                                    </div>
                                </div>
                                <div class = "row">
                                       <div class="col-sm-10">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Assunto ', 'descricao_assunto_processo', 'descricao_assunto_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['descricao_assunto']);
                                        criar_input_hidden( 'cod_assunto_processo',  array(), $dados['idAssunto']);
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
                                    <div class="col-sm-10">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Requerente ', 'desricao_requerente_processo', 'desricao_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['descricao_requerente']);
                                        criar_input_hidden( 'cod_requerente_processo',  array(), $dados['idRequerente']);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-10">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Logradouro ', 'logradouro_requerente_processo', 'logradouro_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['logradouro']);
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Número ', 'numero_endereco_requerente_processo', 'numero_endereco_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['numero']);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Complemento ', 'complemento_requerente_processo', 'complemento_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['complemento']);
                                        ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Bairro ', 'bairro_requerente_processo', 'bairro_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['bairro']);
                                        ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Cidade ', 'cidade_requerente_processo', 'cidade_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), $dados['cidade']);
                                        ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('Cep ', 'cep_endereco_requerente_processo', 'cep_endereco_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['cep']);
                                        ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('UF ', 'uf_endereco_requerente_processo', 'uf_endereco_requerente_processo', array('readonly' => 'true', 'maxlength' => '10', 'placeholder' => ''), $dados['uf']);
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
                    <div id="menu3" class="tab-pane"> <!-- segunda aba -->
                        <div class="panel panel-default">
                            <!-- INICIO Dados do imóvel -->
                            <div class="panel-heading text-center" >APENSOS </div>
                            <div class="panel-body">
                                <div style='max-height: 200px; overflow: auto;'>
                                    <table class='table table-bordered table-hover'>
                                        <thead>
                                            <tr>
                                                <th>Tipo Apenso</th>
                                                <th>Número Apenso</th>
                                                <th>Ano Apenso</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_apenso = "SELECT cp.numeroProcesso, cp.anoProcesso, t.descricao_tipo_processo FROM apenso a, cadastro_processo cp, tipo_processo t ";
                                            $sql_apenso = $sql_apenso . " WHERE a.id_processo_pai ='{$dados['idProcesso']}' ";
                                            $sql_apenso = $sql_apenso . " AND a.id_processo_filho = cp.idProcesso ";
                                            $sql_apenso = $sql_apenso . " AND cp.tipoProcesso = t.id_tipo_processo ";
                                            $query_apenso = $pdo->prepare($sql_apenso);
                                            $query_apenso->execute();
                                            for ($i = 0; $dados_apenso = $query_apenso->fetch(); $i++) {
                                                ?>   	


                                                <tr>
                                                    <td><?php echo $dados_apenso['descricao_tipo_processo']; ?></td>
                                                    <td><?php echo $dados_apenso['numeroProcesso']; ?></td>
                                                    <td><?php echo $dados_apenso['anoProcesso']; ?></td>

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
                                        criar_textarea('Observação ', 'observacao_processo', 'observacao_processo', fun_retorna_descricao_observacao($pdo, $dados['idProcesso']), array('readonly' => 'true', 'maxlength' => '254', 'rows' => '9'));
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
                                                <th>Hora Carga</th>
                                                <th>Setor Carga</th>
                                                <th>Usuario Carga</th>
                                                <th>Data Recebimento</th>
                                                <th>Hora Recebimento</th>
                                                <th>Setor Recebimento</th>
                                                <th>Usuario Recebimento</th>
                                                <th>Parecer Carga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_carga = "SELECT * FROM carga_processo WHERE idProcesso ='{$dados['idProcesso']}' ORDER BY seq_carga DESC ";
                                            $query_carga = $pdo->prepare($sql_carga);
                                            $query_carga->execute();
                                            for ($i = 0; $dados_carga = $query_carga->fetch(); $i++) {
                                                ?>   	


                                                <tr>
                                                    <td><?php echo dataBrasileiro($dados_carga['dataCarga']); ?></td>
                                                    <td><?php echo $dados_carga['hora_carga']; ?></td>
                                                    <td><?php echo func_retorna_descricao_setor($pdo, $dados_carga['idSetorOrigem']); ?></td>
                                                    <td><?php echo func_retorna_usuario($pdo, $dados_carga['idUsuarioCarga']); ?></td>
                                                    <td><?php echo dataBrasileiro($dados_carga['dataRecebimento']); ?></td>
                                                    <td><?php echo $dados_carga['hora_recebimento']; ?></td>
                                                    <td><?php echo func_retorna_descricao_setor($pdo, $dados_carga['idSetorEntrada']); ?></td>
                                                    <td><?php echo func_retorna_usuario($pdo, $dados_carga['idUsuarioRecebimento']); ?></td>
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
            <?php if($addicionar == 1 ){?>
            <button type="submit" class="btn btn-success" >Confirmar</button>
            <?php }?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </form> 
    <?php
}

function fun_verificar_apensado($pdo, $id_processo_filho) {
    $sql_filho = "SELECT cp.numeroProcesso, cp.anoProcesso, t.descricao_tipo_processo FROM apenso a, cadastro_processo cp, tipo_processo t";
    $sql_filho = $sql_filho . " WHERE $id_processo_filho = a.id_processo_filho";
    $sql_filho = $sql_filho . " AND a.id_processo_pai = cp.idProcesso";
    $sql_filho = $sql_filho . " AND cp.tipoProcesso = t.id_tipo_processo";
    $query_filho = $pdo->prepare($sql_filho);
    $query_filho->execute();
    if ($dados_filho = $query_filho->fetch()) {
        $msg = "<div class='alert alert-danger text-center'>";
        $msg = $msg . " PROCESSO APENSADO !!!";
        $msg = $msg . " <hr />";
        $msg = $msg . " DADOS APENSADOR -> TIPO :" . $dados_filho['descricao_tipo_processo'] . " - NÚMERO :" . $dados_filho['numeroProcesso'] . " - ANO :" . $dados_filho['anoProcesso'];
        $msg = $msg . "</DIV>";
        return $msg;
    } else {
        return "";
    }
}

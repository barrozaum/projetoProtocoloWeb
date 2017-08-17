<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
// abrindo conexao
include_once '../estrutura/conexao/conexao.php';

//macete para nao aparecer setor do usuario
$_SESSION['NAO_MOSTRAR_SETOR'] = "";
?>
<?php
if (empty($_POST['id'])) {
    formulario($pdo);
}
?>

<?php

function formulario($pdo) {
    ?>


    <form  method="post" action="recursos/includes/cadastrar/cadastro_carga_coletiva.php" id="id_formulario_carga_coletiva" >    

        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div id="msg_erro"></div>
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CADASTRAMENTO DE CARGA COLETIVA </div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa('SETOR', 'setor', 'setor', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'INFORME O SETOR DE DESTINO DA CARGA'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]', 'lupa_setor');
                                criar_input_hidden('codigo_setor', array(), '');
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <?php
                                criar_input_data('Data Carga', 'data', 'data', array('required' => 'true', 'placeholder' => '00/00/0000'), date('d/m/Y'), 'somente numeros');
                                ?>
                            </div>
                        </div>
                        <?php
//                        se usuario == adm mostra o setor de origem que ele quer ficar
                        if ($_SESSION['LOGADO_PERFIL_USUARIO'] == 1) {

                            criar_input_text_com_lupa('SETOR', 'alterar_colaborador_setor', 'alterar_colaborador_setor', array('readonly' => 'true', 'maxlength' => '30', 'placeholder' => 'ADMINISTRADOR INFORME SEU ORIGEM'), '', '', 'lupa_setor_usuario');
                            criar_input_hidden('alterar_colaborador_codigo_setor', array(), "");
                        } else {
                            criar_input_hidden('alterar_colaborador_codigo_setor', array(), $_SESSION['LOGIN_CODIGO_SETOR_USUARIO']);
                        }
                        ?>
                    </div>
                    <div class="panel-heading text-center">DADOS PROCESSO</div>
                    <div class="panel-body">
                        <table id="tabela-contrato" class="table">

                            <thead>
                                <tr>
                                    <th>    
                                        <?php
                                        //   INPUT -                              
                                        criar_input_select('Tipo Processo', 'tipo_processo', 'tipo_processo', array('required' => 'true'), fun_retorna_tipo_processo_existente($pdo), '');
                                        ?>
                                    </th>
                                    <th>    
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('NÚMERO', 'numero_processo', 'numero_processo', array('maxlength' => '6', 'placeholder' => 'Informe o Número Processo', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                        ?>
                                    </th>
                                    <th>   
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('ANO', 'ano_processo', 'ano_processo', array('maxlength' => '4', 'placeholder' => 'Informe o Ano Processo', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                        ?>
                                    </th>
                                    <th>  
                                        <button type="button" id="id_vericar_processo" class="btn btn-large btn-primary">Procurar</button>
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="id_tabela_apenso"> 
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" id="id_efetuar_carga">Efetuar Carga</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <?php
}
?>


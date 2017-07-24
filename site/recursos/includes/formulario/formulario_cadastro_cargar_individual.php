<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
//inclusao da conexao com o banco de dados
include_once '../estrutura/conexao/conexao.php';
?>
<?php
if (empty($_POST['id'])) {
    formulario($pdo);
}
?>

<?php

function formulario($pdo) {
    ?>


    <form  method="post" action="#">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">CADASTRAMENTO DE CARGA NO PROCESSO</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_select('Tipo Processo', 'tipo_processo', 'tipo_processo', array('required' => 'true'), fun_retorna_tipo_processo_existente($pdo), '');
                                ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Número', 'numero_processo', 'numero_processo', array('required' => 'true', 'maxlength' => '6', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                //   INPUT -                              
                                criar_input_text('Ano', 'ano_processo', 'ano_processo', array('required' => 'true', 'maxlength' => '4', 'placeholder' => '', 'onkeypress' => 'return SomenteNumero(event)'), date('Y'));
                                ?>
                            </div>
                        </div> 
                        <?php
//                        se usuario == adm mostra o setor de origem que ele quer ficar
                        if ($_SESSION['LOGADO_PERFIL_USUARIO'] == 1) {

                            criar_input_text_com_lupa('SETOR', 'alterar_colaborador_setor', 'alterar_colaborador_setor', array('readonly' => 'true', 'maxlength' => '30', 'placeholder' => 'ADMINISTRADOR INFORME SEU SETOR DE ORIGEM'), '', '', 'lupa_setor_usuario');
                            criar_input_hidden('alterar_colaborador_codigo_setor', array(), "");
                        } else {
                            criar_input_hidden('alterar_colaborador_codigo_setor', array(), $_SESSION['LOGIN_CODIGO_SETOR_USUARIO']);
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="id_consulta_numero">Consultar</button>
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

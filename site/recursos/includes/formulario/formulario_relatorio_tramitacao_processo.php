<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
//include funcao com os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
//macete para nao aparecer setor do usuario
$_SESSION['NAO_MOSTRAR_SETOR'] = "";
?>
<?php
if (empty($_POST['id'])) {
    formulario();
}
?>

<?php

function formulario() {
    ?>


   <form  method="post" action="recursos/includes/relatorio/relatorio_tramite_processo_para_setor.php" id="id_formulario_processo" target="_blank">    
   
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div id="msg_erro"></div>
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">RELAÇÃO DE TRAMITAÇÃO DE PROCESSOS PARA O SETOR </div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //   INPUT -                              
                                criar_input_text_com_lupa('SETOR', 'setor', 'setor', array('readonly' => 'true' , 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'INFORME O SETOR DA ORIGEM DA CARGA'), '', 'Conter no Minimo 3 caracteres [a-z A-Z]', 'lupa_setor');
                                criar_input_hidden('codigo_setor', array(), '');
                                ?>
                            </div>
                        </div>
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
                         <?php
//                        se usuario == adm mostra o setor de origem que ele quer ficar
                        if ($_SESSION['LOGADO_PERFIL_USUARIO'] == 1) {

                            criar_input_text_com_lupa('SETOR', 'alterar_colaborador_setor', 'alterar_colaborador_setor', array('readonly' => 'true', 'maxlength' => '30', 'placeholder' => 'ADMINISTRADOR INFORME SEU SETOR DE DESTINO'), '', '', 'lupa_setor_usuario');
                            criar_input_hidden('alterar_colaborador_codigo_setor', array(), "");
                        } else {
                            criar_input_hidden('alterar_colaborador_codigo_setor', array(), $_SESSION['LOGIN_CODIGO_SETOR_USUARIO']);
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="id_buscar_processos">Procurar</button>
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


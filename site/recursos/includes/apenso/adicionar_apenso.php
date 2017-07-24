<?php
// die(print_r($_POST));
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
//abrindo banco 
include_once '../estrutura/conexao/conexao.php';

if ($_POST['id_programa'] == "1") {
    func_prosseguir_anexo($pdo);
}
$pdo = null;

function func_prosseguir_anexo($pdo) {
    ?>

    <form  method="post" id="id_fomr_apenso" action="recursos/includes/cadastrar/cadastro_apenso.php">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">DADOS PROCESSO PRINCIPAL</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('TIPO PROCESSO', 'descricao_tipo_processo', 'descricao_tipo_processo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '50', 'placeholder' => ''), fun_retorna_descricao_tipo_processo($pdo, $_POST['tipo']), "");
                                criar_input_hidden('tipo_processo', array(), $_POST['tipo']);
                                criar_input_hidden('codigo_processo', array(), $_POST['codigo']);
                                criar_input_hidden('apensado', array(), $_POST['apensado']);
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('NUMERO', 'numero_processo', 'numero_processo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '50', 'placeholder' => ''), $_POST['numero'], "");
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_text('ANO', 'ano_processo', 'ano_processo', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '50', 'placeholder' => ''), $_POST['ano'], "");
                                ?>
                            </div>
                        </div> 
                    </div>
                    <div class="panel-heading text-center">DADOS PROCESSO APENSO</div>
                    <div class="panel-body">
                        <table id="tabela-contrato" class="table">
                            <thead>
                                <tr>
                                    <th>    
                                        <?php
                                        //   INPUT -                              
                                        criar_input_select('Tipo Processo', 'tipo_anexo', 'tipo_anexo', array('required' => 'true'), fun_retorna_tipo_processo_existente($pdo), '');
                                        ?>
                                    </th>
                                    <th>    
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('NÚMERO', 'numero_anexo', 'numero_anexo', array('maxlength' => '6', 'placeholder' => 'Informe o Número Anexo', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                        ?>
                                    </th>
                                    <th>   
                                        <?php
                                        //   INPUT -                              
                                        criar_input_text('ANO', 'ano_anexo', 'ano_anexo', array('maxlength' => '4', 'placeholder' => 'Informe o Ano Anexo', 'onkeypress' => 'return SomenteNumero(event)'), '');
                                        ?>
                                    </th>
                                    <th>  
                                        <button type="button" id="id_vericar_processo_anexo" class="btn btn-large btn-primary">Procurar</button>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM apenso a, cadastro_processo cp WHERE a.id_processo_pai = '{$_POST['codigo']}' AND a.id_processo_filho = cp.idProcesso";
                            $query = $pdo->prepare($sql);
                            //executo o comando sql
                            $query->execute();

                            //loop para listar todos os dados encontrados
                            for ($i = 0; $dados = $query->fetch(); $i++) {
                                ?>   	


                                <tr>
                                    <th>    
                                        <input type="text" class="form-control" name ="txt_array_tipo_anexo[]" required="true" value="<?php print fun_retorna_descricao_tipo_processo($pdo,$dados['tipoProcesso']);?>" maxlength="12" placeholder="" readonly="true"/>
                                    </th>
                                    <th>    
                                        <input type="text" class="form-control" name ="txt_array_numero_anexo[]" required="true" value="<?php print $dados['numeroProcesso'];?>" maxlength="12" placeholder="" readonly="true"/>
                                    </th>
                                    <th>   
                                        <input type="text" class="form-control" name ="txt_array_ano_anexo[]" required="true" value="<?php print $dados['anoProcesso'];?>" maxlength="12" placeholder="" readonly="true"/>
                                    </th>
                                    <th>  
                                        <input type="hidden" class="form-control" name ="txt_array_codigo_anexo[]"  required="true" value="<?php print $dados['idProcesso'];?>" maxlength="11" placeholder="" readonly="true"/>
                                    </th>
                                </tr>

                                <?php
                            }
                            $pdo = null;
                            ?>
                            <tbody id="id_tabela_apenso"> 
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" id="id_realizar_apenso">APENSAR PROCESSOS</button>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </form>


    <?php
}
?>
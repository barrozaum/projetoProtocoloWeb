<?php
include_once '../estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../estrutura/conexao/conexao.php';
?>
<?php
if (empty($_POST['id'])) {
    formularioCadastro($pdo);
    $pdo = null;
}
?>


<?php

function formularioCadastro($pdo) {         // preparo para realizar o comando sql
    $sql = "select * FROM usuario  order by login";
    $query = $pdo->prepare($sql);
    //executo o comando sql
    $query->execute();

    //loop para listar todos os dados encontrados
    $colaboradores[""] = "SELECIONE O COLABORADOR";
    for ($i = 0; $dados = $query->fetch(); $i++) {
        $colaboradores[$dados['idUsuario']] = $dados['login'];
    }
    ?>


<form  method="post" name="f1" action="recursos/includes/cadastrar/cadastro_permissao.php">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">PERMISSÃO COLABORADOR</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                //   INPUT -                              
                                criar_input_select("Colaboradores", "colaborador", "colaborador", array("required" => "true"), $colaboradores)
                                ?>
                            </div>
                            <div class="col-sm-8">
                                <?php
                                //   INPUT -                              
                                criar_input_text("Setor", "setor", "setor", array("readonly" => "true", "required" => "true", "placeholder" => "Informe o setor"), "");
                                ?>
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info text-center">Lista de Programas</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn-link " onclick="javascript:selecionar_tudo()">MARCAR</button>
                                <button type="button" class="btn-link " onclick="javascript:deselecionar_tudo()">DESMARCAR</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="overflow: auto; max-width: 100%; max-height: 300px">
                                    <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nome_Programa</th>
                                                <th>Permitir</th>
                                                <th>Nome_Programa</th>
                                                <th>Permitir</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            // preparo para realizar o comando sql
                                            $sql = "select * FROM menu_sistema order by nome_programa";
                                            $query = $pdo->prepare($sql);
                                            //executo o comando sql
                                            $query->execute();

                                            //loop para listar todos os dados encontrados
                                            $contador = 0;
                                            $i=0;
                                            while ($dados = $query->fetch()) {
                                                $i++;
                                                if ($contador == 0) {
                                                    echo "<tr>";
                                                }
                                                echo "<td><label >{$dados['nome_programa']}</label></td>";
                                                echo "<td align='left'><input type='checkbox' class='form-control' name='permissao[]' value='{$dados['id_menu']}' id='{$dados['id_menu']}'/></td>";
                                                if ($contador == 1) {
                                                    echo "</tr>";
                                                    $contador = 0;
                                                } else {
                                                    $contador++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                        </div> 
                    </div> 
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Enviar</button> 
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>


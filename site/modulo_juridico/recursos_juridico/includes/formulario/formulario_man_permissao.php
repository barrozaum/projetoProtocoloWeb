<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
// criacao dos campos inputs 
include_once '../../../../recursos/includes/funcoes/funcaoCriacaoInput.php';
include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';
?>
<?php
if (empty($_POST['id'])) {
    formularioCadastro($pdo);
    $pdo = null;
}
?>


<?php

function formularioCadastro($pdo) {         // preparo para realizar o comando sql
    $sql = "select * FROM usuario WHERE idSetor = 14  order by login";
    $query = $pdo->prepare($sql);
    //executo o comando sql
    $query->execute();

    //loop para listar todos os dados encontrados
    $colaboradores[""] = "SELECIONE O COLABORADOR";
    for ($i = 0; $dados = $query->fetch(); $i++) {
        $colaboradores[$dados['idUsuario']] = $dados['login'];
    }
    ?>


    <form  method="post" name="f1" action="recursos_juridico/includes/cadastrar/cadastro_permissao.php">    
        <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
            <div class="well"><!-- div que coloca a cor no formulário -->
                <div class="panel panel-default">
                    <!-- INICIO Dados do imóvel -->
                    <div class="panel-heading text-center">PERMISSÃO COLABORADOR</div>
                    <div class="panel-body">
                        <!-- inicio dados inscrição-->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                                <?php
                                //   INPUT -                              
                                criar_input_select("Colaboradores", "colaborador", "colaborador", array("required" => "true"), $colaboradores)
                                ?>
                            </div>
                        </div> 

                        <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                                <?php
                                //   INPUT -                              
                                criar_input_select("PERFIL", "perfil", "perfil", array("required" => "true"), array('' => 'SELECIONE O PERFIL', '0' => 'USUARIO', '1' => 'ADMINISTRADOR'))
                                ?>
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


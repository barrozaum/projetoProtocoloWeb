<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
//lembre-se não pode alterar a ordem do menu
// cada código representa uma parte do menu
?>

<div class="page-header">
    <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
        <div class="row">
            <div class="col-lg-2 col-lg-offset-0 text-center">
                <a href="inicial.php">
                    <img src="../<?php echo $_SESSION['CONFIG_CAMINHO_LOGO']; ?>" height="76" width="150" alt="logo cliente" title="logo da prefeitura">
                </a>
            </div>
            <div class="col-lg-9 col-lg-offset-0 ">
                <nav class="navbar navbar-default nav-justified" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->

                    <div class="navbar-header ">
                        <a class="navbar-brand" href="inicial.php"><?php print $_SESSION['CONFIG_NOME_CLIENTE']; ?> - JURÍDICO</a>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse ">
                        <ul class="nav navbar-nav ">
                            

                           
                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">CONSULTA-JURIDICO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        
                                            <li><a href="consulta_numero_juridico.php">NÚMERO</a></li>
                                            <li><a href="consulta_reu.php">RÉU</a></li>
                                            <li><a href="consulta_acao.php">AÇÃO</a></li>
                                            <li><a href="consulta_autor.php">AUTOR</a></li>
                                            <li><a href="consulta_prazo.php">PRAZO</a></li>
                                    </ul>
                                </li>
                            
                                <?php if($_SESSION['PERMISSAO_MENU_JURIDICO'] == 1){    ?>
                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">MANUTENÇÃO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                            <li><a href="man_permissao.php">PERMISSÃO</a></li>
                                      
                                    </ul>
                                </li>
                                <?php } ?>

                            <li class="dropdown"><a href="../inicial.php" >SAIR-JURÍDICO</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    </div>
</div>
<hr />

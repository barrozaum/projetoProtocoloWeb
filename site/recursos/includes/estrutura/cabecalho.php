<?php
session_start();
?>
<div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
    <div class="row">
        <div class="col-lg-2 col-lg-offset-0 text-center">
            <a href="inicial.php">
                <img src="<?php echo $_SESSION['CONFIG_CAMINHO_LOGO']; ?>" height="76" width="150" alt="logo cliente" title="logo da prefeitura">
                <!--<img src="recursos/imagens/estrutura/logo.jpg" height="76px" alt="logo cliente" title="logo da prefeitura">-->
            </a>
        </div>
        <div class="col-lg-9 col-lg-offset-0 ">
            <nav class="navbar navbar-default nav-justified" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header ">
                    <a class="navbar-brand" href="inicial.php"><?php print $_SESSION['CONFIG_NOME_CLIENTE']; ?></a>
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">PROCESSO <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PROCESSO</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cadastro_processo.php">NOVO</a></li>
                                        <li><a href="alterar_processo.php">ALTERAR</a></li>
                                        <li><a href="excluir_processo.php">EXCLUIR</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">CARGA</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cadastro_carga_individual.php">INDIVIDUAL</a></li>
                                        <!--<li><a href="cadastro_carga_coletiva.php">COLETIVA</a></li>-->
                                        <li><a href="excluir_carga.php">EXCLUIR</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">RECEBIMENTO</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cadastro_recebimento_individual.php">INDIVIDUAL</a></li>
                                        <!--<li><a href="cadastro_carga_coletiva.php">COLETIVO</a></li>-->
                                    </ul>
                                </li>
                                <li><a href="segunda_via_etiqueta.php">2° VIA ETIQUETA</a></li>
                                <!--<li><a href="cadastro_anexo.php">ANEXAR</a></li>-->
                            </ul>
                        </li>
                        <li class="root">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CADASTRO <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="cadastro_assunto.php">ASSUNTO</a></li>
                                <li><a href="cadastro_documento.php">DOCUMENTO</a></li>
                                <li><a href="cadastro_origem.php">ORIGEM</a></li>
                                <li><a href="cadastro_secretaria.php">SETOR</a></li>
                                <li><a href="cadastro_requerente.php">REQUERENTE</a></li>
                                <li><a href="cadastro_tipo_processo.php">TIPO PROCESSO</a></li>
                            </ul>
                        </li>

                        <li class="root">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CONSULTA <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="consulta_numero.php">NÚMERO</a></li>
                                <li><a href="consulta_assunto.php">ASSUNTO</a></li>
                                <li><a href="consulta_anexo_processo.php">ANEXO</a></li>
                                <li><a href="consulta_data_carga.php">DATA CARGA</a></li>
                                <li><a href="consulta_data_criacao_processo.php">DATA PROCESSO</a></li>
                                <li><a href="consulta_documento.php">DOCUMENTO</a></li>
                                <li><a href="consulta_requerente.php">REQUERENTE</a></li>
                                <li><a href="consulta_setor.php">SETOR</a></li>
                                <li><a href="consulta_origem.php">ORIGEM</a></li>
                            </ul>
                        </li>

                        <li class="root">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">RELATÓRIO <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">PROCESSO NO SETOR</a></li>
                                <!--remessa, sai do setor da carga e vai para o setor de destino-->
                                <li><a href="relatorio_remessa_processo.php">PROCESSO PARA REMESSA</a></li>
                                <!--tramitação, é os processo enviados para um determinado setor -->
                                <li><a href="relatorio_tramitacao_processo.php">TRAMITAÇÃO DE PROCESSO NO SETOR</a></li>
                                <li><a href="relatorio_carga_processo.php">ANDAMENTO DE PROCESSO</a></li>
                            </ul>
                        </li>



                        <li class="root">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">MANUTENÇÃO <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="Man_Usuario.php">Usuário</a></li>
                                <li><a href="Man_Senha.php">Senha</a></li>
                                <li><a href="Man_Perimissao.php">Permissão</a></li>
                                <li><a href="Man_Configuracao.php">Configuração</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="logout.php" >SAIR</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>


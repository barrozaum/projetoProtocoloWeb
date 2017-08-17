<?php
include_once './controle/validar_secao.php';
//lembre-se não pode alterar a ordem do menu
// cada código representa uma parte do menu
?>

<div class="page-header">
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
                            <?php
                            if (in_array("1", $_SESSION['PERMISSAO_MENU']) || in_array("2", $_SESSION['PERMISSAO_MENU']) || in_array("3", $_SESSION['PERMISSAO_MENU']) || in_array("4", $_SESSION['PERMISSAO_MENU']) || in_array("5", $_SESSION['PERMISSAO_MENU']) || in_array("6", $_SESSION['PERMISSAO_MENU']) || in_array("7", $_SESSION['PERMISSAO_MENU'])) {
                                ?>
                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">PROCESSO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        if (in_array("1", $_SESSION['PERMISSAO_MENU']) || in_array("2", $_SESSION['PERMISSAO_MENU']) || in_array("3", $_SESSION['PERMISSAO_MENU'])) {
                                            ?>
                                            <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PROCESSO</a>
                                                <ul class="dropdown-menu">
                                                    <?php if (in_array("1", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="cadastro_processo.php">NOVO</a></li>
                                                    <?php } if (in_array("2", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="alterar_processo.php">ALTERAR</a></li>
                                                    <?php } if (in_array("3", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="excluir_processo.php">EXCLUIR</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                        <?php
                                        if (in_array("4", $_SESSION['PERMISSAO_MENU']) || in_array("5", $_SESSION['PERMISSAO_MENU'])) {
                                            ?>
                                            <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">CARGA</a>
                                                <ul class="dropdown-menu">
                                                    <?php if (in_array("4", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="cadastro_carga_individual.php">INDIVIDUAL</a></li>
                                                    <?php } if (in_array("37", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="cadastro_carga_coletiva.php">COLETIVA</a></li>
                                                    <?php } if (in_array("5", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="excluir_carga.php">EXCLUIR</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                        <?php
                                        if (in_array("6", $_SESSION['PERMISSAO_MENU'])) {
                                            ?>
                                            <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">RECEBIMENTO</a>
                                                <ul class="dropdown-menu">
                                                    <?php if (in_array("6", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="cadastro_recebimento_individual.php">INDIVIDUAL</a></li>
                                                    <?php } ?>
                                                    <?php if (in_array("31", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="cadastro_recebimento_coletivo.php">COLETIVO</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                        <?php
                                        if (in_array("34", $_SESSION['PERMISSAO_MENU']) || in_array("35", $_SESSION['PERMISSAO_MENU'])) {
                                            ?>
                                            <li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">APENSO</a>
                                                <ul class="dropdown-menu">
                                                    <?php if (in_array("34", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="cadastro_apenso.php">INCLUIR</a></li>
                                                    <?php } ?>
                                                    <?php if (in_array("35", $_SESSION['PERMISSAO_MENU'])) { ?>
                                                        <li><a href="excluir_apenso.php">EXCLUI</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                        <?php if (in_array("7", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="segunda_via_etiqueta.php">2° VIA ETIQUETA</a></li>
                                        <?php } ?>
                                       
                                        <li><a href="modulo_juridico/inicial.php">JURÍDICO</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php
                            if (in_array("32", $_SESSION['PERMISSAO_MENU'])) {
                                ?>
                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">OFÍCIO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php if (in_array("8", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_oficio.php">NOVO</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php
                            if (in_array("8", $_SESSION['PERMISSAO_MENU']) || in_array("9", $_SESSION['PERMISSAO_MENU']) || in_array("10", $_SESSION['PERMISSAO_MENU']) || in_array("11", $_SESSION['PERMISSAO_MENU']) || in_array("30", $_SESSION['PERMISSAO_MENU']) || in_array("12", $_SESSION['PERMISSAO_MENU'])) {
                                ?>
                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">CADASTRO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php if (in_array("8", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_assunto.php">ASSUNTO</a></li>

                                        <?php } if (in_array("9", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_origem.php">ORIGEM</a></li>

                                        <?php } if (in_array("10", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_documento.php">DOCUMENTO</a></li>

                                        <?php } if (in_array("11", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_secretaria.php">SETOR</a></li>

                                        <?php } if (in_array("30", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_requerente.php">REQUERENTE</a></li>

                                        <?php } if (in_array("12", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="cadastro_tipo_processo.php">TIPO PROCESSO</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php
                            if (in_array("13", $_SESSION['PERMISSAO_MENU']) || in_array("14", $_SESSION['PERMISSAO_MENU']) || in_array("15", $_SESSION['PERMISSAO_MENU']) || in_array("16", $_SESSION['PERMISSAO_MENU']) || in_array("17", $_SESSION['PERMISSAO_MENU']) || in_array("18", $_SESSION['PERMISSAO_MENU']) || in_array("19", $_SESSION['PERMISSAO_MENU']) || in_array("20", $_SESSION['PERMISSAO_MENU'])) {
                                ?>

                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">CONSULTA <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php if (in_array("13", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_numero.php">NÚMERO</a></li>
                                        <?php } if (in_array("14", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_assunto.php">ASSUNTO</a></li>
                                        <?php } if (in_array("15", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_data_carga.php">DATA CARGA</a></li>
                                        <?php } if (in_array("16", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_data_criacao_processo.php">DATA PROCESSO</a></li>
                                        <?php } if (in_array("17", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_documento.php">DOCUMENTO</a></li>
                                        <?php } if (in_array("18", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_requerente.php">REQUERENTE</a></li>
                                        <?php } if (in_array("19", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_setor.php">SETOR</a></li>
                                        <?php } if (in_array("20", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_origem.php">ORIGEM</a></li>
                                        <?php } if (in_array("36", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="consulta_observacao.php">OBSERVAÇÃO</a></li>
                                        <?php } ?>
                                    </ul>

                                </li>

                            <?php } ?>
                            <?php if (in_array("21", $_SESSION['PERMISSAO_MENU']) || in_array("22", $_SESSION['PERMISSAO_MENU']) || in_array("23", $_SESSION['PERMISSAO_MENU']) || in_array("24", $_SESSION['PERMISSAO_MENU'])) {
                                ?>
                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">RELATÓRIO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php if (in_array("21", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="relatorio_setor_presente_processo.php">PROCESSO NO SETOR</a></li>
                                        <?php } if (in_array("22", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <!--remessa, sai do setor da carga e vai para o setor de destino-->
                                            <li><a href="relatorio_remessa_processo.php">PROCESSO PARA REMESSA</a></li>
                                        <?php } if (in_array("23", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <!--tramitação, é os processo enviados para um determinado setor -->
                                            <li><a href="relatorio_tramitacao_processo.php">TRAMITAÇÃO DE PROCESSO NO SETOR</a></li>
                                        <?php } if (in_array("24", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="relatorio_criacao_processo.php">PROCESSOS CRIADOS</a></li>
                                        <?php } if (in_array("33", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="relatorio_carga_processo.php">ANDAMENTO DE PROCESSO</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>


                            <?php
                            if (in_array("25", $_SESSION['PERMISSAO_MENU']) || in_array("26", $_SESSION['PERMISSAO_MENU']) || in_array("27", $_SESSION['PERMISSAO_MENU']) || in_array("28", $_SESSION['PERMISSAO_MENU']) || in_array("29", $_SESSION['PERMISSAO_MENU'])) {
                                ?>


                                <li class="root">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">MANUTENÇÃO <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php if (in_array("25", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="novo_usuario.php">COLABORADOR</a></li>
                                        <?php } if (in_array("26", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="#" id="btn_alterar_senha">SENHA</a></li>
                                        <?php } if (in_array("27", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="man_permissao.php">PERMISSÃO</a></li>
                                        <?php } if (in_array("28", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="desbloquear_colaborador.php">DESBLOQUEAR</a></li>
                                        <?php } if (in_array("29", $_SESSION['PERMISSAO_MENU'])) { ?>
                                            <li><a href="man_configuracao.php">CONFIGURAÇÃO</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <li class="dropdown"><a href="logout.php" >SAIR</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    </div>
</div>
<hr />

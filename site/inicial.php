    <?php
    session_start();

    include ('recursos/includes/verSessao.inc');
     $idUsuario = $_SESSION['idUsuario'];
     $idSetorUsuario =$_SESSION['idSetorUsuario'];

    ?>


    <!DOCTYPE HTML>
    <html lang="pt-br">
    	<head>
    		<meta charset="UTF-8">
    		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
    		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
    		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
    		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>



    	<title>Parvaim</title>
    </head>





    <body class="laterais">
    		<div id="externo">
    			<div id="cabecalho">

    						<a href="inicial.php"><h1 id="titulo"><span>Parvaim</span></h1></a>

    			</div>

    			<div id="menu">


    						<?php
    						// Inclui o menu do site
    						include('recursos/includes/verMenu.inc');
    						?>


    			</div>


    			<div id="centro1">

    			</div>

    			<div id="centro">

    				<div id="conteudo">





    				</div>
    			</div>
    			<div id="rodape">

    				<div id="usuario">

    				<?php
    				// Inclui informações do usuario

    				include('recursos/includes/inforUsuario.inc');
    				?>

    				</div>

    			</div>
    		</div>
    	</body>

    </html>

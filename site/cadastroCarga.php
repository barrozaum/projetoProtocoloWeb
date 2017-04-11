<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
	<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
	<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
	
	<?php
	// Inclui o script do site			
	
	include('recursos/includes/verScript.inc');
	include('recursos/includes/verSetor.inc');
	include('recursos/includes/cadastroCarga/funcaoListar.inc');
	include('recursos/includes/cadastroCarga/funcaoVerifica.inc');
	include('recursos/includes/cadastroCarga/funcaoExcluir.inc');
	include('recursos/includes/cadastroCarga/funcaoIncluir.inc');
	include('recursos/includes/cadastroCarga/funcaoListarCargaExcluir.inc');

	?>

		
		
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
					
					<?php 
					// o conteudo da página se encontra neste arquivo
					include('incluirCarga.php');
					?>
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

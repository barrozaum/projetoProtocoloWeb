<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];
$outrasop = $_SESSION['outrasOp'];
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
	include('recursos/includes/cadastroAnexo/funcaoExcluir.inc');
	include('recursos/includes/cadastroAnexo/funcaoIncluir.inc');	
	include('recursos/includes/cadastroAnexo/funcaoBuscaAnexoExcluir.inc');	
	include('recursos/includes/cadastroAnexo/funcaoBuscaAnexoIncluir.inc');	
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
					
				<div id="esquerdaForm">
					<h3>PROCESSO CADASTRO ANEXO</h3>
					<br />
					<br />
					<form>	
						TIPO PROCESSO:
						<select id="tipo" name="tipo"  >
						
						<option value='1'>COMUNICAÇÃO INTERNA</option>
						<option value='2'>COMUNICAÇÃO EXTERNA</option>							
						</select>
						<br />
						<br />
					

						<label>NÚMERO:
							<input type="text"  id="numero"  name="numero" maxlength="30" size="30px" onKeypress="return numeros();"/>
						</label>

						<label>ANO:
							<input type="text" id="ano" class="ano" name="ano" value="<?php echo date('Y'); ?>" maxlength="4" size="4px" onKeypress="return numeros();"/>
						</label>
						<br />
						<br />
						<input type="button" value="    ENVIAR    " onclick="buscarIncluir(this.value)">
						<input type="reset"  value="    CORRIGIR    ">


					</form>
					<br />
					<hr />

					<div id="txtHint">
				 

					 </div>
				</div>		 		
				<?php 


				if($outrasop == 1){?>
				<div id="direitaBotao">
					<input type="button" value="    EXCLUIR   " onclick="excluir();">
				</div>
				<?php }?>
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

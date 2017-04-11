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
		?>

		<script language="JavaScript">
		
		function verifica() {
		var n = document.f1.numeroProcesso.value;
		var a = document.f1.anoProcesso.value;
		
		if (n == ""){
			window.alert("VERIFIQUE O CAMPO NÚMERO !!!");
			document.f1.numeroProcesso.focus();
		}
		else if (a == ""){
			window.alert("VERIFIQUE O CAMPO ANO !!!");
			document.f1.numeroProcesso.focus();
		}
		else
		document.f1.submit();
		
		
		
		
		}
		</script>
		
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
				
				 	<h3>CONSULTA NÚMERO PROCESSO</h3>
					<br />
					<br />	
						<form name="f1"  action="consultaNumero1.php" method="post">
						TIPO PROCESSO :
							<select name = "tipoProcesso">
							<option value='01'>COMUNICAÇÃO INTERNA</option>
							<option value='02'>COMUNICAÇÃO EXTERNA</option>							
							</select>
							<br />
							<br />	
			
						
						<label>NÚMERO :
							<input type="text" name="numeroProcesso" value="" maxlength="30" size="30px" onKeypress="return numeros();" />
						</label>
						
						<label>ANO :
							<input type="text" id="ano" class="ano" name="anoProcesso" value="<?php echo date('Y'); ?>" maxlength="4" size="4px" onKeypress="return numeros();"/>
						</label>
						
						<input type="hidden" name="pagina" value="0">
						
						<br />
						<br />	
					
					
					
						<input type="Button"  value="    CONSULTAR    " onclick = "JavaScript: verifica();"/>
						</form>					
								
						
						
						
						
				
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

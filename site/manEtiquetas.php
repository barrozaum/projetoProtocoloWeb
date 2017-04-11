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
		// Inclui o menu do site			
		include('recursos/includes/verScript.inc');	
		?>
		
		
		<script languagem="JavaScript">
		
		function verifica(){
		
		var n = document.f1.numero.value;
		var a = document.f1.ano.value;
	
		if(n == "") {
			window.alert("VERIFIQUE O CAMPO NUMERO !!!");
			document.f1.numero.focus();
		}else if(a == ""){
			window.alert("VERIFIQUE O CAMPO ANO !!!");
			document.f1.ano.focus();
		}else{
			document.f1.submit();
		}
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
				<h3>IMPRIMIR ETIQUETA</h3>		
				<br />
				<br />		 
				<form name="f1"  action="manEtiquetas1.php" method="post">
						
				<label>TIPO PROCESSO:
				<select name = "tipo">
					<option value='01'>COMUNICAÇÃO INTERNA</option>
					<option value='02'>COMUNICAÇÃO EXTERNA</option>								
				</select>
				</label>
				<br />
				<br />
				
				<label>NÚMERO PROCESSO: 
					<input type = "text" name= "numero" onKeypress="return numeros();"/ >
				</label>
				
				<label>ANO PROCESSO:
					<input type="text" id="ano" class="ano" name="ano" value="<?php echo date('Y'); ?>" maxlength="4" size="4px"/>
				</label>
				<br />
				<br />
			
				<input type= "button" value ="    ENVIAR    " onclick="verifica();">
				<input type= "reset" value ="    CORRIGIR    ">
				</form>
				</div>
			</div>
			<div id="rodape">
				<div id="usuario">
				<?php
				// Incluiinformações do usuario		
				include('recursos/includes/inforUsuario.inc');	
				?>	
				</div>		 
			</div>
		</div>
	</body>
	
</html>

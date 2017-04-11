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
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloform.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		
		<script type="text/javascript" src="recursos/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery1.js"></script>

		
		<!--Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
		<script>
		function showUser(str)
		{
		if (str=="")
		  {
		  document.getElementById("pesquisa").innerHTML="";
		  return;
		  } 
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    document.getElementById("pesquisa").innerHTML=xmlhttp.responseText;
		    }
		  }
		  
		  // Pega as variaveis 
		  
		   var u = document.f2.txtLogin.value;
		 
		xmlhttp.open("POST","mostraUsuarios.php?txtLogin=" + u,true);
		xmlhttp.send();
		}
		</script>
		
		
		
		<?php
		include('recursos/includes/verScript.inc');

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
				
					<h3>PERMISSÃO USUÁRIO</h3>
					<br />
					<br />
				
					<form name='f2'>
						<label>LOGIN:
						<input type="text" value="" name="txtLogin" size="50px" maxlength="45" />
						</label>
						
					
						<br />
						<br />
						<input type="button" value="    CONSULTAR    " onclick="showUser(this.value)">
						<input type="reset" value="    CORRIGIR    ">

					</form>
					<br />
					<hr />
				
							
							
					 <div id="pesquisa">
					 
					
					 </div>
					 
					 
					
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

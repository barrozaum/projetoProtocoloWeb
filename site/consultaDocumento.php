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
		  
		   var numero= document.getElementById('numero').value.toUpperCase();
		   var documento= document.getElementById('documento').value.toUpperCase();
		   var ano = document.getElementById('ano').value.toUpperCase();
		  
		  
			xmlhttp.open("POST","pesquisaDocumentos.php?numero=" + numero+ "&documento=" +documento+ "&ano=" +ano ,true);
			xmlhttp.send();
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
				
					<h3>CONSULTA DOCUMENTO</h3>
					<br />
					<br />
					
					
					
					
					<form name="f1" method="Post">
					DOCUMENTO:
					<select id= "documento">
					<option value="">DOCUMENTOS</option>
					
					<?php
					
					include('recursos/includes/verConexao.inc');
					
					$sql="select * from documento order by idDocumento" ;
					
					$resultado=mysql_query($sql,$conexao) ;
					
					while($dados=mysql_fetch_array($resultado)){
					?>
						
						<option value="<?php  echo $dados['idDocumento']; ?> "><?php echo $dados["nomeDocumento"]; ?></option>
					<?php	
					}
					?>
					</select>
					
					*
					<br />
					<br />	
						
					
						<label>NÚMERO:
							<input type="text" id="numero" maxlength="30" size="30px" onKeypress="return numeros();" />
						</label>
						
						<label>ANO:
							<input type="text" id="ano" class="ano" value="<?php echo date('Y'); ?>" maxlength="4" size="4px" />*
						</label>
						<br />
						<br />
						
						<input type="button" value="    PESQUISAR    " onclick="showUser(this.value)">
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
				// Inclui informações do usuario
				
				include('recursos/includes/inforUsuario.inc');
				?>	
				
				</div>
			</div>
			
					
		</div>
	</body>
	
</html>

<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//P$idSetorUsuario =$_SESSION[idSetorUsuario];

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
		function showAssunto(str)
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
		  
		var datainicial= document.getElementById('dataInicial').value.toUpperCase();
		var assunto= document.getElementById('assunto').value.toUpperCase();
		var datafinal= document.getElementById('dataFinal').value.toUpperCase();
		var nomeAssunto= document.getElementById('nomeAssunto').value.toUpperCase();
		var verificaAssunto= document.getElementById('verificaAssunto').value.toUpperCase();
	
	
	
		if(verificaAssunto == ""){
			window.alert("ASSUNTO NÃO ENCONTRADO !!!");
		document.getElementById('assunto').value="";
		document.getElementById('nomeAssunto').value="";
		document.getElementById('verificaAssunto').value="1";
		}else{
		
		xmlhttp.open("POST","pesquisaAssunto.php?datainicial=" + datainicial+ "&assunto=" +assunto+ "&datafinal=" +datafinal +"&nomeAssunto="+nomeAssunto,true);
		xmlhttp.send();
		}
		}
		</script>
		
		
			
		<?php
		// inclui os scripts
		include('recursos/includes/AssuntoConsulta.inc');
		?>
		
		<script>
		function zerar()
		{
		
		document.getElementById('assunto').value="";
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
					
				<h3>CONSULTA ASSUNTO</h3>
				<br />
				<br />
				
				
				<form name="f1" method="Post">
						
				<label>	
				CÓDIGO 
				<input type="text" id="assunto" name="codAssunto" size="1" value="" onchange="showUser(this.value)" onKeypress="return numeros();"/>
				ASSUNTO
				<i id="mostraAssunto"><input type='text' name="nomeAssunto" id="nomeAssunto" value=''  size='70px' maxlength = '50' onchange="zerar()" /> <input type="hidden" id ="verificaAssunto" value="1" ></i>
				</label>
				<a href="listarAssunto.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
				<br />
				<br />
				
				
				<label>PESQUISAR DESDE:
					<input type="text" class="data"  id="dataInicial" value="" maxlength="10" size="10px"  onfocus ="mascaraData(confData);"  onblur="validarData(this)"  />
					<input type="hidden" name="confData"  maxlength="2" size="2px"  value="0"   />
				</label>
				<br />
				<br />
				
				
				<label>PESQUISAR ATÉ:
					<input type="text" class="data"  id="dataFinal" value="<?php echo date('d/m/Y'); ?>" maxlength="10" size="10px"  onfocus ="mascaraData(confData);" onblur="validarData(this)" />*
				</label>
				<br />
				<br />
				
				
				<input type="button" value="    PESQUISAR    " onclick="showAssunto(this.value)">
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

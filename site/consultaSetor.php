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
		  
		   var datafinal= document.getElementById('dataFinal').value;
		   var datainicial= document.getElementById('dataInicial').value;
		   var setorEntrada= document.getElementById('setorEntrada').value;
		   var verificaSetor= document.getElementById('verificaSetor').value;
		
		if(verificaSetor == ""){
		window.alert("SETOR NÃO ENCONTRADO !!!");
		document.getElementById('setorEntrada').value="";
		document.getElementById('nomeSetor').value="Secretária  ---- Coordenadoria ---- Setor ";
		document.getElementById('verificaSetor').value="1";
		}else{
		xmlhttp.open("POST","pesquisaSetor.php?setorEntrada=" + setorEntrada+ "&datainicial=" +datainicial+ "&datafinal=" +datafinal,true);
		xmlhttp.send();
		}
		}
		</script>
		
		
	
<?php
// inclui os scripts
include('recursos/includes/verSetor.inc');
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
					
					<h3>CONSULTA SETOR</h3>
					<br />
					<br />
						
					<form name="f2">
					<label>
						CÓDIGO 
						<input type="text" id="setorEntrada" name="setorEntrada"  value="" size="1" onchange="s(this.value)" onKeypress="return numeros();">
						SETOR
						<i id="mostraSetor">
						<input type="text" name="nomeSetor" id="nomeSetor" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
						</i>
						<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
					</label>
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

<?php
session_start();

include ('recursos/includes/verSessao.inc');
$outrasOp = $_SESSION['outrasOp'];
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
		
		<?php
		// Inclui o menu do site			
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
		  
		   var data = document.Formulario.data.value;
		   var setorEntrada = document.Formulario.setorEntrada.value;
           var setorOrigem = document.Formulario.setorOrigem.value;

           if(setorOrigem == ""){
			window.alert("VERIFIQUE O CAMPO SETOR ORIGEM !!!");
			document.Formulario.setorOrigem.focus();
		   }else if(setorEntrada == ""){
			window.alert("VERIFIQUE O CAMPO SETOR ENTRADA  !!!");
			document.Formulario.setorEntrada.focus();
		   }else

			xmlhttp.open("POST","pesquisaRemessa.php?data=" + data+ "&setorEntrada=" +setorEntrada+ "&setorOrigem=" +setorOrigem , true);
        	xmlhttp.send();

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
					
					<h3>RELATÓRIO REMESSA</h3>
					<br />
					<br />
					<form name="Formulario" method = "GET">
                 	



					<label>
					<?php 
					 if($outrasOp == 1){
					?>
							
                 		SETOR ORIGEM:
                        <select name="setorOrigem" size="1">
                        	<option value="">DESC. DEPARTAMENTO --- SETOR</option>

                           <?php
                           include('recursos/includes/verConexao.inc');

                            $sql = "SELECT * FROM setor";
                            $resultado = mysql_query($sql,$conexao);
                            while($dados = mysql_fetch_array($resultado)){
                            ?>
                             <option value="<?php echo $dados['idSetor']; ?>"><?php echo $dados['descDepartamento']; ?> --- <?php echo $dados['setor']; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                       
					<?php 
					}else{ 
					?>
					
						CÓDIGO 
						<input type="text" id="setorOrigem" name="setorOrigem"  value="<?php echo $_SESSION['idSetorUsuario']; ?>" size="1" readonly="true">
						SETOR ORIGEM:
						<input type="text" name="nomeSetor" id="nomeSetor" value="<?php echo $_SESSION['nomeDescDepartamentoUsuario']; ?> --- <?php echo $_SESSION['nomeSetorUsuario']; ?>"  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
					<?php
					 }
					 ?>
					
					</label>
					<br />
					<br />





					CÓDIGO 
					<input type="text" id="setorEntrada" name="setorEntrada"  value="" size="1" onchange="s(this.value)" onKeypress="return numeros();">
					SETOR ENTRADA:
					<i id="mostraSetor">
					<input type="text" name="nomeSetor" id="nomeSetor" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
					</i>
					<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
		            <br />
					<br />
		
				

					<label>DATA CARGA:</label>
						<input type="text" class="data"  id="data" name="data" value="<?php echo date('d/m/Y'); ?>" maxlength="10" size="10px"  onfocus ="mascaraData(confData);" onblur="validarData(this)" /><br /><br />
						<input type="hidden" name="confData"  maxlength="2" size="2px"  value="0"   />
					</label>
				
					
					<input type="button" value="    ENVIAR    " onclick="showUser(this.value)">
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

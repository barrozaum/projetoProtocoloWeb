<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION['idSetorUsuario'];

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
	<?php
	// inclui os scripts
	include('recursos/includes/verSetor.inc');
	?>
	
	
	<script language ="JavaScript">
	
		function verifica (){
             var setor = document.f1.setor.value;

             if (setor == ""){
             window.alert('ESCOLHA O SETOR !!!');
              document.f1.setor.focus();
             }else
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
					<h3>RELATÓRIO PROCESSO SETOR</h3>
					<br />
					<br />
					
					<form name="f1" action="relatorioSetor1.php" method="post">

					<label>
					<?php 
					 if($outrasOp == 1){
					?>
							CÓDIGO 
							<input type="text" id="setorEntrada" name="setor"  value="" size="1" onchange="s(this.value)" onKeypress="return numeros();">
							SETOR
							<i id="mostraSetor">
							<input type="text" name="nomeSetor" id="nomeSetor" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
							</i>
							<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
					
					<?php 
					}else{ 
					?>
					
						CÓDIGO 
						<input type="text" id="setorEntrada" name="setor"  value="<?php echo $_SESSION['idSetorUsuario']; ?>" size="1" onchange="s(this.value)" onKeypress="return numeros();" readonly="true">
						SETOR
						<i id="mostraSetor">
						<input type="text" name="nomeSetor" id="nomeSetor" value="<?php echo $_SESSION['nomeDescDepartamentoUsuario']; ?> --- <?php echo $_SESSION['nomeSetorUsuario']; ?>"  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
						</i>
					<?php } ?>
					</label>
					<br />
					<br />



					
					<label>PESQUISAR DESDE:
					<input type="text" class="data"  name="datainicial" value="" maxlength="10" size="10px"  onfocus ="mascaraData(confData);"  onblur="validarData(this)"  />
					<input type="hidden" name="confData"  maxlength="2" size="2px"  value="0"   />
					</label>
					<br />
					<br />
					
					
					<label>PESQUISAR ATÉ:
						<input type="text" class="data"  name="datafinal" value="<?php echo date('d/m/Y'); ?>" maxlength="10" size="10px"  onfocus ="mascaraData(confData);" onblur="validarData(this)" />*
					</label>
					<br />
					<br />
											
					
					<input type="button" value="    Enviar    " onclick="javascript: verifica();"/>
					<input type="reset" value="    Corrigir    "/>
					
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

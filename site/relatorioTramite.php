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
		
		
		<?php
		// Inclui o menu do site			
		include('recursos/includes/verScript.inc');	
		?>	
		<script language ="JavaScript">
			function valida (){
				var setorEntrada= document.Formulario.setorEntradaProcesso.value;
				var setorOrigem= document.Formulario.setorOrigemProcesso.value;
				var f = document.Formulario.dataFinal.value;
   	            var i = document.Formulario.dataInicial.value;

				if (setorEntrada == ""){
				window.alert("VERIFIQUE O CAMPO SETOR ENTRADA !!!");
				document.Formulario.setorEntradaProcesso.focus();
				}else if(setorOrigem == ""){
				window.alert("VERIFIQUE O CAMPO SETOR ORIGEM !!!");
				document.Formulario.setorOrigemProcesso.focus();
				}else
				document.Formulario.submit();
						
								
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
					<h3>RELATÓRIO PROCESSO TRÂMITE </h3>
					<br />
					<br />
					<form name="Formulario" action="relatorioTramite1.php" method="post">
                

					<label>
					CÓDIGO 
					<input type="text" id="setorEntrada" name="setorOrigemProcesso"  value="" size="1" onchange="s(this.value)" onKeypress="return numeros();">
					SETOR ORIGEM:
					<i id="mostraSetor">
					<input type="text" name="setorOrigem" id="setorOrigem" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
					</i>
					<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
		            <br />
					<br />
					</label>

					<label>
					<?php 
					 if($outrasOp == 1){
					?>
							
                 		SETOR ENTRADA:
                        <select name="setorEntradaProcesso" size="1">
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
						<input type="text"  name="setorEntradaProcesso"  value="<?php echo $_SESSION['idSetorUsuario']; ?>" size="1" readonly="true">
						SETOR ENTRADA:
						<input type="text" name="" id="" value="<?php echo $_SESSION['nomeDescDepartamentoUsuario']; ?> --- <?php echo $_SESSION['nomeSetorUsuario']; ?>"  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
					<?php
					 }
					 ?>
					
					</label>
					<br />
					<br />




				

					
				<label>PESQUISAR DESDE:
					<input type="text" class="data"  id="dataInicial" name="datainicial" value="" maxlength="10" size="10px"  onfocus ="mascaraData(confData);"  onblur="validarData(this)"  />
					<input type="hidden" name="confData"  maxlength="2" size="2px"  value="0"   />
					</label>
					<br />
					<br />
					
					
					<label>PESQUISAR ATÉ:
						<input type="text" class="data"  id="dataFinal" name="datafinal" value="<?php echo date('d/m/Y'); ?>" maxlength="10" size="10px"  onfocus ="mascaraData(confData);" onblur="validarData(this)" />*
					</label>
					<br />
					<br />
				
					
				
			
					
					
					<input type="button" value="    Enviar    " onclick = "javascript: valida();">
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

<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
$setorUsuario =$_SESSION['idSetorUsuario'];

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
		// inclui os scripts
		include('recursos/includes/verScript.inc');
		?>
		
		
		<script language="JavaScript">
		function voltar() {
		     location.href="consultaNumero.php";
		  }
		</script>
				

		<script>
		function excluir(cod)
		{
			var r = confirm ("CONFIRMAR EXCLUSÃO ?");
			
			if (r == true){
			location.href="excluirProcesso1.php?cod="+cod;
			}
		}
		</script>

	<title>Parvaim</title>	
</head>	
						

		
		
<?php 
$tipoProcesso = $_REQUEST['tipoProcesso'];

$anoProcesso = $_REQUEST['anoProcesso'] ;

$numeroProcesso = $_REQUEST['numeroProcesso'];

include('recursos/includes/verConexao.inc');
		
$sql="SELECT * FROM cadastroProcesso WHERE numeroProcesso = $numeroProcesso AND anoProcesso = $anoProcesso AND tipoProcesso = $tipoProcesso ";
$resultado = mysql_query($sql,$conexao);

if(mysql_num_rows($resultado) == 0){
?>
<script languagem="javascript">
window.alert('NENHUM PROCESSO ENCONTRADO !!!');
location.href="consultaNumero.php";
</script>

<?php 
}else{
?>



<?php
while($dados= mysql_fetch_array($resultado)){
$idProcesso = $dados['idProcesso'];

$numeroProcesso = $dados['numeroProcesso'];
$anoProcesso = $dados['anoProcesso'];
$tipoProcesso = $dados['tipoProcesso'];

$requerente = $dados['idRequerente'];

$codAssunto = $dados['idAssunto'];


$codOrigem = $dados['idOrigem'];

$idAnexado = $dados['idAnexo'];
}

?>
					




					
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
				
				
				<h3>CONSULTA PROCESSO </h3>	 	
						 	
				</div>	
			 	    <!-- Início: Caixa -->
					    	
		    	<div id="caixa">
		    	
		    		<!-- Início: Seleção de abas -->

				<p id="abas">
					
					<a href="#aba1" class="selected"> PROCESSO</a>
					<a href="#aba2">REQUERENTE</a>
					<a href="#aba3">DOCUMENTO</a>
					<a href="#aba4">ANEXO</a>
					<a href="#aba5">OBSERVAÇÃO</a>
					<a href="#aba6">CARGA</a>
					
					
	
				</p>
				
				<!-- Fim: Seleção de abas -->
				
				<!-- Início: Conteúdo das abas -->
				
				<ul id="formularios">
				
				<!-- Início: Conteúdo da Aba 1 -->
				<form method="post" name="f1" action="alterar.php">
					<li id="aba1">
					<input type="hidden" value="<?php echo $idProcesso;?>" name="op" readonly="TRUE" size="4px" />
					
					<legend>PROCESSO</legend>
					<br />
					<br />
					
				
					<label>TIPO PROCESSO:							
						
						<?php if ($tipoProcesso == 1){?>
						<input type="text" value="COMUNICAÇÃO INTERNA" size="30px" readonly="TRUE" />
						<?php 
						}else{
						?>
						<input type="text" value="COMUNICAÇÃO EXTERNA" size="30px" readonly="TRUE" />
						<?php 
						}
						?>
					</label>							
					<br />
					<br />	
						

					<label>NÚMERO PROCESSO:
						<input type="text" value="<?php echo $numeroProcesso;?>" name="numeroProcesso" readonly="TRUE" size="4px" />
					</label>
					<br />
					<br />
					
					
					<label>ANO PROCESSO:
						<input type="text" value="<?php echo $anoProcesso;?>" name="anoProcesso" readonly="TRUE" size="4px"/>
					</label>
					<br />
					<br />
						
					
						
						
						
					<div id="origem">	
						<?php 
						
						include('recursos/includes/verConexao.inc');
						
						$sql5 = "SELECT * FROM origem WHERE idOrigem = $codOrigem";
						$resultado5 = mysql_query($sql5, $conexao);
						while($dados5 = mysql_fetch_array($resultado5)){
						$origem = $dados5['nomeOrigem'];
						}
						?>
						<label>	
						 ORIGEM:
						<input type="text" id="origemProcesso" name="codOrigem" value="<?php echo $codOrigem; ?>" size="1"  readonly="TRUE"  >
                                <strong id="mostraOrigem"><input type="text"  value="<?php echo $origem ; ?>" size="70px" readonly="TRUE"></strong>						
						</label>
					</div>	
							
					<br />
					
					<div id="Assunto">	
						
						<?php 
						include('recursos/includes/verConexao.inc');
						
						$sql6 = "SELECT * FROM assunto WHERE idAssunto = $codAssunto";
						$resultado6 = mysql_query($sql6, $conexao);
						while($dados6 = mysql_fetch_array($resultado6)){
						$assunto= $dados6['nomeAssunto'];
						}
						?>
						<label>	
						ASSUNTO:
						<input type="text" id="assunto" name="codAssunto" size="1" value="<?php echo $codAssunto; ?>" readonly="TRUE">
						<strong id="mostraAssunto"><input type="text"  value="<?php echo $assunto; ?>" size="70px" readonly="TRUE"></strong>
						</label>
					
					
					</div>	
				
						
						
						
						
						<?php 
						if ($idAnexado != 0){
						include('recursos/includes/verConexao.inc');
						$sql8="SELECT * FROM cadastroProcesso WHERE idProcesso= $idAnexado ";
						$resultado8 = mysql_query($sql8,$conexao);
						
						while($dados8 = mysql_fetch_array($resultado8)){
						?>
						
						<br /><br /><fieldset id="consultaFieldset">
						<legend>PROCESSO ANEXAO AO:</legend>
						
						<i id="consultaI">NÚMERO PROCESSO PAI:</i><strong><?php echo $dados8['numeroProcesso']; ?></strong><br />
						
						
						<?php if ( $dados8['tipoProcesso'] == 1){
						$tipoAnexo ="COMUNICAÇÃO INTERNA";
						}else{
						$tipoAnexo ="COMUNICAÇÃO EXTERNA";
						}
						?>
						<i id="consultaI">TIPO PROCESSO PAI:</i><strong><?php echo $tipoAnexo ; ?></strong><br />
						<i id="consultaI">ANO PROCESSO PAI:</i><strong><?php echo $dados8['anoProcesso']; ?></strong><br />
						</fieldset>
						
						
						<?php
						}
						}
						?>
						
						
						
										
							
					</li>
							
				
				
				
				
					<li id="aba2">
						
						
						<?php 
						
						include('recursos/includes/verConexao.inc');
						$sql="SELECT * FROM requerente WHERE idRequerente = $requerente";
						$resultado = mysql_query($sql,$conexao);
						
						while($dados = mysql_fetch_array($resultado)){
						?>
						
						<legend>REQUERENTE</legend>
						<br />
						<br />
						
						
						<label>CÓDIGO :
							<input type="text" name="codRequerente" id="requerente" value="<?php echo $dados['idRequerente']; ?>" size="2" readonly="TRUE"/>
							
					
						</label>
						
					
						<br />
						<br />
						
						<div id="TrocaRequerente"> 
							

							<label>REQUERENTE:
								
								<input type="text" name="nomeRequerente" maxlength="50" size="50px" value="<?php echo $dados['requerente']; ?>" onKeypress="return carcater();"/> *
								<input type="hidden" name="verificaRequerente" value="1">
								
							</label>
							<br />
							<br />



							<label>LOGRADOURO:
								<input type="text" name="logradouro"  value="<?php echo $dados['logradouro']; ?>" size="50px"  maxlength="50" onKeypress="return carcater();"/>
							</label>

							<label>NÚMERO:
								<input type="text" name="numero_end"  value="<?php echo $dados['numeroEnd']; ?>" maxlength="4" size="4px" onKeypress="return numeros();"/>
							</label>
							<br />
							<br />


							<label>COMPLEMENTO:
								<input type="text" name="complemento" value="<?php echo $dados['complemento']; ?>" size="25" />
							</label>


							<label>BAIRRO:
								<input type="text" name="bairro" onKeypress="return carcater();" value="<?php echo $dados['bairro']; ?>" size="30" />
							</label>
							<br />
							<br />


							<label>CIDADE:
								<input type="text" name="cidade" value="<?php echo $dados['cidade']; ?>" onKeypress="return carcater();" />
							</label>

							<label>UF:
								<input type="text" name="uf" maxlength="2" size="2px" value="<?php echo $dados['uf']; ?>" onKeypress="return carcater();" />
							</label>


							<label>CEP:	
								<input type="text" class="cep" id="cep" name="cep" value="<?php echo $dados['cep']; ?>" />
							</label>
							<BR />
							<BR />

							<label>TEL (FIXO):
								<input type="text" class="tel" id="tel" name="tel" value="<?php echo $dados['tel']; ?>" />
							</label>


							<label>TEL (CEL):
								<input type="text" class="tel" id="tel" name="tel" value="<?php echo $dados['tel']; ?>" /><br />
							</label>
						</div>
							
						<?php	
						}
						?>	
							
					</li>
					
					
					<li id="aba3">
							
					<legend>DOCUMENTO</legend>
					<br />
					<br />
					
					<?php 
					include('recursos/includes/verConexao.inc');
					$sql="SELECT *
					FROM documentoProcesso dp, documento d 
					WHERE dp.idDocumento = d.idDocumento AND dp.idProcesso = $idProcesso";
					$resultado = mysql_query($sql,$conexao);
					if(mysql_num_rows($resultado) == 0){
					?>
						<div id="cadastrados">
	            			 <strong>PROCESSO NÃO POSSUI DOCUMENTO !!!</strong>
	            		</div>
					<?php
					}else{
					?>
						
						
					
					
					
			        <div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
			        <table width="95%">
			        <thead class="fixedHeader">
			        <tr bgcolor="#f5f5dc">
					  <th align="center">NÚMERO DOCUMENTO</th>
					  <th align="center">TIPO DOCUMENTO</th>
					  <th align="center">ANO DOCUMENTO</th>
					</tr>
					
					
						<?php
						$cor = "";
						$i = 0;
						while($dados=mysql_fetch_array($resultado)){
						 $i++;
							
							if ($i% 2 == 0)
								$cor = "#CCCCCC";
							else
								$cor = "#FFFFFF";
								
						?>	
							
           				<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
						    <td height="5" align ="center"><?php echo $dados["numeroDocumento"]; ?></td>
						    <td height="5" align ="center"><?php echo $dados["nomeDocumento"]; ?></td>
						    <td height="5" align ="center"><?php echo $dados["anoDocumento"]; ?></td>
						</tr>
						
						<?php
						 }
						?>
						
					<?php
					 }
					?>
					</table>
						
							
					</li>
					
					
					<li id="aba4">
					
					<legend>ANEXO</legend>
					<br />
					<br />
					
						<?php 
						include('recursos/includes/verConexao.inc');
						
						$sql="SELECT * FROM cadastroProcesso WHERE idAnexo = $idProcesso ";
						$resultado = mysql_query($sql,$conexao);
						if(mysql_num_rows ($resultado) == 0){
						?>
					
						 <div id="cadastrados">
            			 <strong>PROCESSO NÃO POSSUI ANEXO !!!</strong>
            			</div>
						
						<?php
						}else{
						?>
							<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					        <table width="95%">
					        <thead class="fixedHeader">
					        <tr bgcolor="#f5f5dc">
							  <th align="center">NÚMERO ANEXO</th>
							  <th align="center">TIPO ANEXO</th>
							  <th align="center">ANO ANEXO</th>
							<tr>
							<?php
							$cor = "";
							while($dados=mysql_fetch_array($resultado)){
							$i++;
								
								if ($i% 2 == 0)
									$cor = "#FFFFFF";
								else
									$cor = "#CCCCCC";
									
								
									
								if ($dados["tipoProcesso"] == 1)
									$tipoAnexo= "COMUNICAÇAO INTERNA";
								else
									$tipoAnexo= "COMUNICAÇAO EXTERNA";
							
							?>	
									
								
								   
		           				<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
								     <td align="center"><?php echo $dados["numeroProcesso"]; ?></td>
								     <td align="center"><?php echo $tipoAnexo; ?></td>
								     <td align="center"><?php echo $dados["anoProcesso"]; ?></td>
								</tr>
									
								<?php
								 }
								?>	
								
								
							<?php
							 }
							?>
							</table>
							
						</li>
		
						
						
						<li id="aba5">
							
						<legend>OBSERVAÇÃO</legend>
						<br />
						<br />
					
							
						<?php
						include('recursos/includes/verConexao.inc');
						$sql="SELECT * FROM obs  WHERE idProcesso = $idProcesso";
						$resultado = mysql_query($sql,$conexao);
						if(mysql_num_rows($resultado) == 0){
						?>
						<div id="cadastrados">
            			 <strong>PROCESSO NÃO POSSUI OBSERVAÇÃO !!!</strong>
            			</div>
						<?php 
						}else{
						?>
						
							<?php
							while($dados= mysql_fetch_array($resultado)){
							?>
							
								
								<textarea name="obs"  rows="6" cols="65" disabled maxlength="240"><?php echo $dados['obs']; ?></textarea>
								<br />
								<br />
							<?php 
							}
							?>
						<?php 
						}
						?>
						
						
					</li>
					
					
					<li id="aba6">
					
						
					<legend>CARGA </legend>
					<br />
					<br />
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
			        <table width="95%">
			        <thead class="fixedHeader">
			        <tr bgcolor="#f5f5dc">
					  <th align="center">SETOR ENTRADA</th>
					  <th align="center">DATA CARGA</th>
					  <th align="center">USUÁRIO RECEBIMENTO</th>
					  <th align="center">DATA RECEBIMENTO</th>
					  <th align="center">PARECER </th>
					</tr>
					
					<?php 
					$i= 0;
					$cor = "";
					
					include('recursos/includes/verConexao.inc');
					$sql="SELECT * 
					FROM cargaProcesso 
					WHERE idProcesso = $idProcesso ORDER BY idCarga DESC";
					$resultado = mysql_query($sql,$conexao);
					while($dados=mysql_fetch_array($resultado)){

					if($i == 0){
					$setorPresenteEntrada = $dados['idSetorEntrada'];
					$setorPresenteOrigem = $dados['idSetorOrigem'];
					$idUsuarioRecebimento= $dados['idUsuarioRecebimento'];
					}
					
						
						if ($i% 2 == 0)
							$cor = "#FFFFFF";
						else
							$cor = "#CCCCCC";
					
					
					$usuarioRecebimento = $dados['idUsuarioRecebimento'];
					$setorPresente = $dados['idSetorPresente'];
					$Obs= $dados['parecer'];
					$Recebido = $dados['tramite'];
					?>	
						
					<?php		
					//Formata a data americana em brasileira
					
					//VARIAVEL COM A DATA NO FORMATO AMERICANO
					$data_americano = $dados['dataCarga'];
					
					//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
					$partes_da_data = explode('-',$data_americano);
					
					//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
					//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
					$data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
					
					//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
					?>
					
					<?php		
					//Formata a data americana em brasileira
					
					//VARIAVEL COM A DATA NO FORMATO AMERICANO
					$dataAmericano = $dados['dataRecebimento'];
					
					//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
					$partes = explode('-',$dataAmericano);
					
					//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
					//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
					$dataBrasileiro = $partes[2].'/'.$partes[1].'/'.$partes[0];
					
					//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
					?>
					   
					 
					 
					 
					
					 
					 <?php 
					 include('recursos/includes/verConexao.inc');
					 $nomeUsuarioRecebimento = "";
					 $sql7 = "SELECT * FROM usuario WHERE idUsuario = '$usuarioRecebimento' ";
					 $resultado7 = mysql_query($sql7,$conexao);
					 while($dados7 = mysql_fetch_array($resultado7)){
					 $nomeUsuarioRecebimento = $dados7['login'];
					 }
					 ?>
					 
					 <?php 
					 include('recursos/includes/verConexao.inc');
					 
					 $sql8 = "SELECT * FROM setor WHERE idSetor = $setorPresente ";
					 $resultado8 = mysql_query($sql8,$conexao);
					 while($dados8 = mysql_fetch_array($resultado8)){
					 $setorPresente = $dados8['descDepartamento'];
					 }
					 ?>
					   
		           	<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
					    <td height="5" align ="center"><?php echo $setorPresente; ?></td>
					    <td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
					    <td height="5" align ="center"><?php echo $nomeUsuarioRecebimento ; ?></td>
					    <td height="5" align ="center"><?php echo $dataBrasileiro ; ?></td>
					    <td height="5" align ="center"><?php echo $Obs;?></td>
						</tr>
					
					<?php
					  $i++;
					 }
					?>
						 
					</table>
                     <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

       
					</li>
		
					
					
					<table>

						
						<td align="right" colspan="4">
							<input type="button"  value ="    VOLTAR    "  onclick='voltar()'  />
						</td>	
					

						<?php 
						
						if(($setorPresenteEntrada == $setorUsuario) && ($setorPresenteOrigem == $setorUsuario)  && ($idUsuarioRecebimento == $idUsuario)  &&  ($Recebido == 1) && ($outrasOp == 1)){
						
						?>
						<td align="CENTER" colspan="4">
							<input type="submit"  value ="    ALTERAR    "   />
							<input type="button"  value ="    EXCLUIR    " onclick="excluir(<?php echo $idProcesso; ?>)";   />
						</td>	
						
						
						<?php 
						}
						?>


					</table>
					
					
					</form>
						
						
				</ul>
				
					<!-- Fim: Conteúdo das abas -->
			
			
		
				<!-- Fim: Caixa -->
							
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
<?php 
}
?>
	
</html>

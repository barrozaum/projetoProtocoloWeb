<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION['idUsuario'];
$setorUsuario = $_SESSION['idSetorUsuario'];
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


		<?php
		// inclui os scripts
		include('recursos/includes/verScript.inc');
		include('recursos/includes/Assunto.inc');
		include('recursos/includes/Origem.inc');	
		include('recursos/includes/Requerente.inc');	
		include('recursos/includes/pegarValorProcesso.inc');
		?>
	
	
	
	
	
	
		<script language="JavaScript">
		
		function trocaValor() {
		     
		      var t = document.f1.tipoProcesso.value;
		      
		      if( t == 01)
		        
		           document.f1.troca.value="<?php echo $interna; ?>";
		   
		      else
		           document.f1.troca.value="<?php echo $externa; ?>";
		        
		}
		</script>
		
	
		<script language = "javascript">
		
		function valida(){
		
		var o = document.f1.verificaOrigem.value;
		var a = document.f1.verificaAssunto.value;
		var r = document.f1.verificaRequerente.value;
		
		if(o == "")
		window.alert('Campo Origem não foi preenchido Corretamente');
		else	if(a == "")
		window.alert('Campo Assunto não foi preenchido Corretamente');
		else	if(r == "")
		window.alert('Campo Requerente não foi preenchido Corretamente');
		else
		document.f1.submit();
		
		}
		</script>
		
	
		<script language = "javascript">
		function resetar(){
		
		
		document.getElementById("mostraAssunto").innerHTML= "<input type='text' name='nomeAssunto' id='nomeAssunto' value=''  size='70px' maxlength = '50' /> <input type='hidden' name='verificaAssunto' value=''>";
		document.getElementById("mostraOrigem").innerHTML= "<input type='text' name='mostraOrigem2' id='mostraOrigem2' value=''  size='70px' maxlength = '50' /> <input type='hidden' name='verificaOrigem' value=''>";
		
		document.getElementById("TrocaRequerente").innerHTML=xmlhttp.responseText;
		xmlhttp.open("POST","recursos/includes/zerarRequerente.php",true);
		xmlhttp.send();
		
									
		
		}
		</script>
	
	
		
		
		<script language = "javascript">
			function excluir () {
			
			window.open(href='excluirProcesso.php','galeria','width=680,height=470'); 
			return false;
			}
		</script>
	
	
	

	<title>Parvaim</title>	
</head>	
						

		
		
<?php 
$op= $_REQUEST['op'];
	
include('recursos/includes/verConexao.inc');	
		
$sql="SELECT * FROM cadastroProcesso WHERE idProcesso= $op";
$resultado = mysql_query($sql,$conexao);

if(mysql_num_rows($resultado) == 0){
?>
<script>window.alert('Nenhum Processo Encontrado !!!');
history.back(-1);</script>

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
		
		
		<h3>ALTERAR PROCESSO</h3>	 	
				 	
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
				
				<form method="post" name="f1" action="alterar1.php">
				
				
					<li id="aba1">
				
					
					<legend>PROCESSO</legend>
					<br />
					<br />
					
					<input type="hidden" value="<?php echo $op;?>" name="idProcesso"  />
				
											
					
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
						<input type="text" id="origemProcesso" name="codOrigem" value="<?php echo $codOrigem; ?>" size="1"  onchange="User(this.value)" onKeypress="return numeros();"/ >
                             <i id="mostraOrigem"><input type='text' value='<?php echo $origem ; ?>' id="mostraOrigem2" name="mostraOrigem2" size='70px' maxlength = '50' /> <input type="hidden" name="verificaOrigem" value="1"></i>						
						</label>
						<a href="listarOrigem.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png" alt="Consultar"></a>
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
						<input type="text" id="assunto" name="codAssunto" size="1" value="<?php echo $codAssunto; ?>" onchange="showUser(this.value)" onKeypress="return numeros();"/>
						
						<i id="mostraAssunto"><input type='text' name="nomeAssunto" value='<?php echo $assunto; ?>'  size='70px' maxlength = '50' /> <input type="hidden" name="verificaAssunto" value="1"></i>
						</label>
						<a href="listarAssunto.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
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
							<input type="text" name="codRequerente" id="requerente" value="<?php echo $dados['idRequerente']; ?>" size="2"  onchange="rq(this.value)"/>
							
					
						</label>
						<a href="listarRequerente.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>
					
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
					
					<table border="0" cellpadding="2" cellspacing="4">
  
 
	 				 <tr>
	 					 <td class="bd_titulo" width="10">
	 					 	<strong>Documento</strong></td><td class="bd_titulo"><strong>Número</strong></td><td class="bd_titulo"><strong>Ano</strong>
	 					 </td>
	 				</tr>
		 				
		  				<tr class="linhas">
			   				<td height="5" align ="center">
								<select name = "documento[]">
								<option value=''>Escolha o Documento</option>
											
								<?php
								//Tipos dos documentos
								
								//include('verconec.inc');
								
								$sql="select * from documento order by idDocumento" ;
								
								$resultado=mysql_query($sql,$conexao) ;
								
								while($dados=mysql_fetch_array($resultado)){
								
								echo'<option value="'.$dados['idDocumento'].'">'.$dados['nomeDocumento'].'</option>';
								
								}
								?>
								</select>
						
							</td>
							
							<td height="5" align ="center">
								<input type="text" name="numeroDocumento[]" value="" maxlength="9" size="12px" onKeypress="return numeros();"/>
							
							</td>
						
						  
							<td height="5" align ="center">
								<input type="text" name="anoDocumento[]" value="" maxlength="4" size="4px" onKeypress="return numeros();"/>
							</td>
				   			 
							<td height="5" align ="center">
							    	<a href="#" class="deletar" title="Remover linha"><img src="recursos/imagens/icones/minus.png" alt="remover" border="0" /></a>
							</td>
					  	</tr>
						
						<tr>
						  	<td colspan="4">
						      		<a href="#" class="adiciona" title="Adicionar item"><img src="recursos/imagens/icones/plus.png"  alt="Adicionar" border="0" /></a>
							</td>
						</tr>
						 
					</table>

					
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
					  <th align="center">EXCLUIR</th>
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
					         <td height="5" align ="center"><a href="excluiDoc.php?cod=<?php echo $dados["idDocumentoProcesso"]; ?>"><img src="recursos/imagens/icones/excluir.png" alt="excluir" border="0" /></a></td>
						   
						   </tr>
						
						<?php
						 }
						?>
						
						
						<table border="0" cellpadding="2" cellspacing="4">
  
 
	 				 <tr>
	 					 <td class="bd_titulo" width="10">
	 					 	<strong>Documento</strong></td><td class="bd_titulo"><strong>Número</strong></td><td class="bd_titulo"><strong>Ano</strong>
	 					 </td>
	 				</tr>
		 				
		  				<tr class="linhas">
			   				<td height="5" align ="center">
								<select name = "documento[]">
								<option value=''>Escolha o Documento</option>
											
								<?php
								//Tipos dos documentos
								
								//include('verconec.inc');
								
								$sql="select * from documento order by idDocumento" ;
								
								$resultado=mysql_query($sql,$conexao) ;
								
								while($dados=mysql_fetch_array($resultado)){
								
								echo'<option value="'.$dados['idDocumento'].'">'.$dados['nomeDocumento'].'</option>';
								
								}
								?>
								</select>
						
							</td>
							
							<td height="5" align ="center">
								<input type="text" name="numeroDocumento[]" value="" maxlength="9" size="12px" onKeypress="return numeros();"/>
							
							</td>
						
						  
							<td height="5" align ="center">
								<input type="text" name="anoDocumento[]" value="" maxlength="4" size="4px" onKeypress="return numeros();"/>
							</td>
				   			 
							<td height="5" align ="center">
							    	<a href="#" class="deletar" title="Remover linha"><img src="recursos/imagens/icones/minus.png" alt="remover" border="0" /></a>
							</td>
					  	</tr>
						
						<tr>
						  	<td colspan="4">
						      		<a href="#" class="adiciona" title="Adicionar item"><img src="recursos/imagens/icones/plus.png"  alt="Adicionar" border="0" /></a>
							</td>
						</tr>
						 
					</table>

						
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
							</tr>
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
								     <td height="5" align ="center"><?php echo $dados["numeroProcesso"]; ?></td>
								     <td height="5" align ="center"><?php echo $tipoAnexo; ?></td>
								     <td height="5" align ="center"><?php echo $dados["anoProcesso"]; ?></td>
								    
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

						  	<textarea name="cadObs"  rows="6" cols="65"  maxlength="240"></textarea>
						  	<input type="hidden" name="obs" value="">
						<?php 
						}else{
						?>
						
							<?php
							while($dados= mysql_fetch_array($resultado)){
							?>
							
					            <input type="hidden" name="cadObs" value="">
								<textarea name="obs"  rows="6" cols="65"  maxlength="240"><?php echo $dados['obs']; ?></textarea>
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
					 
					if($i == 0)
					$setorPresenteProcesso = $dados['idSetorPresente'];
					 
					
						
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
					 
					 $sql7 = "SELECT * FROM usuario WHERE idUsuario = $usuarioRecebimento ";
					 $resultado7 = mysql_query($sql7,$conexao);
					 while($dados7 = mysql_fetch_array($resultado7)){
					 $nomeUsuario = $dados7['login'];
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
					     <td height="5" align ="center"><?php echo $nomeUsuario ; ?></td>
					     <td height="5" align ="center"><?php echo $dataBrasileiro ; ?></td>
					     <td height="5" align ="center"><?php echo $Obs;?></td>
					   </tr>
					
					<?php
					  $i++;
					 }
					?>
						 
					</table>
					<p>Total de cargas realizadas:  <strong><?php echo $i; ?></strong>
						
					</li>
		
					
					
					<table>
					
						<td align="right" colspan="4">
							<input type="button"  value ="    ALTERAR    "  onclick='valida()'/>
						</td>	
						
						
						<td align="right" colspan="4">
							<input type="button"  value ="    VOLTAR    "  onclick='location.href="consultaNumero.php";'  />
						</td>	
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

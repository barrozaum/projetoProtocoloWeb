<?php
session_start();
include('versessao.inc');

$cadastro=$_SESSION['quem']
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
	include('verscript.inc');
	?>
			
	<title>Parvaim</title>	
</head>	
		
	
<body class="laterais">
	<div id="externo">
		<div id="cabecalho">
		<a href="inicial.php"><h1 id="titulo"><span>Parvaim</span></h1></a> 
		</div>
			
		<div id="menu">
			<div id="submenu">
			<?php
			// Inclui o menu do site			
			include('vermenu.inc');	
			?>
					
			</div>
		</div>
		
			
		<div id="centro1">
		
		</div>
		
		<div id="centro">
			
			<div id="conteudo">
			<h3>Alterar Processo</h3>
			</div>	
			
			
			
	
		<!-- Início: Caixa -->
				
			<div id="caixa">
				
			<!-- Início: Seleção de abas -->
			
			<p id="abas">
				<a href="#aba1" class="selected" >Alterar Processo</a>
				<a href="#aba2" class="selected" >Alterar Requerente</a>
				<a href="#aba3" class="selected" >Alterar Documento</a>
				<a href="#aba4" class="selected" >Alterar Observação</a>
				<a href="#aba5" class="selected" >Alterar Carga</a>
				

			</p>
				
			<!-- Fim: Seleção de abas -->
			
			<!-- Início: Conteúdo das abas -->
			
			<ul id="formularios">
				
			<form name="cadproc" action="alterar.php" method="post">
				
			<!-- Início: Conteúdo da Aba 1 -->
				
				<li id="aba1">
				
				<?php
				$op=$_REQUEST['op'];					
				$_SESSION['idnumero'] = $op;			
				echo'<input type="hidden" name="op" value="'.$op.'">';
				?>		
						
				<legend>Processo</legend>
				<br />
				<br />
				
				<?php		
				$op=$_REQUEST['op'];		
				
				$sql="select * from cadastro_processo where id=$op" ;
				$resultado=mysql_query($sql,$conexao) ;
				while($dados=mysql_fetch_array($resultado)){
							
					echo'<strong>Tipo Processo:</strong>'.$dados["tipo_processo"];
					
					echo'<input type="hidden" name="tipo_processo" value="'.$dados['tipo_processo'].'"/>';
					echo"<br />";
					echo"<br />";
													
					echo'<strong>Número:</strong>'.$dados['numero'];
					echo"<br />";
					echo"<br />";
														
					echo'<strong>Ano:</strong>'.$dados['ano'];
					echo"<br />";
					echo"<br />";
					
					
					//VARIAVEL COM A DATA NO FORMATO AMERICANO
					$data_americano = $dados['data'];
					//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
					$partes_da_data = explode('-',$data_americano);
					 
					//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
					//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
					$data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
					 
					//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
					echo'<strong>Data Criação Processo:</strong>'.$data_brasileiro ;
					echo"<br />";
					echo"<br />";
					echo'<strong>Assunto:</strong>'.$dados['assunto'];
					
					echo'<input type="hidden" name="assunto" value="'.$dados['assunto'].'"/>';
					echo"<br />";
					echo"<br />";									
					
					echo'<strong>Origem Processo:</strong>'.$dados['origem_processo'];
					echo"<br />";
					echo"<br />";
					echo'<input type="hidden" name="mostra" value="'.$dados['numero'].'">';
					
					
								
								
					if(($dados['status'] != 1) || ($dados['anexado'] == 1)){
						echo'<fieldset>	';
						echo'<legend>Status Processo</legend>	';
						
						if($dados['status'] != 1)
							echo'<strong id="importante"> Processo Finalizado</strong><br />';
						
						if($dados['anexado'] == 1){
							echo'<br /><strong > Processo Anexado ao: </strong><br />';
							echo'<strong id="importante">Tipo Processo :</strong>'. $dados['tipoAnexo']."<br />";
							echo"<strong id='importante'>Número Processo :</strong>". $dados['registroAnexo'];
							echo'<strong id="importante">Ano Processo:</strong>'. $dados['anoAnexo'];
						}
					}
				
					$id=$dados['id'];
				
												
				
				}
				?>									
				</li>
				

			<!-- Fim do conteudo da aba 1-->
						 	
	                                                
						
							
			<!-- inicio do conteudo da aba 2-->
						
				<li id="aba2">
				
				<legend>Requerente</legend>
				<br />
				<br />

				<?php 
				$sql="select * from requerente_processo where numero_processo=$op" ;
				$resultado=mysql_query($sql,$conexao) ;
				while($dados=mysql_fetch_array($resultado)){
					if($dados['controle'] == 0 ){
						echo'<label><strong>Requerente:</strong><br />
						<input type"text" name="nome" value="'.$dados['requerente'].'" maxlength="50" size="50px" onKeypress="return carcater();"/>
						</label>';
						echo"<br />";		
						echo"<br />";						
	
						echo'<label><strong>Logradouro:</strong><br />
						<input type"text" name="logradouro" value="'.$dados['logradouro'].'"  size="50px" maxlength="50" onKeypress="return carcater();"/>
						</label>';						
	
						echo'<label><strong>Número:</strong>
						<input type"text" name="numero_end" value="'.$dados['numero_end'].'" maxlength="4" size="4px" onKeypress="return numeros();"/>
						</label>';
						echo"<br />";
						echo"<br />";
	
						echo'<label><strong>Complemento:</strong><br />
						<input type"text" name="complemento" value="'.$dados['complemento'].'"/>
						</label>';
						echo"<br />";
						echo"<br />";
	
						echo'<label><strong>Bairro:</strong><br />
						<input type"text" name="bairro" value="'.$dados['bairro'].'"/>
						</label>';
						echo"<br />";
						echo"<br />";
	
						echo'<label><strong>Cidade:</strong><br />
						<input type"text" name="cidade" value="'.$dados['cidade'].'"/>
						</label>';
	
	
						echo'<label><strong>UF:</strong><input type"text" name="uf" value="'.$dados['uf'].'"/>
						</label>';
						echo"<br />";
						echo"<br />";
	
						echo'<label><strong>CEP:</strong><br />
						<input type="text" class="cep" id="cep" name="cep" value="'.$dados['cep'].'" />';
						echo"<br />";
						echo"<br />";					
	
						echo'<label><strong>Tel:</strong><br />
						<input type="text" class="tel" id="tel" name="tel" value="'.$dados['tel'].'"/>';
						echo"<br />";
						echo"<br />";
					
					}else{
					
				
						echo'<strong>Requerente:</strong>'.$dados['requerente'];
						echo"<br />";
						echo"<br />";
															
						echo'<strong>Logradouro:</strong>'.$dados['logradouro'];
					
						
						echo'<strong>Número:</strong>'.$dados['numero_end'];
						echo"<br />";
						echo"<br />";
															
						echo'<strong>Complemento:</strong>'.$dados['complemento'];
						echo"<br />";
						echo"<br />";
						
						echo'<strong>Bairro:</strong>'.$dados['bairro'];
						echo"<br />";
						echo"<br />";
															
						echo'<strong>Cidade:</strong>'.$dados['cidade'];
						
						
						echo'<strong>Uf:</strong>'.$dados['uf'];
						echo"<br />";
						echo"<br />";
															
						echo'<strong>Cep:</strong>'.$dados['cep'];
						echo"<br />";
						echo"<br />";
						
						echo'<strong>Tel:</strong>'.$dados['tel'];
						echo"<br />";
						echo"<br />";
					}
					
				}
				?>
				</li>
				
			<!-- Fim do conteudo da aba 2-->			
					
			<!-- inicio do conteudo da aba 4-->
				<li id="aba4">
				
				<legend>Observações</legend>
				<br />
				<br />
				<?php				
				$op=$_REQUEST['op'];		
				$sql="select * from obs where numero='$op' " ;
				
				$resultado=mysql_query($sql,$conexao) ;
				while($dados=mysql_fetch_array($resultado)){
					if($dados['controle'] == 0 ){	
						if($cadastro == $dados['usuario']){
							echo 'Observação:<br /> <textarea name="confobs[]" value="'. $dados["obs"]. '" rows="8" cols="50"  maxlength="240">'. $dados["obs"]. '</textarea><br />';
							echo '<input type="hidden" name="idobs[]" value="'.$dados['id'].'"/>';
						}else{
							echo 'Observação: '. $dados["obs"];
							echo"<br />";
						}
					
					
					}else{
						echo 'Observação: '. $dados["obs"];
						echo"<br />";
					}


				echo"<br />";
				echo"<br />";
				}
				?>									
				
				<label>Nova observação:<br />
					<textarea name="obs" value="obs" rows="8" cols="50"  maxlength="240"></textarea>
				</label>
				
				
				</li>
			<!-- Fim do conteudo da aba 4-->			
					
			<!-- inicio do conteudo da aba 3-->
	
				<li id="aba3">

				<?php				
				$cadastro=$_SESSION['quem'];
				$i=0;
				
				$sql="select * from anexo where numero_processo=$op" ;
				$resultado=mysql_query($sql,$conexao) ;
				while($dados=mysql_fetch_array($resultado)){
					$i++;

					if($i <=1){
						echo"<legend>Anexo</legend>";
						echo"<br />";
						echo"<br />";	
					}



					echo "<a onclick='return confirma()' href='excluianexo.php?id=".$dados['id']."'><img src='recursos/imagens/form/close32.png' margin-left='50' width='16' heigth='16' border='0' /></a>";


					echo'<strong>Tipo Anexo:</strong>'.$dados['tipo_anexo'];
					echo"<br />";	
					echo'<strong>Numero:</strong>'.$dados['mostraAnexo'];

					echo'<strong>Ano Anexo:</strong>'.$dados['ano_anexo'];
					echo"<br />";	
					echo"<br />";	

				}

				?>	
				
				
				<!--Inicio :Documento-->

				<?php
				$i =0;
				$sql="select * from documentos order by codigo" ;

				$resultado=mysql_query($sql,$conexao) ;

				while($dados=mysql_fetch_array($resultado)){
					$descricao[$i]=$dados['descricao'];
					$i++;
				}
				?>


				<legend>Documento</legend>
				<br />
				<br />			


				<?php				
				$a = 0;

				$sql="select * from documentos_processo where numero_processo=$op" ;
				$resultado=mysql_query($sql,$conexao) ;
				while($dados=mysql_fetch_array($resultado)){
				

					if(($cadastro == $dados['login']) && ($dados['controle'] == 0)){	

						while ($a < $i){

							$tipDoc= $dados['documento'];


							$tipDoc=str_replace(" ",".",$tipDoc);
							if($a == 0){
							echo'<strong>Tipo Documento:';
							echo '<select name = "TipoDoc[]">';
							echo "<option value=".$tipDoc.">".$dados['documento']."</option>";
							}


							if($dados['documento'] != $descricao[$a])
							echo'<option value="'.$descricao[$a].'">'.$descricao[$a].'</option>';											

							$a++;
						}
						
						echo"</select>";
						echo"<br />";
						
						$a=0;
						echo'<strong>Número:</strong><input type"text" name="numeroDocumento[]" value="'.$dados['numero_documento'].'"/>';
						echo'<input type="hidden" name="idDocumento[]" value="'.$dados['id'].'">';

						echo'<strong>Ano:</strong><input type"text" name="anoDocumento[]" value="'.$dados['ano_documento'].'"/>';
						echo"<br />";
						echo"<br />";
					}else{

						echo'<strong>Tipo Documento:</strong><br />'.$dados['documento'].'<br />';

						echo'<strong>Numero:</strong>'.$dados['numero_documento'];


						echo'<strong>Ano:</strong>'.$dados['ano_documento'];
						echo"<br />";
						echo"<br />";


					}

				}
				?>	
			
				<table border="0" cellpadding="2" cellspacing="4">
					
					<tr><td class="bd_titulo" width="10">Documento</td><td class="bd_titulo">Número Doc</td><td class="bd_titulo">Ano</td></tr>
						<tr class="linhas">
							<td>
							<select name = "documento[]">
							<option value=''>Origem Processo</option>

							<?php
							$sql="select * from documentos order by codigo" ;
							$resultado=mysql_query($sql,$conexao) ;
							while($dados=mysql_fetch_array($resultado)){
								$descricao=$dados["descricao"];
								echo'<option value="'.$descricao.'">'.$descricao.'</option>';
							}
							echo"</select>";
							?>
							</td>
							
							<td>
								<input type="text" name="numero_documento[]" value="" maxlength="20" size="20px" onKeypress="return numeros();"/>
							</td>

							<td>
								<input type="text" name="ndoc[]" value="" maxlength="4" size="4px" onKeypress="return numeros();" />
							</td>


							<td>
								<a href="#" class="deletar" title="Remover linha"><img src="recursos/imagens/form/minus.png" border="0" /></a>
							</td>
						</tr>
					<tr><td colspan="4">
					<a href="#" class="adiciona" title="Adicionar item"><img src="recursos/imagens/form/plus.png" border="0" /></a>
					</td></tr>


				</table>

				</li>
		<!--Fim :Aba 3-->

					
		
					<table>
					<br />
					<br />
					<br />
					<br />
					
					
					<input type='hidden' value='<?php echo $op ?>' name="op">
					<td align='right' colspan='4'>
					<td align="right" colspan="4"><input type="submit" id="btn-alterar" value ="    Alterar    " onclick='return confirma()' /></td>	
					
					
					
					
					
					
					<?php 
					$pagina=$_POST['pagina'];
					
					if($pagina == 1)
					{
					?>
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaAnexo.php')"></td>
					
					<?php
					}elseif($pagina == 2)
					{
					?>
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaAssunto.php')"></td>
					
					<?php
					}elseif($pagina == 3)
					{
					?>
					
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaDataCarga.php')"></td>
					
					<?php
					}elseif($pagina == 4)
					{
					?>
					
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaDataProcesso.php')"></td>
					
					
					<?php
					}elseif($pagina == 5)
					{
					?>
					
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaDocumento.php')"></td>
					
					<?php
					}elseif($pagina == 6)
					{
					?>
					
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaRequerente.php')"></td>
					
					<?php
					}elseif($pagina == 7)
					{
					?>
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaSecretaria.php')"></td>
					
					<?php
					}elseif($pagina == 8)
					{
					?>
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaFinalizados.php')"></td>
					
					<?php
					}elseif($pagina == 9)
					{
					?>
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaFuncProcesso.php')"></td>
					<?php
					}elseif($pagina == 0)
					{
					?>
					<td align='right' colspan='4'><input type="button" value="    Voltar    " onclick="window.location.assign('consultaNumero.php')"></td>
					<?php
					}
					?>
					
					
					
					
					
					
					
					
					
					</table>
				</form>
			</ul>
			
				
				<!-- Fim: Conteúdo das abas -->
			<div id="conteudo">
			</div>
		
		<!-- Fim: Caixa -->
				</div>

			
			</div>
			<div id="rodape">
				<div id="usuario">
				
				<?php
				// Incluiinformações do usuario		
				include('inforUsuario.inc');	
				?>	
				
				</div>
			</div>
		</div>
	</body>

</html>'
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
		
		
		<title>Parvaim</title>
	</head>				
<body>				
	
	

<?php 
$numeroProcesso  = $_REQUEST['numero'];
$tipoProcesso   = $_REQUEST['tipo'];
$anoProcesso     = $_REQUEST['ano'];
$idProcesso	   = $_REQUEST['idProcesso'];

?>

<?php
$c = 0;
if ($_POST){ // IF LINHA 38
	$tipoAnexo    = $_POST['tipoAnexo'];//variavel com o Tipo do Processo que sera anexado ao Processo Pai
	$numeroAnexo  = $_POST['anexo'];//variavel com o Numero do Processo que sera anexado ao Processo Pai
	$anoAnexo     = $_POST['anoAnexo'];//variavel com o Ano do Processo que sera anexado ao Processo Pai
	
	$quant_linhas = count($numeroAnexo);//variavel com a quantidade de vezes que sera executado
	
	for ($i=0; $i< $quant_linhas; $i++) {//FOR LINHA 47
	
	
	
	if ( $numeroAnexo[$i] == 1){
	$tipoAnexoMostra="COMUNICAÇÃO INTERNA";
	}else{
	$tipoAnexoMostra="COMUNICAÇÃO EXTERNA";
	}
		
	//echo "numeroAnexo".$numeroAnexo[$i];
	//echo "tipoAnexo".	$tipoAnexo[$i];
	//echo "anoAnexo".	$anoAnexo[$i];
	
	
		if(($numeroProcesso != $numeroAnexo[$i]) || ($tipoProcesso != $tipoAnexo[$i]) || ($anoProcesso != $anoAnexo[$i])){

?>
				
		<?php
		
		$numeroAnexo[$i];
		$tipoAnexo[$i];
		$anoAnexo[$i];
		
		
		include('recursos/includes/verConexao.inc');
		$sql = "SELECT * FROM cadastroProcesso 
		 WHERE numeroProcesso = '$numeroAnexo[$i]' AND anoProcesso = '$anoAnexo[$i]' AND tipoProcesso = '$tipoAnexo[$i]' ";
		$resultado = mysql_query($sql, $conexao);
		if(mysql_num_rows($resultado) == 0 ){
		?>
		<fieldset>
			<p>O processo : <br />
			
			Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
			
			Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
			
			Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
			 
			<strong>Não Existe !!!</strong> 
		
		</fieldset>
		
		
		
		<?php
		}else{
		while($dados = mysql_fetch_array($resultado)){ // linha 50
		$idProcessoAnexo = $dados['idProcesso'];
		$idAnexo = $dados['idAnexo']; 
		?>
		
			<?php
			if ($idAnexo != 0){
			?>
			<fieldset>
			<p>O processo : <br />
			
			Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
			
			Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
			
			Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
			 
			<strong>Encontra-se Anexado !!!</strong> 
		
			</fieldset>
			
			
			<?php
			}else{
			?>

		
			
				<?php 
				
				include ('recursos/includes/verConexao.inc');
				$tramite = 0;
				$sql1 = "SELECT * FROM cargaProcesso WHERE idProcesso = $idProcessoAnexo ORDER BY idCarga";
				$resultado1= mysql_query($sql1 ,$conexao);
				while($dados1= mysql_fetch_array($resultado1)){
				$setorCarga = $dados1['idSetorEntrada'];
				$tramite = $dados1['tramite'];
				$idUsuarioRecebimento = $dados1['idUsuarioRecebimento'];
				}
				?>
				
				<?php
				if ($tramite != 1){
				?>
				<fieldset>
				<p>O processo : <br />
				
				Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
				
				Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
				
				Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
				 
				<strong>Encontra-se Em Movimento !!!</strong> 
			
				</fieldset>
				<?php
				}else{
				?>
					<?php
					if ($setorCarga != $idSetorUsuario){
					?>
				
					<fieldset>
					<p>O processo : <br />
					
					Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
					
					Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
					
					Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
					 
					<strong>Encontra-se Em Outro Setor!!!</strong> 
				
					</fieldset>
					<?php
					}else{
					?>
					
						<?php 
						if($idUsuarioRecebimento == $idUsuario ){
						?>
						
						
							<?php 
							include('recursos/includes/verConexao.inc');
							
							$sql2 = "UPDATE cadastroProcesso SET idAnexo = $idProcesso WHERE idProcesso = $idProcessoAnexo ";
							if (mysql_query($sql2,$conexao)){
							?>
							<fieldset>
							<p>O processo : <br />
							
							Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
							
							Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
							
							Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
							 
							<strong>Anexado com Sucesso!!!</strong> 
						
							</fieldset>
							
							<?php
							}else{
							?>
							<fieldset>
							<strong> Erro ao Cadastrar !!!</strong> 
							
							<p>O processo : <br />
							
							Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
							
							Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
							
							Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
							 
						
						
							</fieldset>
							<?php
							}//fecha o for linha 47
							?>
							
							
							
						<?php
						}else{
						?>
						<fieldset>
						
						
						<p>O processo : <br />
						
						Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
						
						Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
						
						Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
						 
						<strong> O processo Não encontra-se em seu poder !!!</strong> 
					
						</fieldset>
						<?php
						}//fecha o for linha 47
						?>
					
					<?php
					}//fecha o for linha 47
					?>
					
				<?php
				}//fecha o for linha 47
				?>
			
			
			
			<?php
			}//fecha o for linha 47
			?>
		
		<?php
		}//fecha o while linha 50
		}
		?>
	
	
		<?php
		}else{
		?>
		
		<fieldset>
		<strong> O processo não Pode ser Anexado a Ele mesmo !!!</strong> 		
		
		<p>O processo : <br />
		
		Número: <strong><?php echo $numeroAnexo[$i]; ?></strong>
		
		Ano: <strong><?php echo $anoAnexo[$i]; ?></strong>
		
		Tipo: <strong><?php echo $tipoAnexoMostra; ?></strong></p>
		 
		
	
		</fieldset>
		<?php
		}//fecha o for linha 47
		?>
	<?php
	}//fecha o for linha 47
	?>
<?php
}// fecha o if linha 38
?>	








	
<input type="button" value="    Voltar    " onclick="window.location.assign('apensarAnexo.php')">
						
</body>
</html>

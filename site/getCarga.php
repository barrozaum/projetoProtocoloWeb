<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<?php
	// Inclui o script do site			
	
	include('recursos/includes/verScript.inc');
	
	?>
	

	<title>Parvaim</title>	
</head>
<body>

<?php
$numero = preg_replace("/[^0-9]/", "", $_REQUEST['numero']);
$ano = preg_replace("/[^0-9]/", "", $_REQUEST['ano']);
$tipo = preg_replace("/[^0-9]/", "", $_REQUEST['tipo']);
?>


				
<form name='f2' action='cadastroCarga1.php' method='POST' > 
<?php
include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM  cadastroProcesso WHERE numeroProcesso ='$numero' AND tipoProcesso='$tipo' AND anoProcesso='$ano' " ;
$resultado=mysql_query($sql,$conexao) ;
if(mysql_num_rows($resultado) == 0){
?> 
<div id="cadastrados">
      <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
 </div>
<?php 
}else{
while($dados=mysql_fetch_array($resultado)){
$idProcesso= $dados['idProcesso'];
$idRequerente= $dados['idRequerente'];
$idAssunto= $dados['idAssunto'];
$idOrigem= $dados['idOrigem'];
$idAnexado = $dados['idAnexo'];
}
?>

	
	
	
	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql2 = "SELECT * FROM assunto WHERE idAssunto = $idAssunto";
	$resultado2 = mysql_query($sql2,$conexao);
	while ($dados2 = mysql_fetch_array($resultado2 )){
	$assunto = $dados2['nomeAssunto'];
	}
	?>

	<br /><label> ASSUNTO: <label>
		<input type="text" name="assunto" value="<?php echo $assunto ; ?>" size="45px" readonly= "True" />
	</label><br /><br />
	
	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql3 = "SELECT * FROM requerente WHERE idRequerente = $idRequerente ";
	$resultado3 = mysql_query($sql3,$conexao);
	while ($dados3 = mysql_fetch_array($resultado3 )){
	$requerente= $dados3['requerente'];
	}
	?>
	
	
	<label> REQUERENTE: <input type="text" name="requerente" value="<?php echo $requerente; ?>"  size="45px" readonly= "True" /> 
	</label><br /><br />
		
		
	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql4 = "SELECT * FROM origem WHERE idOrigem = $idOrigem";
	$resultado4 = mysql_query($sql4,$conexao);
	while ($dados4 = mysql_fetch_array($resultado4 )){
	$origem= $dados4['nomeOrigem'];
	}
	?>
	
	
	<label> ORIGEM : <input type="text" name="origem" value="<?php echo $origem; ?>"  size="45px" readonly= "True" /> 
	</label><br /><br />
		
	
	<?php
	include('recursos/includes/verConexao.inc');
	
	$sql5 = "SELECT * FROM cargaProcesso WHERE idProcesso= $idProcesso ORDER BY idCarga";
	$resultado5 = mysql_query($sql5,$conexao);
	while ($dados5 = mysql_fetch_array($resultado5 )){
	$idSetorOrigem= $dados5['idSetorOrigem'];
	$idSetorEntrada= $dados5['idSetorEntrada'];
	$tramite= $dados5['tramite'];
	$idUsuarioRecebimento= $dados5['idUsuarioRecebimento'];
	}
	
	if($idAnexado == 0){
	?>
		
		<?php
		if($tramite == 1){
		?>
			<?php
			if($idSetorOrigem == $_SESSION['idSetorUsuario']){
			?>
				<?php
				if($idUsuarioRecebimento== $_SESSION['idUsuario'] ){
				?>
					<label>DATA CARGA:</label>
						<input type="text" class="data"  id="data" name="data" value="<?php echo date('d/m/Y'); ?>" maxlength="10" size="10px"  onfocus ="mascaraData(confData);" onblur="validarData(this)" /><br /><br />
						<input type="hidden" name="confData"  maxlength="2" size="2px"  value="0"   />
					</label>


					<label> OBSERVAÇÃO: <br />
						<textarea name="obs" rows = "8" cols="60" maxlength="200"></textarea>
					</label><br /><br />	
					
					
					<label>	
					CÓDIGO 
						<input type="text" id="setorEntrada" name="setorEntrada"  value="" size="1" onchange="s(this.value)" onKeypress="return numeros();" >
						SETOR
						<i id="mostraSetor">
						<input type="text" name="nomeSetor" id="nomeSetor" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
						</i>
						<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
					</label>
					<br />					
					<br />
					
					<input type="hidden" name="idProcesso" value="<?php echo $idProcesso; ?>" />	
					<input type="button" value="    Enviar    " onclick = "valida();">
					</form>
								
				<?php
				}else{
				?>
				PROCESSO ENCONTRA-SE COM OUTRO USUÁRIO !!!
				<?php 
				}
				?>
		
			<?php
			}else{
			?>
			PROCESSO NÃO ENCONTRA-SE NESTE SETOR !!!
			<?php 
			}
			?>
	
		<?php
		}else{
		?>
		PROCESSO ENCONTRA-SE EM TRÂMITE !!!
		<?php 
		}
		?>

	<?php
	}else{
	?>
	PROCESSO ENCONTRA-SE ANEXADO A OUTRO !!!
	<?php 
	}
	?>
<?php
}
?>

</body>
</html>		

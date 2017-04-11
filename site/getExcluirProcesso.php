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
	<?php
	// Inclui o script do site			
	
	include('recursos/includes/verScript.inc');
	
	?>
	
	<title>Parvaim</title>	
</head>
<body>

<?php
$numero = $_REQUEST['numero'];
$ano = $_REQUEST['ano'];
$tipo= $_REQUEST['tipo'];
?>

				
<form name='f2' action='excluirProcesso1.php' method='POST' > 
				



<?php

include('recursos/includes/verConexao.inc');

		
$sql="SELECT * FROM  cadastroProcesso WHERE numeroProcesso ='$numero' AND tipoProcesso='$tipo' AND anoProcesso='$ano' " ;

$resultado=mysql_query($sql,$conexao) ;

if(mysql_num_rows($resultado) == 0){
?>
	
	<strong>Nenhum Processo Encontrado !!!</strong>
	
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
	
	<label><strong> Assunto: </strong><label>
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
	
	
	<label><strong> Requerente: </strong><input type="text" name="requerente" value="<?php echo $requerente; ?>"  size="45px" readonly= "True" /> 
	</label><br /><br />
		
		
	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql4 = "SELECT * FROM origem WHERE idOrigem = $idOrigem";
	$resultado4 = mysql_query($sql4,$conexao);
	while ($dados4 = mysql_fetch_array($resultado4 )){
	$origem= $dados4['nomeOrigem'];
	}
	?>
	
	
	<label><strong> Origem : </strong><input type="text" name="origem" value="<?php echo $origem; ?>"  size="45px" readonly= "True" /> 
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
				
				
					
					</select></label><br /><br />
					<input type="hidden" name="idProcesso" value="<?php echo $idProcesso; ?>" />	
					<input type="button" value="    Excluir    "onclick="javascript: confirma();">
					<input type="button" value="    Voltar    " onclick="javascript: window.close();">
					</form>
								
				<?php
				}else{
				?>
				<strong>Processo Encontra-se com Outro Usuário!!!</strong> 
				<?php 
				}
				?>
		
			<?php
			}else{
			?>
			<strong>Processo não Encontra-se Neste Setor !!!</strong>
			<?php 
			}
			?>
	
		<?php
		}else{
		?>
		<strong>Processo não Encontra-se em Tramite !!!</strong>
		<?php 
		}
		?>

	<?php
	}else{
	?>
	<strong> Está Anexado a um Outro !!!</strong> 
	<?php 
	}
	?>

	
<?php
}
?>

</body>
</html>		

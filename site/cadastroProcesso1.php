<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario=$_SESSION['idUsuario'];
$idSetorPresente = $_SESSION['idSetorUsuario'];

?>
<!DOCTYPE HTML>
<html lang="pt-br">
	
	<head>
 	<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/print.css" media='print' />
		<title>Cadastro Processo</title>
	</head>

<body>

<?php 
$nProcesso = $_REQUEST['troca'];// numeroProcesso


$tProcesso  = $_REQUEST['tipoProcesso'];// tipoProcesso


$aProcesso =  $_REQUEST['anoProcesso']; // anoProcesso


$dataProcesso= date('Y-m-d'); // dataProcesso


$codOrigem= $_REQUEST['codOrigem'];// idOrigem



$codAssunto= $_REQUEST['codAssunto'];// idAssunto



$codRequerente= $_REQUEST['codRequerente'];// idRequerente



$obs = $_REQUEST['obs'];// Tabela Observacao
?>
<?php 
$v = 1;
while($v != 0){
?>

	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql = "SELECT * FROM cadastroProcesso WHERE numeroProcesso = $nProcesso AND tipoProcesso = $tProcesso AND anoProcesso = $aProcesso";
	if($resultado = mysql_query($sql,$conexao)){
	if (mysql_num_rows($resultado) == 0){
	?>
	
	
	
		<?php 
		include ('recursos/includes/verConexao.inc');
		
		$sql = "INSERT INTO cadastroProcesso (numeroProcesso, tipoProcesso, anoProcesso, idAssunto, idOrigem, idRequerente, dataProcesso, idUsuario) VALUES ($nProcesso, $tProcesso,$aProcesso, $codAssunto, $codOrigem, $codRequerente, '$dataProcesso',$idUsuario)";
		if (mysql_query($sql,$conexao)){
		?>
	
	
		<?php 
		include ('recursos/includes/verConexao.inc');
		
		$sql1 = "SELECT * FROM cadastroProcesso WHERE numeroProcesso = $nProcesso AND tipoProcesso = $tProcesso AND anoProcesso = $aProcesso";
		$resultado1 = mysql_query($sql1, $conexao);
		while ($dados1 = mysql_fetch_array($resultado1)){
		$idProcesso =  $dados1['idProcesso'];
		}
		?>
		
		<?php 
		if ($obs != ""){
		//Cadastro a observação do processo
		include ('recursos/includes/verConexao.inc');
		
		$sql3 = "INSERT INTO obs (idProcesso, obs) VALUES ($idProcesso, '$obs')";
		if(!mysql_query($sql3,$conexao)){
		?>
		<script>window.alert('ERRO NO SQL OBS !!!');
		location.href="cadastroProcesso.php"</script>
		
		<?php
		}//Fim do cadastro do processo
		}
		?>
		
		
			
		<?php
		// exibindo os dados
		if ($_POST){
			$documento = $_POST['documento'];
			$anoDocumento= $_POST['anoDocumento'];
			$numeroDocumento= $_POST['numeroDocumento'];
			$dt = date('Y-m-d');
				
			$quant_linhas = count($documento);
			
			for ($i=0; $i<$quant_linhas; $i++) {
			
			if(($documento[$i] != "") && ($anoDocumento[$i] != "") &&($numeroDocumento[$i] != "")) {
				include ('recursos/includes/verConexao.inc');
			
				$sql4 = "INSERT INTO documentoProcesso(idProcesso, idDocumento, anoDocumento, numeroDocumento, idUsuario ) VALUES ($idProcesso,$documento[$i], $anoDocumento[$i], $numeroDocumento[$i], $idUsuario )";
				if(!mysql_query($sql4,$conexao)){
				?>
				<script>window.alert('ERRO AO CADASTRAR DOCUMENTO !!!');
				location.href="cadastroProcesso.php"</script>
				<?php
				}
			}
		    }
		}
		?>
		<!--FIM: Documento-->
			
			
			
			
		<?php 
		$dtCarga = date('Y-m-d');
		//Cadastro a observação do processo
		include ('recursos/includes/verConexao.inc');
		
		$sql5 = "INSERT INTO cargaProcesso (idProcesso, idSetorOrigem, idSetorEntrada, idSetorPresente, tramite,idUsuarioCarga, dataCarga,idUsuarioRecebimento, dataRecebimento) VALUES ($idProcesso, $idSetorPresente, $idSetorPresente,$idSetorPresente, 1, $idUsuario, '$dtCarga', $idUsuario, '$dtCarga' )";
		if(mysql_query($sql5,$conexao)){
		?>
		<script>window.alert('CADASATRADO COM SUCESSO !!!');
		location.href="etiquetas.php?Cod=<?php echo $idProcesso; ?>";</script>
		<?php
		}else{
		?>
		<script>window.alert('ERRO AO CADASTRAR CARGA !!!');
		location.href="cadastroProcesso.php"</script>
		
		
		<?php
		}
		?>
	
		
		
		

	
	
	
	
	
	<?php 
	}else{
	?>
	<script>window.alert('ERRO AO CADASTRAR PROCESSO !!!');
		location.href="cadastroProcesso.php"</script>
	<?php
	}
	?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
	$v = 0;
	}else{
	$nProcesso++;
	}
	?>
			
	
	<?php 
	}else{
	?>
	<script>window.alert('ERRO AO CADASTRAR PROCESSO !!!');
		location.href="cadastroProcesso.php"</script>
	<?php
	}
	?>
	
	
<?php }?>

</body>
</html>

<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario=$_SESSION['idUsuario']; 
$idSetorPresente = 1;

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
$idProcesso= $_REQUEST['idProcesso'];// idProcesso



$codOrigem= $_REQUEST['codOrigem'];// idOrigem



$codAssunto= $_REQUEST['codAssunto'];// idAssunto



$codRequerente= $_REQUEST['codRequerente'];// idRequerente



$obs = "";//instancio a variavel
$obs = $_REQUEST['obs'];// Tabela Observacao  altera

$cadObs = ""; //instancio a variavel
$cadObs = $_REQUEST['cadObs'];// Tabela Observacao cadastra
?>

<?php 
include ('recursos/includes/verConexao.inc');

$sql = "UPDATE cadastroProcesso SET  idAssunto =  $codAssunto, idOrigem = $codOrigem, idRequerente  = $codRequerente WHERE idProcesso = $idProcesso";
if (mysql_query($sql,$conexao)){
?>
	
	
	
	
	<?php 
	

    if ($obs != "")
	$sql3 = "UPDATE obs  SET obs = '$obs' WHERE idProcesso = $idProcesso";
    else   if ($cadObs != "")
    $sql3 = "INSERT INTO obs (obs, idProcesso) VALUES  ('$cadObs','$idProcesso') ";

    if (($obs != "") || ($cadObs != "")){
    if(!mysql_query($sql3,$conexao)){
	?>
	<script>window.alert('Erro ao cadastrar Obs!!');
	location.href="consultaNumero.php"</script>
	
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
			<script>window.alert('Erro ao cadastrar documentoProcesso!!');
			location.href="consultaNumero.php"</script>
			<?php
			}
		}
	    }
	}
	?>
	<!--FIM: Documento-->
		
		
	
		
		
		

<?php 
}else{
?>
<script>window.alert('Erro ao Cadastrar Processo !!');
	location.href="consultaNumero.php"</script>
<?php
}
?>
<script>window.alert('Alterado Com Sucesso !!');
	location.href="consultaNumero.php"</script>
</body>
</html>

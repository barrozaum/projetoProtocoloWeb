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

<script>opener.location.reload();</script>
<?php
$idProcesso= $_REQUEST['cod'];

include('recursos/includes/verConexao.inc');

$sql = "UPDATE cadastroProcesso SET idAnexo = 0 WHERE idAnexo = $idProcesso";
if(mysql_query($sql, $conexao)){
?>

	
	<?php 
	
	include('recursos/includes/verConexao.inc');
	
	$sql1 = "DELETE FROM cadastroProcesso WHERE idProcesso = $idProcesso";
	if(mysql_query($sql1, $conexao)){
	?>
	<script languagem="JavaScript"> window.alert('EXCLUÍDO COM SUCESSO !!!');</script>
	<?php
	}else{
	?>
	<script languagem="JavaScript"> window.alert('ERRO AO EXCLUIR !!!');</script>
	<?php
	}
	?>
<?php
}else{
?>
<script languagem="JavaScript"> window.alert('ERRO AO EXCLUIRA ANEXO !!!');</script>
<?php
}
?>
<script languagem="JavaScript">location.href="cadastroProcesso.php"</script>
</body>
</html>		

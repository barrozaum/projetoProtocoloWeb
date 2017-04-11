<?php
session_start();
include ('recursos/includes/verSessao.inc');
?>

<!DOCTYPE HTML>
<html lang="pt-br">	
	<head>
		<meta charset="UTF-8">



	<title>Parvaim</title>
</head>

<body>


<?php 
$mensagem = "";
$lugar = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['setor']);

$secretaria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['secretaria']);

$desc_secretaria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['desc_secretaria']);

$coordenadoria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['coordenadoria']);

$desc_coordenadoria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['desc_coordenadoria']);

$departamento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['departamento']);

$desc_departamento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['desc_departamento']);

?>	
					
<?php
$c = $_REQUEST['codigo']; 
include('recursos/includes/verConexao.inc');

$sql = "SELECT idSetor FROM setor WHERE idSetor = $c";
$resultado = mysql_query($sql,$conexao);
if (mysql_num_rows($resultado)==0) {
	$mensagem = "SETOR NÃO ENCONTRADO !!!";
}else{
?>

	<?php
	include('recursos/includes/verConexao.inc');
	$sql= "UPDATE setor SET  setor = '$lugar', secretaria ='$secretaria',  descSecretaria = '$desc_secretaria', coordenadoria = '$coordenadoria', descCoordenadoria = '$desc_coordenadoria', departamento = '$departamento', 
	descDepartamento= '$desc_departamento'   WHERE idSetor = $c";
	if(mysql_query($sql, $conexao)){
	$mensagem = "ALTERADO COM SUCESSO !!!";
	}else{
	$mensagem = "ERRO AO ALTERAR !!!";
	}
	?>
<?php
}
?>
		
<script type="text/javascript">
	var mensagem = '<?php echo $mensagem; ?>';
		window.alert(mensagem);
	location.href="cadastroSetor.php";
</script>
</body>
</html>
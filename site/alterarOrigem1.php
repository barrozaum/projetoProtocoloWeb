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
$c = preg_replace("/[^0-9]/", "", $_REQUEST['codigo']);
$d = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['descricao']);
$mensagem = "";
?>
	<?php
	include('recursos/includes/verConexao.inc');

	$sql="SELECT * FROM origem WHERE idOrigem = $c";
	$resultado = mysql_query($sql,$conexao);
	if(mysql_num_rows($resultado)==0)
		$mensagem = "ORIGEM NÃO ENCONTRADA";
	else{
	?>

		<?php 
		include('recursos/includes/verConexao.inc');

		$sql = "UPDATE origem SET nomeOrigem = '$d' WHERE idOrigem= $c ";
		if(mysql_query($sql, $conexao)){

		$mensagem = "ALTERADO COM SUCESSO !!!";
		}else{
		$mensagem = "ERRO AO ALTERA !!!";
		}
		?>
	
	<?php
	}
	?>
		
<script type="text/javascript">
	var mensagem = '<?php echo $mensagem; ?>';
		window.alert(mensagem);
	location.href="cadastroOrigem.php";
</script>
</body>
</html>



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
$c = preg_replace("/[^0-9]/", "", $_REQUEST['cod']);
$mensagem = "";

include('recursos/includes/verConexao.inc');
$sql= "SELECT * FROM cadastroprocesso WHERE idAssunto= $c";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php
	if(mysql_num_rows($resultado) >= 1){
	
	$mensagem =  'Assunto Não Pode ser Excluido, Pois ja está cadastrado em Processo !!!';
	
	}else{
	?>
	
		<?php 
		include ('recursos/includes/verConexao.inc');
		
		$sql1 = "DELETE FROM  assunto WHERE idAssunto = $c";
		if(mysql_query($sql1,$conexao)){
		$mensagem =  'EXCLUIDO COM SUCESSO !!!';
		
		}else{
		$mensagem =  'ERRO AO EXCLUIR !!!';
		}
		 
	}
	?>
<?php 
}else{

$mensagem =  'Erro no SQL';
 
}
?>

<script type="text/javascript">
	var mensagem = '<?php echo $mensagem; ?>';
	window.alert(mensagem);
	location.href="cadastroAssunto.php";
</script>
</body>
</html>
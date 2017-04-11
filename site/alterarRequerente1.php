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
?>

<?php
include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM requerente WHERE idRequerente = $c";
$resultado = mysql_query($sql,$conexao);
if(mysql_num_rows($resultado)==0)
	$mensagem = "REQUERENTE NÃO ENCONTRADO";
else{
?>


<?php 
$requerente = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['requerente']);

$logradouro = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['logradouro']);

$numero = $_REQUEST['numero_end'];

$complemento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['complemento']);
 
$bairro = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['bairro']);

$cidade = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['cidade']);

$uf = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['uf']);

$cep =$_REQUEST['cep'];
$tel =$_REQUEST['tel'];
$cel =$_REQUEST['cel'];
?>

	<?php 
	include('recursos/includes/verConexao.inc');
			     	 
	$sql="UPDATE requerente SET requerente = '$requerente',logradouro='$logradouro',numeroEnd =$numero, complemento =  '$complemento', bairro= '$bairro',cidade='$cidade',uf = '$uf',cep='$cep',tel='$tel',cel='$cel' WHERE idRequerente = $c";
	if(mysql_query($sql,$conexao))	
	$mensagem = "ALTERADO COM SUCESSO !!!";
	else
	$mensagem = "ERRO AO ALTERAR !!!";
	?>

		<?php
	}
	?>
		
<script type="text/javascript">
	var mensagem = '<?php echo $mensagem; ?>';
		window.alert(mensagem);
	location.href="cadastroRequerente.php";
</script>
</body>
</html>
	
				
						

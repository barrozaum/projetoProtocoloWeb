<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<!-- Verifica se os dados do formulario estão preenchidos corretamente -->

<?php
$numero=$_REQUEST['numero'];
	if($numero == ""){
	echo "<script language='JavaScript'> window.alert('SELECIONE UM ARQUIVO.');</script>";
	echo "<script>history.go(-1);</script>";
	}


?>
<!-- Fim da Verificação-->


<?php
if ($_POST){//abre if linha 23

$numero= $_POST['numero'];

//$cadastro=$_SESSION['nomeUsuario'];

$dt =date('Y/m/d');

$quant_linhas = count($numero);

   for ($i=0; $i<$quant_linhas; $i++) {//abre for linha 33
?>

   	<?php
  	include('recursos/includes/verConexao.inc');
  	$idAnexo =0;
  	$sql = "SELECT * FROM cadastroProcesso WHERE idAnexo =  $numero[$i]";
	$resultado = mysql_query($sql,$conexao);
	if(mysql_num_rows($resultado) != 0)
	while($dados=mysql_fetch_array($resultado)){
	$idAnexo = $dados['idProcesso'];
  	?>


	   	<?php
	  	include('recursos/includes/verConexao.inc');
	  	$ultimaCargaAnexo = 0;
	  	$sql1 = "SELECT * FROM cargaProcesso WHERE idProcesso=  $idAnexo ";
		$resultado1 = mysql_query($sql1,$conexao);
		if(mysql_num_rows($resultado1) != 0)
		while($dados1=mysql_fetch_array($resultado1)){
		$ultimaCargaAnexo= $dados1['idCarga'];
	  	}
	  	?>

		  	<?php
			include('recursos/includes/verConexao.inc');
			$dtRecebimento= date('Y-m-d');

			$sql2 ="UPDATE cargaProcesso SET tramite = 1, idSetorOrigem = $idSetorUsuario   WHERE idProcesso = $idAnexo";
			if(!mysql_query($sql2, $conexao)){
			?>
			<script>
			window.alert('ERRO AO RECEBER PROCESSO1 !!!');
  			location.href='cadastroRecebimento.php';

			</script>
			<?php
			}
			?>



			<?php
			include('recursos/includes/verConexao.inc');
			$dtRecebimento= date('Y-m-d');

			$sql3 ="UPDATE cargaProcesso SET idUsuarioRecebimento  = $idUsuario , dataRecebimento = '$dtRecebimento' WHERE idCarga = $ultimaCargaAnexo";
			if(!mysql_query($sql3, $conexao)){
			?>
			<script>
			window.alert('ERRO AO RECEBER PROCESSO2 !!!');
  			location.href='cadastroRecebimento.php';

			</script>
			<?php
			}
			?>




	<?php
  	}
  	?>


   	<?php


   	$ultimaCarga  = 0;

   	include('recursos/includes/verConexao.inc');

   	$sql4= "SELECT * FROM cargaProcesso WHERE idProcesso = $numero[$i]";
   	$resultado4 = mysql_query($sql4, $conexao);
   	while ($dados4= mysql_fetch_array($resultado4 )){
   	$ultimaCarga = $dados4['idCarga'];
   	}
   	?>


  	<?php
	include('recursos/includes/verConexao.inc');
	$dtRecebimento= date('Y-m-d');

	$sql5 ="UPDATE cargaProcesso SET tramite = 1, idSetorOrigem = $idSetorUsuario   WHERE idProcesso = $numero[$i]";
	if(!mysql_query($sql5, $conexao)){
	?>
	<script>
	window.alert('ERRO AO RECEBER PROCESSO5 !!!');
	 location.href='cadastroRecebimento.php';

	</script>
	<?php
	}
	?>


	<?php
	include('recursos/includes/verConexao.inc');
	$dtRecebimento= date('Y-m-d');

	$sql6 ="UPDATE cargaProcesso SET idUsuarioRecebimento  = $idUsuario, dataRecebimento = '$dtRecebimento' WHERE idCarga = $ultimaCarga ";
	if(!mysql_query($sql6, $conexao)){
	?>
	<script>
	window.alert('ERRO AO RECEBER PROCESSO6 !!!');
	location.href='cadastroRecebimento.php';

	</script>
	<?php
	}
	?>








<?php
    }	// fecha o for da linha 33
}// fecha o if da linha 23
?>
<script>
window.alert('RECEBIDO COM SUCESSO !!!');
location.href='cadastroRecebimento.php';

</script>

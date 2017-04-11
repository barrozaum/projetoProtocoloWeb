<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php
$idProcesso= $_REQUEST['Cod'];//valor da id do processo
?>


<?php

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM  cadastroProcesso WHERE idAnexo = $idProcesso" ;

$resultado=mysql_query($sql,$conexao);
if($resultado != 0)
while($dados=mysql_fetch_array($resultado)){
$idAnexo = $dados['idProcesso'];
?>

	<?php
	include('recursos/includes/verConexao.inc');

	$sql1 = "UPDATE cargaProcesso SET idSetorOrigem = $idSetorUsuario, idSetorEntrada = $idSetorUsuario, tramite = 1  WHERE idProcesso = $idAnexo";
    mysql_query($sql1,$conexao);
	?>
		<?php

		include('recursos/includes/verConexao.inc');

		$sql2 = "SELECT * FROM cargaProcesso WHERE idProcesso = $idAnexo";
		$resultado2=mysql_query($sql2, $conexao);
		while($dados2 = mysql_fetch_array($resultado2)){
		$ultimaCargaAnexo =  $dados2['idCarga'];
		}
		?>

		<?php
		include('recursos/includes/verConexao.inc');

		$sql3 = "DELETE FROM cargaProcesso WHERE idCarga = $ultimaCargaAnexo ";
		if(!mysql_query($sql3,$conexao)){
		?>
		<script>
		window.alert('ERRO AO EXCLUIR CARGA 3 !!!');
		location.href="cadastroCarga.php";
		</script>
		<?php
		}
		?>



<?php
}
?>

<?php
include('recursos/includes/verConexao.inc');

$sql4 = "UPDATE cargaProcesso SET idSetorOrigem = $idSetorUsuario, idSetorEntrada = $idSetorUsuario, tramite = 1  WHERE idProcesso = $idProcesso";
mysql_query($sql4,$conexao);
?>

	<?php

	include('recursos/includes/verConexao.inc');

	$sql5 = "SELECT * FROM cargaProcesso WHERE idProcesso = $idProcesso";
	$resultado5=mysql_query($sql5, $conexao);
	while($dados5 = mysql_fetch_array($resultado5)){
	$ultimaCarga =  $dados5['idCarga'];
	}
	?>

		<?php
		include('recursos/includes/verConexao.inc');

		$sql6 = "DELETE FROM cargaProcesso WHERE idCarga = $ultimaCarga ";
		if(mysql_query($sql6,$conexao)){
		?>


		<?php
		}else{
		?>
		<script>
		window.alert('ERRO AO EXCLUIR CARGA 6 !!!');
		location.href="cadastroCarga.php";
		</script>
		<?php
		}
		?>




<script>
window.alert('CARGA EXCLUIDA COM SUCESSO !!!');
location.href="cadastroCarga.php";
</script>



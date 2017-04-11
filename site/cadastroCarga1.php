<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php
//recolhe as informações mandadas pelo getcarga.php
$idProcesso = preg_replace("/[^0-9]/", "", $_REQUEST['idProcesso']);
$obs = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['obs']);
$setorEntrada= preg_replace("/[^0-9]/", "", $_REQUEST['setorEntrada']);
?>
 <?php
    $dtCarga=preg_replace("/[^0-9]\//", "", $_REQUEST['data']);

    if(($dtCarga != '00-00-0000') && ($dtCarga != "")){
    //VARIAVEL COM A DATA NO FORMATO AMERICANO
    $dataAmericana= $dtCarga;
     
    //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
    $partesdadata = explode('/',$dataAmericana);
     
    //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
    //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
    $dtCarga= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
     
    //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
    }else{
      $dtCarga  = '0000-00-00';
    }
    ?>




<?php 
if($setorEntrada == ""){
?>

<script>window.alert('VERIFIQUE O CAMPO SETOR');</script>
<script>location.href="cadastroCarga.php";</script>


<?php 
}else{
?>

	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql = "SELECT * FROM cadastroProcesso WHERE idAnexo = $idProcesso";
	$resultado= mysql_query($sql,$conexao);
	if(mysql_num_rows($resultado) != 0)
	while($dados = mysql_fetch_array($resultado)){
	$idAnexo = $dados['idProcesso'];
	?>
		<?php
		//altera os valores antigos das cargas
		include('recursos/includes/verConexao.inc');
		
		$sql3="UPDATE  cargaProcesso SET idSetorOrigem = $idSetorUsuario, idSetorEntrada = $setorEntrada WHERE idProcesso = $idAnexo ";
		if(mysql_query($sql3,$conexao)){
		?>
		
			<?php
			//altera os valores antigos das cargas
			include('recursos/includes/verConexao.inc');
			
			$sql4="INSERT INTO cargaProcesso (idProcesso,idSetorOrigem,idSetorEntrada, tramite, idSetorPresente, parecer, idUsuarioCarga, dataCarga)VALUES($idAnexo ,$idSetorUsuario ,$setorEntrada ,0, $setorEntrada, '$obs', $idUsuario, '$dtCarga'  )";
			if(!mysql_query($sql4,$conexao)){
			?>
			<script>
			window.alert('ERRO AO CADASTRAR ANEXO !!!'); 
			location.href="cadastroCarga.php";
			</script>
			<?php
			}
			?>
				
		<?php
		}else{
		?>
		<script>
		window.alert('ERRO AO ALTERAR CARGA4 !!!'); 
		location.href="cadastroCarga.php";
		</script>
		<?php
		}
		?>
	<?php
	}
	?>

	<?php
	//altera os valores antigos das cargas
	include('recursos/includes/verConexao.inc');
	
	$sql3="UPDATE  cargaProcesso SET idSetorOrigem = $idSetorUsuario, idSetorEntrada = $setorEntrada WHERE idProcesso = $idProcesso ";
	if(mysql_query($sql3,$conexao)){
	?>
	
			
			<?php
			//altera os valores antigos das cargas
			include('recursos/includes/verConexao.inc');
			
			$sql3="INSERT INTO cargaProcesso (idProcesso,idSetorOrigem,idSetorEntrada, tramite, idSetorPresente, parecer, idUsuarioCarga, dataCarga)VALUES($idProcesso,$idSetorUsuario ,$setorEntrada ,0, $setorEntrada, '$obs', $idUsuario, '$dtCarga'  )";
			if(mysql_query($sql3,$conexao)){
			?>
			<script>
			window.alert('CADASTRADO COM SUCESSO !!!'); 
			location.href="cadastroCarga.php";
			</script>
			<?php
			}else{
			?>
			<script>
			window.alert('ERRO AO CADASTRAR CARGA !!!'); 
			location.href="cadastroCarga.php";
			</script>
			<?php
			}
			?>
				
				
		<?php
		}else{
		?>
		<script>
		window.alert('ERRO AO ALTERAR CARGA !!!'); 
		location.href="cadastroCarga.php";
		</script>
		<?php
		}
		?>
			

<?php
}
?>

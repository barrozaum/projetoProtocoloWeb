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
		<link rel="stylesheet" type="text/css" href="recursos/css/print.css" media='print' />
		
		<title>Etiquetas</title>
	</head>				
<body>				
					


<?php
$tipoProcesso = preg_replace("/[^0-9]/", "", $_REQUEST['tipo']);
$anoProceso = preg_replace("/[^0-9]/", "", $_REQUEST['ano']);
$numeroProcesso = preg_replace("/[^0-9]/", "", $_REQUEST['numero']);

include('recursos/includes/verConexao.inc');   

$sql="SELECT * FROM cadastroProcesso WHERE tipoProcesso = $tipoProcesso AND numeroProcesso = $numeroProcesso AND anoProcesso = $anoProceso";
$resultado=mysql_query($sql,$conexao) ;
if(mysql_num_rows($resultado) == 0){
?>
<script languagem="Javascript">window.alert('NENHUM PROCESSO ENCONTRADO !!'); location.href="manEtiquetas.php";</script>

<?php
}else{
while($dados=mysql_fetch_array($resultado)){
$numeroProcesso = $dados['numeroProcesso'];
$tipoProcesso = $dados['tipoProcesso'];
$anoProcesso = $dados['anoProcesso'];
$dataProcesso= $dados['dataProcesso'];
$idRequerente = $dados['idRequerente'];
$idAssunto = $dados['idAssunto'];
$cod = $dados['idProcesso']; 

}	
?>

<?php
if ($tipoProcesso == 1){
$tProcesso = "COMUNICAÇÃO INTERNA";
}else{
$tProcesso = "COMUNICAÇÃO EXTERNA";
}
?>
	
<?php 
$sql1 = "SELECT * FROM assunto WHERE idAssunto = $idAssunto";
$resultado1 = mysql_query($sql1, $conexao);
while($dados1 = mysql_fetch_array($resultado1)){
$nomeAssunto = $dados1['nomeAssunto'];
}
?>		
		
<?php 
$sql2 = "SELECT * FROM requerente WHERE idRequerente = $idRequerente ";
$resultado2 = mysql_query($sql2, $conexao);
while($dados2 = mysql_fetch_array($resultado2)){
$requerente= $dados2['requerente'];
}
?>		
<?php   
//Formata a data americana em brasileira

//VARIAVEL COM A DATA NO FORMATO AMERICANO
$data_americano = $dataProcesso;

//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
$partes_da_data = explode('-',$data_americano);

//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
$dataProcesso= $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];

//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
?>			
	

<div style="margin-left: 100px; width:350px; font-size: 18px;">
												
<fieldset>
						
	 <strong>NÚMERO:</strong> <?php echo $numeroProcesso ; ?>/ <?php echo  $anoProcesso; ?><br />
						
</fieldset>
			
<strong>PROTOCOLADO EM:  <?php echo $dataProcesso; ?></strong> <br />
						
<strong> TIPO PROCESSO:</strong>  <?php echo  $tProcesso ; ?><br />
			
<strong> REQUERENTE:</strong>  <?php echo $requerente; ?><br />
				
<strong> ASSUNTO:</strong>  <?php echo $nomeAssunto ; ?><br />
				




	
	<?php


	include('recursos/includes/verConexao.inc');   

	$sql4="SELECT * FROM documentoProcesso DP, documento d WHERE idProcesso = $cod AND DP.idDocumento = d.idDocumento";

	$resultado4=mysql_query($sql4,$conexao) ;

	while($dados4=mysql_fetch_array($resultado4)){
	
		$documento=$dados4['nomeDocumento'];
		$ano_documento=$dados4['anoDocumento'];
		$numero_documento = $dados4['numeroDocumento'];
		
		
		echo"<hr />";
		echo "<strong>DOCUMENTO: </strong>". $documento."<br />";
		echo "<strong>NÚMERO DOCUMENTO: </strong>". $numero_documento."<br />";
		echo "<strong>ANO DOCUMENTO: </strong>". $ano_documento."<br />";
	
		}
	?>	
	<hr />
</div>

					
					



					
							
							
	<div id="imprimir">
		<form>
			
			<input type="button"  name="Button" value="    IMPRIMIR    " onclick="window.print()">
			<input type=button onClick="window.location.assign('manEtiquetas.php')" value="    VOLTAR    ">	
		</form>
	</div>		
<?php
}
?>
	
		
</body>
</html>

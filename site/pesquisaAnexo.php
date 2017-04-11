<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<form name="f1" action="consultaDados.php" method="post">

<?php
$anexo = preg_replace("/[^0-9]/", "", $_REQUEST['anexo']);

$tipo = preg_replace("/[^0-9]/", "", $_REQUEST['tipo']);

$ano = preg_replace("/[^0-9]/", "", $_REQUEST['ano']);

$i=0;
$cont =0;
			
include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM cadastroProcesso WHERE numeroProcesso like '%$anexo%'  AND tipoProcesso='$tipo' AND anoProcesso='$ano' AND idAnexo != 0" ;

$resultado=mysql_query($sql,$conexao) ;

if (mysql_num_rows($resultado) == 0) {
?>
<div id="cadastrados">
 <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
</div>
<?php

}else{
?>


<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
<table width="100%">
<thead class="fixedHeader">
<tr bgcolor="#f5f5dc">
	<th></th>
	<th>NÚMERO</th>
	<th>TIPO</th>
	<th>ANO</th>
	<th>ANEXO</th>
	<th>TIPO ANEXO</th>
	<th>ANO ANEXO</th>
</tr>

<?php
$i=0;
while($dados=mysql_fetch_array($resultado)){
$idAnexo = $dados['idAnexo'];
$numeroAnexo = $dados['numeroProcesso'];
$anoAnexo= $dados['anoProcesso'];
$tipoAnexo= $dados['tipoProcesso'];
	if ($i% 2 == 0)
		$cor = "#CCCCCC";
	else
		$cor = "#FFFFFF";
	
	
	if ( $dados['tipoProcesso'] == 1 )
		$tipoAnexo= "COMUNICAÇÃO INTERNA";
	else
		$tipoAnexo= "COMUNICAÇÃO EXTERNA"; 
?>	
					
					
	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql1 = "SELECT * FROM cadastroProcesso WHERE idProcesso = $idAnexo";
	$resultado1 = mysql_query($sql1,$conexao);
	while($dados1 = mysql_fetch_array($resultado1)){
	$idProcessoPai =  $dados1['idProcesso'];
	$numeroProcessoPai =  $dados1['numeroProcesso'];
	$anoProcessoPai =  $dados1['anoProcesso'];
	$tipoProcessoPai =  $dados1['tipoProcesso'];
	}
	?>
		
	
        <tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
		<td height="5" align ="center"><input type="radio" name="op" value="<?php echo $idProcessoPai ; ?>"></td>
		<td height="5" align ="center"><?php echo $numeroProcessoPai ; ?></td>
		<td height="5" align ="center"><?php echo $tipoProcessoPai ; ?></td>
		<td height="5" align ="center"><?php echo $anoProcessoPai ; ?></td>
		<td height="5" align ="center"><?php echo $numeroAnexo; ?></td>
		<td height="5" align ="center"><?php echo $tipoAnexo; ?></td>
		<td height="5" align ="center"><?php echo $anoAnexo; ?></td>
		
	</tr>

<?php	
$i++;
}	
?>							

</table>		
</div>		
		
	
          <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

            <input type="submit"  value ="    CONSULTAR    ">
	
</form>
<?php
}
?>	

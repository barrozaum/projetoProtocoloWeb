<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php
$dt=$_REQUEST['data'];

//VARIAVEL COM A DATA NO FORMATO AMERICANO
$dataAmericana= $dt;
 
//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
$partesdadata = explode('/',$dataAmericana);
 
//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
$dataAmericana= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
 
//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO

?>

    <?php
    $dt=preg_replace("/[^0-9]\//", "", $_REQUEST['data']);

    if(($dt != '00-00-0000') && ($dt != "")){
    //VARIAVEL COM A DATA NO FORMATO AMERICANO
    $dataAmericana= $dt;
     
    //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
    $partesdadata = explode('/',$dataAmericana);
     
    //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
    //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
    $dataAmericana= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
     
    //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
    }else{
      $dataAmericana  = '0000-00-00';
    }
    ?>


<form name="f1" action="relatorioRemessa1.php" method="POST">
<?php
$i=0;
$setorOrigem=$_REQUEST['setorOrigem'];
$setorEntrada=$_REQUEST['setorEntrada'];


include('recursos/includes/verConexao.inc');
$sql="SELECT * FROM  cargaProcesso c, cadastroProcesso cP, assunto a, requerente r
WHERE c.idSetorEntrada = '$setorEntrada' AND c.idSetorOrigem = $setorOrigem AND c.tramite = 0 AND c.idProcesso = cP.idProcesso AND cP.idAnexo = 0  AND cP.idAssunto = a.idAssunto AND cP.idRequerente = r.idRequerente AND c.dataCarga = '$dataAmericana'" ;
					

$resultado=mysql_query($sql,$conexao) ;

if (mysql_num_rows($resultado) == 0) {
?>  
 <div id="cadastrados">
     <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
 </div>
<?php

}else{
?>
<input type="hidden" value="<?php echo $setorOrigem; ?>" name ="setorOrigem"/>
<input type="hidden" value="<?php echo $setorEntrada; ?>" name ="setorEntrada"/>

<p align="center"><a id="link" href="javascript:selecionar_tudo()">MARCAR TUDO</a> ||
						<a id="link"  href="javascript:deselecionar_tudo()">DESMARCAR TUDO</a> </p>
			
<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
<table width="100%">
<thead class="fixedHeader">
<tr bgcolor="#f5f5dc">
	<th></th>
	<th>NÚMERO PROCESSO</th>
	<th>TIPO</th>
	<th>Ano</th>
	<th>Assunto</th>
	<th>Requerente </th>
	<th>Data</th>	
	
	</tr>

<?php
while($dados=mysql_fetch_array($resultado)){
$i++;
	
		if ($i% 2 == 0)
			$cor = "#CCCCCC";
		else
			$cor = "#FFFFFF";
	
		if($dados['tipoProcesso'] == '1')
			$tipo = "COMUNICAÇÃO INTERNA";
		else
			$tipo = "COMUNICAÇÃO EXTERNA";	
?>
<?php	
	//Formata a data americana em brasileira
	
	//VARIAVEL COM A DATA NO FORMATO AMERICANO
	$data_americano = $dados['dataCarga'];
	
	//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
	$partes_da_data = explode('-',$data_americano);
	
	//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
	//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
	$data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
	
	//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
?>			

		<tr bgcolor="<?php echo $cor; ?>" >

		<td height="5" align ="center"><input type="checkbox" name="numero[]" value="<?php echo $dados['idProcesso'];?>"></td>
		<td height="5" align ="center"><?php echo $dados['numeroProcesso']; ?></td>
		<td height="5" align ="center"><?php echo $tipo; ?></td>
		<td height="5" align ="center"><?php echo $dados['anoProcesso']; ?></td>
		<td height="5" align ="center"><?php echo $dados['nomeAssunto']; ?></td>
		<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
		<td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
		
	</tr>
	<?php
	}
	?>
	</table>		
</div>		

  <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

   	
	<input type="submit"  value ="    ENVIAR    ">	
</form>
<?php
}
?>

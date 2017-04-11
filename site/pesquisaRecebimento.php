<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


    <?php
    $datainicial=preg_replace("/[^0-9]\//", "", $_REQUEST['datainicial']);

    if(($datainicial != '00-00-0000') && ($datainicial != "")){
    //VARIAVEL COM A DATA NO FORMATO AMERICANO
    $dataAmericana= $datainicial;
     
    //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
    $partesdadata = explode('/',$dataAmericana);
     
    //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
    //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
    $dataAmericanaInicial= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
     
    //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
    }else{
      $dataAmericanaInicial  = '0000-00-00';
    }
    ?>


        <?php
        $dataFinal=preg_replace("/[^0-9]\//", "", $_REQUEST['datafinal']);

        if(($dataFinal != '00-00-0000') && ($dataFinal != "")){
        //VARIAVEL COM A DATA NO FORMATO AMERICANO
        $dataAmericana= $dataFinal;
         
        //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
        $partesdadata = explode('/',$dataAmericana);
         
        //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
        //INVERTENDdataAmericanaFinalO AS POSICOES E COLOCANDO AS BARRAS
        $dataAmericanaFinal= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
         
        //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
        }else{
          $dataAmericanaFinal  = '0000-00-00';
        }
        ?>


<?php
include('recursos/includes/verConexao.inc');
$setorOrigem=$_GET['setorOrigem'];
$setorEntrada = $_GET['setorEntrada'];
 
$sql="SELECT * FROM cargaProcesso WHERE idSetorEntrada = '$setorEntrada' AND idSetorOrigem = '$setorOrigem' AND tramite = 0 " ;
$resultado=mysql_query($sql,$conexao);

if(mysql_num_rows($resultado) == 0){
?>
         <div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
         </div>
<?php 
}else{
?>

<p align="center"><a id="link" href="javascript:selecionar_tudo()">MARCAR TUDO</a> ||
						<a id="link"  href="javascript:deselecionar_tudo()">DESMARCAR TUDO</a> </p>
			

<form name="f1" action="cadastroRecebimento1.php" method="post">
  <div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
	<table width="100%">
	<thead class="fixedHeader">
	<tr bgcolor="#f5f5dc">
	<th></th>
	<th>NÚMERO </th>
	<th>TIPO  </th>
	<th>ANO</th>
	<th>ASSUNTO</th>
	<th>REQUERENTE </th>
	<th>DATA</th>
</tr>


	

<?php
while($dados=mysql_fetch_array($resultado)){// linha 85
$idProcesso = $dados['idProcesso'];

?>


	<?php
	
	include('recursos/includes/verConexao.inc');
	$i = 0;
	$sql2 = "SELECT * 
	FROM cadastroProcesso C, assunto a, requerente r
	WHERE C.idProcesso = $idProcesso AND C.idAssunto = a.idAssunto AND C.idRequerente = r.idRequerente AND idAnexo = 0";
	$resultado2 = mysql_query($sql2, $conexao);
	while($dados2=mysql_fetch_array($resultado2)){
	 $i++;
		
		if ($i% 2 == 0)
			$cor = "#CCCCCC";
		else
			$cor = "#FFFFFF";
	
		if($dados2['tipoProcesso'] == '1')
			$tipo = "COMUNICAÇÃO INTERNA";
		else
			$tipo = "COMUNICAÇÃO EXTERNA";	
			
			
	//VARIAVEL COM A DATA NO FORMATO AMERICANO
	$data_americano = $dados['dataCarga'];
	 
	//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
	$partes_da_data = explode('-',$data_americano);
	 
	//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
	//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
	$data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
	 
	//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
		
	?>	
	
	
	<tr bgcolor="<?php echo $cor; ?>">
		<td height="5" align ="center"><input type="checkbox" name="numero[]" value="<?php echo $dados2['idProcesso'];?>"></td>
		<td height="5" align ="center"><?php echo $dados2['numeroProcesso']; ?></td>
		<td height="5" align ="center"><?php echo $tipo; ?></td>
		<td height="5" align ="center"><?php echo $dados2['anoProcesso']; ?></td>
		<td height="5" align ="center"><?php echo $dados2['nomeAssunto']; ?></td>
		<td height="5" align ="center"><?php echo $dados2['requerente']; ?></td>
		<td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
	</tr>
	
	
	<?php	
	}
	?>


<?php	
}// linha 85
?>
</table>
</div>

  <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

   	
	<input type="submit"  value ="    ENVIAR    ">	
</form>							
<?php	
}
?>	

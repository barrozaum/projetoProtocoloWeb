<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<form name="f1" action="consultaDados.php" method="post">
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
$setorEntrada =$_REQUEST['setorEntrada'];


include('recursos/includes/verConexao.inc');

$i=0;
if ($setorEntrada  == ""){
$sql="SELECT * FROM  cargaProcesso c, cadastroProcesso cP, assunto a, requerente r, setor s
WHERE  c.tramite = 1 AND c.idProcesso = cP.idProcesso AND a.idAssunto = cP.idAssunto AND cP.idRequerente = r.idRequerente AND c.idSetorEntrada = s.idSetor AND  c.idSetorOrigem = s.idSetor AND c.dataRecebimento >= '$dataAmericanaInicial ' AND  c.dataRecebimento <= '$dataAmericanaFinal' ORDER BY c.idProcesso " ;

}else{			
$sql="SELECT * FROM  cargaProcesso c, cadastroProcesso cP, assunto a, requerente r
WHERE c.idSetorEntrada = $setorEntrada AND  c.idSetorOrigem = $setorEntrada AND c.tramite = 1 AND c.idProcesso = cP.idProcesso AND a.idAssunto = cP.idAssunto AND cP.idRequerente = r.idRequerente AND c.dataRecebimento >= '$dataAmericanaInicial ' AND  c.dataRecebimento <= '$dataAmericanaFinal'  " ;
}
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
	<th>ASSUNTO</th>
	<th>REQUERENTE</th>
	<th>DATA</th>
	<?php if ($setorEntrada  == ""){?>
	<th>SETOR</th>
	<?php } ?>
	</tr>

<?php
$compara = 0;
while($dados=mysql_fetch_array($resultado)){

		if ($compara != $dados['idProcesso']){
	
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
	$data_americano = $dados['dataRecebimento'];
	
	//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
	$partes_da_data = explode('-',$data_americano);
	
	//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
	//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
	$data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
	
	//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
?>			


	

     <tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
		<td height="5" align ="center"><input type="radio" name="op" value="<?php echo $dados['idProcesso']; ?>"></td>
		<td height="5" align ="center"><?php echo $dados['numeroProcesso']; ?></td>
		<td height="5" align ="center"><?php echo $tipo; ?></td>
		<td height="5" align ="center"><?php echo $dados['anoProcesso']; ?></td>
		<td height="5" align ="center"><?php echo $dados['nomeAssunto']; ?></td>
		<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
		<td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
		<?php if ($setorEntrada  == ""){?>
		<td height="5" align ="center"><?php echo $dados['setor']; ?></td>
		<?php } ?>
	</tr>
	<?php
	$i++;
	}
	
	
	$compara = $dados['idProcesso'];
	
	}
	?>
	</table>		
</div>		

    <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />
<input type="submit" value="    CONSULTAR    ">	

</form>

<?php			
}		
?>	
    
</body>

</html>

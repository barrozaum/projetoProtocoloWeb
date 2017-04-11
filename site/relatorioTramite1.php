<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>



<?php
// setores escolhidos
$setorEntrada = preg_replace("/[^0-9]/", "", $_REQUEST['setorEntradaProcesso']);
$setorOrigem = preg_replace("/[^0-9]/", "", $_REQUEST['setorOrigemProcesso']);
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

$sql="SELECT * 
FROM cadastroProcesso c, cargaProcesso cp
WHERE cp.tramite = 0 AND cp.idSetorEntrada = $setorEntrada AND cp.idSetorOrigem = $setorOrigem AND cp.idProcesso = c.idProcesso AND cp.dataCarga >= '$dataAmericanaInicial' AND cp.dataCarga <= '$dataAmericanaFinal'";
$resultado= mysql_query($sql,$conexao);
if(mysql_num_rows($resultado) == 0){// if linha 44
?>
<script>
window.alert('NENHUM PROCESSO ENCONTRADO !!!');
location.href="relatorioTramite.php";
</script>
<?php
}else{// if linha 44

?>




<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="recursos/css/estiloedicaorelatorio.css"/>
        <link rel="stylesheet" type="text/css" href="recursos/css/print.css" media='print' />
        
        <STYLE TYPE="text/css"> 
        #quebralinha { 
        page-break-after: always; 
        } 
        </STYLE> 
        
        <script type="text/javascript">
            window.print();
        </script>

    <title>Parvaim</title>  
</head>
	
		
					
<body>
	<div id="externo">
	
	
	
		<div id="TITULO">
			<h3>RELATÓRIO TRÂMITE PROCESSO</h3>
			<?php 
			
			include('recursos/includes/verConexao.inc');
			
			$sql1 = "SELECT * FROM setor WHERE idSetor = $setorOrigem";
			$resultado1 = mysql_query($sql1, $conexao);
			while($dados1 = mysql_fetch_array($resultado1)){
         	             $setor = $dados1['setor'];
		                 $descDepartamento = $dados1['descDepartamento'];
			}
			?>
							
            ORIGEM:  DESC. DEPTO :<?php echo $descDepartamento; ?> --- SETOR :<?php echo $setor; ?>
			<?php
			
			include('recursos/includes/verConexao.inc');
			
			$sql1 = "SELECT * FROM setor WHERE idSetor = $setorEntrada";
			$resultado1 = mysql_query($sql1, $conexao);
			while($dados1 = mysql_fetch_array($resultado1)){
                       $setor1 = $dados1['setor'];
		                 $descDepartamento1 = $dados1['descDepartamento'];
			}
			?>
					
			<BR>DESTINO:  DESC. DEPTO :<?php echo $descDepartamento1; ?> --- SETOR :<?php echo $setor1; ?>
	    	<br />
			
			
			 DATA:   <?php echo date('d/m/Y H:i:s');?><br /><br />
			</div>
			
			<div id="LOGO">
			<img src="recursos/imagens/icones/logo.png" alt="LOGO">
			</div>
		
	
		
		<table width="100%" border="1px">
		<thead class="fixedHeader">
		<tr id="celula">
			<th>NÚMERO</th>
			<th>TIPO</th>
			<th>ANO</th>
			<th>ASSUNTO</th>
			<th>REQUERENTE </th>
			<th>DATA</th>	
			<th>PARECER</th>	
		</tr>
	
	<?php
	$i = 0;
	while ($dados = mysql_fetch_array($resultado)){//while linha 54
	$i++;
	
	 $idAssunto = $dados['idAssunto'];
	 $idRequerente= $dados['idRequerente'];
	
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
		
		
		<?php 
		$sql1 = "SELECT * FROM assunto WHERE idAssunto = $idAssunto ";
		$resultado1 = mysql_query($sql1, $conexao);
		while($dados1 = mysql_fetch_array($resultado1)){
			$nomeAssunto = $dados1['nomeAssunto'];
		}
		?>	
		
		<?php 
		$sql2 = "SELECT * FROM requerente WHERE idRequerente = $idRequerente";
		$resultado2 = mysql_query($sql2, $conexao);
		while($dados2 = mysql_fetch_array($resultado2)){
			$requerente = $dados2['requerente'];
		}
		?>	
	
		<tr bgcolor="<?php echo $cor; ?>">
			<td height="5" align ="center"><?php echo $dados['numeroProcesso']; ?></td>
			<td height="5" align ="center"><?php echo $tipo; ?></td>
			<td height="5" align ="center"><?php echo $dados['anoProcesso']; ?></td>
			<td height="5" align ="center"><?php echo $nomeAssunto; ?></td>
			<td height="5" align ="center"><?php echo $requerente; ?></td>
			<td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
			<td height="5" align ="center"><?php echo $dados['parecer']; ?></td>
			
		</tr>
		<?php
		}
		?>
		</table>		
		
	
	 <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br /> <br />
<div id="imprimir">
		<form>
			
			<input type="button"  name="Button" value="    IMPRIMIR    " onclick="window.print()">
			<input type=button onClick="window.location.assign('relatorioTramite.php')" value="    VOLTAR    ">	
		</form>
	</div>		
	
	</div>
</body>
	
</html>
	
<?php
}
?>	


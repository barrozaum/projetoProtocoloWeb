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
$setorEntrada = $_REQUEST['setor'];

include('recursos/includes/verConexao.inc');

$i=0;
$sql="SELECT * FROM  cargaProcesso c, cadastroProcesso cP, assunto a, requerente r
WHERE c.idSetorEntrada = $setorEntrada AND c.idSetorOrigem = $setorEntrada AND c.tramite = 1 AND c.idProcesso= cP.idProcesso AND a.idAssunto = cP.idAssunto AND cP.idRequerente = r.idRequerente AND  c.dataRecebimento >= '$dataAmericanaInicial' AND  c.dataRecebimento <= '$dataAmericanaFinal' ORDER BY c.idProcesso " ;
				

$resultado=mysql_query($sql,$conexao) ;

if (mysql_num_rows($resultado) == 0) {
?>

<script> window.alert('NENHUM PROCESO ENCONTRADO !!!'); location.href="relatorioSetor.php";</script>

<?php

}else{
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
		
		<h3>RELATÓRIO PROCESSO SETOR</h3>
		<?php 
		include('recursos/includes/verConexao.inc');
		
		$sql1 = "SELECT * FROM setor WHERE idSetor = $setorEntrada ";
		$resultado1 = mysql_query($sql1, $conexao);
		while($dados1 = mysql_fetch_array($resultado1)){
			
			$setor = $dados1['setor'];
			$descDepartamento = $dados1['descDepartamento'];
		}
		?>
		 DESC. DEPTO :<?php echo $descDepartamento; ?> ---  SETOR :<?php echo $setor; ?>
		<br />
		 DATA:   <?php echo date('d/m/Y H:i:s');?><br />
		</div>
		
		
		<div id="LOGO">
		<img src="recursos/imagens/icones/logo.png" alt="LOGO">
		</div>
		
		<table width="100%" border="1px">
		<thead class="fixedHeader">
			<tr id="celula">
			<th>NÚMERO </th>
			<th>TIPO  </th>
			<th>ANO</th>
			<th>ASSUNTO</th>
			<th>REQUERENTE </th>
			<th>DATA</th>	
			
			</tr>
		
		<?php
		$ultimaId = 0;
		while($dados=mysql_fetch_array($resultado)){
		
		
		if($dados['idProcesso']  != $ultimaId){
		$ultimaId = $dados['idProcesso'];
		$i++;
			
				if ($i% 2 == 0)
					$cor = "#CCCCCC";
				else
					$cor = "#FFFFFF";
			
				if($dados['tipoProcesso'] == '1')
					$tipo = "COMUNICACAO INTERNA";
				else
					$tipo = "COMUNICACAO EXTERNA";
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
		
			<tr bgcolor="<?php echo $cor; ?>" >
		
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
		 
			<?php
			}
			?>
			</table>		
	
	 	  <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br /> <br />

            ENTREGUE POR:____________________________________________________________<br /><br />

            RECEBIDO POR:____________________________________________________________
        <div id="imprimir">
        <form>
            
            <input type="button"  name="Button" value="    IMPRIMIR    " onclick="window.print()">
            <input type="button" onClick="window.location.assign('relatorioSetor.php')" value="    VOLTAR    "> 
        </form>
        </div> 





   
        
    </div>
     
</body>
    
</html>
	
<?php 
}
?> 	
	

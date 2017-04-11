<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

$numero = $_REQUEST['numero'];
$tipo = $_REQUEST['tipo'];
$ano = $_REQUEST['ano'];
?>

				
<form name='f1' action='cadastroCarga1.php' method='POST' > 
				



<?php

include('recursos/includes/verConexao.inc');

		
$sql="SELECT * FROM  cadastroProcesso c, cargaProcesso cp WHERE  c.numeroProcesso ='$numero' AND c.tipoProcesso='$tipo' AND c.anoProcesso ='$ano' AND c.idProcesso = cp.idProcesso " ;

$resultado=mysql_query($sql,$conexao) ;

if(mysql_num_rows($resultado) == 0){
?>
	
	  <div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
         </div>
<?php 
}else{
	
	while($dados=mysql_fetch_array($resultado)){
	$idProcesso=$dados['idProcesso'];
	$statusProcesso=$dados['tramite'];
	$idAnexo=$dados['idAnexo'];
	
	}
	if ($idAnexo != 0 ){
	?>
	 <div id="cadastrados">O PROCESSO ESTÁ ANEXADO A OUTRO.<br />
		EXCLUIR CARGA NÃO FOI POSSÍVEL
	 </div>
	<?php
	 }else{
	?>
		<?php
		if ($statusProcesso != 0){
		?>
		<div id="cadastrados">O PROCESSO JÁ FOI RECEBIDO EM OUTRO SETOR.<br />
		EXCLUIR CARGA NÃO FOI POSSÍVEL</div>
		<?php
		 }else{
		?>
			<?php 
			$uIdUsu  = 0; // ultimo	Usuario
			$pIdUsu  = 0; // penultimo Usuario
			$aIdUsu  = 0; // antepultimoUsuario
			
			
			$pIdSet  = 0; // penultimo setor
			
			
			$cont = 0;
			
			include('recursos/includes/verConexao.inc');
			$sql1="SELECT * 
			FROM cargaProcesso 
			WHERE idProcesso = $idProcesso ORDER BY idCarga ASC";
			$resultado1 = mysql_query($sql1,$conexao);
			while($dados1=mysql_fetch_array($resultado1)){
		 
				if($cont <  $dados1['idCarga']){
				$pIdUsu  = $uIdUsu;  
				
				$uIdUsu  = $dados1['idUsuarioRecebimento' ];
				
				
				$uIdSet  = $dados1['idSetorOrigem'];
				$cont =  $dados1['idCarga'];
				}
				
			
			}
			
			
			
			
			
			?>
			
			<?php
			if ($uIdSet  != $idSetorUsuario){
			?>
				<div id="cadastrados">O PROCESSO NÃO FOI ENVIADO PELO SEU SETOR.<br />
				EXCLUIR CARGA NÃO FOI POSSÍVEL</div>
			<?php
			 }else{
			?>
			
				<?php
							
				if ($idUsuario != $pIdUsu){
				?>
				
				<div id="cadastrados">O PROCESSO NÃO RECEBEU CARGA DO SEU USUÁRIO.<br />
				EXCLUIR CARGA NÃO FOI POSSÍVEL</div>
				<?php
				 }else{
				?>
				<h3 align="Center">CARGAS </h3>
								
				<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
		        <table width="100%">
		        <thead class="fixedHeader">
		        <tr bgcolor="#f5f5dc">
	        		  <th align="center">SETOR ENTRADA</th>
					  <th align="center">DATA CARGA</th>
					  <th align="center">USUÁRIO RECEBIMENTO</th>
					  <th align="center">DATA RECEBIMENTO</th>
					  <th align="center">PARECER </th>
					  <th align="center">EXCLUIR </th>
				</tr>
				
				<?php 
				$i= 0;
				$cor = "";
                $ultimo = "";
                $penultimo= "";
                $antePenultimo = "";

            	include('recursos/includes/verConexao.inc');
				$sql="SELECT * 
				FROM cargaProcesso 
				WHERE idProcesso = $idProcesso ORDER BY idCarga DESC";
				$resultado = mysql_query($sql,$conexao);
				while($dados=mysql_fetch_array($resultado)){
				 
				if ($dados['idCarga'] > $ultimo)
				$antePenultimo = $penultimo;
				$penultimo = $ultimo;
				$ultimo = $dados['idSetorEntrada'];
				 
				 
				 
				 if($i == 0 )
				 $setorPresenteProcesso = $dados['idSetorPresente'];
				 
				
					
					if ($i% 2 == 0)
						$cor = "#FFFFFF";
					else
						$cor = "#CCCCCC";
				
				
				$usuarioRecebimento = $dados['idUsuarioRecebimento'];
				$setorPresente = $dados['idSetorPresente'];
				$Obs= $dados['parecer'];
				
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
				//Formata a data americana em brasileira
				
				//VARIAVEL COM A DATA NO FORMATO AMERICANO
				$dataAmericano = $dados['dataRecebimento'];
				
				//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
				$partes = explode('-',$dataAmericano);
				
				//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
				//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
				$dataBrasileiro = $partes[2].'/'.$partes[1].'/'.$partes[0];
				
				//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
				?>
				   
				 
				 
				 
				 <?php 
				 $nomeUsuarioRecebimento = "";
				 include('recursos/includes/verConexao.inc');
				 $sql2="SELECT * FROM  usuario WHERE idUsuario = '$usuarioRecebimento'";
				 $resultado2 = mysql_query($sql2,$conexao);
				 
				 while($dados2= mysql_fetch_array($resultado2)){
				 
				 $nomeUsuarioRecebimento = $dados2['login'];
			      	 
				 } 
				 ?>
				 
				  <?php 
				 
				 include('recursos/includes/verConexao.inc');
				 $sql3="SELECT * FROM  setor WHERE idSetor = '$setorPresente'";
				 $resultado3 = mysql_query($sql3,$conexao);
				 
				 while($dados3= mysql_fetch_array($resultado3)){
				 
				 $setorPresenteProcesso= $dados3['departamento'];
			      	 
				 } 
				 ?>
				 
				 
				 
				   
				   <tr bgcolor="<?php echo $cor; ?>">
				     <td height="5" align ="center"><?php echo $setorPresenteProcesso; ?></td>
				     <td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
				     <td height="5" align ="center"><?php echo $nomeUsuarioRecebimento ; ?></td>
				     <td height="5" align ="center"><?php echo $dataBrasileiro ; ?></td>
				     <td height="5" align ="center"><?php echo $Obs;?></td>
				 <?php  if ($i == 0){ ?>
				     <td align="center"><a href="excluirCarga1.php?Cod=<?php echo $dados['idProcesso']; ?>&idC=<?php echo $dados['idCarga']; ?>"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
				 <?php }else{ ?>
				     <td align="center"><img src="recursos/imagens/icones/minus.png" alt="-"></td>
				 <?php }?>
				   </tr>
				
				<?php
				  $i++;
				 }
				?>
					 
				</table>
				
          <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

			
				
				
				
				
			
				
			<?php	
			}// se o processo não foi encontrado	
			?>
			
			
			<?php	
			}// se o processo estiver no seu setor antes da carga
			?>
			
			
		<?php	
		}// se o processo estiver no seu setor antes da carga
		?>
			
		
	<?php	
	}// se o processo estiver Anexado
	?>	


<?php	
}// se o processo não foi encontrado	
?>

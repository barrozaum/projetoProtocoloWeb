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
   
		
<input type="hidden" value="<?php echo $setorOrigem; ?>" name ="setorOrigem"/>
<input type="hidden" value="<?php echo $setorEntrada; ?>" name ="setorEntrada"/>
					
   
    



<body>
    <div id="externo">


			<div id="TITULO">
			<h3>RELATÓRIO REMESSA PROCESSO</h3>
			<?php 
			
			$setorOrigem=$_POST['setorOrigem'];	
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
			
			$setorEntrada=$_POST['setorEntrada'];	
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
		if ($_POST){
		
		$numero= $_POST ['numero'];
		 
		$quant_linhas = count($numero);
		   
		for ($linhas=0; $linhas <$quant_linhas; $linhas++) {
		?>
			
			
			<?php
			include('recursos/includes/verConexao.inc');
			$sql="SELECT * FROM cadastroProcesso c, assunto a, requerente r
			WHERE  c.idProcesso = $numero[$linhas] AND c.idAssunto = a.idAssunto AND c.idRequerente = r.idRequerente" ;
			
			$resultado=mysql_query($sql,$conexao) ;
			?>
			
			<?php

			while($dados=mysql_fetch_array($resultado)){

				
					if ($linhas % 2 == 1)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
					if($dados['tipoProcesso'] == '1')
						$tipo = "COMUNICAÇÃO INTERNA";
					else
						$tipo = "COMUNICAÇÃO EXTERNA";	
			?>
			<?php	
			
			include('recursos/includes/verConexao.inc');
			$sql2 = "SELECT * FROM cargaProcesso WHERE idProcesso = $numero[$linhas] ORDER BY idCarga";
			$resultado2 = mysql_query($sql2,$conexao);
			while($dados2 = mysql_fetch_array($resultado2)){
			 $dt = $dados2['dataCarga'];
			 $parecer = $dados2['parecer'];
			 }
			//Formata a data americana em brasileira
			
			//VARIAVEL COM A DATA NO FORMATO AMERICANO
			$data_americano = $dt;
			
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
				<td height="5" align ="center"><?php echo $parecer; ?></td>
				
			</tr>
			<?php
			}
			?>
			
		
			<?php
			
			/*
			Verifico se o processo escolhido tem anexo, caso tenha anexo faço a consultar e o listo no relatório
			*/
			?>	
			<?php
			$i = 0;
			include('recursos/includes/verConexao.inc');
			$sql1="SELECT * FROM cadastroProcesso c, assunto a, requerente r
			WHERE  c.idAnexo = $numero[$linhas] AND c.idAssunto = a.idAssunto AND c.idRequerente = r.idRequerente ORDER BY c.idProcesso" ;
			$resultado1 = mysql_query($sql1, $conexao);
			while($dados1=mysql_fetch_array($resultado1)){
			$idProcessoAnexo = $dados1['idProcesso'];
			$i++;
				
			if ($i% 2 == 1)
				$cor = "#CCCCCC";
			else
				$cor = "#FFFFFF";
		
			if($dados1['tipoProcesso'] == '1')
				$tipo = "COMUNICAÇÃO INTERNA";
			else
				$tipo = "COMUNICAÇÃO EXTERNA";	
			?>
					
					
					<?php	
				
					include('recursos/includes/verConexao.inc');
					$sql2 = "SELECT * FROM cargaProcesso WHERE idProcesso = $idProcessoAnexo ORDER BY idCarga";
					$resultado2= mysql_query($sql2,$conexao);
					while($dados2 = mysql_fetch_array($resultado2)){
					 $dt = $dados2['dataCarga'];
					 $parecer = $dados2['parecer'];
					 }
					//Formata a data americana em brasileira
					
					//VARIAVEL COM A DATA NO FORMATO AMERICANO
					$data_americano = $dt;
					
					//AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
					$partes_da_data = explode('-',$data_americano);
					
					//AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
					//INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
					$data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
					
					//UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
					
					?>			
			
					
					
					
					
						
		
			<tr bgcolor="<?php echo $cor; ?>" >


				<td height="5" align ="center"><?php echo $dados1['numeroProcesso']; ?></td>
				<td height="5" align ="center"><?php echo $tipo; ?></td>
				<td height="5" align ="center"><?php echo $dados1['anoProcesso']; ?></td>
				<td height="5" align ="center"><?php echo $dados1['nomeAssunto']; ?></td>
				<td height="5" align ="center"><?php echo $dados1['requerente']; ?></td>
				<td height="5" align ="center"><?php echo $data_brasileiro; ?></td>
				<td height="5" align ="center"><?php echo $parecer; ?></td>
				
			</tr>
			<?php
			}
			$linhas++;
			?>
				
			<?php
			 /*
			Fim da verificação do Anexo
			*/
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
			<input type=button onClick="window.location.assign('relatorioRemessa.php')" value="    VOLTAR    ">	
		</form>
		</div>		
		
		<?php				
		}		
		?>	
		
	</div>
</body>
	
</html>
				
		
		
	

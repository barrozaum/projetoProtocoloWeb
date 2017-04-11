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
		
	<title>Parvaim</title>	
</head>
				
<body>

	


	
<?php 
$setor = $_REQUEST['setor'];
include('recursos/includes/verConexao.inc');
$sql = "SELECT * FROM setor WHERE descDepartamento like '%$setor%' ORDER BY idSetor";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php 
 		if(mysql_num_rows($resultado)==0){
 		?>
 			<div id="cadastrados">
             <strong>NENHUM SETOR ENCONTRADO !!!</strong>
       		</div>
 		<?php	
		}else{
		?>	
		 	<div id="tabelasLista" >
				<table width="100%">
				<thead class="fixedHeader">
				<tr bgcolor="#f5f5dc">
						<th></th>
     	                <th>DESC.DEPARTAMENTO</th>
						<th>SETOR</th>
					</tr>
				
			
					<?php
                    $i = 0;
					while($dados=mysql_fetch_array($resultado)){
					
						
						if ($i% 2 == 0)
							$cor = "#CCCCCC";
						else
							$cor = "#FFFFFF";
					
					?>	
					
			
					<tr bgcolor="<?php echo $cor; ?>">
						<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idSetor']; ?>, '<?php echo $dados['setor']; ?>');"> </td>
						<td height="5" align ="center"><?php echo $dados['descDepartamento']; ?></td>
						<td height="5" align ="center"><?php echo $dados['setor']; ?></td>
					</tr>
			
					<?php	
					 $i++;
					}
					?>	
					
					 </thead>
				</table>		
			</div>		
		<?php	
		}
		?>
	<?php	
	}else{
	?>	
	<script languagem = "JavaScript"> 
	window.alert('Erro no SQl');
	window.close();
	</script>
	<?php	
	}
	?>	
</body>
	
</html>

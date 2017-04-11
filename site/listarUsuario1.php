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


$Usuario = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['Usuario']);
$c = preg_replace("/[^0-9]/", "", $_REQUEST['c']);

include('recursos/includes/verConexao.inc');
$sql = "SELECT * FROM  setor s, usuario u WHERE u.login like '%$Usuario%' AND s.idSetor = u.idSetor  ORDER BY u.idUsuario";

if($resultado = mysql_query($sql,$conexao)){
?>
	<?php 
	if(mysql_num_rows($resultado)==0){
	?>
	<p>Nenhum Usuario Encontrado !!!</p>
	<?php	
	}else{
	?>	
		<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
		<table width="100%">
		<thead class="fixedHeader">
		<tr bgcolor="#f5f5dc">
		<th>N &ordm;</th>
			<th>Nome</th>	
			<th>Sobrenome</th>		
			<th>Login</th>	
			<th>Setor</th>	
			<th>+</th>
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
						<td height="5" align ="center"><?php echo $dados['idUsuario']; ?></td>
						<td height="5" align ="center"><?php echo $dados['nome']; ?></td>
						<td height="5" align ="center"><?php echo $dados['sobrenome']; ?></td>
						<td height="5" align ="center"><?php echo $dados['login']; ?></td>
						<td height="5" align ="center"><?php echo $dados['descDepartamento']; ?></td>
						
						<?php if($c == 1){?>
						
						<th><a href="excluirUsuario.php?Usuario=<?php echo $dados['idUsuario']; ?>" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/excluir.png" alt="Excluir"></a></th>
					
						<?php }else{?>	
					<th><a href="alterarUsuario.php?Usuario=<?php echo $dados['idUsuario']; ?>" ><img src="recursos/imagens/icones/lupa.png" alt="Excluir"></a></th>
						
						
						<?php }?>
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

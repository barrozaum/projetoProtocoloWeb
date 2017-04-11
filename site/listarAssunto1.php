<?php 
$assunto = $_REQUEST['assunto'];
$i = 0;
include('recursos/includes/verConexao.inc');
$sql = "SELECT * FROM assunto WHERE nomeAssunto like '%$assunto%' ORDER BY idAssunto";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php 
	if(mysql_num_rows($resultado)==0){
	?>
		<div id="cadastrados">
             <strong>NENHUM ASSUNTO ENCONTRADO !!!</strong>
        </div>
 		<?php	
		}else{
		?>	
		 	<div id="tabelasLista" >
				<table width="100%">
				<thead class="fixedHeader">
				<tr bgcolor="#f5f5dc">
					<th></th>
					<th>CÓDIGO</th>
					<th>ASSUNTO</th>		
				</tr>
				
		
				<?php	
				while($dados=mysql_fetch_array($resultado)){
				
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
				?>	
				
		
				<tr bgcolor="<?php echo $cor; ?>">
					<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idAssunto']; ?>, '<?php echo $dados['nomeAssunto']; ?>');"> </td>
					<td height="5" align ="center"><?php echo $dados['idAssunto']; ?></td>
					<td height="5" align ="center"><?php echo $dados['nomeAssunto']; ?></td>
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

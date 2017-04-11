<?php 
$origem = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['origem']);
$i = 0;

include('recursos/includes/verConexao.inc');
$sql = "SELECT * FROM origem WHERE nomeOrigem like '%$origem%' ORDER BY idOrigem";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php 
	if(mysql_num_rows($resultado)==0){
	?>
		<div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
        </div>
 		<?php	
		}else{
		?>	
		<!-- <div id="tabelasLista" >-->
		<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
        <table width="100%">
        <thead class="fixedHeader">
		<tr bgcolor="#f5f5dc">
				<th></th>
				<th>CÓDIGO</th>
				<th>ORIGEM</th>	
			</tr>

				<?php	
				while($dados=mysql_fetch_array($resultado)){
				
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
				?>	
				
		
        <tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
					<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idOrigem']; ?>, '<?php echo $dados['nomeOrigem']; ?>');"> </td>
					<td height="5" align ="center"><?php echo $dados['idOrigem']; ?></td>
					<td height="5" align ="center"><?php echo $dados['nomeOrigem']; ?></td>
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
		

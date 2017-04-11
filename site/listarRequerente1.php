<?php 
$requerente = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['requerente']);

include('recursos/includes/verConexao.inc');
$i = 0;
$sql = "SELECT * FROM requerente WHERE requerente like '%$requerente%' ORDER BY idRequerente";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php 
	if(mysql_num_rows($resultado)==0){
	?><div id="cadastrados">
             <strong>NENHUM REQUERENTE ENCONTRADO !!!</strong>
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
					<th>REQUERENTE</th>	
					<th>TELEFONE</th>
					<th>+</th>
				</tr>
				
			
					<?php	
					while($dados=mysql_fetch_array($resultado)){
					
						
						if ($i% 2 == 0)
							$cor = "#CCCCCC";
						else
							$cor = "#FFFFFF";
					
					?>	
			
       				<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
						<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idRequerente']; ?>, '<?php echo $dados['requerente']; ?>', '<?php echo $dados['logradouro']; ?>',  '<?php echo $dados['numeroEnd']; ?>',  '<?php echo $dados['complemento']; ?>', '<?php echo $dados['bairro']; ?>',  '<?php echo $dados['cidade']; ?>',  '<?php echo $dados['uf']; ?>',  '<?php echo $dados['cep']; ?>', '<?php echo $dados['tel']; ?>',  '<?php echo $dados['cel']; ?>')";> </td>
						<td height="5" align ="center"><?php echo $dados['idRequerente']; ?></td>
						<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
						<td height="5" align ="center"><?php echo $dados['tel']; ?></td>
						<td height="5" align ="center"><a href="listarRequerente2.php?requerente=<?php  echo $dados['idRequerente']; ?>" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png" alt="Consultar"></a></td>
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

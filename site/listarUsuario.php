<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];
$c = $_REQUEST['c'];
?>

								
			<h3>LISTAR USUÁRIOS</h3>
			<br /><br />
			
			<form>
			
			
			<label>LOGIN:
			
			<input type"text" value="" name="Usuario" id="Usuario" size="50" maxlength = "40" / >
			<br /><br />	
			
			<input type="button" value="    Pesquisar    " onclick="showUser(this.value)">
			<input type="reset"  value="    Corrigir    "/>
			
			<?php if($c == 2){?>
			<input type="button" value="    Voltar    " onclick="location.href='manUsuario.php'">
			<?php }else{?>
			<input type="button" value="    Voltar    " onclick="window.close();">
			<?php }?>	
			</form>
			
					
			<hr />
			<br />
			<br />		
				
			
			
				
			<div id="pesquisa">
				<?php 
				$i=0;
				include('recursos/includes/verConexao.inc');
				$sql = "SELECT * FROM setor s,  usuario u WHERE u.idSetor = s.idSetor ORDER BY u.idUsuario";
				if($resultado = mysql_query($sql,$conexao)){
				?>
			 		
			 		<?php 
			 		if(mysql_num_rows($resultado)==0){
			 		?>
			 		<p>Nenhum Usuario Encontrada !!!</p>
			 		<?php	
					}else{
					?>	
						<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
						<table width="100%">
						<thead class="fixedHeader">
						<tr bgcolor="#f5f5dc">
							<th>N &ordm;</th>
							<th>NOME</th>	
							<th>SOBRENOME</th>		
							<th>LOGIN</th>	
							<th>SETOR</th>	
							<th>ALTERAR</th>	
							<th>EXCLUIR</th>
						</tr>
							
						
								<?php	
								while($dados=mysql_fetch_array($resultado)){
								
									
									if ($i% 2 == 0)
										$cor = "#CCCCCC";
									else
										$cor = "#FFFFFF";
								
								?>	
								
						
						<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
								<td height="5" align ="center"><?php echo $dados['idUsuario']; ?></td>
									<td height="5" align ="center"><?php echo $dados['nome']; ?></td>
									<td height="5" align ="center"><?php echo $dados['sobrenome']; ?></td>
									<td height="5" align ="center"><?php echo $dados['login']; ?></td>
									<td height="5" align ="center"><?php echo $dados['descDepartamento']; ?></td>
									
								<td height="5" align ="center"><a href="alterarUsuario.php?Usuario=<?php echo $dados['idUsuario']; ?>" ><img src="recursos/imagens/icones/lupa.png" alt="Excluir"></a></th>
								<td height="5" align ="center"><a href="excluirUsuario.php?Usuario=<?php echo $dados['idUsuario']; ?>" ><img src="recursos/imagens/icones/excluir.png" alt="Excluir"></a></th>
									
								
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
		
<?php }?>


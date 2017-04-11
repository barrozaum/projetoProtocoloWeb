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
		<link rel="stylesheet" type="text/css" href="recursos/css/estilologin.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicaologin.css"/>
	<title>Parvaim</title>	
</head>
	
				
<body>	

<?php 	
$cod = preg_replace("/[^0-9]/", "", $_REQUEST['Usuario']);
include('recursos/includes/verConexao.inc');

$sql= "SELECT * FROM cadastroProcesso WHERE idUsuario = $cod";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php
	if(mysql_num_rows($resultado) >= 1){
	?>
	<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ ESTÁ CADASTRADO EM PROCESSO!!!');</script>
	<script>location.href="manUsuario.php";</script>
	<?php 
	}else{
	?>
	
		
		
		<?php 
		include('recursos/includes/verConexao.inc');
		
		$sql1 = "SELECT * FROM cargaProcesso WHERE idUsuarioRecebimento = $cod";
		if($resultado1 = mysql_query($sql1,$conexao)){
		?>
			<?php
			if(mysql_num_rows($resultado1) >= 1){
			?>
			<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ ESTÁ CADASTRADO EM CARGAS DE PROCESSOS!!!');</script>
			<script>location.href="manUsuario.php";</script>
			<?php 
			}else{
			?>
				
				<?php 
				include('recursos/includes/verConexao.inc');
				
				$sql2 = "SELECT * FROM assunto WHERE idUsuario = $cod";
				if($resultado2 = mysql_query($sql2,$conexao)){
				?>
					<?php
					if(mysql_num_rows($resultado2) >= 1){
					?>
					<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ CADASTROU ASSUNTO NO SISTEMA !!!');</script>
					<script>location.href="manUsuario.php";</script>
					<?php 
					}else{
					?>
					
						<?php 
						include('recursos/includes/verConexao.inc');
						
						$sql3 = "SELECT * FROM documento WHERE idUsuario = $cod";
						if($resultado3 = mysql_query($sql3,$conexao)){
						?>
							<?php
							if(mysql_num_rows($resultado3) >= 1){
							?>
					<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ CADASTROU DOCUMENTO NO SISTEMA !!!');</script>
							<script>location.href="manUsuario.php";</script>
							<?php 
							}else{
							?>
						
						
						
								
								<?php 
								include('recursos/includes/verConexao.inc');
								
								$sql4 = "SELECT * FROM origem WHERE idUsuario = $cod";
								if($resultado4 = mysql_query($sql4,$conexao)){
								?>
									<?php
									if(mysql_num_rows($resultado4) >= 1){
									?>
									<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ CADASTROU ORIGEM NO SISTEMA !!!');</script>
									<script>location.href="manUsuario.php";</script>
									<?php 
									}else{
									?>
								
								
								
								
										<?php 
										include('recursos/includes/verConexao.inc');
										
										$sql5 = "SELECT * FROM requerente WHERE idUsuario = $cod";
										if($resultado5 = mysql_query($sql5,$conexao)){
										?>
											<?php
											if(mysql_num_rows($resultado5) >= 1){
											?>
											<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ CADASTROU REQUERENTE NO SISTEMA !!!');</script>
											<script>location.href="manUsuario.php";</script>
											<?php 
											}else{
											?>
											
																	
												<?php 
												include('recursos/includes/verConexao.inc');
												
												$sql6 = "SELECT * FROM setor WHERE idUsuario = $cod";
												if($resultado6= mysql_query($sql6,$conexao)){
												?>
													<?php
													if(mysql_num_rows($resultado6) >= 1){
													?>
													<script>window.alert('USUÁRIO NÃO PODE SER EXCLUÍDO, POIS JÁ CADASTROU SETOR NO SISTEMA !!!');</script>
													<script>location.href="manUsuario.php";</script>
													<?php 
													}else{
													?>
												
														
														<?php 
														
														include('recursos/includes/verConexao.inc');
														
														$sql7 = "DELETE FROM usuario WHERE idUsuario = $cod";
														if(mysql_query($sql7, $conexao)){ 
														?>
														<script>window.alert('EXCLUÍDO COM SUCESSO!!');</script>
														<script>location.href="manUsuario.php";</script>
														<?php 
														}else{
														?>
														<script>window.alert('ERRO AO EXCLUIR !!');</script>
														<script>location.href="manUsuario.php";</script>
														<?php 
														}
														?>
													
												
												
												
												
													<?php 
													}
													?>
												
												
												
												<?php 
												}else{
												?>
												<script>window.alert('ERRO NO SQL 6');</script>
												<script>location.href="manUsuario.php";</script>
												
												<?php 
												}
												?>
											
														
										
											<?php 
											}
											?>
										
										
										
										<?php 
										}else{
										?>
										<script>window.alert('ERRO NO SQL 5');</script>
										<script>location.href="manUsuario.php";</script>
										
										<?php 
										}
										?>
										
										
								
								
								
								
								
									<?php 
									}
									?>
								
								
								
								<?php 
								}else{
								?>
								<script>window.alert('ERRO NO SQL 4');</script>
								<script>location.href="manUsuario.php";</script>
								
								<?php 
								}
								?>
						
						
						
						
						
						
						
						
						
						
							<?php 
							}
							?>
						
						
						
						<?php 
						}else{
						?>
						<script>window.alert('ERRO NO SQL 3');</script>
						<script>location.href="manUsuario.php";</script>
						
						<?php 
						}
						?>
					
					
					
					
			
					<?php 
					}
					?>
			
			
			
			<?php 
			}else{
			?>
			<script>window.alert('ERRO NO SQL 2');</script>
			<script>location.href="manUsuario.php";</script>
			
			<?php 
			}
			?>
			
			
			
			
		<?php 
		}
		?>	
		<?php 
		}else{
		?>
		<script>window.alert('ERRO NO SQL 1');</script>
		<script>location.href="manUsuario.php";</script>
		
		<?php 
		}
		?>

	
	
	<?php 
	}
	?>
<?php 
}else{
?>
<script>window.alert('ERRO NO SQL');</script>
<script>location.href="manUsuario.php";</script>

<?php 
}
?>

				
</body>	
</html>

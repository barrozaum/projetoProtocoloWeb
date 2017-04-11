<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION[idUsuario];	
$idSetorUsuario =$_SESSION[idSetorUsuario];	

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloform.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		
		
		<script type="text/javascript" src="recursos/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery1.js"></script>
	<title>Parvaim</title>	
</head>
	
		
		
		
					
<body class="laterais">
		<div id="externo">
			<div id="cabecalho">
			
						<a href="inicial.php"><h1 id="titulo"><span>Parvaim</span></h1></a> 
			
			</div>
			
			<div id="menu">
					<div id="submenu">
				
				
						<?php
						// Inclui o menu do site			
						include('vermenu.inc');	
						?>
					
					</div>
								
					
			</div>
		
			
			<div id="centro1">
			
			</div>
			
			<div id="centro">
			
				<div id="conteudo">
				
							 
				<?php
					$q=$_POST["numero"];
					$tipo=$_POST['tipo'];	
					$ano=$_POST['ano'];		
					$i = 0;		
			
					//include('verconec.inc');
							
					$sql="select * from carga_processo where mostra='$q' and tipo_processo='$tipo' and ano_processo='$ano'" ;
					
					$resultado=mysql_query($sql,$conexao) ;
					
					while($dados=mysql_fetch_array($resultado)){
					
					
					$situacao_processo= $dados['situacao_processo'];
					
					}
					echo'<strong  id="importante">'.$situacao_processo.'</strong>';
					
				?>
								
				<?php
						
					$q=$_POST["numero"];
					$tipo=$_POST['tipo'];	
					$ano=$_POST['ano'];
					//include('verconec.inc');
							
					$sql="select * from cadastro_processo where numero ='$q' and tipo_processo='$tipo' and ano='$ano'" ;
					
					$resultado=mysql_query($sql,$conexao) ;
					
					
			
					while($dados=mysql_fetch_array($resultado)){
					
					echo"<form name='f1' action='cad_carga.php' method='POST' > ";	
					



						echo'<strong>Tipo Processo:</strong>:'.$dados['tipo_processo'];
						echo"<br />";
						
						echo'<strong>Número:</strong>'.$dados['numero'];
						echo"<br />";
						
						echo'<strong>Ano:</strong>'.$dados['ano'];
						echo"<br />";
						
						echo'<strong>Assunto:</strong>'.$dados['assunto'];
						echo"<br />";
						
						echo'<strong>Requerente:</strong>'.$dados['requerente'];
						echo"<br />";
						
						
							
						echo'<input type="hidden" name="tipo" value="'.$dados['tipo_processo'].'"';echo"<br />";

						echo'<input type="hidden" name="numero" value="'.$dados['numero'].'"';echo"<br />";

						echo'<input type="hidden" name="ano_processo" value="'.$dados['ano'].'"';echo"<br />";

						echo'<input type="hidden" name="assunto" value="'.$dados['assunto'].'"';echo"<br />";

						echo'<input type="hidden" name="nome" value="'.$dados['requerente'].'"';echo"<br />";
						
						echo'<input type="hidden" name="id" value="'.$dados['id'].'"';

						echo"<br />";
						
						$anexado=$dados['anexado'];
						if ($anexado == 1)
						echo'<strong id="importante">Processo não pode ser dado carga pois está anexado a um outro</strong>';
						
						echo"<br />";
					
						
						
						if($dados['status'] != 1)
						echo'<strong  id="importante">Status do Processo:Processo Finalizado</strong>';
						
						
						echo'<input type="hidden" name="status" value="'.$dados['situacao'].'"';
						
						echo"<br />";
		
						$i++;
						$origem = $dados['setor_entrada'];	
						$situacao= $dados['situacao'];
						
							}
					
					
						
					?>
					<br />
					
					<?php
					
					$us=$_SESSION['setor']; 
					$recebe="Recebido no setor :".$us;
					 
					?>	
						
					<?php
					if (($i != 0) && ($situacao!= '2') && ($situacao_processo == $recebe) && ($anexado == 0) )
				
						if($us == $origem) {
						
							echo"<br />";						
							echo'<strong>Obs: </strong><textarea name="obs"></textarea>';	
							echo"<br />";	
												
							//include('verconec.inc');
								
							$sql="select * from setor_empresa " ;
								
							$resultado=mysql_query($sql,$conexao) ;
								
							echo"<strong>Setor:</strong>";
							echo '<select name = "setor_entrada">';
							echo"<option value=''>Secretária/Coordenadoria/Setor</option>";
						
							while($dados=mysql_fetch_array($resultado)){
								$setoresEmpresa= $dados["setor"];
								if ($setoresEmpresa != $origem  )
								echo'<option value="'.$dados["setor"].'">'.$dados["secretaria"].'/'.$dados["coordenadoria"].'/'.$dados["setor"].'</option>';
						
									echo"<br/>";
									}
						echo"</select>";
						
					?>
				
					
					<br />
					
					
					
					<?php
					
					
				
				
				
					echo'<input type="submit" value="Enviar"/>';
					echo'<input type="reset" value="Corrigir"/>';
					}
					?>
					
					<input type="button" value="voltar" onclick="window.location.assign('consultaAnexo.php?')">
					
					
					</form>
									
					
							 
							
					
				</div>
			</div>
			<div id="rodape">
			
				<div id="usuario">
				
				<?php
				// Incluiinformações do usuario		
				include('inforUsuario.inc');	
				?>	
				
				</div>
				
			</div>
		</div>
	</body>
	
</html>
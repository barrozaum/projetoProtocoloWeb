<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		


		<?php 
		include('recursos/includes/verScript.inc');
		include('recursos/includes/cadastroSetor/funcaoVerificar.inc');
		include('recursos/includes/cadastroSetor/funcaoExcluir.inc');
		include('recursos/includes/cadastroSetor/funcaoAlterar.inc');	
		include('recursos/includes/cadastroSetor/funcaoIncluir.inc');
		include('recursos/includes/cadastroSetor/funcaoVerificaAlteracao.inc');		
		?>		

	<title>Parvaim</title>
</head>


<body class="laterais">
		<div id="externo">
			<div id="cabecalho">
				<a href="inicial.php"><h1 id="titulo"><span>Parvaim</span></h1></a> 
			</div>

			<div id="menu">
				<?php
				// Inclui o menu do site
				include('recursos/includes/verMenu.inc');
				?>
			</div>


			<div id="centro1">

			</div>

			<div id="centro">
		
				
			
				<div id ="superior">
				
				<?php include('incluirSetor.php'); ?>
				
				</div>



				<div id="tituloNivel2">
					<h2 >TABELA DE SETORES CADASTRADOS</h2>
					<br /><br />
				</div>
				

				<div id="cadastrados">
			
					<?php
					$i =0;
					include('recursos/includes/verConexao.inc');
					 
					$sql="SELECT * FROM setor ORDER BY setor";
					$resultado=mysql_query($sql,$conexao);
					
					if(mysql_num_rows($resultado) == 0){
					?>
					
					<strong> NENHUM SETOR CADASTRADO !!! </strong>
					
					<?php 
					}else{
					?>
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					<table width="100%">
					<thead class="fixedHeader">
					<tr bgcolor="#f5f5dc">
						<th>CÓDIGO</th>
						<th>DESC. DEPARTAMENTO</th>
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
					
					
					<tr bgcolor="<?php echo $cor; ?>">
					
						<td height="5" align ="center"><?php echo $dados['idSetor']; ?></td>
						<td height="5" align ="center"><?php echo $dados['departamento']; ?></td>
						<td height="5" align ="center"><?php echo $dados['descDepartamento']; ?></td>
					
						<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idSetor']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></th>
						<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idSetor']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></th>
						

						<!--<<th><a href="alterarSetor.php?cod=<?php echo $dados['idSetor']; ?>" onclick="window.open(this.href,'galeria','width=680,height=400'); return false;"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></th> -->
						<!--<th><a href="excluirSetor.php?cod=<?php echo $dados['idSetor']; ?>" onclick="window.open(this.href,'galeria','width=680,height=170'); return false;"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></th> -->
						
					</tr>
				
					<?php	
					$i++;
					}
					?>
					</table>
					</div>	
					<br />
					<p>
					Resultados encontrados <strong><?php echo $i; ?></strong>
					</p>
					<?php
					}
					?>
				</div>
				
			
			</div>
			<div id="rodape">
				<div id="usuario">

				<?php
				// Inclui informações do usuario
				include('recursos/includes/inforUsuario.inc');
				?>

				</div>
			</div>
		</div>
	</body>

</html>

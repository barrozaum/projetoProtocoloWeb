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
		include('recursos/includes/cadastroOrigem/funcaoVerificar.inc');
		include('recursos/includes/cadastroOrigem/funcaoExcluir.inc');
		include('recursos/includes/cadastroOrigem/funcaoAlterar.inc');	
		include('recursos/includes/cadastroOrigem/funcaoIncluir.inc');	
		include('recursos/includes/cadastroOrigem/funcaoVerificaAlteracao.inc');	
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

				<?php INCLUDE('incluirOrigem.php') ?>

				</div>
			


				<div id="tituloNivel2">
					<h2 >TABELA DE ORIGENS CADASTRADAS</h2>
					<br /><br />

				</div>


				<div id="cadastrados">
				
					
					<?php

					include('recursos/includes/verConexao.inc');
					 
					$sql="SELECT * FROM origem";
					$resultado=mysql_query($sql,$conexao);
					$i = 0;
					if(mysql_num_rows($resultado) == 0){
					?>
					
					<strong> NENHUMA ORIGEM CADASTRADA !!! </strong>
					
					
					<?php 
					}else{
					?>
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					<table width="100%">
					<thead class="fixedHeader">
					<tr bgcolor="#f5f5dc">
						<th>CÓDIGO</th>
						<th>ORIGEM</th>
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
						<td height="5" align ="center"><?php echo $dados['idOrigem']; ?></td>
						<td height="5" align ="center"><?php echo $dados['nomeOrigem']; ?></td>
						<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idOrigem']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></td>
						<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idOrigem']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
					</tr>
				
					<?php	
					$i++;
					}
					?>
					
					</table>
					</div>	
					<br />
					<p>
					RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong>
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

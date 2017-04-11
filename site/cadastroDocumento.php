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
		include('recursos/includes/cadastroDocumento/funcaoVerificar.inc');
		include('recursos/includes/cadastroDocumento/funcaoExcluir.inc');
		include('recursos/includes/cadastroDocumento/funcaoAlterar.inc');	
		include('recursos/includes/cadastroDocumento/funcaoIncluir.inc');	
		include('recursos/includes/cadastroDocumento/funcaoVerificaAlteracao.inc');	
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
				<?php 
				include('incluirDocumento.php');
				?>
				</div>
				
				
				<div id="tituloNivel2">
				<h2 >TABELA DE DOCUMENTOS CADASTRADOS</h2>
				<br /><br />
				</div>


				<div id="cadastrados">
				
					
					<?php

					include('recursos/includes/verConexao.inc');
					 
					$sql="SELECT * FROM documento ORDER BY nomeDocumento";
					$resultado=mysql_query($sql,$conexao);
					
					if(mysql_num_rows($resultado) == 0){
					?>
					
					<strong> NENHUM DOCUMENTO CADASTRADO !!! </strong>
					
					
					<?php 
					}else{
					?>
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					<table width="100%">
					<thead class="fixedHeader">
					<tr bgcolor="#f5f5dc">
						<th>CÓDIGO</th>
						<th>DOCUMENTO</th>
						<th>ALTERAR</th>
						<th>EXCLUIR</th>
					</tr>
				
									
					<?php
					$i = 0;
					while($dados=mysql_fetch_array($resultado)){
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
					?>	
					
					
					<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
						<td height="5" align ="center"><?php echo $dados['idDocumento']; ?></td>
						<td height="5" align ="center"><?php echo $dados['nomeDocumento']; ?></td>
						<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idDocumento']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></td>
						<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idDocumento']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
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

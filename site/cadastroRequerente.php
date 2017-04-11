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
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		
		<?php 
		include('recursos/includes/verScript.inc');
		include('recursos/includes/cadastroRequerente/funcaoVerificar.inc');
		include('recursos/includes/cadastroRequerente/funcaoExcluir.inc');
		include('recursos/includes/cadastroRequerente/funcaoAlterar.inc');	
		include('recursos/includes/cadastroRequerente/funcaoIncluir.inc');	
		include('recursos/includes/cadastroRequerente/funcaoVerificaAlteracao.inc');	
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
					include('incluirRequerente.php');
					?>
				</div>
				
					
				
				<div id="tituloNivel2">
					<h2 >TABELA DE REQUERENTES CADASTRADOS</h2>
					<br />
					<br />

				</div>


				<div id="cadastrados">
					<?php

					include('recursos/includes/verConexao.inc');
					 
					$sql="SELECT * FROM requerente ORDER BY requerente";
					$resultado=mysql_query($sql,$conexao);
					
					if(mysql_num_rows($resultado) == 0){
					?>
					<br /><br />
	
					<strong> NENHUM REQUERENTE CADASTRADO !!! </strong>
					
					<?php 
					}else{
					?>
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					<table width="100%">
					<thead class="fixedHeader">
					<tr bgcolor="#f5f5dc">
						<th>CÓDIGO</th>
						<th>REQUERENTE</th>
						<th>LOGRADOURO</th>
						<th>TEL(FIXO)</th>
						<th>ALTERAR</th>
						<th>EXCLUIR</th>
					</tr>
					
									
					<?php
					$i=0;
					while($dados=mysql_fetch_array($resultado)){
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
					?>	
					
					
					<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
						<td height="5" align ="center"><?php echo $dados['idRequerente']; ?></td>
						<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
						<td height="5" align ="center"><?php echo $dados['logradouro']; ?></td>
						<td height="5" align ="center"><?php echo $dados['tel']; ?></td>
						<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idRequerente']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></td>
						<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idRequerente']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
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

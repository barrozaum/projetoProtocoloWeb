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
	// Inclui o menu do site			
	include('recursos/includes/verScript.inc');	
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
			
			<div id="conteudo">
				

			<?php 
			include('recursos/includes/verConexao.inc');
			$op = preg_replace("/[^0-9]/", "", $_REQUEST['op']);
	
			$sql = "SELECT * FROM usuario u, permissao p, setor s WHERE u.idUsuario = $op AND p.idUsuario = u.idUsuario AND u.idSetor = s.idSetor ";
			$resultado = mysql_query($sql, $conexao);
			while($dados = mysql_fetch_array($resultado)){
          	$idUsuarioP = $dados['idUsuario'];
			$nome=  $dados['nome'];
			$sobrenome=  $dados['sobrenome'];
			$Usuario =  $dados['login'];

        	$setor =  $dados['setor'];
			$descDepartamento =  $dados['descDepartamento'];

			$processoNovo=$dados['processoNovo'];
			$processoCarga=$dados['processoCarga'];
			$processoRecebimento=$dados['processoRecebimento'];
			$processoAnexo=$dados['processoAnexo'];

			$cadastroAssunto=$dados['cadastroAssunto'];
			$cadastroDocumento=$dados['cadastroDocumento'];
			$cadastroOrigem=$dados['cadastroOrigem'];
			$cadastroSetor=$dados['cadastroSetor'];
			$cadastroRequerente=$dados['cadastroRequerente'];


			$consultaAnexo=$dados['consultaAnexo'];
			$consultaAssunto=$dados['consultaAssunto'];
			$consultaCarga=$dados['consultaCarga'];
			$consultaProcesso=$dados['consultaProcesso'];
			$consultaDocumento=$dados['consultaDocumento'];
			$consultaNumero=$dados['consultaNumero'];
			$consultaRequerente=$dados['consultaRequerente'];
			$consultaSecretaria=$dados['consultaSecretaria'];
			$consultaOrigem=$dados['consultaOrigem'];

			$relatorioSetor=$dados['relatorioSetor'];
			$relatorioTramite=$dados['relatorioTramite'];
			$relatorioRemessa=$dados['relatorioRemessa'];
			$relatorioCarga=$dados['relatorioCarga'];

			$manutencaoUsuario=$dados['manutencaoUsuario'];
			$manutencaoSenha=$dados['manutencaoSenha'];
			$manutencaoPermissao=$dados['manutencaoPermissao'];
			$manutencaoEtiquetas=$dados['manutencaoEtiquetas'];

			$outrasOp=$dados['outrasOp'];
			}
			?>
			
			<h3>PERMISSÃO USUÁRIO</h3>
			<br />
			<br / >
			<strong>LOGIN : </strong><?php echo  $Usuario; ?><br / >
			<strong> DESC. DEPARTAMENTO   : </strong><?php echo  $descDepartamento; ?> --- <strong> SETOR :</strong><?php echo  $setor; ?><br / ><br / >

			
			<div id="permissao">
			<p align="center"><a id="link" href="javascript:selecionar_tudo()">MARCAR TUDO</a> ||
			<a id="link"  href="javascript:deselecionar_tudo()">DESMARCAR TUDO</a> </p>
		
			<form name='f1' method = 'POST' action='trocaPermissao.php'>
		
			<div id='perEsq'>	
			<input type="hidden" name="txtUsuario" value="<?php echo $op; ?>">
				
				<fieldset>
				<legend>PROCESSO</legend>	
				
					<input type="checkbox" name="processoNovo" value="1"  <?php  if($processoNovo== 1) echo "checked = 'true'"; ?>> NOVO <br />
					
					<input type="checkbox" name="processoCarga" value="1"  <?php  if($processoCarga== 1) echo "checked = 'true'"; ?>> CARGA <br />
							
					<input type="checkbox" name="processoRecebimento" value="1"  <?php  if($processoRecebimento== 1) echo "checked = 'true'"; ?>> RECEBIMENTO <br />
					
					<input type="checkbox" name="processoAnexo" value="1"  <?php  if($processoAnexo== 1) echo "checked = 'true'"; ?>> ANEXAR<br />
				
				</fieldset>
				
				
				
				
				
				
				<fieldset>
				<legend>CADASTRO</legend>	
					<input type="checkbox" name="cadastroAssunto" value="1" <?php  if($cadastroAssunto== 1) echo "checked = 'true'"; ?>> ASSUNTO <br />
							
					<input type="checkbox" name="cadastroDocumento" value="1" <?php  if($cadastroDocumento== 1) echo "checked = 'true'"; ?>> DOCUMENTO <br />
									
					<input type="checkbox" name="cadastroOrigem" value="1" <?php  if($cadastroOrigem== 1) echo "checked = 'true'"; ?>> ORIGEM <br />
					
					<input type="checkbox" name="cadastroSetor" value="1" <?php  if($cadastroSetor== 1) echo "checked = 'true'"; ?>> SETOR <br />
				
					<input type="checkbox" name="cadastroRequerente" value="1" <?php  if($cadastroRequerente== 1) echo "checked = 'true'"; ?>> REQUERENTE <br />
				</fieldset>
				
				
				
					
				
					
						
				
				<fieldset>
				<legend>CONSULTA</legend>
						
					<input type="checkbox" name="consultaAnexo" value="1" <?php  if($consultaAnexo== 1) echo "checked = 'true'"; ?>> ANEXO <br />
												
					<input type="checkbox" name="consultaAssunto" value="1" <?php  if($consultaAssunto== 1) echo "checked = 'true'"; ?>> ASSUNTO <br />
					
					<input type="checkbox" name="consultaCarga" value="1" <?php  if($consultaCarga== 1) echo "checked = 'true'"; ?>> DATA CARGA <br />
					
					<input type="checkbox" name="consultaProcesso" value="1"<?php  if($consultaProcesso== 1) echo "checked = 'true'"; ?> > DATA PROCESSO <br />
					
					<input type="checkbox" name="consultaDocumento" value="1" <?php  if($consultaDocumento== 1) echo "checked = 'true'"; ?>> DOCUMENTO <br />
					
					<input type="checkbox" name="consultaNumero" value="1" <?php  if($consultaNumero== 1) echo "checked = 'true'"; ?>> NÚMERO <br />
					
					<input type="checkbox" name="consultaRequerente" value="1" <?php  if($consultaRequerente== 1) echo "checked = 'true'"; ?>> REQERENTE <br />
					
					<input type="checkbox" name="consultaSecretaria" value="1" <?php  if($consultaSecretaria== 1) echo "checked = 'true'"; ?>> SETOR  <br />
					
					<input type="checkbox" name="consultaOrigem" value="1" <?php  if($consultaOrigem== 1) echo "checked = 'true'"; ?>> ORIGEM <br />
					
				</fieldset>
				
				
				</div>	
				
					
							
				<div id='perDir'>
				<BR />
				<fieldset id='fieldset'>

				<legend>RELATÓRIO</legend>
					<input type="checkbox" name="relatorioSetor" value="1"  <?php  if($relatorioSetor== 1) echo "checked = 'true'"; ?>> SETOR <br />
					
					<input type="checkbox" name="relatorioRemessa" value="1"  <?php  if($relatorioTramite== 1) echo "checked = 'true'"; ?>> REMESSA <br />
					
					<input type="checkbox" name="relatorioTramite" value="1"  <?php  if($relatorioRemessa== 1) echo "checked = 'true'"; ?>> TRÂMITE	 <br />
				
					<input type="checkbox" name="relatorioCarga" value="1" <?php  if($relatorioCarga== 1) echo "checked = 'true'"; ?>> CARGA <br />
				</fieldset>
				
			
				
				
				<fieldset>
				<legend>MANUTENÇÃO</legend>
					<input type="checkbox" name="manutencaoUsuario" value="1" <?php  if($manutencaoUsuario== 1) echo "checked = 'true'"; ?>> USUÁRIO <br />
					
					<input type="checkbox" name="manutencaoSenha" value="1" <?php  if($manutencaoSenha== 1) echo "checked = 'true'"; ?>> SENHA <br />
					
					<input type="checkbox" name="manutencaoPermissao" value="1" <?php  if($manutencaoPermissao== 1) echo "checked = 'true'"; ?>> PERMISSÃO<br />
				
					<input type="checkbox" name="manutencaoEtiquetas" value="1" <?php  if($manutencaoEtiquetas== 1) echo "checked = 'true'"; ?>> ETIQUETAS <br />
				
				</fieldset>
				
				
			
				
				
				
				
				
				<fieldset>
				<legend>OUTRAS PERMISSÕES ?</legend>
					<input type="radio" name="super" value="1"  <?php  if($outrasOp== 1) echo "checked = 'true'"; ?>>SIM <br />
					<input type="radio" name="super" value="0" <?php  if($outrasOp == 0) echo "checked = 'true'"; ?>>NÃO <br />
				</fieldset><br /><br />
				<input type="submit" value="    ENVIAR    "  />
				<input type="reset"  value="    CORRIGIR    " />
				<input type="button" value="    VOLTAR    " onclick="history.back(-1); "/>
				
				
				</div>
			
			
			</div>
			
			
			
				
			</form>
		
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

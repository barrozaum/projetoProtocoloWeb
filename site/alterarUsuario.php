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
	// Inclui o menu do site			
	include('recursos/includes/verScript.inc');	
	?>
	
			
	<?php
	// inclui os scripts
	include('recursos/includes/verSetor.inc');
	?>
	
	<script languagem = "javascript">
		function voltar(){
		location.href="manUsuario.php";
		}
	</script>
	

			<script language="JavaScript">
			function verificar () {
				var n = document.f1.nome.value.toUpperCase();
				var s = document.f1.sobrenome.value.toUpperCase();
				var e = document.f1.email.value.toUpperCase();
				var setor = document.f1.setorEntrada.value.toUpperCase();
				var l = document.f1.novoLogin.value.toUpperCase();
				
				if(n == ""){			
				window.alert("VERIFIQUE O CAMPO NOME !!!");
				document.f1.nome.focus();
				
				}else if(s == ""){
				window.alert("VERIFIQUE O CAMPO SOBRENOME !!!");
				document.f1.sobrenome.focus();
				
				}else if(e == ""){
				window.alert("VERIFIQUE O CAMPO EMAIL !!!");
				document.f1.email.focus();
				
				}else if(setor == ""){
				window.alert("VERIFIQUE O CAMPO SETOR !!!");
				document.f1.setorEntrada.focus();
			
				}else if(l == ""){
				window.alert("VERIFIQUE O CAMPO LOGIN !!!");
				document.f1.novoLogin.focus();
			
				}else{
				 document.f1.nome.value= n;
				 document.f1.sobrenome.value= s;
				 document.f1.email.value= e;
				 document.f1.setorEntrada.value= setor;
				 document.f1.novoLogin.value= l;
				 
				document.f1.submit();
				}
			}
		
		</script>

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
			
			$opU = preg_replace("/[^0-9]/", "", $_REQUEST['Usuario']);
			$sql = "SELECT * FROM usuario u, permissao p, setor s WHERE u.idUsuario = $opU AND p.idUsuario = u.idUsuario AND u.idSetor = s.idSetor ";
			$resultado = mysql_query($sql, $conexao);
			while($dados = mysql_fetch_array($resultado)){
   			$idUsuarioP = $dados['idUsuario'];
			$nome=  $dados['nome'];
			$sobrenome=  $dados['sobrenome'];
			$Usuario =  $dados['login'];
			$email=  $dados['email'];
			$codSetor = $dados['idSetor'];
		

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
			
			<h3>ALTERAR USUÁRIO </h3>
			
						
			<div id="esquerdaForm">
			<BR />
			<form name="f1" action="alterarUsuario1.php" method="post">
			<input type="hidden" name="txtUsuario" value="<?php echo $opU ; ?>">
			
			<label>NOME : 
	              		<input type="text" name="nome" value="<?php echo $nome; ?>" maxlength="30" size="30px" onKeypress="return carcater();"/>*
	                </label><br /><br />
			
			
			
			<label>SOBRENOME :
	              		<input type="text" name="sobrenome" value="<?php echo $sobrenome; ?>" maxlength="30" size="30px" onKeypress="return carcater();"/>*
	                </label><br /><br />
			
			
			
			<label>EMAIL :
	              		<input type="text" name="email" size="40"  value="<?php echo $email; ?>" maxlength="40" onBlur="ValidaEmail(); ">*
	                </label><br /><br />
			
			
			
			<label>
			CÓDIGO
			<input type="text" id="setorEntrada" name="setorEntrada"  value="<?php echo $codSetor; ?>" size="1" onchange="s(this.value)" onKeypress="return numeros();">
			SETOR
			<i id="mostraSetor">
			<input type="text" name="nomeSetor" id="nomeSetor" value="<?php echo $descDepartamento  ; ?> ---- <?php echo $setor ; ?>"  size="60px" maxlength = "50" readOnly="true"/>
			</i>
			<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
			</label>
			<br />
			<br />
			
			<label>LOGIN :
				<input type="text" name="novoLogin" id="novoLogin" value="<?php echo $Usuario; ?>" maxlength="30" size="30px" onKeypress="return carcater(); "  onchange="l(this.value)"/>*
				
				<i id="mostraNovoLogin"><input type='hidden' name='confLogin' value='0' />
				</i>
			</label><br /><br />
			</div>		 	
			
			
			
			
			
			
			
			
		
			<div id="permissao">
			<p align="center"><a id="link" href="javascript:selecionar_tudo()">MARCAR TUDO</a> ||
			<a id="link"  href="javascript:deselecionar_tudo()">DESMARCAR TUDO</a> </p>
		
			<form name='f1' method = 'POST' action='trocaPermissao.php'>
				
				<div id='perEsq'>	
				
				<fieldset>
				<legend>PROCESSO</legend>	
			
				<input type="checkbox" name="processoNovo" value="1"  <?php  if($processoNovo== 1) echo "checked = 'true'"; ?> > NOVO <br />
				
				<input type="checkbox" name="processoCarga" value="1"  <?php  if($processoCarga== 1) echo "checked = 'true'"; ?>> CARGA <br />
						
				<input type="checkbox" name="processoRecebimento" value="1"  <?php  if($processoRecebimento== 1) echo "checked = 'true'"; ?>> RECEBIMENTO <br />
				
				<input type="checkbox" name="processoAnexo" value="1"  <?php  if($processoAnexo== 1) echo "checked = 'true'"; ?>> ANEXAR <br />
				
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
					
					<input type="checkbox" name="consultaRequerente" value="1" <?php  if($consultaRequerente== 1) echo "checked = 'true'"; ?>> REQUERENTE <br />
					
					<input type="checkbox" name="consultaSecretaria" value="1" <?php  if($consultaSecretaria== 1) echo "checked = 'true'"; ?>> SETOR <br />
					
					<input type="checkbox" name="consultaOrigem" value="1" <?php  if($consultaOrigem== 1) echo "checked = 'true'"; ?>> ORIGEM<br />
					
				</fieldset>
				
				
				</div>	
				
					
							
				<div id='perDir'>
				<BR />
				<fieldset id='fieldset'>
				<legend>RELATÓRIO</legend>
					<input type="checkbox" name="relatorioSetor" value="1"  <?php  if($relatorioSetor== 1) echo "checked = 'true'"; ?>> SETOR <br />
					
					<input type="checkbox" name="relatorioRemessa" value="1"  <?php  if($relatorioRemessa== 1) echo "checked = 'true'"; ?>> REMESSA <br />
					
					<input type="checkbox" name="relatorioTramite" value="1"  <?php  if($relatorioTramite== 1) echo "checked = 'true'"; ?>> TRÂMITE	 <br />
				
					<input type="checkbox" name="relatorioCarga" value="1" <?php  if($relatorioCarga== 1) echo "checked = 'true'"; ?>> CARGA <br />
				</fieldset>
				
			
				
				
				<fieldset>
				<legend>MANUTENÇÃO</legend>
					<input type="checkbox" name="manutencaoUsuario" value="1" <?php  if($manutencaoUsuario== 1) echo "checked = 'true'"; ?>> USUÁRIO <br />
					
					<input type="checkbox" name="manutencaoSenha" value="1" <?php  if($manutencaoSenha== 1) echo "checked = 'true'"; ?>> SENHA <br />
					
					<input type="checkbox" name="manutencaoPermissao" value="1" <?php  if($manutencaoPermissao== 1) echo "checked = 'true'"; ?>> PERMISSAO<br />
				
					<input type="checkbox" name="manutencaoEtiquetas" value="1" <?php  if($manutencaoEtiquetas== 1) echo "checked = 'true'"; ?>> ETIQUETAS <br />
				
				</fieldset>
				
				
			
				
				
				
				
				
				<fieldset>
				<legend>OUTRAS PERMISSÕES ?</legend>
					<input type="radio" name="super" value="1"  <?php  if($outrasOp== 1) echo "checked = 'true'"; ?>> SIM <br />
					<input type="radio" name="super" value="0" <?php  if($outrasOp == 0) echo "checked = 'true'"; ?>> NÃO <br />
				</fieldset><br /><br />
				<input type="button" value="    ENVIAR    "  onclick="verificar();"/>
				<input type="reset"  value="    CORRIGIR    " />
				<input type="button" value="    VOLTAR    " onclick="voltar();"/>
				
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

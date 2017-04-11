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
		


		<script language="JavaScript">
			function verificar () {
				var n = document.f1.nome.value.toUpperCase();
				var s = document.f1.sobrenome.value.toUpperCase();
				var e = document.f1.email.value.toUpperCase();
				var setor = document.f1.setorEntrada.value.toUpperCase();
				var l = document.f1.novoLogin.value.toUpperCase();
				var senha= document.f1.senha.value.toUpperCase();
				var confSenha = document.f1.confSenha.value.toUpperCase();
				var confLogin = document.f1.confLogin.value.toUpperCase();
				var confEmail = document.f1.confEmail.value.toUpperCase();
				
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
			
				}else if(senha == ""){
				window.alert("VERIFIQUE O CAMPO SENHA !!!");
				document.f1.senha.focus();
			
				}else if(confSenha == ""){
				window.alert("VERIFIQUE O CAMPO CONFIRME SENHA !!!");
				document.f1.confSenha.focus();
				
				}else if(confSenha != senha){
				window.alert("SENHAS NÃO CONFEREM !!!");
				document.f1.senha.value="";
				document.f1.confSenha.value="";
				document.f1.senha.focus();
			
				}else if(confLogin == 0){
				window.alert("LOGIN JÁ CADASTRADO !!!");
				document.f1.novoLogin.focus();

				}else if(confEmail == 0){
				window.alert("E-MAIL JÁ CADASTRADO !!!");
				document.f1.email.focus();
				
				}else{ 

				 document.f1.nome.value= n;
				 document.f1.sobrenome.value= s;
				 document.f1.email.value= e;
				 document.f1.setorEntrada.value= setor;
				 document.f1.novoLogin.value= l;
				 document.f1.senha.value= senha;
				 document.f1.confSenha.value= confSenha;
				 document.f1.confLogin.value= confLogin;
				 document.f1.confEmail.value= confEmail;
			     
			     document.f1.submit();
				}
			}
		
		</script>
		
		<script language="JavaScript">
			function excluir() {
				window.open(href='listarUsuario.php?c=1','galeria','width=680,height=470'); 
				return false;
			}
		</script>
		
		<script language="JavaScript">
			function alterar() {
				window.open(href='listarUsuario.php?c=2','','left=1,top=1,scroll=yes'); return false;
				}
		</script>
		
		
		
		
		
	<?php
	
	// inclui os scripts
	include('recursos/includes/verSetor.inc');
	include('recursos/includes/verLogin.inc');
	include('recursos/includes/verEmail.inc');
	
	include('recursos/includes/manUsuario/funcaoAlterar.inc');
	
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
				<h3>CADASTRO DE USUÁRIO</h3>
				<br />
				
							
				<div id="esquerdaForm">
				<form name="f1" action="manUsuario1.php" method="post">
				
				<label>NOME : 
		              		<LABEL><input type="text" name="nome" value="" maxlength="30" size="30px" onKeypress="return carcater();"/>*
		        </label><br /><br />
				
				
				
				<label>SOBRENOME : 
		              		<LABEL><input type="text" name="sobrenome" value="" maxlength="30" size="30px" onKeypress="return carcater();"/>*
		                </label><br /><br />
				
				
				
				<label>E-MAIL : 
		              		<LABEL><input type="text" id="email" name="email" size="40"  value="" maxlength="40" onBlur="ValidaEmail(); " onchange="e(this.value)">*
		              		<i id="mostraNovoEmail"><LABEL><input type='hidden' name='confEmail' value='0' /></i>
		        </label><br /><br />
				
				
				
				<label>
				CÓDIGO:
				<LABEL><input type="text" id="setorEntrada" name="setorEntrada"  value="" size="1" onchange="s(this.value)" onKeypress="return numeros();">
				SETOR:
				<i id="mostraSetor">
				<LABEL><input type="text" name="nomeSetor" id="nomeSetor" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/>
				</i>
				<a href="listarSetor.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
				</label>
				<br />
				<br />
				
				<label>LOGIN :
					<LABEL><input type="text" name="novoLogin" id="novoLogin" value="" maxlength="30" size="30px" onKeypress="return carcater(); "  onchange="l(this.value)"/>*
					
					<i id="mostraNovoLogin"><LABEL><input type='hidden' name='confLogin' value='0' /></i>
				</label><br /><br />
				
				<label>SENHA:
					<LABEL><input type="password" name="senha" value="" maxlength="30" size="30px" />*
				</label><br /><br />
				
				<label>CONFIRME SENHA:
					<LABEL><input type="password" name="confSenha" value="" maxlength="30" size="30px"/>*
				</label><br /><br />
				</div>		 		
						
				<div id="direitaBotao">
					<LABEL><input type="button" value="    LISTAR   " onclick="alterar();"><br /><br />
				</div>
		
				
					
				
				<div id="permissao">
					<p align="center"><a id="link" href="javascript:selecionar_tudo()">MARCAR TUDO</a> ||
						<a id="link"  href="javascript:deselecionar_tudo()">DESMARCAR TUDO</a> </p>
			
					<div id='perEsq'>	
					
					<fieldset>
					<legend>PROCESSO</legend>
						
						<LABEL><input type="checkbox" name="processoNovo" value="1"> NOVO </LABEL><br />
						
						<LABEL><input type="checkbox" name="processoCarga" value="1"> CARGA </LABEL><br />
								
						<LABEL><input type="checkbox" name="processoRecebimento" value="1"> RECEBIMENTO </LABEL><br />
						
						<LABEL><input type="checkbox" name="processoAnexo" value="1"> ANEXAR </LABEL><br />
					</fieldset>
					
					<BR />
					<fieldset>
					<legend>CADASTRO</legend>
						<LABEL><input type="checkbox" name="cadastroAssunto" value="1"> ASSUNTO </LABEL><br />
								
						<LABEL><input type="checkbox" name="cadastroDocumento" value="1"> DOCUMENTO </LABEL><br />
										
						<LABEL><input type="checkbox" name="cadastroOrigem" value="1"> ORIGEM </LABEL><br />
						
						<LABEL><input type="checkbox" name="cadastroSetor" value="1"> SETOR </LABEL><br />
						
						<LABEL><input type="checkbox" name="cadastroRequerente" value="1"> REQUERENTE </LABEL><br />
					</fieldset>
					
					
					<BR />
					
					<fieldset>
					<legend>CONSULTA</legend>
							
						<LABEL><input type="checkbox" name="consultaAnexo" value="1"> ANEXO </LABEL><br />
													
						<LABEL><input type="checkbox" name="consultaAssunto" value="1"> ASSUNTO </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaCarga" value="1"> DATA CARGA </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaProcesso" value="1"> DATA PROCESSO </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaDocumento" value="1"> DOCUMENTO </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaNumero" value="1"> NÚMERO </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaRequerente" value="1"> REQUERENTE </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaSecretaria" value="1"> SETOR  </LABEL><br />
						
						<LABEL><input type="checkbox" name="consultaOrigem" value="1"> ORIGEM </LABEL><br />
						
					</fieldset>
					
					
					</div>	
					
						
								
					<div id='perDir'>
					<BR />
					<fieldset id='fieldset'>
					<legend>RELATÓRIO</legend>
						<LABEL><input type="checkbox" name="relatorioSetor" value="1"> SETOR </LABEL><br />
						
						<LABEL><input type="checkbox" name="relatorioRemessa" value="1"> REMESSA </LABEL><br />
						
						<LABEL><input type="checkbox" name="relatorioTramite" value="1"> TRÂMITE </LABEL><br />
						
						<LABEL><input type="checkbox" name="relatorioCarga" value="1"> CARGA </LABEL><br />
					</fieldset>
					
				<BR />
					
					
					<fieldset>
					<legend>MANUTENÇÃO</legend>
					<LABEL><input type="checkbox" name="manutencaoUsuario" value="1"> USUÁRIO </LABEL>	<br />
						
						<LABEL><input type="checkbox" name="manutencaoSenha" value="1"> SENHA </LABEL><br />
						
						<LABEL><input type="checkbox" name="manutencaoPermissao" value="1"> PERMISSÃO</LABEL><br />
						
						<LABEL><input type="checkbox" name="manutencaoEtiquetas" value="1"> ETIQUETA </LABEL><br />
						
					</fieldset>
					
						<BR />
					<fieldset>
					<legend>OUTRAS PERMISSÕES ?</legend>
						<LABEL><input type="radio" name="super" value="1" >SIM </LABEL><br />
						<LABEL><input type="radio" name="super" value="0" checked="CHECKED">NÃO </LABEL><br />
					</fieldset>
					<BR />
					
					
					<LABEL><input type="button" value="    ENVIAR    " onclick="javascript: verificar();" /></LABEL>
					<LABEL><input type="reset"  value="    CORRIGIR    " /></LABEL><br />
					</div>
				
				
				</div>
				
				
				
				</form>
			
				</div>
			</div>
		<div id="rodape">
			<div id="usuario">
				<?php
				// Incluiinformações do usuario		
				include('recursos/includes/inforUsuario.inc');	
				?>	
			</div>
		</div>
	</div>
	</body>
		
	</html>

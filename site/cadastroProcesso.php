<?php
session_start();

include ('recursos/includes/verSessao.inc');

$outrasOp = $_SESSION['outrasOp'];
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


	<?php
	// inclui os scripts
	include('recursos/includes/verScript.inc');
	include('recursos/includes/Assunto.inc');
	include('recursos/includes/Origem.inc');	
	include('recursos/includes/Requerente.inc');	
	include('recursos/includes/pegarValorProcesso.inc');
	?>




	<script language="JavaScript">
	function trocaValor() {
	      var t = document.f1.tipoProcesso.value;
	      if( t == 01)
	          document.f1.troca.value="<?php echo $interna; ?>";
	      else
	           document.f1.troca.value="<?php echo $externa; ?>";
	}
	</script>
	

	<script language = "javascript">
	
	function valida(){
	
	var o = document.f1.verificaOrigem.value;
	var a = document.f1.verificaAssunto.value;
	var r = document.f1.verificaRequerente.value;
	
	if(o == ""){
	window.alert('VERIFIQUE O CAMPO ORIGEM !!!');
	document.f1.codOrigem.focus();
	}else	if(a == ""){
	window.alert('VERIFIQUE O CAMPO ASSUNTO !!!');	
	document.f1.codAssunto.focus();
	}else	if(r == ""){
	window.alert('VERIFIQUE O CAMPO REQUERENTE !!!');	
	document.f1.codRequerente.focus();
	}else
	document.f1.submit();
	
	}
	</script>
	


	<script language = "javascript">
		function excluir () {
		
		window.open(href='excluirProcesso.php','galeria','width=680,height=470'); 
		return false;
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
				
				
				<h3>PROCESSO CADASTRO NOVO</h3>		 	
						 	
				</div>	
			

				


		 	    <!-- Início: Caixa -->
				    	
				<div id="caixa">
					    	
				<!-- Início: Seleção de abas -->
				
				<p id="abas">
					<a href="#aba1" class="selected">CADASTRO PROCESSO</a>
					<a href="#aba2">REQUERENTE</a>
					<a href="#aba3">DOCUMENTO</a>
					<a href="#aba4">OBSERVAÇÃO</a>
					
	
				</p>
				
				<!-- Fim: Seleção de abas -->
				
				<!-- Início: Conteúdo das abas -->
				
				<ul id="formularios">
				
				<!-- Início: Conteúdo da Aba 1 -->
				<form method="post" name="f1" action="cadastroProcesso1.php">
				
				
					<li id="aba1">
				
				
						
					<legend>PROCESSO</legend>
					<br />
					<br />
					
			
					
					
					<label>TIPO PROCESSO:
							
						<select name = "tipoProcesso" onchange=" trocaValor()" >
							<option value='01'>COMUNICAÇÃO INTERNA</option>
							<option value='02'>COMUNICAÇÃO EXTERNA</option>							
						</select>
						
					</label>							
					<br />
					<br />	
						

					<label>NÚMERO PROCESSO:
						<input type="text" value="<?php echo $interna;?>" name="troca" onKeypress="return numeros();"/>
						<input type="hidden" value="<?php echo date('Y'); ?>" name="anoProcesso" onKeypress="return numeros();"/>
					</label>
					<br />
					<br />


				<?php
				if($outrasOp == 1){
				?>
					<label>ANO PROCESSO:
						<input type="text" value="<?php echo date('Y'); ?>" name="anoProcesso" onKeypress="return numeros();"/>
					</label>
					<br />
					<br />
				<?php 
				}
				?>
					

					
						
						
						<div id="origem">	
						<label>	
						ORIGEM: 
						<input type="text" id="origemProcesso" name="codOrigem" value="" size="1"  onchange="User(this.value)" onKeypress="return numeros();"/ >
                             <i id="mostraOrigem"><input type='text' value='' id="mostraOrigem2" name="mostraOrigem2" size='70px' maxlength = '50' /> <input type="hidden" name="verificaOrigem" value=""></i>						
						</label>
						
								
						
						<a href="listarOrigem.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png" alt="Consultar"></a>
						<a href="cadastrarOrigem.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/plus.png"  alt="Cadastrar"></a>
						</div>	
						
						
						
						
						
						
								
						<br />
						<div id="Assunto">	
						<label>	
						ASSUNTO:
						<input type="text" id="assunto" name="codAssunto" size="1" value="" onchange="showUser(this.value)" onKeypress="return numeros();"/>
						
						<i id="mostraAssunto"><input type='text' name="nomeAssunto" value=''  size='70px' maxlength = '50' /> <input type="hidden" name="verificaAssunto" value=""></i>
						</label>
						<a href="listarAssunto.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>	
						<a href="cadastrarAssunto.php" onclick="window.open(this.href,'galeria','width=880,height=590'); return false;"><img src="recursos/imagens/icones/plus.png"  alt="Cadastrar"></a>
						
						</div>	
						
						<br />
						
							SETOR DE ORIGEM NA EMPRESA:<?php ECHO $_SESSION['nomeSetorUsuario'];  ?><br /><label>
					</li>
							
				
				
				
				
					<li id="aba2">
						
							
							<legend>REQUERENTE</legend>
							<br />
							<br />
							
							
						
							<label>CÓDIGO:
								<input type="text" name="codRequerente" id="requerente" size="2" onchange="rq(this.value)" onKeypress="return numeros();"/>
								
						
							</label>
							
							<a href="listarRequerente.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png"  alt="Consultar"></a>
							<a href="cadastrarRequerente.php" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/plus.png"  alt="Cadastrar"></a>
							<br />
							<br />
							
							<div id="TrocaRequerente">
						

								<label>REQUERENTE:
									<input type="text" name="nomeRequerente" maxlength="50" value="" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(requerente);"/> *
									<input type="hidden" name="verificaRequerente" value="">
								</label>
								<br />
								<br />
								
								<label>LOGRADOURO:
									<input type="text" name="logradouro"  size="50px"  maxlength="50"  value=""onKeypress="return carcater();" onKeyUp="maiusculo(logradouro);"/>
								</label>
								
								<label>NÚMERO:
									<input type="numero" name="numero_end"  maxlength="4" size="4px" value="" onKeypress="return numeros();" onKeyUp="maiusculo(numero_end);"/>
								</label>
								<br />
								<br />
								
								<label>COMPLEMENTO:
									<input type="text" name="complemento"  value="" onKeyUp="maiusculo(complemento);" />
								</label>
								
								
								<label>BAIRRO:
									<input type="text" size="30px" name="bairro" value="" onKeypress="return carcater();" value="" onKeyUp="maiusculo(bairro);" />
								</label>
								<br />
								<br />
								
								<label>CIDADE:
									<input type="text" name="cidade"  value="" onKeypress="return carcater();" onKeyUp="maiusculo(cidade);"/>
								</label>
								
								<label>UF:
									<input type="text" name="uf" maxlength="2" size="2px"  value=""  onKeypress="return carcater();" onKeyUp="maiusculo(uf);" />
								</label>

								<label>CEP	:
									<input type="text" name="cep"  class="cep" value=""  onfocus ="mascaraCep(confCep);" />
									<input type="hidden" name="confCep"  maxlength="2" size="2px"  value="0"   />
								</label>
								<br />
								<br />
								
								<label>TEL (FIXO)	:
									<input type="text" name="tel"  class="tel" value=""  onfocus ="mascaraTelefoneFixo(confFixo);" />
									<input type="hidden" name="confFixo"  maxlength="2" size="2px"  value="0"   />
								</label>
								


								<label>TEL (CEL)	:
									<input type="text" name="cel"  class="cel" value=""  onfocus ="mascaraTelefoneCelular(confCel);" />
									<input type="hidden" name="confCel"  maxlength="2" size="2px"  value="0"   />
								</label>
								<br />
								<br />
	
							</div>
							
					</li>
					
					
					<li id="aba3">
							
						
							
						
						
					<legend>DOCUMENTO</legend>
					<br />
					<br />
							
					<table style="max-height: 400px; margin-top:20px;  overflow: auto; ">
    				<tr>
	 					 <th class="bd_titulo">DOCUMENTO</th><th class="bd_titulo">NÚMERO</th><th class="bd_titulo">ANO </th>
	 				</tr>
		 				
		  				<tr class="linhas">
			   				<td>
								<select name = "documento[]">
								<option value=''>ESCOLHA O DOCUMENTO</option>
											
								<?php
								//Tipos dos documentos
								
								//include('verconec.inc');
								
								$sql="select * from documento order by idDocumento" ;
								
								$resultado=mysql_query($sql,$conexao) ;
								
								while($dados=mysql_fetch_array($resultado)){
								
								echo'<option value="'.$dados['idDocumento'].'">'.$dados['nomeDocumento'].'</option>';
								
								}
								?>
								</select>
						
							</td>
							
							<td>
								<input type="text" name="numeroDocumento[]" value="" maxlength="9" size="12px" onKeypress="return numeros();"/>
							
							</td>
						
						  
							<td>
								<input type="text" name="anoDocumento[]" value="" maxlength="4" size="4px" onKeypress="return numeros();"/>
							</td>
				   			 
							<td>
							    	<a href="#" class="deletar" title="Remover linha"><img src="recursos/imagens/icones/minus.png" alt="remover" border="0" /></a>
							</td>
					  	</tr>
						
						<tr>
						  	<td colspan="4">
						      		<a href="#" class="adiciona" title="Adicionar item"><img src="recursos/imagens/icones/plus.png"  alt="Adicionar" border="0" /></a>
							</td>
						</tr>
						 
					</table>

						
							
					</li>
					
					
					
					
					<li id="aba4">
						
							
						<legend>OBSERVAÇÃO</legend>
						<br />
						<br />
						<textarea name="obs" value=""  rows="15" cols="60"  maxlength="240"></textarea><br />
						<br />
						
						</li>
			
						
					<table>
						<td align="right" colspan="4">
							<input type="button"  value ="    ENVIAR    "  onclick='valida()'/>
      					</td>	
					</table>
					</form>
				</li>
				
				</ul>
				
					<!-- Fim: Conteúdo das abas -->
			
			
		
				<!-- Fim: Caixa -->
							
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

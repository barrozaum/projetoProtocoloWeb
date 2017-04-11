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
		// Inclui o script do site			
		
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
				<h2>INFORMAÇÃO DO PROCESSO</h2> 
				<br />
				<br />
				
				<form name='f1' action='cadApensarAnexo.php' method='POST'>
				<?php 
				
				$idProcesso=$_POST['idProcesso'];
				echo"<input type='hidden' name='idProcesso' value='".$idProcesso."'>";
									
				
				$tipo=$_POST['tipo'];
				
					
				if($tipo == '1')
				$tipo ="COMUNICAÇÃO INTERNA";
				else
				$tipo = "COMUNICAÇÃO EXTERNA";	

				
				echo"<input type='hidden' name='tipo' value='".$_POST['tipo']."'>";
				echo "<strong>TIPO PROCESSO:</strong>".$tipo."<br />";
				echo"<br />";
				
				$numero=$_POST['numero'];
				$numero=strtoupper($numero);
				echo"<input type='hidden' name='numero' value='".$numero."'>";
				echo "<strong>NÚMERO:</strong>".$numero;
			
				
				$ano=$_POST['ano'];
				$ano=strtoupper($ano);
				echo"<input type='hidden' name='ano' value='".$ano."'>";
				echo"<strong>ANO:</strong>".$ano."<br />";
				echo"<br />";
				
				$requerente=$_POST['requerente'];
				$requerente=strtoupper($requerente);
				echo"<input type='hidden' name='requerente' value='".$requerente."'>";
				echo "<strong>REQUERENTE: </strong>".$requerente."<br />";
				echo"<br />";
				
				$assunto=$_POST['assunto'];
				$assunto=strtoupper($assunto);
				echo"<input type='hidden' name='assunto' value='".$assunto."'>";
				echo "<strong>ASSUNTO: </strong>".$assunto."<br />";
				echo"<br />";
				
				
				$anexoPai=$dados['anexoPai'];//variavel com o Anexo Pai do Processo que recebera os anexos,pra saber se ele está anexado a outro processo ou n
				
				$tipoAnexoPai=$dados['tipoAnexoPai'];//variavel com o Tipo Anexo Pai do processo em que recebera o anexo,pra saber se ele está anexado a outro processo ou n
				
				$anoAnexoPai=$dados['anoAnexoPai'];//variavel com o Ano Anexo Pai do processo em que recebera o anexo,pra saber se ele está anexado a outro processo ou n
				
				$anexado=$dados['anexado'];//variavel com o anexado do processo em que recebera o anexo, pra saber se ele está anexado a outro processo ou n
				
				$setorEntradaAnexo=$dados['setor_entrada'];//variavel com o anexado do processo em que recebera o anexo, pra saber se ele está anexado a outro processo ou n
				
				?>
				<br />
				<br />
				
				<hr />
				
				
				<legend>ANEXO</legend>
					<br />
							
							
					<div style=" height: 300px; overflow: auto; width: 670px" >
						<table  border="0" cellpadding="2" cellspacing="4">
						  
						  <tr><td class="bd_titulo" width="10"><strong>TIPO ANEXO</strong></td><td class="bd_titulo"><strong>ANEXO</strong></td><td class="bd_titulo"><strong>ANO</strong></td></tr>
						  <tr class="linha">
						    <td><select name = "tipoAnexo[]">
								<option value='01'>COMUNICAÇÃO INTERNA</option>
								<option value='02'>COMUNICAÇÃO EXTERNA</option>							
								</select>
								<br />
								
						</td>		
						    <td><input type="text" name="anexo[]" value="" maxlength="20" size="20px"/></td>
						    <td><input type="text" name="anoAnexo[]" value="" maxlength="4" size="4px"/></td>
						   
						  
						    <td><a href="#" class="excluir" title="Remover linha"><img src="recursos/imagens/icones/minus.png" border="0" /></a></td>
						  </tr>
						  <tr><td colspan="4">
						        <a href="#" class="mais" title="Adicionar item"><img src="recursos/imagens/icones/plus.png" border="0" /></a>
							</td></tr>
						 
						</table>
	
						</fieldset>	
			
		
					</div>
				<br />
				<br />
					<input type="submit" value="    Enviar    " > 
					<input type="button" value="    Voltar    " onclick="window.location.assign('apensarAnexo.php')">
				<form>
				</div>
				
			</div>
			<div id="rodape">
				<?php
				// Inclui informações do usuario
				
				include('recursos/includes/inforUsuario.inc');
				?>
			
			</div>
		</div>
	</body>
	
</html>

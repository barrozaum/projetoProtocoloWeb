<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		
	
		<?php
		// inclui os scripts
		include('recursos/includes/verScript.inc');
		?>
		<script language="JavaScript">

		function verifica() {
			var requerente= document.f1.requerente.value.toUpperCase();
			var logradouro= document.f1.logradouro.value.toUpperCase();
			var numeroEnd= document.f1.numero_end.value;
			var complemento= document.f1.complemento.value.toUpperCase();
			var bairro= document.f1.bairro.value.toUpperCase();
			var cidade= document.f1.cidade.value.toUpperCase();
			var uf= document.f1.uf.value.toUpperCase();
			var cep= document.f1.cep.value;
			var tel= document.f1.tel.value;
			var cel= document.f1.cel.value;
			
			if (requerente == ""){
		 	  	window.alert("VERIFIQUE O CAMPO REQUERENTE !!!");
				document.f1.requerente.focus();
			}
			else if (logradouro== ""){
				window.alert("VERIFIQUE O CAMPO LOGRADOURO !!!");
				document.f1.logradouro.focus();
			}
		 	else if (numeroEnd== ""){
				window.alert("VERIFIQUE O CAMPO NÚMERO !!!");
		 		document.f1.numero_end.focus();
		 	}
			else if (bairro== ""){
				window.alert("VERIFIQUE O CAMPO BAIRRO !!!");
				document.f1.bairro.focus();
			}
			else if (cidade== ""){
				window.alert("VERIFIQUE O CAMPO CIDADE !!!");
				document.f1.cidade.focus();
			}
			else if (tel == ""){
				window.alert("VERIFIQUE O CAMPO TEL(FIXO) !!!");
				document.f1.tel.focus();
			
			}
			else{
		     	 document.f1.submit();
		    }
		}

		 </script>
		
	<title>Parvaim</title>
</head>



<body>
	
	
<?php 
$i = 0;

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM requerente ORDER BY idRequerente";
$resultado = mysql_query($sql,$conexao);

while($dados = mysql_fetch_array($resultado)){
$i=$dados['idRequerente'];
}

$total = ++$i; 
?>


	<h3>CADASTRO REQUERENTE</h3>
	<br />
	<br />

	<form name="f1" action="cadastrarRequerente1.php" method="post">

	<label>CÓDIGO:
		<input type="text" name="cod" value="<?php echo $total; ?>" size="2px" readonly="true"/> 
	</label>
	
	
	<label>REQUERENTE:
		<input type="text" name="requerente" maxlength="50" value="" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(requerente);"/> *
	</label>
	<br />
	<br />
	
	<label>LOGRADOURO:
		<input type="text" name="logradouro"  size="45px"  maxlength="50"  value=""onKeypress="return carcater();" onKeyUp="maiusculo(logradouro);"/>
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
	
		
	<input type="button" value="    CADASTRAR    " onclick="javascript: verifica();" />
	<input type="reset" value="    CORRIGIR    " />
	<input type="button" value="    VOLTAR    " onclick="window.close();" /> 
	</form>
	<br />
	<br />

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

</body>

</html>

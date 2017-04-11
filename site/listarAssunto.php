<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<?php
		// Inclui o script do site			
		
		include('recursos/includes/verScript.inc');
		?>
				
		
		<!--Fun0Š40Š0o quando preencher o campo numero gera os informa0Š40Š0o dos arquivos autom¨¢ticamente -->
		<script languagem = "JavaScript">
		function pesquisar(str)
		{
		if (str=="")
		  {
		  document.getElementById("pesquisa").innerHTML="";
		  return;
		  } 
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    document.getElementById("pesquisa").innerHTML=xmlhttp.responseText;
		    }
		  }
		  
		  // Pega as variaveis 
		  
		   var assunto= document.getElementById('assunto').value;
		
		
		xmlhttp.open("POST","listarAssunto1.php?assunto="+assunto,true);
		xmlhttp.send();
		}
		</script>
	

	<script languagem = "JavaScript">
		function escolha(codigo, nomeAssunto){
			opener.f1.codAssunto.value=codigo;
			opener.f1.nomeAssunto.value=nomeAssunto;
			opener.f1.verificaAssunto.value="1";
			window.close();
		}
	</script>
		
	<title>Parvaim</title>	
</head>
	
		
		
		
					
<body>
	
			

<h3>LISTAR ASSUNTO</h3>
<br />
<br />

<form>


<label><strong>ASSUNTO:</strong>

<input type"text" value="" name="assunto" id="assunto" size="50" maxlength = "40" / >
<br /><br />	
</label>

<input type="button" value="    PESQUISAR    " onclick="pesquisar()">
<input type="reset"  value="    CORRIGIR    "/>
<input type="button" value="    VOLTAR    " onclick="window.close();">
</form>

		
<hr />
<br />
<br />		
	


	
<div id="pesquisa">
	<?php 
	$i = 0;
	include('recursos/includes/verConexao.inc');
	$sql = "SELECT * FROM assunto ORDER BY idAssunto";
	if($resultado = mysql_query($sql,$conexao)){
	?>
 		
 		<?php 
 		if(mysql_num_rows($resultado)==0){
 		?>
 		<div id="cadastrados">
             <strong>NENHUM ASSUNTO ENCONTRADO !!!</strong>
        </div>
 		<?php	
		}else{
		?>	
				<table width="100%">
				<thead class="fixedHeader">
				<tr bgcolor="#f5f5dc">
					<th></th>
					<th>CÓDIGO</th>
					<th>ASSUNTO</th>	
				</tr>
				
			
				<?php	
				while($dados=mysql_fetch_array($resultado)){
				
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
				?>	
				
				<tr bgcolor="<?php echo $cor; ?>">
					<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idAssunto']; ?>, '<?php echo $dados['nomeAssunto']; ?>');"> </td>
					<td height="5" align ="center"><?php echo $dados['idAssunto']; ?></td>
					<td height="5" align ="center"><?php echo $dados['nomeAssunto']; ?></td>
				</tr>
				<?php	
				 $i++;
				}
				?>	
					
		    </thead>
			</table>		
		</div>		
		<?php	
		}
		?>
	<?php	
	}else{
	?>	
	<script languagem = "JavaScript"> 
	window.alert('Erro no SQl');
	window.close();
	</script>
	<?php	
	}
	?>	

</div>
			
</body>
	
</html>

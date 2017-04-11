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
				
		
		<!--Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
		<script>
		function showUser(str)
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
		  
		   var origem= document.getElementById('origem').value;
		
		
		xmlhttp.open("POST","listarOrigem1.php?origem="+origem,true);
		xmlhttp.send();
		}
		</script>


	<script languagem = "JavaScript">
		function escolha(codigo, nomeOrigem){
				opener.f1.codOrigem.value=codigo;
   				opener.f1.mostraOrigem2.value=nomeOrigem;
   				opener.f1.verificaOrigem.value="1";
   				window.close();
		}
	</script>
		
		
		
	<title>Parvaim</title>	
</head>
	
		
		
		
					
<body>
	
			

<h3>LISTAR ORIGEM</h3>
<br />
<br />

<form>


<label><strong>ORIGEM :</strong>

<input type"text" value="" name="origem" id="origem" size="50" maxlength = "40" / >
<br /><br />	

<input type="button" value="    PESQUISAR    " onclick="showUser(this.value)">
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
	$sql = "SELECT * FROM origem ORDER BY idOrigem";
	if($resultado = mysql_query($sql,$conexao)){
	?>
 		
 		<?php 
 		if(mysql_num_rows($resultado)==0){
 		?>
 		<div id="cadastrados">
             <strong>NENHUMA ORIGEM ENCONTRADO !!!</strong>
        </div>
 		<?php	
		}else{
		?>	
		<!-- <div id="tabelasLista" >-->
		<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
        <table width="100%">
        <thead class="fixedHeader">
		<tr bgcolor="#f5f5dc">
				<th></th>
				<th>CÓDIGO</th>
				<th>ORIGEM</th>	
			</tr>

			<?php	
			while($dados=mysql_fetch_array($resultado)){


			if ($i% 2 == 0)
				$cor = "#CCCCCC";
			else
				$cor = "#FFFFFF";

			?>	

	
            <tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
				<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idOrigem']; ?>, '<?php echo $dados['nomeOrigem']; ?>');"> </td>
				<td height="5" align ="center"><?php echo $dados['idOrigem']; ?></td>
				<td height="5" align ="center"><?php echo $dados['nomeOrigem']; ?></td>
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

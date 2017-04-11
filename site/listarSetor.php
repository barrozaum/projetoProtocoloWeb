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
		  
		   var setor= document.getElementById('setor').value;
		
		
		xmlhttp.open("POST","listarSetor1.php?setor="+setor,true);
		xmlhttp.send();
		}
		</script>
			
		<script languagem = "JavaScript">
		function escolha(codigo,nomeSetor ){
			opener.f2.setorEntrada.value=codigo;
			opener.f2.nomeSetor.value=nomeSetor;
			opener.f2.verificaSetor.value="1";
			window.close();
		}
	</script>
		
	<title>Parvaim</title>	
</head>
	
		
		
		
					
<body>
	
			

<h3>LISTAR SETOR</h3>
<br />
<br />

<form>


<label><strong>SETOR:</strong>

<input type"text" value="" name="setor" id="setor" size="50" maxlength = "40" / >
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
	
	include('recursos/includes/verConexao.inc');
	$sql = "SELECT * FROM setor ORDER BY idSetor";
	if($resultado = mysql_query($sql,$conexao)){
	?>
 		
 		<?php 
 		if(mysql_num_rows($resultado)==0){
 		?>
 			<div id="cadastrados">
             <strong>NENHUM SETOR ENCONTRADO !!!</strong>
       		</div>
 		<?php	
		}else{
		?>	
		 	<div id="tabelasLista" >
				<table width="100%">
				<thead class="fixedHeader">
				<tr bgcolor="#f5f5dc">
						<th></th>
     	                <th>DESC.DEPARTAMENTO</th>
						<th>SETOR</th>
					</tr>
				
			
					<?php
                    $i = 0;
					while($dados=mysql_fetch_array($resultado)){
					
						
						if ($i% 2 == 0)
							$cor = "#CCCCCC";
						else
							$cor = "#FFFFFF";
					
					?>	
					
			
					<tr bgcolor="<?php echo $cor; ?>">
						<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idSetor']; ?>, '<?php echo $dados['setor']; ?>');"> </td>
						<td height="5" align ="center"><?php echo $dados['descDepartamento']; ?></td>
						<td height="5" align ="center"><?php echo $dados['setor']; ?></td>
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

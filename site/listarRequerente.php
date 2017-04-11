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
		  
		   var requerente= document.getElementById('requerente').value;
		
		
		xmlhttp.open("POST","listarRequerente1.php?requerente="+requerente,true);
		xmlhttp.send();
		}
		</script>
		



	<script languagem = "JavaScript">
		function escolha(codigo, nomeRequerente, logradouro, numeroEnd, complemento, bairro, cidade, uf, cep, tel,cel){
			
			window.close();
			opener.f1.codRequerente.value=codigo;
			opener.f1.nomeRequerente.value=nomeRequerente;
			opener.f1.numero_end.value=numeroEnd;
			opener.f1.logradouro.value=logradouro;
			opener.f1.bairro.value=bairro;
			opener.f1.complemento.value=complemento;
			opener.f1.cidade.value=cidade;
			opener.f1.uf.value=uf;
			opener.f1.cep.value=cep;
			opener.f1.tel.value=tel;
			opener.f1.cel.value=cel;
   			
			opener.f1.verificaRequerente.value="1";
   			
   		}
	</script>
		
			<title>Parvaim</title>	
</head>
	
		
		
		
					
<body>
	
			

<h3>LISTAR REQUERENTE</h3>
<br />
<br />

<form>


<label><strong>REQUERENTE:</strong>

<input type"text" value="" name="requerente" id="requerente" size="50" maxlength = "40" / >
<br /><br />	

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
	$sql = "SELECT * FROM requerente ORDER BY idRequerente";
	if($resultado = mysql_query($sql,$conexao)){
	?>
 		
 		<?php 
 		if(mysql_num_rows($resultado)==0){
 		?>
 		<div id="cadastrados">
             <strong>NENHUM REQUERENTE ENCONTRADO !!!</strong>
        </div>
 		<?php	
		}else{
		?>	
		 	<div id="tabelasLista" >
				<table width="100%">
				<thead class="fixedHeader">
				<tr bgcolor="#f5f5dc">
					<th></th>
					<th>CÓDIGO</th>
					<th>REQUERENTE</th>	
					<th>TELEFONE</th>
					<th>+</th>
				</tr>
				
			
					<?php	
					while($dados=mysql_fetch_array($resultado)){
					
						
						if ($i% 2 == 0)
							$cor = "#CCCCCC";
						else
							$cor = "#FFFFFF";
					
					?>	
			
       				<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
						<td height="5" align ="center"><input type="radio" name="op" onclick="escolha(<?php echo $dados['idRequerente']; ?>, '<?php echo $dados['requerente']; ?>', '<?php echo $dados['logradouro']; ?>',  '<?php echo $dados['numeroEnd']; ?>',  '<?php echo $dados['complemento']; ?>', '<?php echo $dados['bairro']; ?>',  '<?php echo $dados['cidade']; ?>',  '<?php echo $dados['uf']; ?>',  '<?php echo $dados['cep']; ?>', '<?php echo $dados['tel']; ?>',  '<?php echo $dados['cel']; ?>')";> </td>
						<td height="5" align ="center"><?php echo $dados['idRequerente']; ?></td>
						<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
						<td height="5" align ="center"><?php echo $dados['tel']; ?></td>
						<td height="5" align ="center"><a href="listarRequerente2.php?requerente=<?php  echo $dados['idRequerente']; ?>" onclick="window.open(this.href,'galeria','width=680,height=470'); return false;"><img src="recursos/imagens/icones/lupa.png" alt="Consultar"></a></td>
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

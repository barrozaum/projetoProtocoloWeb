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
	<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
	
	<?php
	// Inclui o script do site			
	
	include('recursos/includes/verScript.inc');
	?>

		
		<!-Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
		<script>
		function showUser(str)
		{
					
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
		    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		    }
		  }
		  
		  // Pega as variaveis 
		  
		   var numero= document.getElementById('numero').value;
		   var tipo = document.getElementById('tipo').value;
		   var ano = document.getElementById('ano').value;
		  
		xmlhttp.open("POST","getExcluirProcesso.php?numero=" + numero+ "&tipo=" +tipo + "&ano=" +ano ,true);
		xmlhttp.send();
		}
		</script>
		
		
		<script lanuagem='javascript'>
		
		function confirma(){
		var v = window.confirm('Deseja Prosseguir com a Exclusão ?');
		
		if(v == true)
		document.f2.submit();
		
		}
		</script>
		
	<title>Parvaim</title>	
</head>
	
				
<body class="laterais">
		
	<h3>Excluir Processo </h3>
	<br />
	<br />
	
	<form name="f1" action="#" method="POST">
		<strong>Tipo Processo:</strong>
			<select name="tipo" id="tipo" >
			
			<option value='1'>Comunicação Interna</option>
			<option value='2'>Comunicação Externa</option>							
			</select>
			<br />
			<br />
	
	
		<label><strong>Número Processo:</strong>
			<input type="text" name="numero" id="numero"  maxlength="30" size="30px" onKeypress="return numeros();" />
		</label>
	
		<label><strong>Ano do Processo:</strong>
			<input type="text" name="ano" id="ano" class="ano" maxlength="4" size="4px" value="<?php echo date('Y'); ?>" onKeypress="return numeros();" />
		</label>
		<br />
		<br />
		<input type="button" value="    Enviar    " onclick="showUser(this.value)">
		<input type="reset" value="    Corrigir    " >
		<input type="button" value="    Voltar    " onclick="javascript:window.close();">

		
		
	</form>
	<br />
	<hr />
	
							
				
	 <div id="txtHint">
	 
	
	 </div>
			
</body>
	
</html>

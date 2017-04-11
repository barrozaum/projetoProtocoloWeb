<!--Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
		<script>
		function buscarExcluir(str)
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
		  
		xmlhttp.open("POST","getExcluirAnexo.php?numero=" + numero+ "&tipo=" +tipo + "&ano=" +ano ,true);
		xmlhttp.send();
		}
		</script>
		
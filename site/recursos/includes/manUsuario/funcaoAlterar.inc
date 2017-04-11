<!--Função para alterar arquivo automáticamente -->
		<script>
		function alterar(str)
		{
		
		if (str=="")
		  {
		  document.getElementById("conteudo").innerHTML="";
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
		    document.getElementById("conteudo").innerHTML=xmlhttp.responseText;
		    }
		  }
		 
			xmlhttp.open("POST","listarUsuario.php?c=2",true);
			xmlhttp.send();
			}
		</script>

		<!-- Fim da função que realiza a alteração -->
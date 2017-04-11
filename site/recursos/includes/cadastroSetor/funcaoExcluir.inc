<!--Função para excluir arquivo automáticamente -->
		<script>
		function excluir(str)
		{
		if (str=="")
		  {
		  document.getElementById("cadastrados").innerHTML="";
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
		    document.getElementById("cadastrados").innerHTML=xmlhttp.responseText;
		    }
		  }
		 
			var r = confirm ("CONFIRMAR EXCLUSÃO ?");
			if (r == true){
				xmlhttp.open("POST","excluirSetor.php?cod="+str,true);
				xmlhttp.send();
				}
			}
		</script>

		<!-- Fim da função que realiza a exclusão -->

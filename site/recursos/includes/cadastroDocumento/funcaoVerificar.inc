
		<!--Função para alterar arquivo automáticamente -->
		<script languagem= "JavaScript">

		function verifica(str)
		{
			if (str=="")
		 	 {
		 	 document.getElementById("esquerda").innerHTML="";
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
			 
		 
			 var d = document.f1.descricao.value.toUpperCase();
			 if(d != ""){
			  	xmlhttp.open("POST","cadastroDocumento1.php?descricao=" + d,true);
				xmlhttp.send();
				document.f1.descricao.value="";
				}else{
				window.alert("VERIFIQUE O CAMPO DOCUMENTO !!!");
					document.f1.descricao.focus();
				}
		}
		</script>

		<!-- Fim da função que realiza a alteração -->

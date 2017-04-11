	<script languagem= "JavaScript">

		function verificaAlteracao(str)
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
			 
		 
			var cod = document.f1.cod.value;
		
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

		<!-- Fim da função que realiza a alteração -->
<script language="javascript"> 
		function listaCarga(str)
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
		
		  if (numero == ""){
		  	window.alert("VERIFIQUE O CAMPO NÚMERO !!!");
		  		document.getElementById('numero').focus();
		  }else if (ano == ""){
		  	window.alert("VERIFIQUE O CAMPO ANO !!!");
		  		document.getElementById('ano').focus();
		  }else{  
		xmlhttp.open("POST","getExcluirCarga.php?numero=" + numero+ "&tipo=" +tipo + "&ano=" +ano ,true);
		xmlhttp.send();
		}
	}
		</script>
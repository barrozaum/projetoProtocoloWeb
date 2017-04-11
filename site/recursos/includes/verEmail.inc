

<!-Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
<script>
function e(str){



	if (str==""){
		document.getElementById("mostraNovoEmail").innerHTML="";
		return;
	} 
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
		xmlhttp=new XMLHttpRequest();
	
	}else{// code for IE6, IE5
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	}
	
	xmlhttp.onreadystatechange=function(){
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("mostraNovoEmail").innerHTML=xmlhttp.responseText;
		}
	}
	
	// Pega as variaveis 
	var email= document.getElementById('email').value.toUpperCase();
	
		xmlhttp.open("POST","mostrarEmail.php?email=" + email,true);
		xmlhttp.send();
		
	
	}
</script>

<!-Fim da Função que traz valores sem refresh -->
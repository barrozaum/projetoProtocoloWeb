
<!-Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
<script>
function showUser(str){
	if (str==""){
		document.getElementById("mostraAssunto").innerHTML="<input type='text' name='nomeAssunto' id='nomeAssunto' value=''  size='70px' maxlength = '50' /> <input type='hidden' name='verificaAssunto' value=''>";
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
			document.getElementById("mostraAssunto").innerHTML=xmlhttp.responseText;
		}
	}
	
	// Pega as variaveis 
	
	
	var assunto= document.getElementById('assunto').value;
	
	
	if ((assunto <= 0 ) || (assunto == "")){
	window.alert('Assunto Inválido');
	document.getElementById("mostraAssunto").innerHTML= "<input type='text' name='nomeAssunto' id='nomeAssunto' value=''  size='70px' maxlength = '50' /> <input type='hidden' name='verificaAssunto' value=''>";
	document.getElementById('assunto').value="";
	
	}else{
	xmlhttp.open("POST","trocaAssunto.php?assunto=" + assunto,true);
	xmlhttp.send();
	}
}
</script>

<!-Fim da Função que traz valores sem refresh -->
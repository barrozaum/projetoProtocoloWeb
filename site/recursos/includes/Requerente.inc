
<!-- Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
<script>
function rq(str){
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
		xmlhttp=new XMLHttpRequest();
	
	}else{// code for IE6, IE5
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	}
	
	xmlhttp.onreadystatechange=function(){
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("TrocaRequerente").innerHTML=xmlhttp.responseText;
		}
	}
	
	// Pega as variaveis 
	var requerente= document.getElementById('requerente').value;
		
		if ((requerente <= 0) || (requerente == "")){
		window.alert('Requerente Inválido');
		
		}else{
		xmlhttp.open("POST","trocaRequerente.php?requerente=" + requerente,true);
		xmlhttp.send();
		}
	
}
</script>

<!-- Fim da Função que traz valores sem refresh -->
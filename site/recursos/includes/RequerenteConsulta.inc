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
			document.getElementById("mostraRequerente").innerHTML=xmlhttp.responseText;
		}
	}
	
	// Pega as variaveis 

	var requerente= document.getElementById('requerente').value;
	
		xmlhttp.open("POST","trocaConsultaRequerente.php?requerente=" + requerente,true);
		xmlhttp.send();
		
	
}
</script>

<!-- Fim da Função que traz valores sem refresh -->

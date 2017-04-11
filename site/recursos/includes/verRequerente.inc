<?php 
$totalRequerente = 0;

include('recursos/includes/verConexao.inc');
$sql= "SELECT * FROM requerente";
$resultado = mysql_query($sql,$conexao);
while($dados = mysql_fetch_array($resultado)){
$totalRequerente++;
}

?>


<!-Função quando preencher o campo numero gera os informação dos arquivos automáticamente -->
<script>
function User(str){
	if (str==""){
		document.getElementById("mostraRequerente").innerHTML="<input type='text' name='nomeRequerente' id='nomeRequerente' value=''  size='70px' maxlength = '50' />";
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
			document.getElementById("mostraRequerente").innerHTML=xmlhttp.responseText;
		}
	}
	
	// Pega as variaveis 
	var requerente= document.getElementById('requerente').value;
	var totalRequerente = <?php echo $totalRequerente; ?>;
		
		if ((requerente <= 0) || (requerente > totalRequerente)){
		window.alert('Requerente Inválido');
		document.getElementById("mostraRequerente").innerHTML= "<input type='text'  name='nomeRequerente' id='nomeRequerente' value=''  size='70px' maxlength = '50' />";
		document.getElementById('requerente').value="";
		}else{
		xmlhttp.open("POST","mostraRequerente.php?requerente=" + requerente,true);
		xmlhttp.send();
		}
}
</script>

<!-Fim da Função que traz valores sem refresh -->
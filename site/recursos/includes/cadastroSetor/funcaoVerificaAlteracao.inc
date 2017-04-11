	<script languagem= "JavaScript">

		function verificaAlteracao(str)
		{

 
			var codigo = document.f1.codigo .value.toUpperCase().toUpperCase();
			var setor = document.f1.setor .value.toUpperCase().toUpperCase();

			var secretaria = document.f1.secretaria .value.toUpperCase();
			var desc_secretaria= document.f1.desc_secretaria.value.toUpperCase();

			var coordenadoria= document.f1.coordenadoria.value.toUpperCase();
			var desc_coordenadoria= document.f1.desc_coordenadoria.value.toUpperCase();
		
			var departamento= document.f1.departamento.value.toUpperCase();
			var desc_departamento= document.f1.desc_departamento.value.toUpperCase();
		  
		   
		 	   if(setor == ""){
		   		window.alert("VERIFIQUE O CAMPO SETOR !!!");
		   		document.f1.setor.focus();

			   }else if (secretaria == ""){
		  		window.alert("VERIFIQUE O CAMPO SECRETARIA !!!");
		   		document.f1.secretaria.focus();
		   
			   }else if (desc_secretaria== ""){
		  		window.alert("VERIFIQUE O CAMPO DESC.SECRETARIA !!!");
		   		document.f1.desc_secretaria.focus();
			   
			   }else if (coordenadoria== ""){
		  		window.alert("VERIFIQUE O CAMPO COODENADORIA !!!");
		   		document.f1.coordenadoria.focus();

			   }else if (desc_coordenadoria== ""){
		  		window.alert("VERIFIQUE O CAMPO DESC.COODENADORIA !!!");
		   		document.f1.desc_coordenadoria.focus();
			   
			   }else if (departamento== ""){
		  		window.alert("VERIFIQUE O CAMPO DEPARTAMENTO !!!");
		   		document.f1.departamento.focus();
			   
			   }else if (desc_departamento== ""){
		  		window.alert("VERIFIQUE O CAMPO DESC.DEPARTAMENTO !!!");
		   		document.f1.desc_departamento.focus();

			  	}else{
			  		document.f1.submit();
				
				}
	
		}
		</script>

		<!-- Fim da função que realiza a alteração -->
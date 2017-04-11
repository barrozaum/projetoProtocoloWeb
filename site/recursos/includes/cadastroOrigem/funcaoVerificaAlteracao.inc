	<script languagem= "JavaScript">

		function verificaAlteracao(str)
		{
		
		 
			 var d = document.f1.descricao.value.toUpperCase();
			 var c = document.f1.codigo.value;

				 if(d != ""){
					document.f1.submit();
				}else{
						window.alert("VERIFIQUE O CAMPO ORIGEM !!!");
					document.f1.descricao.focus();
				}
		}
		</script>

		<!-- Fim da função que realiza a alteração -->
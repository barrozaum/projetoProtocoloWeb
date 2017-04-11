	<script languagem= "JavaScript">

		function verificaAlteracao(str)
		{
			 var d = document.f1.descricao.value.toUpperCase();
			 var c = document.f1.codigo.value;

			 if(d != ""){
			  location.href="alterarDocumento1.php?descricao=" + d + "&codigo="+c;
				}else{
					window.alert("VERIFIQUE O CAMPO DOCUMENTO !!!");
					document.f1.descricao.focus();
				}

	
		}
		</script>

		<!-- Fim da função que realiza a alteração -->
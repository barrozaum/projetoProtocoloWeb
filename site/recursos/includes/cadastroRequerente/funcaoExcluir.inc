<!--Função para excluir arquivo automáticamente -->
		<script>
		function excluir(str)
		{

		 
			var r = confirm ("CONFIRMAR EXCLUSÃO ?");
			if (r == true){
				location.href="excluirRequerente.php?cod="+str;
				}
			}
		</script>

		<!-- Fim da função que realiza a exclusão -->

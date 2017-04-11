<!--Função para excluir arquivo automáticamente -->
		<script>
		function excluir(str)
		{
			var r = confirm ("CONFIRMAR EXCLUSÃO ?");
			if (r == true){
			location.href="excluirOrigem.php?cod="+str;
			}
		}
		</script>

		<!-- Fim da função que realiza a exclusão -->

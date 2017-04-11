		<script>
		function excluir(cod)
		{
			var r = confirm ("CONFIRMAR EXCLUSÃO ?");
			
			if (r == true){
			location.href="excluirAssunto.php?cod="+cod;
			}
		}
		</script>
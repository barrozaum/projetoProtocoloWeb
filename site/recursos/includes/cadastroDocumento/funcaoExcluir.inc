		<script>
		function excluir(str)
		{
			var r = confirm ("CONFIRMAR EXCLUSÃO ?");
			if (r == true){
				location.href="excluirDocumento.php?cod="+str;
				}
			}
		</script>
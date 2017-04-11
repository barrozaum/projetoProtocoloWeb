$(function () {
	function removeCampo() {
		$(".removerCampo").unbind("click");
		$(".removerCampo").bind("click", function () {
			i=0;
			$(".anexo p.campoanexo").each(function () {
				i++;
			});
			if (i>1) {
				$(this).parent().remove();
			}
		});
	}
	removeCampo();
	$(".adicionarCampo").click(function () {
		novoCampo = $(".anexo p.campoanexo:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter(".anexo p.campoanexo:last");
		removeCampo();
	});
});
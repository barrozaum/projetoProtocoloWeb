$(function () {

    $(document).on('change', '#id_colaborador', function (e) {

        var id_usuario_selecionado = $(this).val();
        if (id_usuario_selecionado > 0) {
            $.ajax({
                method: 'POST',
                url: "recursos_juridico/includes/consulta/consulta_permissao.php",
                dataType: "json",
                data: {
                    id: id_usuario_selecionado
                },
                success: function (data) {
                    selecionar("id_perfil", data.nivel)
                }, error: function (erro) {
                    console.log(erro.responseText);
                }
            });
        }
    });
});
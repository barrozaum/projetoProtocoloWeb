$(document).on('click', '#id_consulta_numero', function (e) {
    e.preventDefault();

//valores buscado no frmulario
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();

    $(".modal-content").html('');
    $(".modal-content").addClass('loader');
    $("#dialog-example").modal('show');
    $.post('recursos/includes/formulario/formulario_modal_consulta_dados_processo.php',
            {
                id: 99,
                txt_tipo_processo: tipo_processo,
                txt_numero_processo: numero_processo,
                txt_ano_processo: ano_processo
            },
    function (html) {
        $(".modal-content").removeClass('loader');
        $(".modal-content").html(html);
    }
    );
});

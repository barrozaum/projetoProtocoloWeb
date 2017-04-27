$(document).on('click', '#id_consulta_numero', function (e) {
    e.preventDefault();

//valores buscado no frmulario
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
//    mensagem de erro
    var msg = "";

    if (tipo_processo < 1) {
        msg += "POR FAVOR ENTRE COM O TIPO PROCESSO VÁLIDO !!! \n";
    }

    if (numero_processo < 1) {
        msg += "POR FAVOR ENTRE COM O NÚMERO PROCESSO VÁLIDO !!! \n";
    }

    if (ano_processo.length !== 4) {
        msg += "POR FAVOR ENTRE COM O ANO PROCESSO VÁLIDO !!! \n";
    }

    if (msg !== "") {
        alert(msg);
        return false;
    }

    $(".modal-content").html('');
    $(".modal-content").addClass('loader');
    $("#dialog-example").modal('show');
    $.post('recursos/includes/formulario/formulario_modal_excluir_carga.php',
            {
                id: 1,
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

//função para efetuar validação
$(document).on('click', '#id_btn_enviar_carga', function (e) {
    var id_carga = $("#id_carga:checked").val();
    if (id_carga === undefined) {
        $('#error_modal').html("<div class='alert alert-danger'> POR FAVOR SELECIONE UMA CARGA PARA SER EXCLUÍDA !!!</div>");
        return false;
    }else{
         var r = confirm("PROSSEGUIR COM EXCLUSÃO ?");
        if(r == true){
            $('#id_formulario_carga').submit();
        }else{
              $('#error_modal').html('');
              return false;
        }
    }
});
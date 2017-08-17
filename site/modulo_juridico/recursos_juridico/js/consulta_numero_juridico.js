// quando o campo código sofrer alteração executo
$(document).on('blur', "#id_ano_processo", function (e) {
// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
    var valor = preencheZeros(this.value, 4);
//    comparo se o valor é menor que
    if (valor < '2000') {
//        zero o campo cdigo
        $(this).val('2000');

    } else {
//        atribuo o valor informado pelo usario no campo
        $(this).val(valor);

    }

});

$(document).on('click', '#id_consulta_numero', function (e) {
    e.preventDefault();

//valores buscado no frmulario
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
    var msg = "";

 
    if (numero_processo < 1) {
        msg += "NÚMERO PROCESSO INVÁLIDO !!! <BR />";
    }

    if (ano_processo.length != 4) {
        msg += "ANO INVÁLIDO !!! <BR />";
    }

    if (msg !== "") {
        $('#msg_erro').html('<div class="alert alert-danger">' + msg + '</div>');
        return false;
    } else {
        $('#msg_erro').html('');
        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos_juridico/includes/formulario/formulario_modal_consulta_dados_processo_juridico.php',
                {
                    id: 99,
                    txt_numero_processo: numero_processo,
                    txt_ano_processo: ano_processo
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    }
});
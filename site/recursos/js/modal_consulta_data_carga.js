
$(document).on('click', '#id_consulta_numero', function (e) {
    var dt_inicial = $('#id_data_inicial').val();
    var dt_final = $('#id_data_final').val();

    $.ajax({
//      Requisição pelo Method POST
        method: "POST",
//      url para o arquivo para validação
        url: "recursos/includes/consulta/consulta_data_carga.php",
        //      dados passados
        data: {
            txt_op: 1,
            txt_dt_inicial: dt_inicial,
            txt_dt_final: dt_final
        },
        // dataType json
        dataType: "json",
        // função para de sucesso
        success: function (data) {
            $('#listar').html(data);

        }, error: function (error) {
            console.log(error.responseText);
        }
    });//termina o ajax


});
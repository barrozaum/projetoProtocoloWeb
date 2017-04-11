
$(document).on('click', '#id_consulta_numero', function (e) {
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();

    $.ajax({
//      Requisição pelo Method POST
        method: "POST",
//      url para o arquivo para validação
        url: "recursos/includes/consulta/consulta_numero_processo.php",
        //      dados passados
        data: {
            txt_op: 1,
            txt_tipo_processo: tipo_processo,
            txt_numero_processo: numero_processo,
            txt_ano_processo: ano_processo
        },
        // dataType json
        dataType: "json",
        // função para de sucesso
        success: function (data) {
            console.log(data);

        }, error: function (error) {
            console.log(error.responseText);
        }
    });//termina o ajax


});
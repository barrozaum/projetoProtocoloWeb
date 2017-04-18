

function funcao_retorna_pesquisa(url, parametros) {

    $.ajax({
//        Requisição pelo Method POST
        method: "POST",
        // url para o arquivo para validação
        url: url,
//        dados passados
        data: parametros,
        // dataType json
        dataType: "json",
        // função para de sucesso
        success: function (data) {

            $('#listar').html(data);
        }, error: function (error) {
            $('#listar').html(error.responseText);
        }
    });//termina o ajax

}
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
// função retorna o proximo numero de processo vago
function fun_retorna_proximo(url, parametros) {
    $.ajax({
//        Requisição pelo Method POST
        method: "POST",
        // url para o arquivo para validação
        url: url,
//        dados passados
        data: parametros,
        // função para de sucesso
        success: function (data) {

            $("#id_numero_processo").val(data);
            $("#id_numero_processo_banco").val(data);
        }, error: function (error) {
            console.log(error.responseText);
        }
    });//termina o ajax
}

// funcão que valida se o procesos ja existe ou não
function fun_retorna_existencia_processo(url, parametros) {

    $.ajax({
//        Requisição pelo Method POST
        method: "POST",
        // url para o arquivo para validação
        url: url,
//        dados passados
        data: parametros,
        // função para de sucesso
        success: function (data) {
            if (data === "TRUE") {
                $("#msg_erro").html('<div class="alert alert-danger">PROCESSO JÁ CADASTRADO </div>');
            } else {
                $('#id_formulario_processo').submit();
            }
        }, error: function (error) {
            console.log(error.responseText);
        }
    });//termina o ajax
}

//função que retorna dados do processo 
function fun_retorna_dados_processo(url, parametros) {

    $.ajax({
//        Requisição pelo Method POST
        method: "POST",
        // url para o arquivo para validação
        url: url,
//        dados passados
        data: parametros,
//   tipo de retorno
        dataType: "json",
        // função para de sucesso
        success: function (data) {
            console.log(data);
//            console.log(data.achou);
//            console.log(data.requerente.id_requerente);
//            console.log(data.array_requerente.);

        }, error: function (error) {
            console.log(error.responseText);
        }
    });//termina o ajax
}
   
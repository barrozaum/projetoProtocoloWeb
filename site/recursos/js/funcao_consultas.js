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
//alert()

    $('#msg').html('');
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
//            console.log(data);
            if (data.achou === 1) {
//             processo
                $('#id_codigo_processo').val(data.codigo_processo);
//             assunto 
                $('#id_codigo_assunto').val(data.codigo_assunto);
                $('#id_assunto').val(data.descricao_assunto);
                $('#id_complemento_assunto').val(data.complemento_assunto);

//            origem
                $('#id_codigo_origem').val(data.codigo_origem);
                $('#id_origem').val(data.descricao_origem);

//           requerente
                $('#id_codigo_requerente').val(data.requerente.codigo_requerente);
                $('#id_requerente').val(data.requerente.requerente);
                $('#id_tel_fixo').val(data.requerente.tel);
                $('#id_tel_cel').val(data.requerente.cel);
                $('#id_cep_requerente').val(data.requerente.cep);
                $('#id_logradouro_requerente').val(data.requerente.logradouro);
                $('#id_bairro_requerente').val(data.requerente.bairro);
                $('#id_cidade_requerente').val(data.requerente.cidade);
                $('#id_uf_requerente').val(data.requerente.uf);
                $('#id_numero_requerente').val(data.requerente.numero_end);
                $('#id_complemento_requerente').val(data.requerente.complemento);
//            observacao 
                $('#id_obs_processo').val(data.observacao);

                var i;
                var codigo_documento
                var descricao_documento
                var numero_documento
                var ano_documento

                for (i = 0; i < data.documentos.length; i++) {
//                console.log(i);

                    codigo_documento = data.documentos[i].codigo_documento;
                    descricao_documento = data.documentos[i].documento;
                    numero_documento = data.documentos[i].numero;
                    ano_documento = data.documentos[i].ano;

                    AddTableRow(codigo_documento, descricao_documento, numero_documento, ano_documento);
                }
                return true;
            } else {
                $('#msg').html("<div class='alert alert-danger'> PROCESSO NÃO ENCONTRADO !!! ");
                limpar_formulario();
                return false;
            }

        }, error: function (error) {
            console.log(error.responseText);
        }
    });//termina o ajax
}
   
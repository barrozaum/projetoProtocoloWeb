
$(document).on('click', '#id_consulta_anexo_processo', function (e) {
//limpo mensagem de erro
    $("#msg_erro").html('');

//        carrego paramtros do formulario
    var tipo_anexo = $("#id_tipo_anexo").val();
    var numero_anexo = $("#id_numero_anexo").val();
    var ano_anexo = $("#id_ano_anexo").val();



//passo o parametro pra onde deve ir buscar
    var url = 'recursos/includes/consulta/consulta_anexo_processo.php'
    var parametros = {txt_tipo_anexo: tipo_anexo, txt_numero_anexo: numero_anexo, txt_ano_anexo: ano_anexo};

// chamo a função que irá pesquisar o valor
    funcao_retorna_pesquisa(url, parametros);
});

$(document).on('click', '#id_buscar_processos', function (e) {
//limpo mensagem de erro
    $("#msg_erro").html('');

//        carrego paramtros do formulario
    var setor = $('#id_setor').val();
    var codigo_setor = $('#id_codigo_setor').val();
    var dt_inicial = $('#id_dt_inicial').val();
    var dt_final = $('#id_dt_final').val();


// valido o setor
    if (setor.length < 3) {
        $("#msg_erro").html('<div class="alert alert-danger">POR FAVOR PREENCHA O SETOR CORRETAMENTE !! </div>');
        return false;
    } else {
        $('#id_formulario_processo').submit();
    }


});


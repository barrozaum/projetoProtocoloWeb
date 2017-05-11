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
    }

//passo o parametro pra onde deve ir buscar
    var url = 'recursos/includes/listar/listar_rel_remessa_processo.php'
    var parametros = {setor: setor, dt_inicial: dt_inicial, dt_final: dt_final, codigo_setor: codigo_setor};
    var listar = 'listar';
// chamo a função que irá pesquisar o valor
    funcao_retorna_pesquisa(url, parametros, listar);
});


//verificar se checkbox foi preenchido
$(document).on('click', '#id_gerar_relatorio', function (e) {

    if (valida_checkbox()) {
        $("#msg_erro").html('');
        $('#id_form_gerar_rel').submit();
    } else {
        $("#msg_erro").html('<div class="alert alert-danger">POR FAVOR SELECIONE PROCESSOS DA LISTA !!!</div>');
    }

});

function valida_checkbox() {
    var check = document.getElementsByName("txt_op[]");

    for (var i = 0; i < check.length; i++) {
        if (check[i].checked == true) {
            return true;
        }
    }
    return false;
}

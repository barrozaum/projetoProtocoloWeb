$(document).on('click', '#id_buscar_processos', function (e) {
//limpo mensagem de erro
    $("#msg_erro").html('');

//        carrego paramtros do formulario
    var setor = $('#id_setor').val(); //destino
    var setor_origem = $('#id_alterar_colaborador_codigo_setor').val(); //origem
    var codigo_setor = $('#id_codigo_setor').val();
    var dt_inicial = $('#id_dt_inicial').val();
    var dt_final = $('#id_dt_final').val();
    var msg = "";

// valido o setor
    if (setor_origem < 1) {
        msg += "SETOR ORIGEM INVÁLIDO !!! <BR />";
    }
// valido o setor
    if (setor.length < 3) {
        msg += "SETOR REMESSA INVÁLIDO !!! <BR />";
    }

    if (msg !== "") {
        $("#msg_erro").html('<div class="alert alert-danger">' + msg + '</div>');
        return FALSE;
    }

//passo o parametro pra onde deve ir buscar
    var url = 'recursos/includes/listar/listar_recebimento_coletivo.php'
    var parametros = {setor: setor, setor_origem: setor_origem, dt_inicial: dt_inicial, dt_final: dt_final, codigo_setor: codigo_setor};
    var listar = 'listar';
    $("#"+listar).html('<div style="margin-top:50px; margin-left:50%"><img src="recursos/imagens/ajax-loader.gif" alt="carregando" title="carregando" width="20px"></div>');

// chamo a função que irá pesquisar o valor
    funcao_retorna_pesquisa(url, parametros, listar);
});


//verificar se checkbox foi preenchido
$(document).on('click', '#id_recebimento_coletivo', function (e) {

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

function selecionar_tudo() {
    for (i = 0; i < document.form_gerar_rel.elements.length; i++)
        if (document.form_gerar_rel.elements[i].type == "checkbox")
            document.form_gerar_rel.elements[i].checked = 1
}
function deselecionar_tudo() {
    for (i = 0; i < document.form_gerar_rel.elements.length; i++)
        if (document.form_gerar_rel.elements[i].type == "checkbox")
            document.form_gerar_rel.elements[i].checked = 0
}
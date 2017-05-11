$(document).ready(function () {
    estrutura();
});

function estrutura() {
    $('#cabecalho').load('recursos/includes/estrutura/cabecalho.php');
    $('#rodape').load('recursos/includes/estrutura/rodape.php');
}

//MODAL PARA ALTERAR A SENHA

$(function () {
// id = qual formulario irei chamer 
// cod = parametro enviado da linha (Codigo Rua, Bairrr
    $(document).on('click', '#btn_alterar_senha', function (e) {
        e.preventDefault();


        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_alterar_senha.php',
                {id: 1,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });


    $(document).on('click', '#btn_confirma_alterar_senha', function (e) {

        var senha_atual = $('#id_form_senha_atual_login').val();
        var nova_senha = $('#id_form_nova_senha_login').val();
        var conf_nova_senha = $('#id_form_conf_nova_senha_login').val();

//        limpa os campos
        $('#id_form_senha_atual_login').val('');
        $('#id_form_nova_senha_login').val('');
        $('#id_form_conf_nova_senha_login').val('');
//         valida o forma   
        var msg = "";

        if (senha_atual.length < 3) {
            msg += "SENHA ATUAL INVÁLIDA !!! <BR />";
        }

        if (nova_senha.length < 3) {
            msg += "NOVA SENHA NÃO ATENDE EXIGENCIAS !!! <BR />";
        }

        if (conf_nova_senha.length < 3) {
            msg += "CONFIRMAÇÃO NOVA SENHA NÃO ATENDE EXIGENCIAS !!! <BR />";
        }

        if (conf_nova_senha !== nova_senha) {
            msg += "SENHAS NÃO CONFEREM !!! <BR />";
        }

        if (msg !== "") {
            $('#msg_erro_alterar_senha').html("<div class='alert alert-danger'>" + msg + "</div>");
        } else {
            $('#msg_erro_alterar_senha').html("");


//passo o parametro pra onde deve ir alterar a senha
            var url = 'recursos/includes/alterar/alterar_senha.php';
            var parametros = {senha_atual: senha_atual, nova_senha: nova_senha, conf_nova_senha: conf_nova_senha};
            var listar = 'msg_erro_alterar_senha';
            funcao_retorna_pesquisa(url, parametros, listar);
        }


    });


});
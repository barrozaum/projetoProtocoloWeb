$(function () {
// id = qual formulario irei chamer 
// cod = parametro enviado da linha (Codigo Rua, Bairrr
    $(document).on('click', '#edit-editar', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_novo_colaborador.php',
                {id: 1,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });

    $(document).on('click', '#edit-excluir', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_novo_colaborador.php',
                {id: 2,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });
   
     $(document).on('click', '#id_desbloqueio', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_novo_colaborador.php',
                {id: 3,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });



    $(document).on('blur', '#id_novo_login', function (e) {
        var login = $(this).val();

        if (login.length > 2 && login.length < 51) {
            $("#msg_error").html('');


//passo o parametro pra onde deve ir buscar
            var url = 'recursos/includes/funcoes/func_validar_novo_login.php'
            var parametros = {cmd: 1, login: login};


// chamo a função que irá pesquisar o valor
            funcao_validar_novo_login(url, parametros);
        } else {
            $("#msg_error").html('<div class="alert alert-danger"> LOGIN INVÁLIDO </div>');
        }

    });


});


function func_liberar_form() {
    $('#id_novo_email').removeAttr('readonly');
    $('#id_novo_nome').removeAttr('readonly');
    $('#id_novo_sobrenome').removeAttr('readonly');
    $('#id_novo_sobrenome').removeAttr('readonly');
    $('#id_novo_permissao').removeAttr('readonly');
    $('#id_novo_permissao').empty();
    $('#id_novo_permissao').append('<option value="">SELECIONE O NIVEL PERMISSÃO</option>');
    $('#id_novo_permissao').append('<option value="0">USUARIO</option>');
    $('#id_novo_permissao').append('<option value="1">ADMINISTRADOR</option>');
    $('#id_novo_senha').removeAttr('readonly');
    $('#id_novo_conf_senha').removeAttr('readonly');
}

function func_bloquear_form() {
    $('#id_novo_email').attr('readonly', 'true');
    $('#id_novo_nome').attr('readonly', 'true');
    $('#id_novo_sobrenome').attr('readonly', 'true');
    $('#id_novo_sobrenome').attr('readonly', 'true');
    $('#id_novo_permissao').attr('readonly', 'true');
    $('#id_novo_permissao').empty();
    $('#id_novo_permissao').append('<option value="">SELECIONE O NIVEL PERMISSÃO</option>');
    $('#id_novo_senha').attr('readonly', 'true');
    $('#id_novo_conf_senha').attr('readonly', 'true');
}

function valida_form() {
    var erro = "";
    if ($("#id_novo_senha").val() !== $("#id_novo_conf_senha").val()) {
        erro += "Senhas não conferem !!! <br />"
    }
    if ($("#id_codigo_setor").val() < 1) {
        erro += "Usuário sem Setor !!! <br />";
    }
    if (erro !== "") {
        $("#msg_error").html('<div class="alert alert-danger">' + erro + '</div>');
        return false;
    } else {
        return true;
    }
}

function valida_form_alterar() {

    var erro = "";

    if ($("#id_alterar_novo_senha").val() !== $("#id_alterar_novo_conf_senha").val()) {
        erro += "Senhas não conferem !!! <br />"
    }

    if ($("#id_alterar_colaborador_codigo_setor").val() < 1) {
        erro += "Usuário sem Setor !!! <br />";
    }
    if (erro !== "") {
        $("#msg_error").html('<div class="alert alert-danger">' + erro + '</div>');
        return false;
    } else {
        return true;
    }
}
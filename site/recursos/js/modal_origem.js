
$(function () {
// id = qual formulario irei chamer 
// cod = parametro enviado da linha (Codigo Rua, Bairrr
    $(document).on('click', '#edit-editar', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_cadastro_origem.php',
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
        $.post('recursos/includes/formulario/formulario_cadastro_origem.php',
                {id: 2,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });


// Daqui pra baixo são arqivos para realizar a consulta por origem
// pagina consulta_origem.php


    $(document).on('click', '#id_consultar_processo', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_modal_consulta_dados_processo.php',
                {id: 7,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });

//---------------------------------------------------------------------------------------------


    $(document).on('click', '#id_buscar_origem', function (e) {
//limpo mensagem de erro
        $("#msg_erro").html('');

//        carrego paramtros do formulario
        var origem = $('#id_origem').val();
        var dt_inicial = $('#id_dt_inicial').val();
        var dt_final = $('#id_dt_final').val();


// valido o origem
        if (origem.length < 3) {
            $("#msg_erro").html('<div class="alert alert-danger">POR FAVOR PREENCHA O ORIGEM CORRETAMENTE !! </div>');
            return false;
        }

//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/consulta/consulta_origem.php'
        var parametros = {origem: origem, dt_inicial: dt_inicial, dt_final: dt_final};
        var listar = "listar";
        $("#"+listar).html('<div style="margin-top:50px; margin-left:50%"><img src="recursos/imagens/ajax-loader.gif" alt="carregando" title="carregando" width="20px"></div>');

// chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros, listar);
    });

});




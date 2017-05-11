$(function () {
// id = qual formulario irei chamer 
// cod = parametro enviado da linha (Codigo Rua, Bairrr
    $(document).on('click', '#edit-editar', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_cadastro_documento.php',
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
        $.post('recursos/includes/formulario/formulario_cadastro_documento.php',
                {id: 2,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });


// Daqui pra baixo são arqivos para realizar a consulta por documento
// pagina consulta_documento.php


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


    $(document).on('click', '#id_buscar_documento', function (e) {
//limpo mensagem de erro
        $("#msg_erro").html('');

//        carrego paramtros do formulario
        var documento = $('#id_documento').val();
        var numero_documento = $('#id_numero_documento').val();
        var ano_documento = $('#id_ano_documento').val();


// valido o documento
        if (documento.length < 3) {
            $("#msg_erro").html('<div class="alert alert-danger">POR FAVOR PREENCHA O DOCUMENTO CORRETAMENTE !! </div>');
            return false;
        }

//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/consulta/consulta_documento.php'
        var parametros = {documento: documento, numero_documento: numero_documento, ano_documento: ano_documento};
        var listar = "listar";

// chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros, listar);
    });

});




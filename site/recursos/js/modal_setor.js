$(function () {
// id = qual formulario irei chamer 
// cod = parametro enviado da linha (Codigo Rua, Bairrr
    $(document).on('click', '#edit-editar', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_cadastro_setor.php',
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
        $.post('recursos/includes/formulario/formulario_cadastro_setor.php',
                {id: 2,
                    codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });


// Daqui pra baixo são arqivos para realizar a consulta por setor
// pagina consulta_setor.php


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


    $(document).on('click', '#id_buscar_setor', function (e) {
//limpo mensagem de erro
        $("#msg_erro").html('');

//        carrego paramtros do formulario
        var setor = $('#id_setor').val();
        var dt_inicial = $('#id_dt_inicial').val();
        var dt_final = $('#id_dt_final').val();


// valido o setor
        if (setor.length < 3) {
            $("#msg_erro").html('<div class="alert alert-danger">POR FAVOR PREENCHA O SETOR CORRETAMENTE !! </div>');
            return false;
        }

//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/consulta/consulta_setor.php'
        var parametros = {setor: setor, dt_inicial: dt_inicial, dt_final: dt_final};

// chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros);
    });

});




$(function () {

// Daqui pra baixo são arqivos para realizar a consulta por data_carga
// pagina consulta_data_carga.php


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


    $(document).on('click', '#id_consulta_data_carga', function (e) {
//limpo mensagem de erro
        $("#msg_erro").html('');

//        carrego paramtros do formulario
        var dt_inicial = $('#id_dt_inicial').val();
        var dt_final = $('#id_dt_final').val();


//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/consulta/consulta_data_carga.php'
        var parametros = {dt_inicial: dt_inicial, dt_final: dt_final};

// chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros);
    });

});




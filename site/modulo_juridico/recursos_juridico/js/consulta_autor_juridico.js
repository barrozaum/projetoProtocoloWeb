$(function () {

    $(document).on('click', '#id_buscar_autor', function (e) {
//limpo mensagem de erro
        $("#msg_erro").html('');

//        carrego paramtros do formulario
        var autor_processo = $('#id_autor_processo').val();
        var dt_inicial = $('#id_dt_inicial').val();
        var dt_final = $('#id_dt_final').val();


// valido o requerente
        if (autor_processo.length < 3) {
            $("#msg_erro").html('<div class="alert alert-danger">POR FAVOR PREENCHA O AUTOR DO PROCESSO CORRETAMENTE !! </div>');
            return false;
        }

//passo o parametro pra onde deve ir buscar
        var url = 'recursos_juridico/includes/consulta/consulta_autor_processo.php'
        var parametros = {autor_processo: autor_processo, dt_inicial: dt_inicial, dt_final: dt_final};
        var listar = "listar";
        $("#" + listar).html('<div style="margin-top:50px; margin-left:50%"><img src="../recursos/imagens/ajax-loader.gif" alt="carregando" title="carregando" width="20px"></div>');

// chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros, listar);
    });

    $(document).on('click', '#id_consultar_processo', function (e) {
        e.preventDefault();

        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos_juridico/includes/formulario/formulario_modal_consulta_dados_processo_juridico.php',
                {id: 2,
                 codigo: $(this).attr('data-id')
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );
    });
});
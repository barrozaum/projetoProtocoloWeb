$(function () {
    // quando o campo código sofrer alteração executo
    $(document).on('blur', "#id_numero_processo", function (e) {

// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
        var valor = preencheZeros(this.value, 6);
//    comparo se o valor é menor que
        if (valor < '000001') {
//        zero o campo cdigo
            $(this).val('000000');

        } else {
//        atribuo o valor informado pelo usario no campo
            $(this).val(valor);

        }

    });
    // quando o campo código sofrer alteração executo
    $(document).on('blur', "#id_numero_anexo", function (e) {

// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
        var valor = preencheZeros(this.value, 6);
//    comparo se o valor é menor que
        if (valor < '000001') {
//        zero o campo cdigo
            $(this).val('000000');

        } else {
//        atribuo o valor informado pelo usario no campo
            $(this).val(valor);

        }

    });

// quando o campo código sofrer alteração executo
    $(document).on('blur', "#id_ano_processo", function (e) {
// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
        var valor = preencheZeros(this.value, 4);
//    comparo se o valor é menor que
        if (valor < '2000') {
//        zero o campo cdigo
            $(this).val('2000');

        } else {
//        atribuo o valor informado pelo usario no campo
            $(this).val(valor);

        }

    });

// quando o campo código sofrer alteração executo
    $(document).on('blur', "#id_ano_anexo", function (e) {
// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
        var valor = preencheZeros(this.value, 4);
//    comparo se o valor é menor que
        if (valor < '2000') {
//        zero o campo cdigo
            $(this).val('2000');

        } else {
//        atribuo o valor informado pelo usario no campo
            $(this).val(valor);

        }

    });

    $(document).on('click', '#id_consulta_numero', function (e) {
        e.preventDefault();

//valores buscado no frmulario
        var tipo_processo = $('#id_tipo_processo').val();
        var numero_processo = $('#id_numero_processo').val();
        var ano_processo = $('#id_ano_processo').val();
        var msg = "";

        if (tipo_processo < 1) {
            msg += "TIPO PROCESSO INVÁLIDO !!! <BR />";
        }

        if (numero_processo < 1) {
            msg += "NÚMERO PROCESSO INVÁLIDO !!! <BR />";
        }

        if (ano_processo.length != 4) {
            msg += "ANO INVÁLIDO !!! <BR />";
        }

        if (msg !== "") {
            $('#msg_erro').html('<div class="alert alert-danger">' + msg + '</div>');
            return false;
        } else {
            $('#msg_erro').html('');

            var url = 'recursos/includes/consulta/consulta_cadastro_apenso.php'
            var parametros = {numero: numero_processo, ano: ano_processo, tipo: tipo_processo};
            var listar = "listar";
            $("#" + listar).html('<div style="margin-top:50px; margin-left:50%"><img src="recursos/imagens/ajax-loader.gif" alt="carregando" title="carregando" width="20px"></div>');

// chamo a função que irá pesquisar o valor
            funcao_retorna_pesquisa(url, parametros, listar);
        }
    });

    $(document).on('click', '#id_prosseguir_com_apenso', function (e) {
        var insere_exclui = $("#id_insere_exclui").val();
        var id_apensado = $("#id_apensado").val();
        var id_processo = $("#id_processo").val();
        var numero_processo = $("#id_numero_processo").val();
        var ano_processo = $("#id_ano_processo").val();
        var tipo_processo = $("#id_tipo_processo").val();
        var parametros = {id_insere_exclui: insere_exclui, id_programa: 1, apensado : id_apensado, codigo: id_processo, numero: numero_processo, ano: ano_processo, tipo: tipo_processo};
        var url = 'recursos/includes/apenso/adicionar_apenso.php';
        var listar = "prosseguindo";
        $("#" + listar).html('<div style="margin-top:50px; margin-left:50%"><img src="recursos/imagens/ajax-loader.gif" alt="carregando" title="carregando" width="20px"></div>');
//      chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros, listar);

    });

//função que verifica se o processo pode ser apensado ou nao 
    $(document).on('click', "#id_vericar_processo_anexo", function (e) {
//      processo que vai ser anexado 
        var numero_anexo = $("#id_numero_anexo").val();
        var ano_anexo = $("#id_ano_anexo").val();
        var tipo_anexo = $("#id_tipo_anexo").val();



//        processo pai
        var numero_processo = $("#id_numero_processo").val();
        var ano_processo = $("#id_ano_processo").val();
        var tipo_processo = $("#id_tipo_processo").val();

        if (numero_processo === numero_anexo && ano_processo === ano_anexo && tipo_processo === tipo_anexo) {
            alert("ATENÇÃO PROCESSO NAO PODE SER APENSADO NELE MESMO !!! ");
            return false;
        }

        if (numero_anexo.length < 6 || numero_anexo === '000000') {
            alert("NUMERO PROCESSO INVÁLIDO");
            return false;
        }
        if (ano_anexo.length < 4 || ano_anexo === '0000') {
            alert("ANO PROCESSO INVÁLIDO");
            return false;
        }
        if (tipo_anexo.length < 1 || tipo_anexo === '0') {
            alert("TIPO PROCESSO INVÁLIDO");
            return false;
        }


        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_modal_apensando_processo.php',
                {
                    id: 1,
                    txt_tipo_processo: tipo_anexo,
                    txt_numero_processo: numero_anexo,
                    txt_ano_processo: ano_anexo,
                    codigo_setor_usuario_carga: 1
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );

///        limpo campo
        $("#id_numero_anexo").val('');
        $("#id_ano_anexo").val('');
        selecionar('id_tipo_anexo', 0);
    });


//adicionando numero do apenso na tabela 
    $(document).on('click', '#id_btn_enviar_apenso', function (e) {

        var apenso_anexo = $("#id_conf_apenso_anexo").val();
        var codigo_anexo = $("#id_conf_id_anexo").val();
        var numero_anexo = $("#id_conf_numero_anexo").val();
        var ano_anexo = $("#id_conf_ano_anexo").val();
        var tipo_anexo = $("#id_conf_tipo_anexo").val();
        if (tipo_anexo == 1) {
            tipo_anexo = "PROCESSO INTERNO";
        } else {
            tipo_anexo = "PROCESSO EXTERNO";
        }

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td>' +
                '<input type="hidden" class="form-control" name ="txt_array_codigo_anexo[]"  required="true" value="' + codigo_anexo + '" maxlength="11" placeholder="" readonly="true"/>' +
                '<input type="text" class="form-control" name ="txt_array_tipo_anexo[]" required="true" value="' + tipo_anexo + '" maxlength="12" placeholder="" readonly="true"/>' +
                '</td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_array_numero_anexo[]" required="true" value="' + numero_anexo + '" maxlength="12" placeholder="" readonly="true"/></td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_array_ano_anexo[]"  required="true" value="' + ano_anexo + '" maxlength="12" placeholder="" readonly="true"/></td>';
        cols += '<td class="actions">';
        cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
        cols += '</td>';

        newRow.append(cols);

        $("#id_tabela_apenso").append(newRow);
    });

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest('tr');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };



// quando eu apertar o botao para apensar antes 
// eu limpo o formulario para escolher processo 
// para apenso
    $(document).on('click', '#id_realizar_apenso', function (e) {

///        limpo campo
        $("#id_numero_anexo").val('');
        $("#id_ano_anexo").val('');
        selecionar('id_tipo_anexo', 0);

        $("#id_fomr_apenso").submit();
    });

});
(function ($) {

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest('tr');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };

    btn_AddTableRow = function () {
        $('#msg_doc_erro').html('');

        var id_codigo_documento = $("#id_codigo_documento").val();
        var id_descricao_documento = $("#id_documento").val();
        var id_numero_documento = $("#id_numero_documento").val();
        var id_ano_documento = $("#id_ano_documento").val();

//        validando campos
        var msg = "";

        if (id_descricao_documento.length < 3 || id_descricao_documento.length > 50) {
            msg += "POR FAVOR VERIFIQUE O DOCUMENTO !!! <BR />";
        }

        if (id_numero_documento.length < 1 || id_numero_documento.length > 11) {
            msg += "POR FAVOR VERIFIQUE O NÚRMERO DO DOCUMENTO !!! <BR />";
        }
        if (id_ano_documento.length !== 4) {
            msg += "POR FAVOR VERIFIQUE O ANO DO DOCUMENTO !!! <BR />";
        }

        if (msg !== "") {
            $('#msg_doc_erro').html('<div class="alert alert-danger">' + msg + '</div>');
        } else {
            inserir_linha_tabela(id_codigo_documento, id_descricao_documento, id_numero_documento, id_ano_documento);
        }
    };


    AddTableRow = function (id_codigo_documento, id_descricao_documento, id_numero_documento, id_ano_documento) {



        inserir_linha_tabela(id_codigo_documento, id_descricao_documento, id_numero_documento, id_ano_documento);
    };

    function inserir_linha_tabela(id_codigo_documento, id_descricao_documento, id_numero_documento, id_ano_documento) {


        var newRow = $("<tr>");
        var cols = "";

        cols += '<td>' +
                '<input type="hidden" class="form-control" name ="txt_id_doc[]"  required="true" value="' + id_codigo_documento + '" maxlength="11" placeholder="" readonly="true"/>' +
                '<input type="text" class="form-control" name ="txt_doc[]" required="true" value="' + id_descricao_documento + '" maxlength="12" placeholder="" readonly="true"/>' +
                '</td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_numero_doc[]" required="true" value="' + id_numero_documento + '" maxlength="12" placeholder="" readonly="true"/></td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_ano_doc[]"  required="true" value="' + id_ano_documento + '" maxlength="12" placeholder="" readonly="true"/></td>';

        cols += '<td class="actions">';
        cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
        cols += '</td>';

        newRow.append(cols);

        $("#tabela-contrato").append(newRow);

        //zero campos
        $("#id_codigo_documento").val("");
        $("#id_documento").val("");
        $("#id_numero_documento").val("");
        $("#id_ano_documento").val("");

        return false;


    }
    ;

})(jQuery);

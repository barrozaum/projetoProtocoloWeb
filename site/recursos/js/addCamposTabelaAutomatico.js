(function ($) {

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest('tr');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };

    btn_AddTableRow = function () {


        inserir_linha_tabela();

    };


    function inserir_linha_tabela() {
   
//        var options = .appendTo();
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td>' + $("select").clone() + '</td>';

        cols += '<td>      <input type="file" class="form-control" name ="txt_arquivo_doc[]" required="true" value="" placeholder="" readonly="true"/>';

        cols += '<td>     <input type="text" class="form-control" name ="txt_descricao_doc[]"  required="true" value="" maxlength="12" placeholder="" readonly="true"/></td>';

        cols += '<td class="actions">';
        cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
        cols += '</td>';

        newRow.append(cols);

        $("#tabela-contrato").append(newRow);

        //zero campos
        $('#msg_doc_erro').html("");

        return false;


    }
    ;

})(jQuery);
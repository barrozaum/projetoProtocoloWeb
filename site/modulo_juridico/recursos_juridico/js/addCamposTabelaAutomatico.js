(function ($) {

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest('tr');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };

    btn_AddTableRow = function () {
       var newRow = $("<tr>");
        var cols = "";

        cols += '<td>     <input type="file" class="form-control" name ="txt_documento[]" required="true" value=""  placeholder="" /></td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_descricao_documento[]" required="true" value="" maxlength="50" placeholder="DESCRIÇÃO DOCUMENTO" /></td>';
     
        cols += '<td class="actions">';
        cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
        cols += '</td>';

        newRow.append(cols);

        $("#tabela-contrato").append(newRow);

        return false;

    };



})(jQuery);

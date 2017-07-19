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
        
        var url = 'recursos/includes/consulta/consulta_assunto.php'
        var parametros = {numero: numero_processo, ano: ano_processo, tipo: tipo_processo};
        var listar = "listar";
        $("#"+listar).html('<div style="margin-top:50px; margin-left:50%"><img src="recursos/imagens/ajax-loader.gif" alt="carregando" title="carregando" width="20px"></div>');

// chamo a função que irá pesquisar o valor
        funcao_retorna_pesquisa(url, parametros, listar);
        }
    });
});

$(function () {

    $(document).on('click', '#id_transforma_judicial', function (e) {
//        limpar mensagem de erro
        $("#msg_erro").html("");

//        variaveis
        var numero_processo_judicial = $("#id_numero_processo_judicial").val();
        var prazo = $("#id_dt_final").val();
        var data_inicial_judicial = $("#id_dt_inicial").val();
        var acao_processo_judicial = $("#id_acao_processo_judicial").val();
        var autor_processo_judicial = $("#id_autor_processo_judicial").val();
        var reu_processo_judicial = $("#id_reu_processo_judicial").val();
       
//        erro
        var msg_erro = "";

        if (numero_processo_judicial.length < 3 || numero_processo_judicial.length > 12) {
            msg_erro += "NÚMERO PROCESSO JUDICIAL INVÁLIDO !!! <br />";
        }
        if (data_inicial_judicial.length !== 10) {
            msg_erro += "DATA PROCESSO JUDICIAL INVÁLIDO !!! <br />";
        }
        if (acao_processo_judicial.length < 3 || acao_processo_judicial.length > 50) {
            msg_erro += "AÇÃO JUDICIAL INVÁLIDA !!! <br />";
        }
        if (autor_processo_judicial.length < 3 || autor_processo_judicial.length > 50) {
            msg_erro += "AUTOR AÇÃO JUDICIAL INVÁLIDA !!! <br />";
        }
        if (reu_processo_judicial.length < 3 || reu_processo_judicial.length > 50) {
            msg_erro += "RÉU AÇÃO JUDICIAL INVÁLIDA !!! <br />";
        }
        if (prazo.length !== 10) {
            msg_erro += "PRAZO PROCESSO JUDICIAL INVÁLIDO !!! <br />";
        }else{
            var objDate = new Date();
            objDate.setYear(prazo.split("/")[2]);
            objDate.setMonth(prazo.split("/")[1] - 1);//- 1 pq em js é de 0 a 11 os meses
            objDate.setDate(prazo.split("/")[0]);

            if (objDate.getTime() <= new Date().getTime()) {
                msg_erro += "PRAZO NÃO PODE SER MENOR OU IGUAL DIA ATUAL !!! <br />";
            }
        }
        
        if (msg_erro !== "") {
            $("#msg_erro").html("<div class='alert alert-danger'>" + msg_erro + "</div");
        }else{
            $("#id_formulario_processo").submit();
        }

    });

    $(document).on('blur', '#id_ano_processo_judicial', function(e){
        var ano = $(this).val();
        $(this).val(preencheZeros(ano, 4));
    });

});
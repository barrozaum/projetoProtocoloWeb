// quando o campo código sofrer alteração executo
$(document).on('blur', "#id_numero_protocolo", function (e) {
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
$(document).on('blur', "#id_numero_processo_protocolo", function (e) {
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
$(document).on('blur', "#id_ano_processo_protocolo", function (e) {
// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
    var valor = preencheZeros(this.value, 4);
//    comparo se o valor é menor que
    if (valor < 2000) {
//        zero o campo cdigo
        $(this).val('2000');

    } else {
//        atribuo o valor informado pelo usario no campo
        $(this).val(valor);

    }

});

// quando o campo código sofrer alteração executo
$(document).on('blur', "#id_ano_protocolo", function (e) {
// pego o valor informado no campo
// coloco no formato correto 
// atribuo o valor formatado na variavel valor
    var valor = preencheZeros(this.value, 4);
//    comparo se o valor é menor que
    if (valor < '0001') {
//        zero o campo cdigo
        $(this).val('0000');

    } else {
//        atribuo o valor informado pelo usario no campo
        $(this).val(valor);

    }

    controllerAcao();
});



// controla qual ação vai ter o formulário
function controllerAcao() {
    $("#msg").html('');
    $("#msg_erro").html('');
    $("#divButonn").html('');
    limparCampos("");
    var param1 = $('#id_numero_protocolo').val();
    var param2 = $('#id_ano_protocolo').val();


    if (param1 === "" || param2 === "" || param1 < '000001' || param2 < '1990') {
        cadastrar();
    } else {
        alterar(param1, param2);

    }
}


//busca o próximo valor a ser inserido no banco de dados
function cadastrar() {
    $("#formularioOficio").attr({"action": "recursos/includes/cadastrar/cadastrar_protocolo.php"});

    limparCampos('');
//    adiciono a uma variavel local o valor passado 
    var op = 1;
//    zero a div de erro 
    $("#msg").html('');
//    faç
    $.ajax({
//      Requisição pelo Method POST
        method: "POST",
//      url para o arquivo para validação
        url: "recursos/includes/funcoes/func_retorna_protocolo.php",
//      dados passados
        data: {
            op: op
        },
        // dataType json
        dataType: "json",
        // função para de sucesso
        success: function (data) {
            $("#msg").html('<div class="alert alert-success" style="text-align:center; font-size:15px;"><strong>Cadastrar </strong></div>');
            $("#id_numero_protocolo").val(data.numero_protocolo);
            $("#id_ano_protocolo").val(data.ano_protocolo);
            $("#divButonn").html(' <button type="button" class="btn btn-success" id="btn_inserir_protocolo" >Cadastrar</button>');

        }, error: function (error) {
            console.log(error.responseText);
        }

    }); //termina o ajax

}


function limparCampos(valor) {
    $('#id_requerente').val(valor);
    $('#id_codigo_requerente').val(valor);
    $('#id_tel_fixo').val(valor);
    $('#id_tel_cel').val(valor);
    $('#id_cep_requerente').val(valor);
    $('#id_logradouro_requerente').val(valor);
    $('#id_bairro_requerente').val(valor);
    $('#id_cidade_requerente').val(valor);
    $('#id_uf_requerente').val(valor);
    $('#id_numero_requerente').val(valor);
    $('#id_complemento_requerente').val(valor);
    $('#id_assunto').val(valor);
    $('#id_codigo_assunto').val(valor);
    $('#id_origem').val(valor);
    $('#id_codigo_origem').val(valor);
    $('#id_obs_protocolo').val(valor);
    $('#id_numero_processo_protocolo').val(valor);
    $('#id_ano_processo_protocolo').val('2017');
    selecionar("id_tipo_processo", "0");
    
    

}



// VALIDANDO DADOS DO FORMULARIO
$(document).on('click', "#btn_inserir_protocolo", function (e) {

//    variaveis
    var msg = "";
    var requerente = $('#id_requerente').val();
    var assunto = $('#id_assunto').val();
    var origem = $('#id_origem').val();

    if (requerente.length < 3 || requerente.length > 50) {
        msg += "POR FAVOR INFORME REQUERENTE VÁLIDO !!!<br /> ";
    }
    if (assunto.length < 3 || assunto.length > 50) {
        msg += "POR FAVOR INFORME ASSUNTO VÁLIDO !!! <br />";
    }
    if (origem.length < 3 || origem.length > 50) {
        msg += "POR FAVOR INFORME ORIGEM VÁLIDA !!! <br /> ";
    }

    if (msg !== "") {
        $("#msg_erro").html("<div class='alert alert-danger'>" + msg + "</div>");
    } else {

        $('#formularioOficio').submit();
    }
});


// retorna com o itbi já cadastrado
function alterar(param1, param2) {
    $("#formularioItbi").attr({"action": "recursos/includes/alterar/alterar_protocolo.php"});
//    adiciono a uma variavel local o valor passado 
    var op = 2;
//    zero a div de erro 
    $("#msg").html('');

    $.ajax({
//      Requisição pelo Method POST
        method: "POST",
//      url para o arquivo para validação
        url: "recursos/includes/funcoes/func_retorna_protocolo.php",
//      dados passados
        data: {
            op: op,
            numero_protocolo: param1,
            ano_protocolo: param2
        },
        // dataType json
        dataType: "json",
        // função para de sucesso
        // Adquirente --

        success: function (data) {
           $("#msg").html(data);
            if (data.achou == 1) {
                $("#formularioOficio").attr({"action": "recursos/includes/alterar/alterar_protocolo.php"});
                
                $("#msg").html('<div class="alert alert-info" style="text-align:center; font-size:15px;"><strong>ALTERAR </strong></div>');
//                preenchendo o formulario
                $("#id_assunto").val(data.assunto_protocolo);
                $("#id_requerente").val(data.requerente_protocolo);
                $("#id_obs_protocolo").val(data.observacao_protocolo);
                $("#id_origem").val(data.origem_protocolo);
                selecionar('id_tipo_processo', data.tipo_processo);
                $("#id_numero_processo_protocolo").val(data.numero_processo);
                $("#id_ano_processo_protocolo").val(data.ano_processo);
//                fim dados formulario
                $("#divButonn").html(' <button type="button" class="btn btn-info" id="btn_inserir_protocolo" >Alterar </button>');

            } else {
                $("#formularioOficio").attr({"action": "recursos/includes/cadastrar/cadastrar_protocolo.php"});
                $("#msg").html('<div class="alert alert-success" style="text-align:center; font-size:15px;"><strong>Cadastrar </strong></div>');
                $("#divButonn").html(' <button type="button" class="btn btn-success" id="btn_inserir_protocolo" >Cadastrar </button>');

            }
        }, error: function (error) {
             $("#msg").html(error.responseText);
        }

    }); //termina o ajax


}



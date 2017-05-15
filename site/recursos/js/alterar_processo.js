//troca o numero do processo de acordo com o tipo do processo
$(document).on('blur', '#id_ano_processo', function (e) {

    var tipo_processo = $('#id_tipo_processo').val();
    var ano_processo = $('#id_ano_processo').val();
    var numero_processo = $('#id_numero_processo').val();

    var msg_erro = "";

    if (tipo_processo < 1) {
        msg_erro += "TIPO PROCESSO INVÁLIDO !!! <BR />";
    }

    if (numero_processo < 1) {
        msg_erro += "NÚMERO PROCESSO INVÁLIDO !!! <BR />";
    }

    if (ano_processo.length < 4) {
        msg_erro += "ANO PROCESSO INVÁLIDO !!! <BR />";
    }

    if (msg_erro !== "") {
        $("#msg_erro").html('<div class="alert alert-danger">' + msg_erro + '</div>');
    } else {
       limpar_formulario();




//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/funcoes/func_retorna_dados_processo.php'
        var parametros = {cmd: 'dados_processo',
            numero: numero_processo,
            ano: ano_processo,
            tipo: tipo_processo
        };

// chamo a função que irá pesquisar o valor
        fun_retorna_dados_processo(url, parametros);
    }
});




$(document).on('click', '#id_btn_enviar_processo', function(e){
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
    var assunto_processo = $('#id_assunto').val();
    var origem_processo = $('#id_origem').val();
    var requerente_processo = $('#id_requerente').val();
    var tel = $('#id_tel_fixo').val();
    var cel = $('#id_tel_cel').val();
//   alert(tipo_processo);
    
    var msg_erro = "";
    
    if(tipo_processo < 1){
        msg_erro += "TIPO PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(numero_processo < 1){
        msg_erro += "NÚMERO PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(ano_processo.length < 4){
        msg_erro += "ANO PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(assunto_processo.length < 3 || assunto_processo.length > 50){
        msg_erro += "ASSUNTO PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(origem_processo.length < 3 || origem_processo.length > 50){
        msg_erro += "ORIGEM PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(requerente_processo.length < 3 || requerente_processo.length > 50){
        msg_erro += "REQUERENTE PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(tel.length < 12 && cel.length < 13){
        msg_erro += "POR FAVOR INFORME O TELEFONE DO REQUERENTE !!! <BR />";
    }
    
    
    if(msg_erro !== ""){
        $("#msg_erro").html('<div class="alert alert-danger">' + msg_erro + '</div>');
    }else{
        $('#id_formulario_processo').submit();
    }
});



function limpar_formulario(){
    $('#msg_erro').html('');
//codigo_processo
    $('#id_codigo_processo').val('');
    
//    assunto
    $('#id_assunto').val('');
    $('#id_codigo_assunto').val('');
    $('#id_complemento_assunto').val('');
//    origem
    $('#id_origem').val('');
    $('#id_codigo_origem').val('');
//    requerente
    $('#id_codigo_requerente').val('');
    $('#id_requerente').val('');
    $('#id_tel_fixo').val('');
    $('#id_tel_cel').val('');
    $('#id_cep_requerente').val('');
    $('#id_logradouro_requerente').val('');
    $('#id_bairro_requerente').val('');
    $('#id_cidade_requerente').val('');
    $('#id_uf_requerente').val('');
    $('#id_numero_requerente').val('');
    $('#id_complemento_requerente').val('');
    
// documentos
    $('#id_documento').val('');
    $('#id_codigo_documento').val('');
    $('#id_numero_documento').val('');
    $('#id_ano_documento').val('');
    $('#id_tabela_documentos').html('');
    
//    observaçao
    $('#id_obs_processo').val('');

}
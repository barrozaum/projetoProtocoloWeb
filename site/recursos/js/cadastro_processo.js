//troca o numero do processo de acordo com o tipo do processo

$(document).on('change', '#id_tipo_processo', function (e) {
    var tipo = $("#id_tipo_processo").val();
    var data = new Date();
    var ano_atual = data.getYear()
    if (ano_atual < 1000)
        ano_atual += 1900;


    if (tipo === '0') {
        $("#id_numero_processo").val('');
        $("#id_ano_processo").val(ano_atual);
    } else {
       
//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/funcoes/func_retorna_tipos_processos_existentes.php'
        var parametros = {cmd: 'proximo_valor', tipo: tipo};

// chamo a função que irá pesquisar o valor
         fun_retorna_proximo(url, parametros);
    }
}); 


$(document).on('click', '#id_btn_enviar_processo', function(e){
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
    var assunto_processo = $('#id_codigo_assunto').val();
    var origem_processo = $('#id_codigo_origem').val();
    var requerente_processo = $('#id_codigo_requerente').val();
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
    
    if(assunto_processo < 1){
        msg_erro += "ASSUNTO PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(origem_processo < 1){
        msg_erro += "ORIGEM PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(requerente_processo < 1){
        msg_erro += "REQUERENTE PROCESSO INVÁLIDO !!! <BR />";
    }
    
    if(msg_erro !== ""){
        $("#msg_erro").html('<div class="alert alert-danger">' + msg_erro + '</div>');
    }else{
         
//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/funcoes/func_retorna_tipos_processos_existentes.php'
        var parametros = {cmd: 'validar_processo', numero_processo: numero_processo, ano_processo: ano_processo, tipo_processo : tipo_processo };
        var retorno = "";
        
       fun_retorna_existencia_processo(url , parametros, retorno);
       
    }
//      $("#msg_erro").html(msg_erro);
});

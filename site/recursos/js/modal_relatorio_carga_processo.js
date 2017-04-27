$(document).on('click', '#id_gerar_relatorio', function (e) {
    e.preventDefault();


//valores buscado no frmulario
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
//    mensagem de erro
    var msg = "";

    if (tipo_processo < 1) {
        msg += "POR FAVOR ENTRE COM O TIPO PROCESSO VÁLIDO !!! \n";
    }

    if (numero_processo < 1) {
        msg += "POR FAVOR ENTRE COM O NÚMERO PROCESSO VÁLIDO !!! \n";
    }

    if (ano_processo.length !== 4) {
        msg += "POR FAVOR ENTRE COM O ANO PROCESSO VÁLIDO !!! \n";
    }

    if (msg !== "") {
        alert(msg);
        return false;
    }else{
           
//passo o parametro pra onde deve ir buscar
        var url = 'recursos/includes/funcoes/func_retorna_tipos_processos_existentes.php'
        var parametros = {cmd: 'validar_processo', numero_processo: numero_processo, ano_processo: ano_processo, tipo_processo : tipo_processo };
        var retorno = "";
        
       fun_valida_existencia_processo_formulario(url , parametros, retorno);
       
    
    }


});

$(document).on('click', '#id_consulta_numero', function (e) {
    e.preventDefault();

//valores buscado no frmulario
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
    var codigo_setor_usuario_carga = $('#id_alterar_colaborador_codigo_setor').val();

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
    if (codigo_setor_usuario_carga < 1) {
        msg += "POR FAVOR ENTRE COM O SETOR ORIGEM VÁLIDO !!! \n";
    }

    if (msg !== "") {
        alert(msg);
        return false;
    }

    $(".modal-content").html('');
    $(".modal-content").addClass('loader');
    $("#dialog-example").modal('show');
    $.post('recursos/includes/formulario/formulario_modal_recebimento_individual.php',
            {
                id: 1,
                txt_tipo_processo: tipo_processo,
                txt_numero_processo: numero_processo,
                txt_ano_processo: ano_processo,
                codigo_setor_usuario_carga : codigo_setor_usuario_carga
            },
    function (html) {
        $(".modal-content").removeClass('loader');
        $(".modal-content").html(html);
    }
    );
});

//função para efetuar validação
$(document).on('click', '#id_btn_enviar_carga', function(e){
  var codigo_processo =   $('#id_codigo_processo').val();
  var codigo_ultima_carga=   $('#id_carga').val();
  var msg = "";
  
  
  if(codigo_processo < 1 ){
      msg += "CÓDIGO PROCESSO INVÁLIDO !!! <br />"; 
  }
  
  if(codigo_ultima_carga < 1){
      msg += "DESCULPE MAIS ALGO DEU ERRADO, POR FAVOR VERIFIQUE AS CARGAS DO PROCESSO !!! <br />";
  }
  
  if(msg !== ""){
      $('#error_modal').html("<div class='alert alert-danger'>" + msg + '</div>');
      return false;
  }else{
      $('#id_formulario_carga').submit();
  }
  
});
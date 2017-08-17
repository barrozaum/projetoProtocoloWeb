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



//função que verifica se o processo pode ser apensado ou nao 
    $(document).on('click', "#id_vericar_processo", function (e) {
//      processo que vai ser anexado 
        var numero_processo = $("#id_numero_processo").val();
        var ano_processo = $("#id_ano_processo").val();
        var tipo_processo = $("#id_tipo_processo").val();


        if (numero_processo.length < 6 || numero_processo === '000000') {
            alert("NUMERO PROCESSO INVÁLIDO");
            return false;
        }
        if (ano_processo.length < 4 || ano_processo === '0000') {
            alert("ANO PROCESSO INVÁLIDO");
            return false;
        }
        if (tipo_processo.length < 1 || tipo_processo === '0') {
            alert("TIPO PROCESSO INVÁLIDO");
            return false;
        }


        $(".modal-content").html('');
        $(".modal-content").addClass('loader');
        $("#dialog-example").modal('show');
        $.post('recursos/includes/formulario/formulario_modal_cadastro_carga.php',
                {
                    id: 1,
                    txt_tipo_processo: tipo_processo,
                    txt_numero_processo: numero_processo,
                    txt_ano_processo: ano_processo,
                    codigo_setor_usuario_carga: 1
                },
        function (html) {
            $(".modal-content").removeClass('loader');
            $(".modal-content").html(html);
        }
        );

///        limpo campo
        $("#id_numero_processo").val('');
        $("#id_ano_processo").val('');
        selecionar('id_tipo_processo', 0);
    });


//adicionando numero do apenso na tabela 
    $(document).on('click', '#id_btn_enviar_processo', function (e) {

        var codigo_processo = $("#id_conf_id_processo").val();
        var numero_processo = $("#id_conf_numero_processo").val();
        var ano_processo = $("#id_conf_ano_processo").val();
        var tipo_processo = $("#id_conf_tipo_processo").val();
        var parecer_processo = $("#id_parecer").val();
        var ultima_carga = $("#id_ultima_carga_processo").val();
        var sequencia_carga = $("#id_num_sequencia_carga").val();
        if (tipo_processo == 1) {
            tipo_processo = "INTERNO";
        } else if (tipo_processo == 2) {
            tipo_processo = "EXTERNO";
        } else {
            tipo_processo = "JURIDICO";
        }

        var newRow = $("<tr>");
        var cols = "";


        cols += '<td>' +
                '<input type="hidden" class="form-control" name ="txt_array_codigo_processo[]"  required="true" value="' + codigo_processo + '" maxlength="11" placeholder="" readonly="true"/>' +
                '<input type="hidden" class="form-control" name ="txt_array_ultima_carga[]" required="true" value="' + ultima_carga + '" maxlength="12" placeholder="" readonly="true"/>' +
                '<input type="hidden" class="form-control" name ="txt_array_sequencia_carga[]" required="true" value="' + sequencia_carga + '" maxlength="12" placeholder="" readonly="true"/>' +
                '<input type="text" class="form-control" name ="txt_array_tipo_processo[]" required="true" value="' + tipo_processo + '" maxlength="12" placeholder="" readonly="true"/>' +
                '</td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_array_numero_processo[]" required="true" value="' + numero_processo + '" maxlength="12" placeholder="" readonly="true"/></td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_array_ano_processo[]"  required="true" value="' + ano_processo + '" maxlength="12" placeholder="" readonly="true"/></td>';
        cols += '<td>     <input type="text" class="form-control" name ="txt_array_parecer_processo[]" required="true" value="' + parecer_processo + '" maxlength="12" placeholder="" readonly="true"/></td>';
        cols += '<td class="actions">';
        cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
        cols += '</td>';


        newRow.append(cols);

        $("#id_tabela_apenso").append(newRow);
    });

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest('tr');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };



// quando eu apertar o botao para cadastrar carga antes 
// eu limpo o formulario para escolher processo 
// para apenso e verifico se existe setor de entrada

    $(document).on('click', '#id_efetuar_carga', function (e) {

///        limpo campo
        $("#id_numero_processo").val('');
        $("#id_ano_processo").val('');
        selecionar('id_tipo_processo', 0);

        var cod_setor_origem = $("#id_alterar_colaborador_codigo_setor").val();
        var cod_setor_entrada = $("#id_codigo_setor").val();
        if(cod_setor_entrada > 0 && cod_setor_origem > 0){
            $("#id_formulario_carga_coletiva").submit();
        } else if(cod_setor_origem < 1 ){
            $("#msg_erro").html("<div class='alert alert-danger'>SELECIONE O SETOR DE ORIGEM </div>")
        }else{
            $("#msg_erro").html("<div class='alert alert-danger'>SELECIONE O SETOR DE DESTINO </div>")
        }

    });



});


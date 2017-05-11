$(document).on('click', '#id_lupa_assunto', function (e) {
    var url = "recursos/includes/selecionar/selecionar_assunto.php?janela=1";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_lupa_documento', function (e) {
    var url = "recursos/includes/selecionar/selecionar_documento.php?janela=1";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_lupa_requerente', function (e) {
    var url = "recursos/includes/selecionar/selecionar_requerente.php?janela=1";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_lupa_setor', function (e) {
    var url = "recursos/includes/selecionar/selecionar_setor.php?janela=1";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_lupa_setor_usuario', function (e) {
    var url = "recursos/includes/selecionar/selecionar_setor.php?janela=3";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});
$(document).on('click', '#id_lupa_origem', function (e) {
    var url = "recursos/includes/selecionar/selecionar_origem.php?janela=1";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_segunda_via_etiqueta', function (e) {
    var tipo_processo = $('#id_tipo_processo').val();
    var numero_processo = $('#id_numero_processo').val();
    var ano_processo = $('#id_ano_processo').val();
    
    
    var url = "recursos/includes/relatorio/relatorio_emissao_segunda_via_etiqueta.php";
    url = url +    "?j=1";
    url = url +    "&t="+tipo_processo;
    url = url +    "&n="+numero_processo;
    url = url +    "&a="+ano_processo;
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});


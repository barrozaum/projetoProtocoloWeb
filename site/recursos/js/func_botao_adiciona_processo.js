$(document).on('click', '#id_add_assunto', function (e) {
    var url = "cadastro_assunto.php";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_add_origem', function (e) {
    var url = "cadastro_origem.php";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_add_requerente', function (e) {
    var url = "cadastro_requerente.php";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});

$(document).on('click', '#id_add_documento', function (e) {
    var url = "cadastro_documento.php";
    window.open(url, 'galeria', 'width=1024,height=508');
    return false;
});
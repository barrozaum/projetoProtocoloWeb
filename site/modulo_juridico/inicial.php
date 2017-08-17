<?php
//valida para saber se o usuário está logado
include "../recursos/includes/estrutura/controle/validar_secao.php";
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Protocolo-Juridico</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="recursos_juridico/css/bootstrap.css" rel="stylesheet">
        <link href="recursos_juridico/css/menu.css" rel="stylesheet">
        <script src="recursos_juridico/js/jquery.min.js"></script>
        <script src="recursos_juridico/js/bootstrap.min.js"></script>
        <script src="recursos_juridico/js/estrutura.js"></script>
        <script src="recursos_juridico/js/inicial_juridico.js"></script>
        <script>
            $(document).ready(function () {
                $('#acessoRapido').load('recursos_juridico/includes/estrutura/acesso_rapido.php');
                $('#modal').load('recursos_juridico/includes/estrutura/modal_grande.html');
            });
        </script>
    </head>
    <body>

        <div id="cabecalho">
            <!-- Não apagar, pois é onde encontra-se o menu do site -->
        </div>
        <div id="acessoRapido">

        </div>

        <div id="modal"></div>
        <hr >
        <div id="rodape">
            <!-- Não apagar, pois é onde encontra-se o rodape da página -->
        </div>
    </body>
</html>

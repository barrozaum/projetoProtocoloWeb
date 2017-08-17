<?php
//valida para saber se o usuário está logado
include "../recursos/includes/estrutura/controle/validar_secao.php";
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Protocolo</title>


        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="recursos_juridico/css/bootstrap.css" rel="stylesheet">
        <link href="recursos_juridico/css/menu.css" rel="stylesheet">
        <script src="recursos_juridico/js/jquery.min.js"></script>
        <script src="recursos_juridico/js/bootstrap.min.js"></script>
        <script src="recursos_juridico/js/estrutura.js"></script>
        <script src="recursos_juridico/js/consulta_prazos_juridico.js"></script>
        <script src="../recursos/js/funcao_consultas.js"></script>
        <script src="../recursos/js/camposNumeros.js"></script>
        <!-- Includes para Colocar o Calendário na data -->
        <link rel="stylesheet" href="../recursos/css/redmond/jquery-ui-1.10.1.custom.css" />
        <script src="../recursos/js/data_calendario.js" type="text/javascript"></script>
        <script src="../recursos/js/calendario.js" type="text/javascript"></script>
        <script src="../recursos/js/mascaraData.js"></script>
        
        <!-- fim dos includes para Colocar a Data -->
            <link rel="stylesheet" href="../recursos/css/jquery.dataTables.min.css">
        <script src="../recursos/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {
                estruturaPagina();
            });

            function estruturaPagina() {
                $('#formulario').load('recursos_juridico/includes/formulario/formulario_consulta_prazo.php');
                $('#modal').load('recursos_juridico/includes/estrutura/modal_grande.html');

            }
        </script>

    </head>
    <body>
        <div id="cabecalho">
            <!-- Não apagar, pois é onde encontra-se o menu do site -->
        </div>

        <div class="container text center">
            <div id="formulario"></div>
        </div>
        <hr />
        <div class="container bg-4 text center">
            <div id="listar"></div>
        </div>

        <div id="modal"></div>
        <hr />
        <div id="rodape">
            <!-- Não apagar, pois é onde encontra-se o rodape da página -->
        </div>
    </body>
</html>
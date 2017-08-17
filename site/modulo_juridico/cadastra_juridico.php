<?php
//valida para saber se o usuário está logado
include_once '../recursos/includes/estrutura/controle/validar_secao.php';
include_once '../recursos/includes/funcoes/function_letraMaiscula.php';
//usandao sessao
$_SESSION['SESSION_TORNAR_JUDICIAL'] = "true";
$_SESSION['PROTOCOLO_ID_PROCESSO'] = letraMaiuscula($_POST['txt_cod_processo']);
$_SESSION['PROTOCOLO_DESCRICAO_TIPO_PROCESSO'] = letraMaiuscula($_POST['txt_tipo_processo']);
$_SESSION['PROTOCOLO_COD_TIPO_PROCESSO'] = letraMaiuscula($_POST['txt_cod_tipo_processo']);
$_SESSION['PROTOCOLO_VALOR_PROCESSO'] = letraMaiuscula($_POST['txt_valor_processo']);
$_SESSION['PROTOCOLO_NUMERO_PROCESSO'] = letraMaiuscula($_POST['txt_numero_processo']);
$_SESSION['PROTOCOLO_ANO_PROCESSO'] = letraMaiuscula($_POST['txt_ano_processo']);
$_SESSION['PROTOCOLO_ORIGEM_PROCESSO'] = letraMaiuscula($_POST['txt_desricao_origem_processo']);
$_SESSION['PROTOCOLO_ASSUNTO_PROCESSO'] = letraMaiuscula($_POST['txt_descricao_assunto_processo']);
$_SESSION['PROTOCOLO_REQUERENTE_PROCESSO'] = letraMaiuscula($_POST['txt_desricao_requerente_processo']);


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
        <script src="recursos_juridico/js/cadastrar_juridico.js"></script>
        <script src="recursos_juridico/js/addCamposTabelaAutomatico.js"></script>
        <script src="recursos_juridico/tinymce/tinymce.min.js"></script>
        <script src="../recursos/js/adiciona_zero.js"></script>
     
        <!-- Includes para Colocar o Calendário na data -->
        <link rel="stylesheet" href="../recursos/css/redmond/jquery-ui-1.10.1.custom.css" />
        <script src="../recursos/js/data_calendario.js" type="text/javascript"></script>
        <script src="../recursos/js/calendario.js" type="text/javascript"></script>
        <script src="../recursos/js/mascaraData.js"></script>
        <!-- fim dos includes para Colocar a Data -->
       
        <script>
            $(document).ready(function () {
                $('#formulario').load('recursos_juridico/includes/formulario/formulario_cadastro_juridico.php');
                $('#modal').load('recursos_juridico/includes/estrutura/modal_grande.html');
            });
            
        </script>
    </head>
    <body>
        <div id="cabecalho">
            <!-- Não apagar, pois é onde encontra-se o menu do site -->
        </div>
        <div class="container text center">
            <div id="formulario">
            </div>
        </div>

        <div id="modal"></div>
        <hr >
        <div id="rodape">
            <!-- Não apagar, pois é onde encontra-se o rodape da página -->
        </div>
    </body>
</html>

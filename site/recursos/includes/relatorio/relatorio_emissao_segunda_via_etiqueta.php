<?php
//validando seccao
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/funcao_formata_data.php';
include_once '../funcoes/func_retorna_assunto.php';
include_once '../funcoes/func_retorna_origem.php';
include_once '../funcoes/func_retorna_requerente.php';
include_once '../funcoes/func_retorna_documento.php';
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
?>



<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
        <meta charset="utf-8" />
        <title>Protocolo</title>
        <link href="../../css/guias_pagamento.css" rel="stylesheet" />
    </head>

    <body>


        <?php
        if ($_SESSION['JANELA_SEGUNDA_VIA'] == "OK") {
            if ($_GET['j'] === '1') {

//        incluindo funcao que gera etiqueta
                include_once '../funcoes/func_emitir_etiqueta_processo.php';

                fun_montar_etiqueta($_GET['t'], $_GET['n'], $_GET['a']);
            }
        }
        ?>




        



    </body>
</html>

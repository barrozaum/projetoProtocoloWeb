<?php
//valida para saber se o usuário está logado
include "recursos/includes/estrutura/controle/validar_secao.php";
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Protocolo</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="recursos/css/bootstrap_error.css" rel="stylesheet">
        <link href="recursos/css/menu.css" rel="stylesheet">

        <script src="recursos/js/jquery.min.js"></script>
        <script src="recursos/js/bootstrap.min.js"></script>
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
        <script src="recursos/js/estrutura.js"></script>

        <script>
            $(document).ready(function () {
                $('#acessoRapido').load('recursos/includes/estrutura/acesso_rapido.php');
            });
        </script>
    </head>
    <body>



        <div class="container alert alert-danger">

            <div class="col-sm-12">
                <div class="panel-group " id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#"> 
                                <h4 class="panel-title text-center" style="color: black">
                                    ERRO GERAÇÃO DE RELATÓRIO
                                </h4>
                            </a>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body ">
                                <h1>OPS, DESCULPE PELO INCONVENIENTE !!! </h1>
                                <p>Infelizmente, algo deu errado no processamento do Relatório.</p>
                                <p>Por favor tente novamente !!!</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>

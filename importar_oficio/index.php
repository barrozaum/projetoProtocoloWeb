<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
        <title>Parvaim</title>	
    </head>
    <div id="externo">


        <?php
        if ($arquivo = fopen("Comparativo.txt", "r")) {

            while (!feof($arquivo)) {
                $linha = fgets($arquivo, 250);
                $dados = explode(";", $linha);


                $data = dataAmericano($dados[0]);
                $numero_oficio = str_pad($dados[1],6,0,STR_PAD_LEFT);
                $origem_oficio = utf8_encode($dados[2]);
                $assunto_oficio = utf8_encode($dados[3]);
                $numero_processo_oficio = $dados[4];

                $sql = "INSERT INTO oficio (numero_oficio, ano_oficio, data_oficio, requerente_oficio, origem_oficio, assunto_oficio,observacao_oficio)";
                $sql = $sql . " VALUES ";
                $sql = $sql . "('{$numero_oficio}', 2017, '{$data}', 'PLANILHA' , '{$origem_oficio}', '{$assunto_oficio}', 'PLANILHA');";

                print $sql;
                PRINT "<BR />";
            }
        }
        ?>
    </body>

</html>


<?php

function dataAmericano($data) {
    if ($data == "" || $data == "00/00/0000") {
        return null;
    } else {
        $partes_data = explode("/", $data);
        $dia = $partes_data[0];
        $mes = $partes_data[1];
        $ano = $partes_data[2];

        //servidor
        return $ano . '-' . $mes . '-' . $dia;
    }
}
?>
<?php

if(!isset($_SESSION))
{
   session_start();
}

//função vai dizer se o processo tem algum anexo 
function fun_retorna_anexo_processo($pdo, $codigo_processo) {
    
}

function fun_limpar_anexos_processo($pdo, $codigo_processo) {
    $sql_limpa_anexo = "UPDATE cadastro_processo SET idAnexo = 0 WHERE idAnexo =" . $codigo_processo;
    if ($executa = $pdo->query($sql_limpa_anexo)) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

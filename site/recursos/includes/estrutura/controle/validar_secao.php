<?php
//abrindo seção no servidor 

if(!isset($_SESSION))
{
   session_start();
}



//limpando váriaveis de sessao
if (isset($_SESSION['NAO_MOSTRAR_SETOR'])) {
    unset($_SESSION['NAO_MOSTRAR_SETOR']);
}

if (!isset($_SESSION["LOGADO_SISTEMA"])) {
    session_destroy();
    header("Location: ../");
    exit();
}
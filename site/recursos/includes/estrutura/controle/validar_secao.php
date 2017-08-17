<?php
//abrindo seção no servidor 
if(!isset($_SESSION))
{
   session_start();
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
 
//limpando váriaveis de sessao
if (isset($_SESSION['NAO_MOSTRAR_SETOR'])) {
    unset($_SESSION['NAO_MOSTRAR_SETOR']);
}

if (!isset($_SESSION["LOGADO_SISTEMA"])) {
    session_destroy();
    header("Location: sessao_expirada.php");
    exit();
}

//error_reporting(0);
<?php
//abrindo seção no servidor 
session_start();

   
if (!isset($_SESSION["LOGADO_SISTEMA"])) {
    session_destroy();
    header("Location: ../");
    exit();
}
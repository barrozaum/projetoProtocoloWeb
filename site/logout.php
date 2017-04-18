<?php 
//inicia e finaliza a sessao e redireciona para a tela de login

session_start();
session_destroy();
header("Location: ../index.php");
?>

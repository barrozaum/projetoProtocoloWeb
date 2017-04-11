<?php
$idUsuario = $_SESSION['idUsuario'];
$idSetorUsuario =$_SESSION['idSetorUsuario'];


if(!$_SESSION['logado'] == "1") {
	echo "<script>location.href='index.php';</script>";
	}

?>

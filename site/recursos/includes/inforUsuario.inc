<div id="mostrarInformUsuario">
<?php


$loginUsuario=$_SESSION['nomeUsuario']; 
$loginUsuario = strtoupper($loginUsuario);

echo"<strong id='loginUsuario'>Usuário :</strong>" . $loginUsuario;

$setorUsuario=$_SESSION['nomeSetorUsuario']; 
$setorUsuario= strtoupper($setorUsuario);

echo"<strong id='setorUsuario'>Setor Usuário :</strong>". $setorUsuario;
?>
</div>

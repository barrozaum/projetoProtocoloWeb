<?php
session_start();

$ipUsuario= $REMOTE_ADDR;

if($ipUsuario != $_SESSION['ipUsuario'])
echo "<script>
alert('Troca de Ip Por Favor logar Novamente');
location.href='index.php';
</script>";
 
?>
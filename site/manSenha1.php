<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		
		<title>Altera Senha</title>
	</head>				
<body>		
<?php						
$login = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['usuarioLogin']);

$pass = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['antigaSenha']);
$pass= sha1($pass);

$nPass = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['novaSenha']);
$nPass= sha1($nPass);



include('recursos/includes/verConexao.inc');
$sql="SELECT * FROM usuario WHERE idUsuario = $login AND senha = '$pass' " ;

$resultado=mysql_query($sql,$conexao) ;
if(mysql_num_rows($resultado) == 0){
?>	
<script>window.alert('Senha Atual Inválida!!!'); location.href="manSenha.php";</script>     
<?php
 }else{
?>						

	<?php 
	include ('recursos/includes/verConexao.inc');
	
	$sql = "UPDATE usuario SET senha = '$nPass' WHERE idUsuario = $login";
	if(mysql_query($sql,$conexao)){
	?>
	<script>window.alert('ALTERADO COM SUCESSO !!!'); location.href="manSenha.php";</script>     
	<?php
	 }else{
	?>
	<script>window.alert('ERRO AO ALTERAR !!!'); location.href="manSenha.php";</script>     
	<?php
	}
	?>
<?php
}
?>						

</body>
</html>										

						
					
				

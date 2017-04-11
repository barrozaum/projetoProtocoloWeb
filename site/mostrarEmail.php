<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>


<?php 
$email = $_REQUEST['email'];
$email = strtoupper($email);



include ('recursos/includes/verConexao.inc');

$sql = "SELECT * FROM usuario WHERE email = '$email'";
if($resultado = mysql_query($sql, $conexao)){
?>
	<?php 
	if(mysql_num_rows($resultado) == 0){
	?>
	<input type='hidden' name='confEmail' value='1' />
	<?php 
	}else{
	?>
	<i>E-MAIL JÁ CADASTRADO</i><input type='hidden' name='confEmail' value='0' />
	<?php
	}
	?>
<?php 
}else{
?>
erro sql
<?php
}
?>
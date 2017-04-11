<?php
session_start();

include ('recursos/includes/verSessao.inc');
?>


<?php 
$novoLogin = $_REQUEST['novoLogin'];
$novoLogin = strtoupper($novoLogin);



include ('recursos/includes/verConexao.inc');

$sql = "SELECT * FROM usuario WHERE login = '$novoLogin'";
if($resultado = mysql_query($sql, $conexao)){
?>
	<?php 
	if(mysql_num_rows($resultado) == 0){
	?>
	<input type='hidden' name='confLogin' value='1' />
	<?php 
	}else{
	?>
	<i>Login já e encontra-se no sistema</i><input type='hidden' name='confLogin' value='0' />
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
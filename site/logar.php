<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilologin.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicaologin.css"/>
		
		
		
		
	<title>Parvaim</title>	
</head>
<body>


<?php 
// trato os valores passados pelos usuários

$l = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['txtlogin']);
$s = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['txtsenha']);
$s= sha1($s);


include('recursos/includes/verConexao.inc'); 

$sql= "SELECT * FROM usuario WHERE login='$l' AND senha='$s'";
if($resultado=mysql_query($sql,$conexao)){
?>
	<?php 

	if(mysql_num_rows($resultado) != 0){	
	
	while($dados= mysql_fetch_array($resultado)){
	$_SESSION['logado']= 1;
	$_SESSION['nomeUsuario'] = $dados['login'];
	$_SESSION['idUsuario'] = $dados['idUsuario'];
	$_SESSION['idSetorUsuario'] = $dados['idSetor'];
	$_SESSION['status'] = $dados['status'];
	}
	?>
	
	<?php
    if ($_SESSION['status'] == 1){
    ?>

    	<script languagem = 'Javascript'>
			alert('Usuário Bloqueado no sistema');
			//location.href='index.php';
		</script>
    <?php 
        }
	?>
	
		<?php 
		
		include('recursos/includes/verConexao.inc'); 
		
		$sql1= "SELECT * FROM setor WHERE idSetor =  $_SESSION[idSetorUsuario] ";
		$resultado1=mysql_query($sql1,$conexao);
		while($dados1 = mysql_fetch_array($resultado1)){
		$_SESSION['nomeSetorUsuario'] = $dados1['setor'];
		$_SESSION['nomeDescDepartamentoUsuario'] = $dados1['descDepartamento'];
		}
		?>
	
		<?php
		include('recursos/includes/verConexao.inc');
		
		$sql1 = "SELECT * FROM permissao WHERE idUsuario = $_SESSION[idUsuario]";
		$resultado1 = mysql_query($sql1, $conexao);
		while($dados1 = mysql_fetch_array($resultado1)){
		$_SESSION['outrasOp'] = $dados1['outrasOp'];
		}
		?> 
		<?php
		$hora = date('H');
			
			
			if($hora <= 12)
			echo "<script languagem = 'Javascript'>
			alert('Bom dia $l');
			location.href='inicial.php';
			</script>";
			
			if(($hora > 12) && ($hora <=18))
			echo "<script languagem = 'Javascript'>
			alert('Boa Tarde $l');
			location.href='inicial.php';
			</script>";
			
			if(($hora > 18) && ($hora <=24))
			echo " <script languagem = 'Javascript'>
			alert('Boa Noite $l');
			location.href='inicial.php';
			</script>";
			?>
	
	
	
	
	
	
	<?php }else {?>

    <script languagem = "Javascript">
	window.alert('Ususário não Encontrado !!');
	location.href="index.php"; </script>
	<?php } ?>


<?php 
}
else 
{
?>
<script languagem = "Javascript">
window.alert('Erro de Conexao !!');
location.href="index.php";</script>
<?php 
}
 ?>
</body>
</html>

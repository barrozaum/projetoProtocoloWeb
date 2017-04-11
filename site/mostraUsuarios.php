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
		
		<?php
		// Inclui o menu do site			
		include('recursos/includes/verScript.inc');	
		?>
		
	<title>Parvaim</title>	
</head>
		
<body>   
<?php 
$u = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['txtLogin']);


include('recursos/includes/verConexao.inc');

$sql = "SELECT * FROM usuario WHERE login like '%$u%'";
$resultado = mysql_query($sql,$conexao);
if(mysql_num_rows($resultado) == 0){
?>
<p>Nenhum Usuário Encontrado !!!</p>
<?php
}else{
?>
	<form name="f1" action = "mostraPermissao.php" method="POST">
	<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
	<table width="100%">
	<thead class="fixedHeader">
	<tr bgcolor="#f5f5dc">
	<th>OP</th>
	<th>LOGIN</th>
	<th>NOME</th>
	<th>E-MAIL</th>
	</tr>
	
	<?php
	$i=0;
	while($dados = mysql_fetch_array($resultado)){
		
		if ($i% 2 == 0)
			$cor = "#CCCCCC";
		else
			$cor = "#FFFFFF";
	?>
	
	
	<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
		<td height="5" align ="center"><input type="radio" name="op" value="<?php echo $dados['idUsuario']; ?>"></td>
		<td height="5" align ="center"><?php echo $dados['login']; ?></td>
		<td height="5" align ="center"><?php echo $dados['nome']; ?></td>
		<td height="5" align ="center"><?php echo $dados['email']; ?></td>
		
	</tr>

	<?php	
	$i++;
	}
	?>
	
	</table>
	</div>	
	<br />
	<p align="center">
	RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong>
	</p>
	
			
	<input type="submit"  value ="    CONSULTAR    ">	
	</form>
	
	
<?php
}
?>
</body>
</html>

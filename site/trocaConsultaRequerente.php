<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


<?php 
$cod = $_REQUEST['requerente'];
?>

<?php 
if($cod == ""){
?>
<input type="text" name="nomeRequerente"  id="nomeRequerente" maxlength="50" size="50px" value="" onKeypress="return carcater();" onchange="zerar()"/> *
<input type="hidden" id="verificaRequerente" value="1">
<?php 
}else{
?>
	
	<?php
	include('recursos/includes/verConexao.inc');
	
	$sql="SELECT * FROM requerente WHERE idRequerente= '$cod'";
	$resultado = mysql_query($sql,$conexao);
	
	if(mysql_num_rows($resultado) == 0){
	?>
		<input type="text" name="nomeRequerente"  id="nomeRequerente" value="Nenhum Requerente Encontrado" maxlength="50" size="50px" value="" onchange="zerar()"/> *
		<input type="hidden" id="verificaRequerente" value="">
	
	<?php
	}else
	while($dados = mysql_fetch_array($resultado)){
	?>
	
		<input type="text" name="nomeRequerente"  id="nomeRequerente" maxlength="50" size="50px" value="<?php echo $dados['requerente']; ?>" onKeypress="return carcater();" onchange="zerar()"/> *
		<input type="hidden" id="verificaRequerente" value="1">
	<?php 
	}
	?>
<?php 
}
?>

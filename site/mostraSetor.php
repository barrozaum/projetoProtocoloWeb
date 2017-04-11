<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


<?php 
$s = $_REQUEST['setorEntrada'];
?>

<?php
 if($s == ""){
?>
<input type="text" name="nomeSetor" id="nomeSetor" value="DESC. DEPARTAMENTO --- SETOR "  size="60px" maxlength = "50" readOnly="true"/> <input type="hidden" id ="verificaSetor" value="1" >
<?php
}else{
?>
	<?php
	include('recursos/includes/verConexao.inc');
	
	$sql = "SELECT * FROM setor WHERE idSetor = $s";
	$resultado = mysql_query($sql,$conexao);
	if(mysql_num_rows($resultado) == 0){
	?>
	
	<input type="text"  name="nomeSetor" id="nomeSetor"  value="SETOR NÃO ENCONTRADO"  size="60px" maxlength = "50"  readOnly='true'/> <input type="hidden" id ="verificaSetor" value=""> 
	<?php
	}else
	while($dados = mysql_fetch_array($resultado)){
	?>
	<input type="text"  name="nomeSetor" id="nomeSetor"  value="<?php echo $dados['descDepartamento']; ?> --- <?php echo $dados['setor']; ?>"  size="60px" maxlength = "50"  readOnly='true'/><input type="hidden" id ="verificaSetor" value="1">
	<?php 
	}
	?>
	
<?php 
}
?>

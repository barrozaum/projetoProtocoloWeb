<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<?php
$origem=$_GET['origem'];

 if($origem== ""){
?>
	<input type='text' value='' id="mostraOrigem2" name="mostraOrigem2" size='70px' maxlength = '50'  onchange="zerar()"/>
	<input type='hidden' id='verificaOrigem' value='1'>
<?php
}else{
?>

	<?php
	include('recursos/includes/verConexao.inc');
	
	$sql="SELECT * FROM origem WHERE idOrigem= $origem" ;
	
	$resultado=mysql_query($sql,$conexao) ;
	if (mysql_num_rows($resultado) == 0){
	?><input type='text' value="Nenhuma Origem Encontrada " id="mostraOrigem2" name="mostraOrigem2" size='70px' maxlength = '50' onchange="zerar()" />
	<input type="hidden" id="verificaOrigem" value="">
	<?php
	}else
	while($dados=mysql_fetch_array($resultado)){
	?>
	<input type='text' id='mostraOrigem2' name='mostraOrigem2'  value='<?php echo $dados['nomeOrigem']; ?>'  size='70px' maxlength = '50' readonly="true" onchange="zerar()"/>
	<input type="hidden" id="verificaOrigem" value="1">
	<?php
	}
	?>
	

<?php
}
?>

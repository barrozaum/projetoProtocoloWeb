<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION[idUsuario];	
$idSetorUsuario =$_SESSION[idSetorUsuario];	

?>


<?php 
$r = $_REQUEST['requerente'];

include('recursos/includes/verConexao.inc');

$sql = "SELECT * FROM requerente WHERE idRequerente = $r";
$resultado = mysql_query($sql,$conexao);
while($dados = mysql_fetch_array($resultado)){
?>

<input type="text"  name="nomeRequerente" id="nomeRequerente" value="<?php echo $dados['requerente']; ?>"  size="70px" maxlength = "50" />

<?php 
}
?>
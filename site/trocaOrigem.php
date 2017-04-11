<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<?php
$origem=$_GET['origem'];

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM origem WHERE idOrigem= $origem" ;

$resultado=mysql_query($sql,$conexao) ;
if (mysql_num_rows($resultado) == 0){
?>

<input type="text" value="NENHUMA ORIGEM ENCONTRADA " name="mostraOrigem2" size="70px" readonly="true"/>
<input type="hidden" name="verificaOrigem" value="">
<?php
}else
while($dados=mysql_fetch_array($resultado)){
?>

<input type='text'  id="mostraOrigem2" name="mostraOrigem2"  value='<?php echo $dados['nomeOrigem']; ?>' readonly="true" size='70px' maxlength = '50' />
<input type="hidden" name="verificaOrigem" value="1">
<?php
}
?>

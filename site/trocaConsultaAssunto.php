<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php

$assunto=$_GET['assunto'];

 if($assunto == ""){
?>

<input type="text" name= "nomeAssunto" id= "nomeAssunto" value="" size="70px" onchange="zerar()" />
<input type='hidden' id='verificaAssunto' value='1'>
<?php
}else{
?>

<?php
include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM assunto WHERE idAssunto = '$assunto'  " ;

$resultado=mysql_query($sql,$conexao) ;
if(mysql_num_rows($resultado)==0){
?>


<input type="text" name= "nomeAssunto" id= "nomeAssunto" value="Nenhum Assunto Encontrado" size="70px" onchange="zerar()" />
<input type='hidden' id='verificaAssunto' value=''>
<?php
}else
while($dados=mysql_fetch_array($resultado)){
?>
<input type="text" name="nomeAssunto" value="<?php echo $dados["nomeAssunto"]; ?>"  id="nomeAssunto"  size="70px" onchange="zerar()" />
<input type='hidden' id='verificaAssunto' value='1'>
<?php
}
?>	

<?php
}
?>	


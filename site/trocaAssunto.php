<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php

$assunto=$_GET['assunto'];

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM assunto WHERE idAssunto = $assunto  " ;

$resultado=mysql_query($sql,$conexao) ;
if(mysql_num_rows($resultado)==0){
?>
<input type="text" name= "nomeAssunto" value="NENHUM ASSUNTO ENCONTRADO" size="70px" readonly="true"/>
<input type='hidden' name='verificaAssunto' value=''>
<?php
}else
while($dados=mysql_fetch_array($resultado)){
?>
<input type="text" name="nomeAssunto" value="<?php echo $dados["nomeAssunto"]; ?>"  id="nomeAssunto"  size="70px" readonly="true"/>
<input type='hidden' name='verificaAssunto' value='1'>
<?php
}
?>	

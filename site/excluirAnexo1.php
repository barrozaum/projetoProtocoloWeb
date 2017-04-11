<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<?php 
//informação do processo que está o anexo,
//mais o processo que está perdendo o vinculo.
include('recursos/includes/verConexao.inc');
$idProcesso = $_REQUEST['Cod'];

$sql = "UPDATE cadastroProcesso SET idAnexo = 0 WHERE idProcesso = $idProcesso";
if(mysql_query($sql,$conexao)){
?>

<script>
window.alert('Desapensado com Sucesso!!');
location.href='apensarAnexo.php';
</script>

<?php 
}else{
?>
<script>
window.alert('Erro ao Desapensar Anexo!!');
location.href='apensarAnexo.php';
</script>
<?php 
}
?>

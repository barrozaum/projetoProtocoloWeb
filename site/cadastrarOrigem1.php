<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php

//Verifica se existe palavras com acentos e troca para ficar sem

$descricao = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['descricao']);
$cod = preg_replace("/[^0-9]/", "", $_REQUEST['cod']);
?>

<script>opener.f1.codOrigem.value="<?php echo $cod; ?>";
	opener.f1.mostraOrigem2.value="<?php echo $descricao; ?>";
	opener.f1.verificaOrigem.value="1";
</script>
<?php
include('recursos/includes/verConexao.inc');

$sql="INSERT INTO origem (idOrigem,nomeOrigem,idUsuario) VALUES ($cod,'$descricao',$idUsuario)";

if(mysql_query($sql,$conexao)){
	echo "<script language='JavaScript'> window.alert('ORIGEM CADASTRADO COM SUCESSO !!!');</script>";
	echo "<script>window.close();</script>";
}else{
	echo "<script language='JavaScript'> window.alert('ERRO AO CADASTRAR ORIGEM !!!');</script>";
	echo "<script>window.close();</script>";
}
	
?>

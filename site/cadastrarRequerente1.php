<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION['idUsuario'];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<?php 
$requerente = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['requerente']);

$logradouro = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['logradouro']);

$numero = $_REQUEST['numero_end'];

$complemento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['complemento']);
 
$bairro = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['bairro']);

$cidade = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['cidade']);

$uf = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['uf']);

$cep =$_POST['cep'];
$tel =$_POST['tel'];
$cod =$_POST['cod'];
$cel =$_POST['cel'];
?>


<script language = "javascript">
opener.f1.codRequerente.value="<?php echo $cod; ?>";
opener.f1.nomeRequerente.value="<?php echo $requerente; ?>";
opener.f1.numero_end.value="<?php echo $numero; ?>";
opener.f1.logradouro.value="<?php echo $logradouro; ?>";
opener.f1.bairro.value="<?php echo $bairro; ?>";
opener.f1.complemento.value="<?php echo $complemento; ?>";
opener.f1.cidade.value="<?php echo $cidade; ?>";
opener.f1.uf.value="<?php echo $uf; ?>";
opener.f1.cep.value="<?php echo $cep; ?>";
opener.f1.tel.value="<?php echo $tel; ?>";

opener.f1.verificaRequerente.value="1";
</script>



<?php 
include('recursos/includes/verConexao.inc');
		     	 
$sql="insert into requerente(idRequerente,requerente,logradouro,numeroEnd,complemento, bairro,cidade,uf,cep,tel,cel,idUsuario ) values ($cod,'$requerente','$logradouro','$numero','$complemento','$bairro','$cidade','$uf','$cep','$tel','$cel',$idUsuario)";

if(mysql_query($sql,$conexao)){
          echo "<script language='JavaScript'> window.alert('REQUERENTE CADASTRADO COM SUCESSO !!!');</script>";
            echo "<script>window.close();</script>";
}else{
	   echo "<script language='JavaScript'> window.alert('ERRO AO CADASTRAR REQUERENTE !!!');</script>";
	   echo "<script>window.close();</script>";
}


?>
				
					
				

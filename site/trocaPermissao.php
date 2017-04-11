<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<title>Parvaim</title>
</head>




<body>

<?php
// instancio as variaveis

$processoNovo="";
$processoCarga="";
$processoRecebimento="";
$processoAnexo="";

$cadastroAssunto="";
$cadastroDocumento="";
$cadastroOrigem="";
$cadastroSetor="";
$cadastroRequerente="";


$consultaAnexo="";
$consultaAssunto="";
$consultaCarga="";
$consultaProcesso="";
$consultaDocumento="";
$consultaNumero="";
$consultaRequerente="";
$consultaSecretaria="";
$consultaOrigem="";

$relatorioSetor="";
$relatorioTramite="";
$relatorioRemessa="";
$relatorioCarga="";

$manutencaoUsuario="";
$manutencaoSenha="";
$manutencaoPermissao="";
$manutencaoEtiquetas="";
$super=  "";
?>

						
				
<?php

$txtUsuario = $_REQUEST['txtUsuario'];

//Menu Processo
if (isset($_POST['processoNovo'])){
$processoNovo  = 1;
}ELSE{
$processoNovo  = 0;
}

if (isset($_POST['processoCarga'])){
$processoCarga  = 1;
}ELSE{
$processoCarga  = 0;
}

if (isset($_POST['processoRecebimento'])){
$processoRecebimento  = 1;
}ELSE{
$processoRecebimento  = 0;
}


if (isset($_POST['processoAnexo'])){
$processoAnexo  = 1;
}ELSE{
$processoAnexo  = 0;
}

//Menu Cadastro


if (isset($_POST['cadastroAssunto'])){
$cadastroAssunto  = 1;
}ELSE{
$cadastroAssunto  = 0;
}

if (isset($_POST['cadastroDocumento'])){
$cadastroDocumento  = 1;
}ELSE{
$cadastroDocumento  = 0;
}

if (isset($_POST['cadastroOrigem'])){
$cadastroOrigem  = 1;
}ELSE{
$cadastroOrigem  = 0;
}

if (isset($_POST['cadastroSetor'])){
$cadastroSetor  = 1;
}ELSE{
$cadastroSetor  = 0;
}

if (isset($_POST['cadastroRequerente'])){
$cadastroRequerente  = 1;
}ELSE{
$cadastroRequerente  = 0;
}

//Consulta

if (isset($_POST['consultaAnexo'])){
$consultaAnexo  = 1;
}ELSE{
$consultaAnexo  = 0;
}

if (isset($_POST['consultaAssunto'])){
$consultaAssunto  = 1;
}ELSE{
$consultaAssunto  = 0;
}

if (isset($_POST['consultaCarga'])){
$consultaCarga  = 1;
}ELSE{
$consultaCarga  = 0;
}

if (isset($_POST['consultaProcesso'])){
$consultaProcesso  = 1;
}ELSE{
$consultaProcesso  = 0;
}


if (isset($_POST['consultaDocumento'])){
$consultaDocumento  = 1;
}ELSE{
$consultaDocumento  = 0;
}

if (isset($_POST['consultaNumero'])){
$consultaNumero  = 1;
}ELSE{
$consultaNumero  = 0;
}

if (isset($_POST['consultaRequerente'])){
$consultaRequerente  = 1;
}ELSE{
$consultaRequerente  = 0;
}

if (isset($_POST['consultaSecretaria'])){
$consultaSecretaria  = 1;
}ELSE{
$consultaSecretaria  = 0;
}

if (isset($_POST['consultaOrigem'])){
$consultaOrigem  = 1;
}ELSE{
$consultaOrigem  = 0;
}

//menu Relatório

if (isset($_POST['relatorioSetor'])){
$relatorioSetor  = 1;
}ELSE{
$relatorioSetor  = 0;
}
if (isset($_POST['relatorioTramite'])){
$relatorioTramite  = 1;
}ELSE{
$relatorioTramite  = 0;
}
if (isset($_POST['relatorioRemessa'])){
$relatorioRemessa  = 1;
}ELSE{
$relatorioRemessa  = 0;
}
if (isset($_POST['relatorioCarga'])){
$relatorioCarga  = 1;
}ELSE{
$relatorioCarga  = 0;
}

//menu Manutenção

if (isset($_POST['manutencaoUsuario'])){
$manutencaoUsuario  = 1;
}ELSE{
$manutencaoUsuario  = 0;
}
if (isset($_POST['manutencaoSenha'])){
$manutencaoSenha  = 1;
}ELSE{
$manutencaoSenha  = 0;
}
if (isset($_POST['manutencaoPermissao'])){
$manutencaoPermissao  = 1;
}ELSE{
$manutencaoPermissao  = 0;
}
if (isset($_POST['manutencaoEtiquetas'])){
$manutencaoEtiquetas  = 1;
}ELSE{
$manutencaoEtiquetas  = 0;
}

//outras op
$super  = $_POST['super'];

?>
		
	<?php
    if(($processoNovo==0)&&($processoCarga==0)&&($processoRecebimento==0)&&($processoAnexo==0)&&($cadastroAssunto==0)&&($cadastroDocumento==0)&&($cadastroOrigem==0)&&($cadastroSetor==0)&&($cadastroRequerente==0)&&($consultaAnexo==0)&&($consultaAssunto==0)&&($consultaCarga==0)&&($consultaProcesso==0)&&($consultaDocumento==0)&&($consultaNumero==0) &&($consultaRequerente==0)&&($consultaSecretaria==0)&&($consultaOrigem==0)&&($relatorioSetor==0)&&($relatorioRemessa==0)&&($relatorioTramite==0)&&($relatorioCarga==0)&&($manutencaoUsuario==0)&&($manutencaoSenha==0)&&($manutencaoEtiquetas==0)&&($super== 0)){
	?>
		
	
		<script languagem="JavaScript">
	   	window.alert("TROCA NÃO REALIZADA, FALTA DE PERMISSÃO !!!");
         location.href="manPermissao.php";
		</script>
		
	<?php
	}else{	
	?>
	
		<?php		
		include('recursos/includes/verConexao.inc');   

		//consulta sql - update
		$alterar ="UPDATE permissao SET processoNovo='$processoNovo', processoCarga='$processoCarga', processoRecebimento='$processoRecebimento' ,processoAnexo = '$processoAnexo',
		
		cadastroAssunto='$cadastroAssunto', cadastroDocumento='$cadastroDocumento' ,cadastroOrigem ='$cadastroOrigem',cadastroSetor = '$cadastroSetor', cadastroRequerente= '$cadastroRequerente',
		
		consultaAnexo='$consultaAnexo', consultaAssunto='$consultaAssunto', consultaCarga='$consultaCarga',consultaProcesso='$consultaProcesso',consultaDocumento='$consultaDocumento',
		
		consultaNumero ='$consultaNumero ',consultaRequerente ='$consultaRequerente ',consultaSecretaria = '$consultaSecretaria' ,consultaOrigem = '$consultaOrigem',
		
		relatorioSetor='$relatorioSetor', relatorioRemessa= '$relatorioRemessa' , relatorioTramite ='$relatorioTramite ', relatorioCarga= '$relatorioCarga',
		
		manutencaoUsuario='$manutencaoUsuario', manutencaoSenha='$manutencaoSenha' , manutencaoPermissao = '$manutencaoPermissao', manutencaoEtiquetas ='$manutencaoEtiquetas ',outrasOp='$super'
		
		
		WHERE idUsuario = $txtUsuario " ;
		
		if(mysql_query($alterar , $conexao)){
		?>	
		<script languagem = "JavaScript">
        window.alert('ALTERADO COM SUCESSO !!!');
        location.href="manPermissao.php";
        </script>
		
		<?php 
		}else{
		?>
		<script  languagem = "JavaScript">
        window.alert('ERRO AO ALTERAR !!!');
        location.href="manPermissao.php";
        </script>
		
		<?php 
		}
		?>
		
		
<?php } ?>

</body>
</html>

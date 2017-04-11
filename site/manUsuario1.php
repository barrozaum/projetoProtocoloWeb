<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>



<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilologin.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicaologin.css"/>
		
	<title>Parvaim</title>	
</head>
	
		
		
		
					
<body>
<?php 
 $nome = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['nome']);
 $sobrenome = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['sobrenome']);
 $novoLogin = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['novoLogin']);
?>


<?php
$email=$_POST['email'];
$email=strtoupper($email);
$setorTrabalho= $_POST['setorEntrada'];

$pass=$_POST['senha'];
$pass=strtoupper($pass);
$pass= sha1($pass);

?>




		
<?php

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

//$txtUsuario = $_REQUEST['txtUsuario'];

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
	if(($processoNovo== "")&&($processoCarga== "")&&($processoRecebimento== "")&&($processoAnexo== "")&&($cadastroAssunto== "")&&($cadastroDocumento== "")&&($cadastroOrigem== "")&&($cadastroSetor== "")&&($cadastroRequerente== "")&&($consultaAnexo== "")&&($consultaAssunto== "")&&($consultaCarga== "")&&($consultaProcesso== "")&&($consultaDocumento== "")&&($consultaNumero== "") &&($consultaRequerente== "")&&($consultaSecretaria== "")&&($consultaOrigem== "")&&($relatorioSetor== "")&&($relatorioRemessa== "")&&($relatorioTramite== "")&&($relatorioCarga== "")&&($manutencaoUsuario== "")&&($manutencaoSenha== "")&&($manutencaoEtiquetas== "")&&($super== 0)){
	?>
		
		<script language='JavaScript'> window.alert('Você não colocou permissao ao Usuário');
		location.href='manUsuario.php';</script>
		
	<?php
	}else{	
	?>
	
	<?php 
	include('recursos/includes/verConexao.inc');  
	
	$sql = "INSERT INTO usuario (login, nome, email, senha, sobrenome, idSetor) VALUES ('$novoLogin', '$nome', '$email', '$pass', '$sobrenome', $setorTrabalho)";
	if(mysql_query($sql,$conexao)){
	?>	
		
		<?php 
		include('recursos/includes/verConexao.inc');  
		
		$sql2 = "SELECT * FROM usuario WHERE login = '$novoLogin' AND senha = '$pass'";
		$resultado2 = mysql_query($sql2,$conexao);
		while($dados2 = mysql_fetch_array($resultado2)){
		$idUsuarioNovo = $dados2['idUsuario'];
		}
		?>
		
		
	
		<?php 
		include('recursos/includes/verConexao.inc'); 
		$sql="INSERT INTO permissao (idUsuario, processoNovo, processoCarga, processoRecebimento, processoAnexo, cadastroAssunto, cadastroDocumento, cadastroOrigem, cadastroSetor, cadastroRequerente,consultaAnexo,consultaAssunto,consultaCarga, consultaProcesso,consultaDocumento,consultaNumero,consultaRequerente,consultaSecretaria, consultaOrigem, relatorioSetor, relatorioRemessa, relatorioTramite, relatorioCarga, manutencaoUsuario, manutencaoSenha, manutencaoPermissao, manutencaoEtiquetas, outrasOp) 
		
		VALUES
		
		('$idUsuarioNovo' , '$processoNovo', '$processoCarga', '$processoRecebimento', '$processoAnexo','$cadastroAssunto','$cadastroDocumento', '$cadastroOrigem', '$cadastroSetor', '$cadastroRequerente', '$consultaAnexo', '$consultaAssunto', '$consultaCarga', '$consultaProcesso', '$consultaDocumento', '$consultaNumero','$consultaRequerente', '$consultaSecretaria', '$consultaOrigem', '$relatorioSetor','$relatorioRemessa', '$relatorioTramite', '$relatorioCarga', '$manutencaoUsuario','$manutencaoSenha', '$manutencaoPermissao', '$manutencaoEtiquetas', '$super')";		
			
			if(mysql_query($sql,$conexao)){
			?>
			<script>
			window.alert('Cadastro Funcionário com Sucesso!!');
			location.href="manUsuario.php";
			</script>
			<?php
			}else{
			?>
			<script>
			window.alert('Erro ao Cadastrar Permissão Funcionário!!');
			location.href="manUsuario.php";
			</script>
			<?php
			}
			?>
		
		
		
	
	
	
	<?php }else{ ?>
	<script>
	window.alert('Erro ao Cadastrar FuncionÃ¡rio!!');
	location.href="manUsuario.php";
	</script>
	<?php } ?>

<?php } ?>
</body>
	
</html>
	

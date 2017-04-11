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
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		
		<?php
		// Inclui o script do site			
		
		include('recursos/includes/verScript.inc');
		?>
		
			
		<!-- Fim do script para criação de campos -->
		
		<title>Parvaim</title>	
	</head>
<body>

<form name="f1" action="addApenso.php" method="POST">
<?php
$numero = preg_replace("/[^0-9]/", "", $_REQUEST['numero']);
$tipo = preg_replace("/[^0-9]/", "", $_REQUEST['tipo']);
$ano = preg_replace("/[^0-9]/", "", $_REQUEST['ano']);

$i=0;

include('recursos/includes/verConexao.inc');

$sql="SELECT * 
FROM  cadastroProcesso c, requerente r, assunto a
WHERE  c.numeroProcesso ='$numero' AND c.tipoProcesso='$tipo' AND c.anoProcesso='$ano' AND c.idRequerente = r.idRequerente AND c.idAssunto = a.idAssunto" ;

$resultado=mysql_query($sql,$conexao) ;

if (mysql_num_rows($resultado) == 0) {// if linha 44
?>

 <div id="cadastrados"> <strong>NENHUM PROCESSO ENCONTRADO !!! </strong> </div>

<?php							
}else{// else if linha 44

while($dados=mysql_fetch_array($resultado)){//inicio do while linha 50
$idProcesso=$dados['idProcesso'];

$tipo = $dados['tipoProcesso'];
$requerente=$dados['requerente'];
$assunto=$dados['nomeAssunto'];
$idAnexado = $dados['idAnexo'];
}//fim do while linha 50	
?>

	<?php 
	include('recursos/includes/verConexao.inc');
	
	$sql1 ="SELECT * FROM cargaProcesso WHERE idProcesso= $idProcesso ORDER BY idCarga";
	$resultado1 = mysql_query($sql1 ,$conexao);
	while($dados1=mysql_fetch_array($resultado1)){
	$tramite = $dados1['tramite'];
	$idSetorEntrada = $dados1['idSetorEntrada'];
	$idUsuarioRecebimento = $dados1['idUsuarioRecebimento'];
	}
	?>

	

	<?php
	if ($idAnexado == 0){// if linha 44
	?>
	
		<?php
		if ($tramite == 1){// if linha 44
		?>
		
		
		
			<?php
			if ($idSetorEntrada == $idSetorUsuario ){// if linha 44
			?>
			
			
				<?php
				if ($idUsuarioRecebimento == $idUsuario ){// if linha 44
				?>
				
				
				<input type="hidden" name="idProcesso" value="<?php echo $idProcesso; ?>">
				
				
				<input type="hidden" name="numero" value="<?php echo $numero; ?>">
				
				<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
			
				<input type="hidden" name="ano" value="<?php echo $ano; ?>">
				
				<strong>REQUERENTE:</strong><?php echo $requerente; ?>
				<br />
				<input type="hidden" name="requerente" value="<?php echo $requerente; ?>">
				<br />
				
				<strong>ASSUNTO:</strong><?php echo $assunto; ?>
				<br />
				<input type="hidden" name="assunto" value="<?php echo $assunto; ?>">
				<br />
				
					
					<input type='submit' value='    Continuar    '>
							
				
				
				<?php
				}else{
				?>
				 <div id="cadastrados"> <strong>O PROCESSO ENCONTRA-SE COM OUTRO USUÁRIO !!! </strong> </div>
				
				<?php
				}
				?>
			 
			<?php
			}else{
			?>
			 <div id="cadastrados"> <strong>PROCESSO ENCONTRA-SE EM OUTRO SETOR !!! </strong> </div>
			
			<?php
			}
			?>
	
	
		<?php
		}else{
		?>
		 <div id="cadastrados"> <strong> PROCESSO ENCONTRA-SE EM TRÂMITE !!! </strong> </div>
		
		<?php
		}
		?>
	<?php
	}else{
	?>
	 <div id="cadastrados"> <strong>PROCESSO ENCONTRA-SE ANEXADO EM OUTRO !!!</strong> </div>
	
	<?php
	}
	?>
<?php
}
?>
</body>
</html>
	

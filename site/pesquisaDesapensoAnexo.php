<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION[idUsuario];	
$idSetorUsuario =$_SESSION[idSetorUsuario];	

?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloform.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		
		<script type="text/javascript" src="recursos/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery1.js"></script>
		
		<script type="text/javascript" src="recursos/js/jquery.maskedinput.js"></script>
		
		<?php
		// Inclui o menu do site			
		include('verscript.inc');	
		?>
			
		<!-- Fim do script para criação de campos -->
		
		<title>Parvaim</title>	
	</head>
<body>

<?php
	

$numero=$_GET["numero"];
$tipo=$_GET['tipo'];	
$ano=$_GET['ano'];
$i=0;
$cont =0;
							
include('verconec.inc');


$sql="select * from cadastro_processo where numero ='$numero' and tipo_processo='$tipo' and ano='$ano'  " ;

$resultado=mysql_query($sql,$conexao) ;								
while($dados=mysql_fetch_array($resultado)){
	$i++;
	
	$requerente=$dados['requerente'];
	$requerente=strtoupper($requerente);
	

	$assunto=$dados['assunto'];
	$assunto=strtoupper($assunto);
	
	
	echo'<input type="hidden" name="numero" value="'.$numero.'">';
	
	echo'<input type="hidden" name="tipo" value="'.$tipo.'">';

	echo'<input type="hidden" name="ano" value="'.$ano.'">';
	
	echo "<strong>Requerente:</strong>".$requerente;
	echo"<br />";
	echo'<input type="hidden" name="requerente" value="'.$requerente.'">';
	echo"<br />";
	
	echo "<strong>Assunto:</strong>".$assunto;
	echo"<br />";
	echo'<input type="hidden" name="assunto" value="'.$assunto.'">';
	echo"<br />";
	
	
	echo "<strong>Ano:</strong>".$dados['ano'];
	echo"<br />";
	echo'<input type="hidden" name="ano" value="'.$ano.'">';
	echo"<br />";
	
}	
											
?>	
<hr />
		
			
<?php

echo"<br />";	
include('verconec.inc');


$sql="select * from anexo where numero_processo ='$numero' and tipo_processo='$tipo' and ano_processo='$ano'  " ;
	
$resultado=mysql_query($sql,$conexao) ;								
while($dados=mysql_fetch_array($resultado)){
	$cont++;
	
	
	
	
	
	
echo "<strong>Tipo:</strong>".$dados['tipo_anexo'];
echo"<br />";

echo "<strong>Número:</strong>".$dados['anexo'];




echo "<strong>Ano:</strong>".$dados['ano_anexo'];
 
  echo "<a onclick='return confirma()' href='excluianexo.php?id=".$dados['id']."'><img src='recursos/imagens/form/close32.png' margin-left='50' width='16' heigth='16' border='0' /> </a>";
echo"<br />";
echo"<br />";




}



	
							
?>	
<?php
						
if ($i != 0)
	
	echo"Resultados Encontrados de Anexo <strong>  ". $cont++."</strong><br />";
	
else
	echo "Nenhum Resultado encontrado";

echo '</form>';

?>

</body>
</html>
	
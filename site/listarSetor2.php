<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<?php 
$i = 0;
$setor = $_REQUEST['setor'];

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM setor WHERE idSetor = $setor";
$resultado = mysql_query($sql,$conexao);

while($dados = mysql_fetch_array($resultado)){
$setor = $dados['setor'];

$secretaria = $dados['secretaria'];
$desc_secretaria= $dados['descSecretaria'];

$coordenadoria = $dados['coordenadoria'];
$desc_coordenadoria= $dados['descCoordenadoria'];

$departamento= $dados['departamento'];
$desc_departamento= $dados['descDepartamento'];

}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>
		
		<script language="JavaScript">

		function verifica() {
			var altSetor = "<?php echo $setor; ?>";
			
			var altSecretaria = "<?php echo $secretaria ; ?>";
			var altDescSecretaria = "<?php echo $desc_secretaria; ?>";
			
			var altCoordenadoria  = "<?php echo $coordenadoria ; ?>";
			var altDescCoordenadoria = "<?php echo $desc_coordenadoria; ?>";
			
			var altDepartamento = "<?php echo $departamento; ?>";
			var altDescDepartamento= "<?php echo $desc_departamento; ?>";
			
			
			   var setor = document.f1.setor .value;
			  
			   var secretaria = document.f1.secretaria .value;
			   var desc_secretaria= document.f1.desc_secretaria.value;
			  
			   var coordenadoria= document.f1.coordenadoria.value;
			   var desc_coordenadoria= document.f1.desc_coordenadoria.value;
			  
			   var departamento= document.f1.departamento.value;
			   var desc_departamento= document.f1.desc_departamento.value;
			  
			  
			  if ((setor == altSetor )&&(secretaria == altSecretaria ) && (desc_secretaria == altDescSecretaria ) && (coordenadoria== altCoordenadoria  ) && (desc_coordenadoria== altDescCoordenadoria ) && (departamento == altDepartamento ) && (desc_departamento == altDescDepartamento))
			      window.alert("Campos Não Modificados !");
			 
			  else  if (setor == "")
			      window.alert("Por favor, digite a Setor!");
			 
			   else if (secretaria == "")
			      window.alert("Por favor, digite a Secretaria !");
			   
			   else if (desc_secretaria == "")
			      window.alert("Por favor, digite a Descrição Secretaria !");
			   
			   else if (coordenadoria == "")
			      window.alert("Por favor, digite a Coordenadoria!");
			   
			   
			   else if (desc_coordenadoria == "")
			      window.alert("Por favor, digite a Descrição Coordenadoria!");
			   
			   else if (departamento == "")
			      window.alert("Por favor, digite a Departamento!");
			   
			   else if (desc_departamento == "")
			      window.alert("Por favor, digite a Descrição Departamento!");
			   
			   
			   else {
			      document.f1.submit();
			      opener.location.reload();
			}
		}
		
		</script>
	<title>Parvaim</title>
</head>





<body>
		

				
				
				

				
				
				<h3>Listar Setor</h3>
				<br />
				<br />		
				<form name="f1" action="alterarSetor1.php" method="post" >
					<input type="hidden" name="codigo"  value="<?php echo $c;?>" /> 
					
					
					
					<label><strong>Setor:</strong>
						<input type="text" name="setor"  value="<?php echo $setor ;?>" maxlength="50" size="50px" onKeypress="return carcater();"/> 
					</label>
					<br />
					<br />
					
					<label><strong>Secretaria:</strong>
						<input type="text" name="secretaria" value="<?php echo $secretaria;?>" maxlength="50" size="50px" onKeypress="return carcater();"/> 
					</label>
					<br />
					<br />
					
					<label><strong>Desc.Secretaria:</strong>
						<input type="text" name="desc_secretaria"   value="<?php echo $desc_secretaria;?>" maxlength="50" size="50px" onKeypress="return carcater();"/> 
					</label>
					<br />
					<br />
					
									
					<label><strong>Coordenadoria:</strong>
						<input type="text" name="coordenadoria"  value="<?php echo $coordenadoria;?>" maxlength="50" size="50px" onKeypress="return carcater();"/> 
					</label>
					<br />
					<br />
					
					<label><strong>Desc.Coordenadoria:</strong>
						<input type="text" name="desc_coordenadoria"  value="<?php echo $desc_coordenadoria;?>" maxlength="50" size="50px" onKeypress="return carcater();"/>
					</label>
					<br />
					<br />
					<label>
					<strong>Deparatamento:</strong>
						<input type="text" name="departamento"  value="<?php echo $departamento;?>"  maxlength="50" size="50px" onKeypress="return carcater();"/>
					</label>
					<br />
					<br />
					
					<label><strong>Desc.departamento:</strong>
						<input type="text" name="desc_departamento"  value="<?php echo $desc_departamento;?>" maxlength="50" size="50px" onKeypress="return carcater();"/>
					</label>
					<br />
					<br />
					<input type="button" value="    Voltar    " onclick="javascript: history.back(-1);" />
					<input type="button" value="    Fechar    " onclick="javascript: window.close();" />
					</form>
				
	</body>

</html>

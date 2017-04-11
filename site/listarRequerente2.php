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
	<title>Parvaim</title>	
</head>
				
<body>

	
<?php 
$cod = $_REQUEST['requerente'];

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM requerente WHERE idRequerente= '$cod'";
$resultado = mysql_query($sql,$conexao);
while($dados = mysql_fetch_array($resultado)){
?>
	
	<h3>INFORMAÇÃO REQUERENTE</h3>
	<br /><br />
<form>
<label>REQUERENTE:
	
	<input type="text" name="nomeRequerente" maxlength="50" size="50px" value="<?php echo $dados['requerente']; ?>" onKeypress="return carcater();"/> *
	<input type="hidden" name="verificaRequerente" value="1">
	
</label>
<br />
<br />



<label>LOGRADOURO:
	<input type="text" name="logradouro"  value="<?php echo $dados['logradouro']; ?>" size="50px"  maxlength="50" onKeypress="return carcater();"/>
</label>

<label>NÚMERO:
	<input type="text" name="numero_end"  value="<?php echo $dados['numeroEnd']; ?>" maxlength="4" size="4px" onKeypress="return numeros();"/>
</label>
<br />
<br />


<label>COMPLEMENTO:
	<input type="text" name="complemento" value="<?php echo $dados['complemento']; ?>" size="25" />
</label>


<label>BAIRRO:
	<input type="text" name="bairro" onKeypress="return carcater();" value="<?php echo $dados['bairro']; ?>" size="30" />
</label>
<br />
<br />


<label>CIDADE:
	<input type="text" name="cidade" value="<?php echo $dados['cidade']; ?>" onKeypress="return carcater();" />
</label>

<label>UF:
	<input type="text" name="uf" maxlength="2" size="2px" value="<?php echo $dados['uf']; ?>" onKeypress="return carcater();" />
</label>


<label>CEP:	
	<input type="text" class="cep" id="cep" name="cep" value="<?php echo $dados['cep']; ?>" />
</label>
<BR />
<BR />

<label>TEL (FIXO):
	<input type="text" class="tel" id="tel" name="tel" value="<?php echo $dados['tel']; ?>" />
</label>


<label>TEL (CEL):
	<input type="text" class="tel" id="tel" name="tel" value="<?php echo $dados['tel']; ?>" /><br />
</label><br />

		
		<input type="button" value ="    VOLTAR    " onclick="javascript:location.href='listarRequerente.php';"/>
		
		<input type="button" value ="    FECHAR    " onclick="javascript:window.close();"/>
	
	</form>
<?php 
}
?>			
</body>
	
</html>

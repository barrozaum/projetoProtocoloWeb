<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


<?php 
$cod = preg_replace("/[^0-9]/", "", $_REQUEST['cod']);

include('recursos/includes/verConexao.inc');

$sql="SELECT nomeAssunto FROM assunto where idAssunto = $cod";
$resultado = mysql_query($sql,$conexao);

while($dados = mysql_fetch_array($resultado)){
$assunto = $dados['nomeAssunto'];
}
?>

		<h3>ALTERAR ASSUNTO</h3>
		<br />
		<br />

		<form name="f1" action="alterarAssunto1.php" method="POST">
			<input type="hidden" name="codigo" value="<?php echo $cod ; ?>" />
		   	<label>ASSUNTO:
       	       <input type="text" name="descricao" id="descricao" value="<?php echo $assunto ; ?>" maxlength="50" size="100%" onKeypress="return cancelaEnter();" onKeyUp="maiusculo(descricao);" />
	      	</label>
        	<br />
			<br />

			<input type="button" value ="    ALTERAR    " Onclick="javascript:verificaAlteracao();" Onclick="javascript:incluir();" />
			<input type="reset"  value ="    CORRIGIR    "/>
			<input type="button" value ="    INCLUIR    " Onclick="javascript:incluir();" />
		</form>
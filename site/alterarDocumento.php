<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


<?php 
$cod = preg_replace("/[^0-9]/", "", $_REQUEST['cod']);
$i = 0;
include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM documento WHERE idDocumento = $cod";
$resultado = mysql_query($sql,$conexao);

while($dados = mysql_fetch_array($resultado)){
$documento= $dados['nomeDocumento'];
}
?>

	
		<h3>ALTERAR DOCUMENTO </h3>
		<br />
		<br />

		<form name="f1" action="#" method="post">
 			<input type="hidden" name="codigo" value="<?php echo $cod ; ?>" />
           	<label>DOCUMENTO:
       			 <input type="text" name="descricao" value="<?php echo $documento ; ?>" maxlength="50" size="100%" onKeypress="return cancelaEnter();" onKeyUp="maiusculo(descricao);"/>
           	</label>
        	<br />
			<br />

		
			<input type="button" value ="    ALTERAR    " Onclick="javascript:verificaAlteracao();" />
			<input type="reset"  value ="    CORRIGIR    "/>
			<input type="button" value ="    INCLUIR    " Onclick="javascript:incluir();" />
		</form>

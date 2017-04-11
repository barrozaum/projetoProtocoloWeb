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

$sql="SELECT * FROM origem WHERE idOrigem = $cod";
$resultado = mysql_query($sql,$conexao);

while($dados = mysql_fetch_array($resultado)){
$origem= $dados['nomeOrigem'];
}
?>		
		
		<h3>ALTERAR ORIGEM PROCESSO</h3>
		<br />
		<br />

		<form name="f1" action="alterarOrigem1.php" method="post">
			<input type="hidden" name="codigo" value="<?php echo $cod; ?>" size="2px" readonly="true"/> 
		   	<label>ORIGEM:
       			 <input type="text" name="descricao" value="<?php echo $origem; ?>"maxlength="80" size="100%" onKeyUp="maiusculo(descricao);"/>
           	</label>
        	<br />
			<br />

			<input type="button" value ="    ALTERAR    " Onclick="javascript:verificaAlteracao();" />
			<input type="reset"  value ="    CORRIGIR    "/>
			<input type="button" value ="    INCLUIR    " Onclick="javascript:incluir();" />
		</form>
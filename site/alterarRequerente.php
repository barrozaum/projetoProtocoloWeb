<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<?php 
$c = preg_replace("/[^0-9]/", "", $_REQUEST['cod']);

include('recursos/includes/verConexao.inc');


$sql= "SELECT * FROM requerente WHERE idRequerente = $c ";
$resultado= mysql_query($sql,$conexao);
while($dados = mysql_fetch_array($resultado)){
	
	$requerente  = $dados['requerente'];
	$logradouro  = $dados['logradouro'];
	$numeroEnd   = $dados['numeroEnd'];
	$complemento = $dados['complemento'];
	$bairro	     = $dados['bairro'];
	$cidade	     = $dados['cidade'];
	$uf	         = $dados['uf'];
	$cep	     = $dados['cep'];
	$tel	     = $dados['tel'];
	$cel	     = $dados['cel'];

}
?>

	<h3>ALTERAR REQUERENTE</h3>
	<br />
	<br />

	<form name="f1" action="alterarRequerente1.php" method="POST">


	<input type="hidden" name="cod" value="<?php echo $c; ?>" size="2px" readonly="true"/> 
	
	
	
	<label>REQUERENTE:
		<input type="text" name="requerente" maxlength="50" value="<?php echo $requerente; ?>" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(requerente);"/> 
	</label>
	<br />
	<br />
	
	<label>LOGRADOURO:
		<input type="text" name="logradouro"  size="50px"  maxlength="50"  value="<?php echo $logradouro; ?>"onKeypress="return carcater();" onKeyUp="maiusculo(logradouro);"/>
	</label>
	
	<label>NÚMERO:
		<input type="numero" name="numero_end"  maxlength="4" size="4px" value="<?php echo $numeroEnd; ?>" onKeypress="return numeros();"/>
	</label>
	<br />
	<br />
	
	<label>COMPLEMENTO:
		<input type="text" name="complemento"  value="<?php echo $complemento; ?>" onKeyUp="maiusculo(complemento);"/>
	</label>
	
	
	<label>BAIRRO:
		<input type="text" size="30px" name="bairro" value="<?php echo $bairro; ?>" onKeypress="return carcater();" value="<?php echo $complemento; ?>" onKeyUp="maiusculo(bairro);"/>
	</label>
	<br />
	<br />
	
	<label>CIDADE:
		<input type="text" name="cidade"  value="<?php echo $cidade; ?>" onKeypress="return carcater();" onKeyUp="maiusculo(cidade);"/>
	</label>
	
	<label>UF:
		<input type="text" name="uf" maxlength="2" size="2px"  value="<?php echo $uf; ?>"  onKeypress="return carcater();" onKeyUp="maiusculo(uf);"/>
	</label>
	


	<label>CEP	:
		<input type="text" name="cep"  class="cep" value="<?php echo $cep; ?>"   onfocus ="mascaraCep(confCep);" />
		<input type="hidden" name="confCep"  maxlength="2" size="2px"  value="0"   />
	</label>
	<br />
	<br />
	
	<label>TEL (FIXO)	:
		<input type="text" name="tel"  class="tel" value="<?php echo $tel; ?>"onfocus ="mascaraTelefoneFixo(confFixo);" />
		<input type="hidden" name="confFixo"  maxlength="2" size="2px"  value="0"   />
	</label>
	


	<label>TEL (CEL)	:
		<input type="text" name="cel"  class="cel" value="<?php echo $cel; ?>"  onfocus ="mascaraTelefoneCelular(confCel);" />
		<input type="hidden" name="confCel"  maxlength="2" size="2px"  value="0"   />
	</label>

	<br />
	<br />

		
		<input type="button" value ="    ALTERAR    " Onclick="javascript:verificaAlteracao();" />
		<input type="reset"  value ="    CORRIGIR    "/>
		<input type="button" value ="    INCLUIR    " Onclick="javascript:incluir();" />
	</form>

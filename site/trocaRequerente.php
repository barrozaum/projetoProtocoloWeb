<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


<?php 
$cod = $_REQUEST['requerente'];

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM requerente WHERE idRequerente= '$cod'";
$resultado = mysql_query($sql,$conexao);

if(mysql_num_rows($resultado) == 0){
?>

 <div>
    <strong>REQUERNTE NÃO ENCOTRADO !!!</strong>
 </div>

<label>REQUERENTE:
	<input type="text" name="nomeRequerente" value="" maxlength="50" size="50px" value="" /> *
	<input type="hidden" name="verificaRequerente" value="">
</label>
<br />
<br />
	
	<label>LOGRADOURO:
		<input type="text" name="logradouro"  size="50px"  maxlength="50"  value=""onKeypress="return carcater();" onKeyUp="maiusculo(logradouro);"/>
	</label>
	
	<label>NÚMERO:
		<input type="numero" name="numero_end"  maxlength="4" size="4px" value="" onKeypress="return numeros();" onKeyUp="maiusculo(numero_end);"/>
	</label>
	<br />
	<br />
	
	<label>COMPLEMENTO:
		<input type="text" name="complemento"  value="" onKeyUp="maiusculo(complemento);" />
	</label>
	
	
	<label>BAIRRO:
		<input type="text" size="30px" name="bairro" value="" onKeypress="return carcater();" value="" onKeyUp="maiusculo(bairro);" />
	</label>
	<br />
	<br />
	
	<label>CIDADE:
		<input type="text" name="cidade"  value="" onKeypress="return carcater();" onKeyUp="maiusculo(cidade);"/>
	</label>
	
	<label>UF:
		<input type="text" name="uf" maxlength="2" size="2px"  value=""  onKeypress="return carcater();" onKeyUp="maiusculo(uf);" />
	</label>

	<label>CEP	:
		<input type="text" name="cep"  class="cep" value=""  onfocus ="mascaraCep(confCep);" />
		<input type="hidden" name="confCep"  maxlength="2" size="2px"  value="0"   />
	</label>
	<br />
	<br />
	
	<label>TEL (FIXO)	:
		<input type="text" name="tel"  class="tel" value=""  onfocus ="mascaraTelefoneFixo(confFixo);" />
		<input type="hidden" name="confFixo"  maxlength="2" size="2px"  value="0"   />
	</label>
	


	<label>TEL (CEL)	:
		<input type="text" name="cel"  class="cel" value=""  onfocus ="mascaraTelefoneCelular(confCel);" />
		<input type="hidden" name="confCel"  maxlength="2" size="2px"  value="0"   />
	</label>
	<br />
	<br />
	


<?php
}else
while($dados = mysql_fetch_array($resultado)){
?>




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
</label>
<?php 
}
?>


	<h3>CADASTRO REQUERENTE</h3>
	<br />
	<br />

	<form name="f1">


	<input type="hidden" name="cod" value="<?php echo $c; ?>" size="2px" readonly="true"/> 
	
	
	
	<label>REQUERENTE:
		<input type="text" name="requerente" maxlength="50" value="" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(requerente);"/> *
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
	

		
		<input type="button" value="    CADASTRAR    " onclick="javascript: verifica();" />
		<input type="reset"  value="    CORRIGIR    " />
					 
	</form>

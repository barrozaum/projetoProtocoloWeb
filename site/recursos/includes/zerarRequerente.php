<label><strong>Requerente:</strong>
	<input type="text" name="nomeRequerente" maxlength="50" size="50px" value="" onKeypress="return carcater();"/> *
	<input type="hidden" name="verificaRequerente" value="">
</label>
<br />
<br />


<label><strong>Logradouro:</strong>
	<input type="text" name="logradouro"  size="50px"  maxlength="50" onKeypress="return carcater();"/>
</label>

<label><strong>Número:</strong>
	<input type="text" name="numero_end"  maxlength="4" size="4px" onKeypress="return numeros();"/>
</label>
<br />
<br />


<label><strong>Complemento:</strong>
	<input type="text" name="complemento" size="25" />
</label>


<label><strong>Bairro:</strong>
	<input type="text" name="bairro" onKeypress="return carcater();"  size="30" />
</label>
<br />
<br />


<label><strong>Cidade:</strong>
	<input type="text" name="cidade" onKeypress="return carcater();" />
</label>

<label><strong>Uf:</strong>
	<input type="text" name="uf" maxlength="2" size="2px"  onKeypress="return carcater();" />
</label>
<br />
<br />

<label><strong>CEP:</strong>	
	<input type="text" class="cep" id="cep" name="cep" />
</label>


<label><strong>Tel:</strong>
	<input type="text" class="tel" id="tel" name="tel" /><br />
</label>
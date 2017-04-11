<h3>CADASTRO ORIGEM PROCESSO</h3>
<br />
<br />
<form name="f1" action="cadastroOrigem1.php" method="post"> 


	<label>ORIGEM:
			<input type="text" name="descricao" maxlength="50" size="100%" onKeypress="return cancelaEnter();" onKeyUp="maiusculo(descricao);"/>
		</label>
		<br />
	<br />

	<input type="button" value ="    CADASTRAR    " onclick="javascript: verifica();" />
	<input type="reset"  value ="    CORRIGIR    "/>
</form>
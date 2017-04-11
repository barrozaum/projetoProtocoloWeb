
	<h3>CADASTRO ASSUNTO</h3>
	<br />
	<br />

	<form name="f1" action="cadastroAssunto1.php" method="post">

	 	<label>ASSUNTO:
           <input type="text" name="descricao" id="descricao" maxlength="50" size="100%" onKeypress="return cancelaEnter();" onKeyUp="maiusculo(descricao);" />
	    </label>
        <br />
		<br />

		<input type="button" value="    CADASTRAR    " onclick="javascript: verifica();" />
		<input type="reset"  value ="    CORRIGIR    "/>
	</form>
	

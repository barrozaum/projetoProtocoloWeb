<div id="esquerdaForm">
				
	<h3>PROCESSO EXCLUIR ANEXO</h3>
	<br />
	<br />
	
	<form name="f1" action="#" method="POST">
	TIPO PROCESSO:
		<select id="tipo" name="tipo"  >
		
		<option value='1'>COMUNICAÇÃO INTERNA</option>
		<option value='2'>COMUNICAÇÃO EXTERNA</option>							
		</select>
		<br />
		<br />
	
	
		<label>NÚMERO:
			<input type="text"  id="numero"  name="numero" maxlength="30" size="30px" onKeypress="return numeros();"/>
		</label>

		<label>ANO:
			<input type="text" id="ano" class="ano" name="ano" value="<?php echo date('Y'); ?>" maxlength="4" size="4px" onKeypress="return numeros();"/>
		</label>
		<br />
		<br />
		<input type="button" value="    ENVIAR    " onclick="buscarExcluir(this.value)">
		<input type="reset"  value="    CORRIGIR    " >
		
		
	</form>
	<br />
	<hr />
	
							
				
	 <div id="txtHint">


		 </div>
	</div>		 		
	<div id="direitaBotao">
		<input type="button" value="    INCLUIR   " onclick="incluir();">
	</div>
</div>

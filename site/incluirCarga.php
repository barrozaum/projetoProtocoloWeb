<div id="esquerdaForm">
		<h3>PROCESSO CADASTRO CARGA</h3>
		<br />
		<br />
		
		<form name="f1" action="#" method="POST">
		TIPO PROCESSO:
		<select name="tipo" id="tipo" >
		
		<option value='1'>COMUNICAÇÃO INTERNA</option>
		<option value='2'>COMUNICAÇÃO EXTERNA</option>							
		</select>
		<br />
		<br />
	
	
		<label>NÚMERO:
			<input type="text" name="numero" id="numero"  maxlength="30" size="30px" onKeypress="return numeros();" />
		</label>
	
		<label>ANO:
			<input type="text" name="ano" id="ano" class="ano" maxlength="4" size="4px" value="<?php echo date('Y'); ?>" onKeypress="return numeros();" />
		</label>
		<br />
		<br />
		<input type="button" value="    ENVIAR    " onclick="showUser(this.value)">
		<input type="reset"  value="    CORRIGIR    " >
			
			
		</form>
		<br />
		<hr />
	
		<div id="txtHint">
	
		 </div>
	</div>		 		
	
	<div id="direitaBotao">
		<input type="button" value="    EXCLUIR   " onclick="excluir();">
	</div>

	
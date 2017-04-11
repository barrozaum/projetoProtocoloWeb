
<?php 
$i = 0;
$c= $_REQUEST['cod'];

include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM setor WHERE idSetor = $c";
$resultado = mysql_query($sql,$conexao);

while($dados = mysql_fetch_array($resultado)){
$setor = $dados['setor'];

$secretaria = $dados['secretaria'];
$desc_secretaria= $dados['descSecretaria'];

$coordenadoria = $dados['coordenadoria'];
$desc_coordenadoria= $dados['descCoordenadoria'];

$departamento= $dados['departamento'];
$desc_departamento= $dados['descDepartamento'];

}
?>


				<h3>Alterar Setor</h3>
				<br />
				<br />		
				<form name="f1" action="alterarSetor1.php" method="post" >
					<input type="hidden" name="codigo"  value="<?php echo $c;?>" /> 
					
					
					
					<label>SETOR:
						<input type="text" name="setor"  value="<?php echo $setor ;?>" maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(setor);"/> 
					</label>
					<br />
					<br />
					
					<label>SECRETARIA:
						<input type="text" name="secretaria" value="<?php echo $secretaria;?>" maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(secretaria);"/> 
					</label>
					<br />
					<br />
					
					<label>DESC.SECRETARIA:
						<input type="text" name="desc_secretaria"   value="<?php echo $desc_secretaria;?>" maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(desc_secretaria);"/> 
					</label>
					<br />
					<br />
					
									
					<label>COORDENADORIA:
						<input type="text" name="coordenadoria"  value="<?php echo $coordenadoria;?>" maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(coordenadoria);"/> 
					</label>
					<br />
					<br />
					
					<label>DESC.COORDENADORIA:
						<input type="text" name="desc_coordenadoria"  value="<?php echo $desc_coordenadoria;?>" maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(desc_coordenadoria);"/>
					</label>
					<br />
					<br />
					<label>DEPARTAMENTO:
						<input type="text" name="departamento"  value="<?php echo $departamento;?>"  maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(departamento);"/>
					</label>
					<br />
					<br />
					
					<label>DESC.DEPARTAMENTO:
						<input type="text" name="desc_departamento"  value="<?php echo $desc_departamento;?>" maxlength="50" size="50px" onKeypress="return carcater();" onKeyUp="maiusculo(desc_departamento);"/>
					</label>
					<br />
					<br />
					
					<input type="button" value="    Alterar    " onclick="javascript: verificaAlteracao();" />
					<input type="reset"   value ="    Corrigir    "/>
					<input type="button" value="    Incluir    " onclick="javascript: incluir();" />
					</form>
				
	
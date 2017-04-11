<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		
		<script language="JavaScript">

		function verifica(str)
		{
			
			 var d = document.f1.descricao.value.toUpperCase();
			 if(d != ""){
				document.f1.submit();
				}else{
					window.alert("VERIFIQUE O CAMPO ORIGEM !!!");
					document.f1.descricao.focus();
				}
		}
		</script>
		
	<title>Parvaim</title>
</head>





<body>
			

					
	<?php 
	$i = 0;
	include('recursos/includes/verConexao.inc');
	
	$sql="SELECT * FROM origem ORDER BY idOrigem";
	$resultado = mysql_query($sql,$conexao);
	
	while($dados = mysql_fetch_array($resultado)){
	$i= $dados['idOrigem'];
	}
	
	$total = ++$i; 
	?>
	

	
	
		<h3>CADASTRO ORIGEM</h3>
		<br />
		<br />
		<form name="f1" action="cadastrarOrigem1.php" method="post"> 
		
	 	<label>ORIGEM:
	           <input type="text" name="descricao" id="descricao" maxlength="70" size="100%" onKeypress="return cancelaEnter();" onKeyUp="maiusculo(descricao);" />
	           <input type="hidden" name="cod" value="<?php echo $total; ?>" />
		</label>
		<br />
		<br />
		

		<input type="button" value ="    CADASTRAR    " onclick="javascript: verifica();" />
		<input type="reset"  value ="    CORRIGIR    "/>
		<input type="button" value ="    VOLTAR    " onclick="javascript: window.close();" />
		</form>
		<hr />
		<br />
		<br />
	
		

				<div id="tituloNivel2">
					<h2 >TABELA DE ORIGENS CADASTRADAS</h2>
					<br /><br />

				</div>


				<div id="cadastrados">
				
					
					<?php

					include('recursos/includes/verConexao.inc');
					 
					$sql="SELECT * FROM origem";
					$resultado=mysql_query($sql,$conexao);
					$i = 0;
					if(mysql_num_rows($resultado) == 0){
					?>
					
					<strong> NENHUMA ORIGEM CADASTRADA !!! </strong>
					
					
					<?php 
					}else{
					?>
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					<table width="100%">
					<thead class="fixedHeader">
					<tr bgcolor="#f5f5dc">
						<th>CÓDIGO</th>
						<th>ORIGEM</th>
					</tr>
					
									
					<?php
					while($dados=mysql_fetch_array($resultado)){
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
					?>	
					
					
					<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
						<td height="5" align ="center"><?php echo $dados['idOrigem']; ?></td>
						<td height="5" align ="center"><?php echo $dados['nomeOrigem']; ?></td>
					</tr>
				
					<?php	
					$i++;
					}
					?>
					
					</table>
					</div>	
					<br />
					<p>
					RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong>
					</p>
					<?php
					}
					?>


</body>

</html>

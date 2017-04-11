<?php
session_start();

include ('recursos/includes/verSessao.inc');
$mensagem = "";
$erro = 0;
?>


<?php 
$mensagem = "";
$lugar = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['setor']);

$secretaria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['secretaria']);

$desc_secretaria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['desc_secretaria']);

$coordenadoria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['coordenadoria']);

$desc_coordenadoria = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['desc_coordenadoria']);

$departamento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['departamento']);

$desc_departamento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['desc_departamento']);

?>	
					

<?php
									
					
include('recursos/includes/verConexaoTransacao.inc');
     	 

$sql="insert into setor (setor,secretaria,descSecretaria,coordenadoria,descCoordenadoria,departamento,descDepartamento, idUsuario)

values

('$lugar','$secretaria','$desc_secretaria','$coordenadoria','$desc_coordenadoria','$departamento','$desc_departamento', $idUsuario)";
	        
if (!mysqli_query($conexao, $sql)) $erro++;

if ($erro == 0){
    mysqli_commit($conexao);
    $mensagem = "CADASTRADO COM SUCESSO !!!";
} else {
    mysqli_rollback($conexao);
    $mensagem = "ERRO AO CADASTRAR !!!";
}
?>

<strong id="aviso">
<?php
echo $mensagem;
?>
</strong><br /><br />
<?php
					$i =0;
					include('recursos/includes/verConexao.inc');
					 
					$sql="SELECT * FROM setor ORDER BY setor";
					$resultado=mysql_query($sql,$conexao);
					
					if(mysql_num_rows($resultado) == 0){
					?>
					
					<strong> NENHUM SETOR CADASTRADO !!! </strong>
					
					<?php 
					}else{
					?>
					<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
					<table width="100%">
					<thead class="fixedHeader">
					<tr bgcolor="#f5f5dc">
						<th>CÓDIGO</th>
						<th>DESC. DEPARTAMENTO</th>
						<th>SETOR</th>
						<th>ALTERAR</th>
						<th>EXCLUIR</th>
					</tr>
					
									
					<?php
					while($dados=mysql_fetch_array($resultado)){
					
					if ($i% 2 == 0)
						$cor = "#CCCCCC";
					else
						$cor = "#FFFFFF";
				
					?>	
					
					
					<tr bgcolor="<?php echo $cor; ?>">
					
						<td height="5" align ="center"><?php echo $dados['idSetor']; ?></td>
						<td height="5" align ="center"><?php echo $dados['departamento']; ?></td>
						<td height="5" align ="center"><?php echo $dados['descDepartamento']; ?></td>
					
						<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idSetor']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></th>
						<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idSetor']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></th>
						

						<!--<<th><a href="alterarSetor.php?cod=<?php echo $dados['idSetor']; ?>" onclick="window.open(this.href,'galeria','width=680,height=400'); return false;"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></th> -->
						<!--<th><a href="excluirSetor.php?cod=<?php echo $dados['idSetor']; ?>" onclick="window.open(this.href,'galeria','width=680,height=170'); return false;"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></th> -->
						
					</tr>
				
					<?php	
					$i++;
					}
					?>
					</table>
					</div>	
					<br />
					<p>
					Resultados encontrados <strong><?php echo $i; ?></strong>
					</p>
					<?php
					}
					?>
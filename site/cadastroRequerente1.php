<?php
session_start();

include ('recursos/includes/verSessao.inc');
$mensagem = "";
$erro = 0;
?>

<?php 
$requerente = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['requerente']);

$logradouro = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['logradouro']);

$numero = $_REQUEST['numeroEnd'];

$complemento = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['complemento']);
 
$bairro = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['bairro']);

$cidade = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['cidade']);

$uf = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['uf']);

$cep =$_REQUEST['cep'];
$tel =$_REQUEST['tel'];
$cel =$_REQUEST['cel'];
?>



<?php
							
			
include('recursos/includes/verConexaoTransacao.inc');
     	 
$sql="insert into requerente(requerente,logradouro,numeroEnd,complemento, bairro,cidade,uf,cep,tel,cel,idUsuario ) values ('$requerente','$logradouro','$numero','$complemento','$bairro','$cidade','$uf','$cep','$tel','$cel',$idUsuario)";
        
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

	include('recursos/includes/verConexao.inc');
	 
	$sql="SELECT * FROM requerente ORDER BY requerente";
	$resultado=mysql_query($sql,$conexao);
	
	if(mysql_num_rows($resultado) == 0){
	?>
	
	<strong> NENHUM REQUERENTE CADASTRADO !!! </strong>
	
	<?php 
	}else{
	?>
	<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
	<table width="100%">
	<thead class="fixedHeader">
	<tr bgcolor="#f5f5dc">
		<th>CÓDIGO</th>
		<th>REQUERENTE</th>
		<th>LOGRADOURO</th>
		<th>TEL(FIXO)</th>
		<th>ALTERAR</th>
		<th>EXCLUIR</th>
	</tr>

					
	<?php
	$i = 0;
	while($dados=mysql_fetch_array($resultado)){
	
	if ($i% 2 == 0)
		$cor = "#CCCCCC";
	else
		$cor = "#FFFFFF";

	?>	
	
	
	<tr bgcolor="<?php echo $cor; ?>">
	
		<td height="5" align ="center"><?php echo $dados['idRequerente']; ?></td>
		<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
		<td height="5" align ="center"><?php echo $dados['logradouro']; ?></td>
		<td height="5" align ="center"><?php echo $dados['tel']; ?></td>
		<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idRequerente']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></td>
		<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idRequerente']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
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
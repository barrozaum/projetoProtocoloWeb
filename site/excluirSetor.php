
<?php 
$c = $_REQUEST['cod'];
$mensagem = "";
?>

<?php
include('recursos/includes/verConexao.inc');
$sql= "SELECT * FROM cargaProcesso WHERE idSetorEntrada = $c OR idSetorPresente = $c";
if($resultado = mysql_query($sql,$conexao)){
?>
	<?php
	if(mysql_num_rows($resultado) >= 1){
	$mensagem =  'Setor Não Pode ser Excluido, Pois ja está cadastrado em Processo !!!';
	}else{
	?>
	
		<?php 
		include ('recursos/includes/verConexao.inc');
		$sql1 = "DELETE FROM  setor WHERE idSetor= $c";
		if(mysql_query($sql1,$conexao)){
		$mensagem =  'Setor Excluido Com Sucesso';
		}else{
		$mensagem =  'Erro ao Setor';
		}
		?>
	
	<?php 
	}
	?>





<?php 
}else{
$mensagem = 'Erro no SQL';
}
?>

<strong id= "aviso">
<?php 
echo $mensagem;
?>
</strong><br / ><br />

	
<?php

include('recursos/includes/verConexao.inc');
 
$sql="SELECT * FROM setor";
$resultado=mysql_query($sql,$conexao);

if(mysql_num_rows($resultado) == 0){
?>

 Nenhum Setor Cadastrado !!! 


<?php 
}else{
?>
<div id="tabelas" >
<table width="100%">
<thead class="fixedHeader">


<tr >
	<th>Codigo</th>
	<th>Desc. Departamento</th>
	<th>Departamento</th>
	<th>Alterar</th>
	<th>Excluir</th>
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

	<td><?php echo $dados['idSetor']; ?></td>
	<td><?php echo $dados['departamento']; ?></td>
	<td><?php echo $dados['descDepartamento']; ?></td>

	<td><a onclick="alterar(<?php echo $dados['idSetor']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></th>
	<td><a onclick="excluir(<?php echo $dados['idSetor']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></th>
	

	<!--<<th><a href="alterarSetor.php?cod=<?php echo $dados['idSetor']; ?>" onclick="window.open(this.href,'galeria','width=680,height=400'); return false;"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></th> -->
	<!--<th><a href="excluirSetor.php?cod=<?php echo $dados['idSetor']; ?>" onclick="window.open(this.href,'galeria','width=680,height=170'); return false;"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></th> -->
	
</tr>

<?php	
$i++;
}
?>

</table>
</div>	
<?php
}
?>

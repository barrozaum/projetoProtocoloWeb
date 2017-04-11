<?php
session_start();

include ('recursos/includes/verSessao.inc');
$mensagem = "";
$erro = 0;
?>



<?php

//Verifica se existe palavras com acentos e troca para ficar sem
$descricao = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['descricao']);
			
?>

<?php 
if($descricao == "") {
	$mensagem = "Campo não Preenchido Corretamente !! ";
}else{
?>


<?php
							
			
include('recursos/includes/verConexaoTransacao.inc');
     	 
$sql="insert into documento (nomeDocumento,idUsuario) values ('$descricao',$idUsuario)";
			        
if (!mysqli_query($conexao, $sql)) $erro++;

if ($erro == 0){
    mysqli_commit($conexao);
    $mensagem = "CADASTRADO COM SUCESSO !!!";
} else {
    mysqli_rollback($conexao);
    $mensagem = "ERRO AO CADASTRAR !!!";
}
?>

	

<?php
}
?>
	<strong id="aviso">
	<?php
	echo $mensagem;
	?>
	</strong><br /><br />
	
			
			<?php

			include('recursos/includes/verConexao.inc');
			 
			$sql="SELECT * FROM documento ORDER BY nomeDocumento";
			$resultado=mysql_query($sql,$conexao);
			
			if(mysql_num_rows($resultado) == 0){
			?>
			
			<strong> NENHUM DOCUMENTO CADASTRADO !!! </strong>
			
			
			<?php 
			}else{
			?>
			<div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
			<table width="100%">
			<thead class="fixedHeader">
			<tr bgcolor="#f5f5dc">
				<th>CÓDIGO</th>
				<th>DOCUMENTO</th>
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
			
			
			<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
				<td height="5" align ="center"><?php echo $dados['idDocumento']; ?></td>
				<td height="5" align ="center"><?php echo $dados['nomeDocumento']; ?></td>
				<td height="5" align ="center"><a onclick="alterar(<?php echo $dados['idDocumento']; ?>);"><img src="recursos/imagens/icones/alterar.png" alt="alterar"></a></td>
				<td height="5" align ="center"><a onclick="excluir(<?php echo $dados['idDocumento']; ?>);"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
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




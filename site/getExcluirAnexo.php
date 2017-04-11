<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>


<?php
$numero=$_REQUEST["numero"];
$tipo=$_REQUEST['tipo'];	
$ano=$_REQUEST['ano'];
?>


<?php
include('recursos/includes/verConexao.inc');

$sql="SELECT * FROM cadastroProcesso WHERE numeroProcesso = '$numero' AND tipoProcesso= '$tipo' AND anoProcesso ='$ano'" ;

$resultado=mysql_query($sql,$conexao) ;

if (mysql_num_rows($resultado) == 0) {//linha 22
?>
<div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
            </div>
<?php
}else{//else linha 22 
while($dados = mysql_fetch_array($resultado)){
$idAnexo = $dados['idProcesso'];
}
?>
	
	
	
	
		
	 
		<?php			
		include('recursos/includes/verConexao.inc');
		
		$sql="SELECT * FROM cadastroProcesso WHERE idAnexo = $idAnexo" ;
		
		$resultado=mysql_query($sql,$conexao) ;
		
		if (mysql_num_rows($resultado) == 0) {//linha 56
		?>
		<div id="cadastrados">
             <strong>NENHUM ANEXO ENCONTRADO !!!</strong>
            </div>
			<?php
			
		}else{//else linha 56
		?>
		
        <div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
        <table width="100%">
        <thead class="fixedHeader">
        <tr bgcolor="#f5f5dc">
			<th>ANEXO</th>
			<th>TIPO</th>
			<th>ANO</th>
			<th>EXCLUIR</th>
		</tr>
			
			<?php
			$i=0;
			while($dados=mysql_fetch_array($resultado)){//while 79
				if ($i% 2 == 0)
				$cor = "#CCCCCC";
				else
				$cor = "#FFFFFF";
				
				
				if ( $dados['tipoProcesso'] == 1 )
				$tipoAnexo= "COMUNICAÇÃO INTERNA";
				else
				$tipoAnexo= "COMUNICAÇÃO EXTERNA";
				
				?>	
				
				
				
				
				
				<tr bgcolor="<?php echo $cor; ?>">
				
				<td height="5" align ="center"><?php echo $dados['numeroProcesso']; ?></td>
				<td height="5" align ="center"><?php echo $tipoAnexo; ?></td>
				<td height="5" align ="center"><?php echo $dados['anoProcesso']; ?></td>
				<td height="5" align="center"><a href="excluirAnexo1.php?Cod=<?php echo $dados['idProcesso']; ?>"><img src="recursos/imagens/icones/excluir.png" alt="excluir"></a></td>
				
				</tr>
				
			<?php	
			$i++;
			}// while linha79	
			?>							
			
			</table>		
			</div>		
			
			
			          <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

		<?php
		}//if linha 56
		?>
	
	
	
	
	
<?php
}// if linha 22
?>	

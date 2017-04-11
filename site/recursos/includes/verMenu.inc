<?php 
include('recursos/includes/verConexao.inc');


$sql = "SELECT * FROM usuario u, permissao p  WHERE u.idUsuario = $idUsuario  AND p.idUsuario = u.idUsuario ";
$resultado = mysql_query($sql, $conexao);
while($dados = mysql_fetch_array($resultado)){

$processoNovo1 =$dados['processoNovo'];
$processoCarga1 =$dados['processoCarga'];
$processoRecebimento1 =$dados['processoRecebimento'];
$processoAnexo1 =$dados['processoAnexo'];


$cadastroAssunto1 =$dados['cadastroAssunto'];
$cadastroDocumento1 =$dados['cadastroDocumento'];
$cadastroOrigem1 =$dados['cadastroOrigem'];
$cadastroSetor1 =$dados['cadastroSetor'];
$cadastroRequerente1 =$dados['cadastroRequerente'];

$consultaAnexo1 =$dados['consultaAnexo'];
$consultaAssunto1 =$dados['consultaAssunto'];
$consultaCarga1 =$dados['consultaCarga'];
$consultaProcesso1 =$dados['consultaProcesso'];
$consultaDocumento1 =$dados['consultaDocumento'];
$consultaNumero1 =$dados['consultaNumero'];
$consultaRequerente1 =$dados['consultaRequerente'];
$consultaSecretaria1 =$dados['consultaSecretaria'];
$consultaOrigem1 =$dados['consultaOrigem'];

$relatorioSetor1 =$dados['relatorioSetor'];
$relatorioTramite1 =$dados['relatorioTramite'];
$relatorioRemessa1 =$dados['relatorioRemessa'];
$relatorioCarga1 =$dados['relatorioCarga'];

$manutencaoUsuario1 =$dados['manutencaoUsuario'];
$manutencaoSenha1 =$dados['manutencaoSenha'];
$manutencaoEtiquetas1 =$dados['manutencaoEtiquetas'];
$manutencaoPermissao1 =$dados['manutencaoPermissao'];
$outrasOp =$dados['outrasOp'];
}
?>
<ul> 


	<?php 
	if(($processoNovo1 == 1) || ($processoCarga1 == 1) || ($processoRecebimento1 == 1) || ($processoAnexo1 == 1)){
	?>
	<li><a href='#'><span>PROCESSO</span></a>
  
		<ul>
			<?php if($processoNovo1 == 1){?>
			<li ><a href="cadastroProcesso.php"><span>NOVO</span></a></li>
			<?php } ?>
			
			
			
			<?php if($processoCarga1 == 1){?>
			<li><a href="cadastroCarga.php"><span>CARGA</span></a></li>
			<?php } ?>
			
			
			
			<?php if($processoRecebimento1 == 1){?>
			<li><a href="cadastroRecebimento.php"><span>RECEBIMENTO</span></a></li> 
			<?php } ?>
			
			
			<?php if($processoAnexo1  == 1){?>
			<li><a href="apensarAnexo.php"><span>ANEXAR</span></a></li>
			<?php } ?>
		</ul>		
	</li>
	<?php } ?>
	
	
	
	<?php
	if(($cadastroAssunto1 == 1) || ($cadastroDocumento1 == 1) || ($cadastroOrigem1 == 1) || ($cadastroSetor1 == 1) ||($cadastroRequerente1 == 1) ){
	?>
	<li><a  href="#"><span>CADASTRO</span></a>

		<ul>
			<?php if($cadastroAssunto1 == 1){?>
			<li><a href="cadastroAssunto.php"><span>ASSUNTO</span></a></li>
			<?php } ?>



			<?php if($cadastroDocumento1 == 1){?>
			<li><a href="cadastroDocumento.php"><span>DOCUMENTO</span></a></li>
			<?php } ?>



			<?php if($cadastroOrigem1 == 1){?>
			<li><a href="cadastroOrigem.php"><span>ORIGEM</span></a></li>
			<?php } ?>



			<?php if($cadastroSetor1 == 1){?>
			<li><a href="cadastroSetor.php"><span>SETOR</span></a></li>
			<?php } ?>



			<?php if($cadastroRequerente1 == 1){?>
			<li><a href="cadastroRequerente.php"><span>REQUERENTE</span></a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>
		
		
		
		
	<?php
	if(($consultaAnexo1 == 1) || ($consultaAssunto1 == 1) || ($consultaCarga1 == 1) || ($consultaProcesso1 == 1) ||($consultaDocumento1 == 1) || ($consultaNumero1 == 1) || ($consultaRequerente1 == 1) || ($consultaSetor1 == 1) ){
	?>
	<li><a  href="#"><span>CONSULTA</span></a>

		<ul>
			<?php if($consultaAnexo1 == 1){?>
			<li><a href="consultaAnexo.php"><span>ANEXO</span></a></li>
			<?php } ?>



			<?php if($consultaAssunto1 == 1){?>
			<li><a href="consultaAssunto.php"><span>ASSUNTO</span></a></li>
			<?php } ?>



			<?php if($consultaCarga1 == 1){?>
			<li><a href="consultaDataCarga.php"><span>DATA CARGA</span></a></li>
			<?php } ?>



			<?php if($consultaProcesso1 == 1){?>
			<li><a href="consultaDataProcesso.php"><span>DATA PROCESSO</span></a></li>
			<?php } ?>



			<?php if($consultaDocumento1 == 1){?>
			<li><a href="consultaDocumento.php"><span>DOCUMENTO</span></a></li>
			<?php } ?>



			<?php if($consultaNumero1 == 1){?>
			<li><a href="consultaNumero.php"><span>NÚMERO</span></a></li>
			<?php } ?>



			<?php if($consultaRequerente1 == 1){?>
			<li><a href="consultaRequerente.php"><span>REQUERENTE</span></a></li>
			<?php } ?>



			<?php if($consultaSecretaria1 == 1){?>
			<li><a href="consultaSetor.php"><span>SETOR</span></a></li>
			<?php } ?>



			<?php if($consultaOrigem1 == 1){?>
			<li><a href="consultaOrigem.php"><span>ORIGEM</span></a></li>
			<?php } ?>

		</ul>
	</li>
	<?php } ?>
	
	
	

	<?php
	if(($relatorioSetor1 == 1) || ($relatorioTramite1 == 1) || ($relatorioRemessa1 == 1) || ($relatorioCarga1 == 1)){
	?>
	<li><a  href="#"><span>RELATÓRIO</span></a>

		<ul>
			<?php if($relatorioSetor1 == 1){?>
			<li><a href="relatorioSetor.php"><span>SETOR</span></a></li>
			<?php } ?>



			<?php if($relatorioTramite1 == 1){?>
			<li><a href="relatorioRemessa.php"><span>REMESSA</span></a></li>
			<?php } ?>



			<?php if($relatorioRemessa1 == 1){?>
			<li><a href="relatorioTramite.php"><span>TRÂMITE </span></a></li>
			<?php } ?>

			<?php if($relatorioCarga1 == 1){?>
			<li><a href="relatorioCarga.php"><span>CARGA</span></a></li>
			<?php } ?>
		</ul>

	</li>
	<?php } ?>
	

	<?php
	if(($manutencaoUsuario1 == 1) || ($manutencaoSenha1 == 1) || ($manutencaoPermissao1 == 1) || ($manutencaoEtiquetas1 == 1)){
	?>

	<li><a  href="#"><span>MANUTENÇÃO</span></a>

		<ul>
			<?php if($manutencaoUsuario1 == 1){?>
			<li><a href="manUsuario.php"><span>USUÁRIO</span></a></li>
			<?php } ?>



			<?php if($manutencaoSenha1 == 1){?>
			<li><a href="manSenha.php"><span>SENHA</span></a></li>
			<?php } ?>


			<?php if($manutencaoPermissao1 == 1){?>
			<li><a href="manPermissao.php"><span>PERMISSÃO</span></a></li>
			<?php } ?>



			<?php if($manutencaoEtiquetas1 == 1){?>
			<li><a href="manEtiquetas.php"><span>ETIQUETA</span></a></li>
			<?php } ?>
		</ul>

	</li>
 <?php } ?>
	<li><a   href="logoff.php"><span>SAIR</span></a></li>  
</ul>
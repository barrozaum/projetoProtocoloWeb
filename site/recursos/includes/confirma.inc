<?php
session_start();

include('versessao.inc');
	

						
?>	
				<?php
					include('verconec.inc');
					
					//echo $_SESSION['codUsuario'];
					$codUsuario=$_SESSION['codUsuario'];
					  
					 $sql= "select * from Permissao where Usuario= '$codUsuario' ";
					 
					   
					   
					  $resultado=mysql_query($sql,$conexao) ;
						while($dados=mysql_fetch_array($resultado)){
						$_SESSION['permissaoNovo']=$dados['processoNovo'];
						$_SESSION['permissaoCarga']=$dados['processoCarga'];
						$_SESSION['permissaoReceber']=$dados['processoRecebimento'];
						$_SESSION['permissaoFinali']=$dados['processoFinalizar'];
						
						$_SESSION['permissaoAssunto']=$dados['cadastroAssunto'];
						$_SESSION['permissaoDocumento']=$dados['cadastroDocumento'];
						$_SESSION['permissaoOrigem']=$dados['cadastroOrigem'];
						$_SESSION['permissaoSetor']=$dados['cadastroSetor'];
						
						
						$_SESSION['permConAxeno']=$dados['consultaAnexo'];
						$_SESSION['permConAssunto']=$dados['consultaAssunto'];
						$_SESSION['permConCarga']=$dados['consultaCarga'];
						$_SESSION['permConProcesso']=$dados['consultaProcesso'];
						$_SESSION['permConDocumento']=$dados['consultaDocumento'];
						$_SESSION['permConNumero']=$dados['consultaNumero'];
						$_SESSION['permConRequerente']=$dados['consultaRequerente'];
						$_SESSION['permConSecretaria']=$dados['consultaSecretaria'];
						$_SESSION['permConFinali']=$dados['consultaFinalizado'];
						$_SESSION['permConUsuario']=$dados['consultaUsuario'];
						
						$_SESSION['permissao']=$dados['relatorio'];
						$_SESSION['permRelSetor']=$dados['relatorioSetor'];
						$_SESSION['permRelTramite']=$dados['relatorioTramite'];
						$_SESSION['permRelRemessa']=$dados['relatorioRemessa'];
						
					
						$_SESSION['permissaoUsuario']=$dados['manutencaoUsuario'];
						$_SESSION['permissaoSenha']=$dados['manutencaoSenha'];
						$_SESSION['permissaoEtiquetas']=$dados['manutencaoEtiquetas'];
						$_SESSION['outrasop']=$dados['outrasOp'];
						
						}
						
			
	?>
	
	
	
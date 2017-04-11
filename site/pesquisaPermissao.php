<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION[idUsuario];	
$idSetorUsuario =$_SESSION[idSetorUsuario];	

?>


<?php
$idUsuario= $_GET['funcionario'];



include('recursos/includes/verConexao.inc');
					 

$sql="SELECT  * FROM permissao WHERE idUsuario = $idUsuario" ;

$resultado=mysql_query($sql,$conexao) ;
?>

<div id="permissao">
				<a id="link" href="javascript:selecionar_tudo()">Marcar todos</a> ||
				<a id="link"  href="javascript:deselecionar_tudo()">Marcar nenhum</a> 
				
				<div id='perEsq'>	
				
				<fieldset>
				<legend>Processo</legend>
				
				
				
				<input type="checkbox" name="processoNovo" value="1"> Novo <br />
				
				<input type="checkbox" name="processoCarga" value="1"> Carga <br />
						
				<input type="checkbox" name="processoRecebimento" value="1"> Recebimento <br />
				
				
				</fieldset>
				
				
				
				
				
				
				<fieldset>
				<legend>Cadastro</legend>
					<input type="checkbox" name="cadastroAssunto" value="1"> Assunto <br />
							
					<input type="checkbox" name="cadastroDocumento" value="1"> Documento <br />
									
					<input type="checkbox" name="cadastroOrigem" value="1"> Origem <br />
					
					<input type="checkbox" name="cadastroSetor" value="1"> Setor <br />
				</fieldset>
				
				
				
					
				
					
						
				
				<fieldset>
				<legend>Consulta</legend>
						
					<input type="checkbox" name="consultaAnexo" value="1"> Anexo <br />
												
					<input type="checkbox" name="consultaAssunto" value="1"> Assunto <br />
					
					<input type="checkbox" name="consultaCarga" value="1"> Data Carga <br />
					
					<input type="checkbox" name="consultaProcesso" value="1"> Data Processo <br />
					
					<input type="checkbox" name="consultaDocumento" value="1"> Documento <br />
					
					<input type="checkbox" name="consultaNumero" value="1"> Número <br />
					
					<input type="checkbox" name="consultaRequerente" value="1"> Requerente <br />
					
					<input type="checkbox" name="consultaSecretaria" value="1"> Setor Empresa <br />
					
					<input type="checkbox" name="consultaUsuario" value="1"> Funcionário  <br />
					
				</fieldset>
				
				
				</div>	
				
					
							
				<div id='perDir'>
				
				<fieldset id='fieldset'>
				<legend>Relatório</legend>
					<input type="checkbox" name="relatorioSetor" value="1"> Setor <br />
					
					<input type="checkbox" name="relatorioRemessa" value="1"> Remessa <br />
					
					<input type="checkbox" name="relatorioTramite" value="1"> Tramite	 <br />
				</fieldset>
				
			
				
				
				<fieldset>
				<legend>Manutenção</legend>
					<input type="checkbox" name="manutencaoUsuario" value="1"> Usuario <br />
					
					<input type="checkbox" name="manutencaoSenha" value="1"> Senha <br />
					
					<input type="checkbox" name="manutencaoEtiquetas" value="1"> Etiquetas <br />
				</fieldset>
				
				
			
				
				
				
				
				
				<fieldset>
				<legend>Outras Permissões</legend>
					<input type="radio" name="super" value="1" >Sim <br />
					<input type="radio" name="super" value="0" checked="CHECKED">Não <br />
				</fieldset>
				
				
				
				</div>
			
			
			</div>
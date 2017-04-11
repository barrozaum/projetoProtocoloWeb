<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];

?>
<form name="f1" action="consultaDados.php" method="post">
<?php
$numero = preg_replace("/[^0-9]/", "", $_REQUEST['numero']);
$documento = preg_replace("/[^0-9]/", "", $_REQUEST['documento']);
$ano = preg_replace("/[^0-9]/", "", $_REQUEST['ano']);

$i=0;
$cont =0;

include('recursos/includes/verConexao.inc');  

if($documento == "")
	$sql="SELECT * 
	FROM documentoProcesso dp, cadastroProcesso c, requerente r, assunto a, documento d
	WHERE dp.idDocumento LIKE '%$documento%' AND dp.numeroDocumento LIKE '%$numero%' AND dp.anoDocumento = $ano AND dp.idProcesso = c.idProcesso AND c.idRequerente = r.idRequerente AND a.idAssunto = c.idAssunto AND dp.idDocumento = d.idDocumento ORDER BY d.idDocumento";
else
	$sql="SELECT * 
	FROM documentoProcesso dp, cadastroProcesso c, requerente r, assunto a, documento d
	WHERE dp.idDocumento = '$documento' AND dp.numeroDocumento LIKE '%$numero%' AND dp.anoDocumento = $ano AND dp.idProcesso = c.idProcesso AND c.idRequerente = r.idRequerente AND a.idAssunto = c.idAssunto AND dp.idDocumento = d.idDocumento ORDER BY d.idDocumento";


$resultado=mysql_query($sql,$conexao) ;
if (mysql_num_rows($resultado) == 0) {
?>

         <div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
            </div>
  <?php
}else{
?>

   <div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
    <table width="100%">
    <thead class="fixedHeader">
    <tr bgcolor="#f5f5dc">
	<th></th>
	<th>NÚMERO</th>
	<th>TIPO</th>
	<th>ANO</th>
	<th>REQUERENTE</th>
	<th>ASSUNTO</th>
	<th>NÚMERO DOC.</th>	
	<th>TIPO DOC.</th>	
	<th>ANO DOC.</th>	
	</tr>
	
	
<?php						
while($dados=mysql_fetch_array($resultado)){
 $i++;
		
		if ($i% 2 == 0)
			$cor = "#CCCCCC";
		else
			$cor = "#FFFFFF";
	
		if($dados['tipoProcesso'] == '1')
			$tipo = "COMUNICAÇÃO INTERNA";
		else
			$tipo = "COMUNICAÇÃO EXTERNA";	
?>	

	
   	<tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
	<td height="5" align ="center"><input type="radio" name="op" value="<?php echo $dados['idProcesso']; ?>"></th>
	<td height="5" align ="center"><?php echo $dados['numeroProcesso']; ?></th>
	<td height="5" align ="center"><?php echo $tipo; ?></td>
	<td height="5" align ="center"><?php echo $dados['anoProcesso']; ?></td>
	<td height="5" align ="center"><?php echo $dados['requerente']; ?></td>
	<td height="5" align ="center"><?php echo $dados['nomeAssunto']; ?></td>
	<td height="5" align ="center"><?php echo $dados['numeroDocumento']; ?></th>
	<td height="5" align ="center"><?php echo $dados['nomeDocumento']; ?></th>
	<td height="5" align ="center"><?php echo $dados['anoDocumento']; ?></th>

	</tr>
	
<?php
}
?>

</table>		
</div>			



          <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />
	
	<input type="submit"  value ="    CONSULTAR    ">	
	</form>

<?php 
}
?>

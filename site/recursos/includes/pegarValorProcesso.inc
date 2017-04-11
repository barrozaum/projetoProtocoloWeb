

<?php 
//Pega o ultimo processo cadastrado do tipo interno

$interna = 0;
$dt = date('Y');

include('recursos/includes/verConexao.inc');
$sql= "SELECT numeroProcesso FROM cadastroProcesso WHERE tipoProcesso = 1 AND anoProcesso = $dt ORDER BY idProcesso";
$resultado = mysql_query($sql,$conexao);
while($dados = mysql_fetch_array($resultado)){
$interna = $dados['numeroProcesso'];
}
$interna++;

?>

<?php 
//Pega o ultimo processo cadastrado do tipo externo


$externa= 0;
$dt = date('Y');

include('recursos/includes/verConexao.inc');
$sql= "SELECT numeroProcesso FROM cadastroProcesso WHERE tipoProcesso = 2 AND anoProcesso = $dt ORDER BY idProcesso";
$resultado = mysql_query($sql,$conexao);
while($dados = mysql_fetch_array($resultado)){
$externa= $dados['numeroProcesso'];
}
$externa++;

?>

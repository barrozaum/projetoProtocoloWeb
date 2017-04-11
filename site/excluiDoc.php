<?php
session_start();
include ('recursos/includes/verSessao.inc');
include ('recursos/includes/verConexao.inc');
?>
<?php

echo $cod = $_REQUEST['cod'];

$sql = "DELETE FROM documentoprocesso WHERE  idDocumentoProcesso = $cod";

mysql_query($sql,$conexao) or die('Erro no SQL');


echo "<script>location.href='consultaNumero.php'</script>";

?>

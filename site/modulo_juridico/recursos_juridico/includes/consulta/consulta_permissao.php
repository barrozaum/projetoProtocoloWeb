<?php
//validando sessao
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';
include_once '../../../../recursos/includes/funcoes/function_letraMaiscula.php';

$id_usuario_selecionado = letraMaiuscula($_POST['id']);


$sql = "SELECT * FROM permissao_juridico WHERE id_usuario = '{$id_usuario_selecionado}'";
$query = $pdo->prepare($sql);
$query->execute();
if($dados = $query->fetch()){
    $nivel = $dados['nivel_acesso'];
}else{
    $nivel = "";
}

$var = array('nivel' => $nivel);


echo json_encode($var);
?>

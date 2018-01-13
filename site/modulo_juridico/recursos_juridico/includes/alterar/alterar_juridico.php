<?php
//die(print_r($_FILES));
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../../../../recursos/includes/funcoes/function_letraMaiscula.php';
    include_once '../../../../recursos/includes/funcoes/funcao_formata_data.php';

    $id_processo_juridico = letraMaiuscula($_POST['txt_jud_cod_processo']);
    $jud_proximo_prazo = dataAmericano(letraMaiuscula($_POST['txt_dt_final']));
    $jud_observacao = $_POST['txt_observacao_judicial'];

    try {
        include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';

        $pdo->begintransaction();
//        sql para dizer que o processo ja foi cadastrado como juridico

        $sql_altera_prazo = "UPDATE prazo_processo_judicial SET ativo = 0 WHERE id_processo_judicial = '{$id_processo_juridico}'";
        $query_alterar = $pdo->prepare($sql_altera_prazo);
        $query_alterar->execute();

        $sql_observacao = "INSERT INTO prazo_processo_judicial (id_processo_judicial, observacao_processo_judicial,data_observacao, prazo_processo, usuario, ativo)";
        $sql_observacao = $sql_observacao . " VALUES ";
        $sql_observacao = $sql_observacao . "('{$id_processo_juridico}', '{$jud_observacao}', now(), '{$jud_proximo_prazo}', '{$_SESSION['LOGIN_USUARIO']}', 1)";
        $query_observacao = $pdo->prepare($sql_observacao);
        $query_observacao->execute();



        if (isset($_FILES)) {

            foreach ($_FILES["txt_documento"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    if ($_FILES['txt_documento']['type'][$key] == "application/pdf") {
                        $tmp_name = $_FILES["txt_documento"]["tmp_name"][$key];
                        $extensao = func_descobri_extensao_arquivo($_FILES["txt_documento"]["name"][$key]);
                        $name = substr(md5(uniqid(time())), 0, 50) . "." . $extensao;

                        move_uploaded_file($tmp_name, "../documentos_uploader/$name");


//                    inserindo a referencia no banco de dados
                        $descricao = $_POST['txt_descricao_documento'];
                        $sql_upload = "INSERT INTO upload_judiciais (id_processo_judicial,arquivo, descricao, usuario, dataUploader, ativo ) ";
                        $sql_upload = $sql_upload . " VALUE ";
                        $sql_upload = $sql_upload . " ('{$id_processo_juridico}','{$name}', '{$descricao[$key]}', '{$_SESSION['LOGIN_USUARIO']}', now(), 1)";
                        $query_upload = $pdo->prepare($sql_upload);
                        $query_upload->execute();
                    }
                }
            }
        }

        $pdo->commit();
        $msg = "ALTERADO COM SUCESSO !!! ";
    } catch (Exception $e) {
        $msg = $e->getMessage();
    }

    echo '<script>window.alert("' . $msg . '");
                    location.href = "../../../inicial.php";
                     </script>';


// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../../logout.php"));
}
?>
<?php

function func_descobri_extensao_arquivo($nome_arquivo) {
    $aux_extensao = explode(".", $nome_arquivo);
    foreach ($aux_extensao as $valor) {
        $extensao = $valor;
    }
    return $extensao;
}

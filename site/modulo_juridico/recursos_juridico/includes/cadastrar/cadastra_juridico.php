<?php

include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../../../../recursos/includes/funcoes/function_letraMaiscula.php';
    include_once '../../../../recursos/includes/funcoes/funcao_formata_data.php';

//    protocololado
    $proto_id_processo = letraMaiuscula($_POST['txt_cod_processo']);
    $proto_numero_processo = letraMaiuscula($_POST['txt_numero_processo']);
    $proto_ano_processo = letraMaiuscula($_POST['txt_ano_processo']);
    $proto_tipo_processo = letraMaiuscula($_POST['txt_cod_tipo_processo']);

//    judicial
    $jud_numero_processo = letraMaiuscula($_POST['txt_numero_processo_judicial']);
    $jud_ano_processo = letraMaiuscula($_POST['txt_ano_processo_judicial']);
    $jud_data_inicio_processo = dataAmericano(letraMaiuscula($_POST['txt_dt_inicial']));
    $jud_acao = letraMaiuscula($_POST['txt_acao_processo_judicial']);
    $jud_autor = letraMaiuscula($_POST['txt_autor_processo_judicial']);
    $jud_reu = letraMaiuscula($_POST['txt_reu_processo_judicial']);
    $jud_proximo_prazo = dataAmericano(letraMaiuscula($_POST['txt_dt_final']));
    $jud_observacao = $_POST['txt_observacao_judicial'];


    try {
        include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';

        $pdo->begintransaction();
//        sql para dizer que o processo ja foi cadastrado como juridico
        $sql_alt = "UPDATE cadastro_processo SET juridico = 1 WHERE idProcesso = {$proto_id_processo} ";
        $query_alt = $pdo->prepare($sql_alt);
        $query_alt->execute();


        $sql_insere_juridico = "INSERT INTO processo_judicial (prot_id_processo, prot_numero_processo, prot_tipo_processo, prot_ano_processo, jud_numero,jud_ano_processo, jud_data_inicio, jud_acao, jud_autor, jud_reu, usuario)";
        $sql_insere_juridico = $sql_insere_juridico . " VALUES";
        $sql_insere_juridico = $sql_insere_juridico . " ({$proto_id_processo}, '{$proto_numero_processo}', '{$proto_tipo_processo}', '{$proto_ano_processo}', '{$jud_numero_processo}','{$jud_ano_processo}', '{$jud_data_inicio_processo}', '{$jud_acao}', '{$jud_autor}', '{$jud_reu}', '{$_SESSION['LOGIN_USUARIO']}')";

        $query_insere_juridico = $pdo->prepare($sql_insere_juridico);
        $query_insere_juridico->execute();
        $ultima_id_inserida = $pdo->lastInsertId();

        $sql_observacao = "INSERT INTO prazo_processo_judicial (id_processo_judicial, observacao_processo_judicial,data_observacao, 	prazo_processo, usuario, ativo)";
        $sql_observacao = $sql_observacao . " VALUES ";
        $sql_observacao = $sql_observacao . "('{$ultima_id_inserida}', '{$jud_observacao}', now(), '{$jud_proximo_prazo}', '{$_SESSION['LOGIN_USUARIO']}', 1)";
        $query_observacao = $pdo->prepare($sql_observacao);
        $query_observacao->execute();



        if (isset($_FILES)) {

            foreach ($_FILES["txt_documento"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["txt_documento"]["tmp_name"][$key];
                    $extensao = func_descobri_extensao_arquivo($_FILES["txt_documento"]["name"][$key]);
                    $name = substr(md5(uniqid(time())), 0, 50) . "." . $extensao;

                    move_uploaded_file($tmp_name, "../documentos_uploader/$name");


//                    inserindo a referencia no banco de dados
                    $descricao = $_POST['txt_descricao_documento'];
                    $sql_upload = "INSERT INTO upload_judiciais (id_processo_judicial,arquivo, descricao, usuario, dataUploader) ";
                    $sql_upload = $sql_upload . " VALUE ";
                    $sql_upload = $sql_upload . " ('{$ultima_id_inserida}','{$name}', '{$descricao[$key]}', '{$_SESSION['LOGIN_USUARIO']}', now())";
                    $query_upload = $pdo->prepare($sql_upload);
                    $query_upload->execute();
                }
            }
        }

        $pdo->commit();
        $msg = "ENTRADA NO JURIDICO REALIZADA COM SUCESSO !!! ";
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

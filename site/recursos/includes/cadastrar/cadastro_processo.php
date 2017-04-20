<?php
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/fun_log.php';
include ('../funcoes/function_letraMaiscula.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

    $numero_processo_banco = (int) letraMaiuscula($_POST['txt_numero_processo_banco']);
    $tipo_processo = (int) letraMaiuscula($_POST['txt_tipo_processo']);
    $numero_processo = (int) letraMaiuscula($_POST['txt_numero_processo']);
    $ano_processo = (int) letraMaiuscula($_POST['txt_ano_processo']);
    $codigo_assunto_processo = (int) letraMaiuscula($_POST['txt_codigo_assunto']);
    $complemento_assunto_processo = letraMaiuscula($_POST['txt_complemento_asssuto']);
    $codigo_origem_processo = (int) letraMaiuscula($_POST['txt_codigo_origem']);
    $codigo_requerente_processo = (int) letraMaiuscula($_POST['txt_codigo_requerente']);
    $observacao_processo = letraMaiuscula($_POST['txt_obs_processo']);


//data_criacao_processo
    $data_atual = date('Y-m-d');

//      Conexao com o banco de dados  
    include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
    $pdo->beginTransaction();


//      Comando sql a ser executado  
    $sql = "INSERT INTO cadastro_processo (idProcesso, numeroProcesso, tipoProcesso, anoProcesso, dataProcesso, idAssunto, complemento_assunto, idOrigem, idRequerente, idUsuario)";
    $sql = $sql . " VALUES ";
    $sql = $sql . " (null, {$numero_processo}, {$tipo_processo}, {$ano_processo}, '{$data_atual}', {$codigo_assunto_processo}, '{$complemento_assunto_processo}', {$codigo_origem_processo}, {$codigo_requerente_processo},{$_SESSION['LOGIN_ID_USUARIO']} ) ";

    $executa = $pdo->query($sql);
    $id_proceso = $pdo->lastInsertId();

    if (!$executa) {
        $pdo->rollback();
        die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../cadastro_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
    } else if (!inserindo_documentos($pdo, $id_proceso)) {
        $pdo->rollback();
        die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../cadastro_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
    } else if (!inserindo_observacao($pdo, $id_proceso, $observacao_processo)) {
        $pdo->rollback();
        die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../cadastro_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
    } else if (!alterando_proximo_processo($pdo, $tipo_processo, $numero_processo, $numero_processo_banco)) {
        $pdo->rollback();
        die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../cadastro_processo.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
    } else {
        $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
    }
//        fecho conexao
    $pdo = null;
    ?>
    <!-- Dispara mensagem de sucesso -->
    <script>
        window.alert("<?php echo "Assunto Cadastrado com Sucesso !!!"; ?> ");
        location.href = "../../../cadastro_processo.php";
    </script>


    <?php
// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}

function inserindo_documentos($pdo, $id_proceso) {
    if (isset($_POST['txt_id_doc'])) {
        $codigo_documento = (int) $_POST['txt_id_doc'];
        $nume_documento = (int) $_POST['txt_numero_doc'];
        $ano_documento = (int) $_POST['txt_ano_doc'];

        $quant_linhas = count($codigo_documento);
        for ($i = 0; $i < $quant_linhas; $i++) {
            $codigo_documento[$i];
            $nume_documento[$i];
            $ano_documento[$i];

            $sql_doc = "INSERT INTO documento_processo (idProcesso, idDocumento, anoDocumento, numeroDocumento, idUsuario)";
            $sql_doc = $sql_doc . " VALUES ";
            $sql_doc = $sql_doc . "({$id_proceso}, {$codigo_documento}, {$ano_documento}, {$nume_documento}, {$_SESSION['LOGIN_ID_USUARIO']})";

            if ($executa = $pdo->query($sql_doc)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    return TRUE;
}

function inserindo_observacao($pdo, $id_processo, $observacao) {
    $sql_obs = "INSERT INTO obs (idObs, idProcesso, obs)";
    $sql_obs = $sql_obs . " VALUES ";
    $sql_obs = $sql_obs . "(null, {$id_processo}, '{$observacao}') ";

    if ($executa = $pdo->query($sql_obs)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function alterando_proximo_processo($pdo, $tipo_processo, $numero_processo, $numero_processo_banco) {

    if ($numero_processo < $numero_processo_banco) {
        return true;
    } else {
        $sql_tipo = "UPDATE tipo_processo SET numero_proximo_processo = ($numero_processo + 1) WHERE id_tipo_processo  = {$tipo_processo}";

        if ($executa = $pdo->query($sql_tipo)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
?>
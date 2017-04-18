<?php
//valido a sessão do usuário 
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/fun_log.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//ARRAY PARA ARMAZENAR ERROS
    $array_erros = array();

// biblioteca para validar string informada    
    include ('../funcoes/function_letraMaiscula.php');
//    aplica filtro na string enviada (LetraMaiuscula)
    $codigo_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_codigo']);
    $secretaria_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_secretaria']);
    $descricao_secretaria_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_descricao_secretaria']);
    $coordenadoria_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_coordenadoria']);
    $descricao_coordenadoria_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_descricao_coordenadoria']);
    $departamento_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_departamento']);
    $descricao_departamento_Letra_Maiscula = letraMaiuscula($_POST['txt_alterar_descricao_departamento']);


// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($secretaria_Letra_Maiscula) > 2) {
        $secretaria = $secretaria_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_secretaria'] = 'POR FAVOR ENTRE COM A SECRETARIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_secretaria_Letra_Maiscula) > 2) {
        $descricao_secretaria = $descricao_secretaria_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_descricao_secretaria'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO SECRETARIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($coordenadoria_Letra_Maiscula) > 2) {
        $coordenadoria = $coordenadoria_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_coordenadoria'] = 'POR FAVOR ENTRE COM A COORDENADORIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_coordenadoria_Letra_Maiscula) > 2) {
        $descricao_coordenadoria = $descricao_coordenadoria_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_descricao_coordenadoria'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO COORDENADORIA VÁLIDA \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($departamento_Letra_Maiscula) > 2) {
        $departamento = $departamento_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_departamento'] = 'POR FAVOR ENTRE COM O DEPARTAMENTO VÁLIDO \n';
    }

// filtro pra validar Nome do Bairro (não ter nenhum sql_injection)
    if (strlen($descricao_departamento_Letra_Maiscula) > 2) {
        $descricao_departamento = $descricao_departamento_Letra_Maiscula;
    } else {
        $array_erros['txt_alterar_descricao_departamento'] = 'POR FAVOR ENTRE COM A DESCRIÇÃO DEPARTAMENTO VÁLIDO \n';
    }

// verifico se tem erro na validação
    if (empty($array_erros)) {

//      Conexao com o banco de dados  
        include_once '../estrutura/conexao/conexao.php';

//      Inicio a transação com o banco        
        $pdo->beginTransaction();

//      Comando sql a ser executado  
        $sql = "UPDATE setor ";
        $sql = $sql . " SET setor = '{$secretaria}', ";
        $sql = $sql . " setor = '{$secretaria}', ";
        $sql = $sql . " secretaria = '{$secretaria}', ";
        $sql = $sql . " descSecretaria = '{$descricao_secretaria}', ";
        $sql = $sql . " coordenadoria = '{$coordenadoria}', ";
        $sql = $sql . " descCoordenadoria = '{$descricao_coordenadoria}', ";
        $sql = $sql . " departamento = '{$departamento}', ";
        $sql = $sql . " descDepartamento = '{$descricao_departamento}' ";
        $sql = $sql . " WHERE idSetor = '{$codigo_Letra_Maiscula}'";

//      execução com comando sql    
        $executa = $pdo->query($sql);

//      Verifico se comando foi realizado      
        if (!$executa) {
//          Caso tenha errro 
//          lanço erro na tela
            die('<script>window.alert("Erro ao Cadastrar  !!!");location.href = "../../../cadastro_secretaria.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else if (fun_log_setor($pdo, 'A', $sql) == FALSE) {
            die('<script>window.alert("Erro ao Cadastrar Log !!!");location.href = "../../../cadastro_secretaria.php";</script>'); /* É disparado em caso de erro na inserção de movimento */
        } else {

//          die();
//          salvo alteração no banco de dados
            $pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
        }
//        fecho conexao
        $pdo = null;
        ?>
        <!-- Dispara mensagem de sucesso -->
        <script>
            window.alert("<?php echo "Setor Alterado com Sucesso !!!"; ?> ");
            location.href = "../../../cadastro_secretaria.php";
        </script>

        <?php
//  if (empty($array_erros)) {
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_secretaria.php";
        </script>';
    }



// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
?>
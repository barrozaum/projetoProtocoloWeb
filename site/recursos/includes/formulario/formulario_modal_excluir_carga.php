<?php
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcaoCriacaoInput.php';
include_once '../funcoes/funcao_formata_data.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/func_telas_de_erros.php';
include_once '../funcoes/func_retorna_setor.php';
include_once '../funcoes/func_retorna_usuario.php';
include_once '../funcoes/func_carga_processo.php';


if ($_POST['cod'] === '01') {
    $tipo_processo = letraMaiuscula($_POST['txt_tipo_processo']);
    $numero_processo = letraMaiuscula($_POST['txt_numero_processo']);
    $ano_processo = letraMaiuscula($_POST['txt_ano_processo']);

    mostrar_formulario($pdo, $tipo_processo, $numero_processo, $ano_processo);
    $pdo = null;
}

function mostrar_formulario($pdo, $tipo_processo, $numero_processo, $ano_processo) {
//   buscando dados do processo
//    consulta para saber se o processo existe
    $sql = "SELECT * FROM cadastro_processo ";
    $sql = $sql . " WHERE tipoProcesso = '{$tipo_processo}'";
    $sql = $sql . " AND numeroProcesso = '{$numero_processo}'";
    $sql = $sql . " AND anoProcesso = '{$ano_processo}'";
    $sql = $sql . " LIMIT 1";
    $query = $pdo->query($sql);
    $query->execute();
    if (($dados = $query->fetch()) == true) {
        $id_processo = $dados['idProcesso'];
        $descricao_assunto = $dados['descricao_assunto'];
        $descricao_origem = $dados['descricao_origem'] ;
        $requerente = $dados['descricao_requerente'];
        $idAnexado = 0;
    } else {
        criar_modal_erros("ERROR !!!", "Desculpe, porém não encotramos o processo desejado !!!");
        die();
    }
    ?>

    <form name="formulario_carga" id="id_formulario_carga" action="recursos/includes/excluir/excluir_carga.php" method="POST">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <p class="text-danger">EXCLUIR CARGA PROCESSO !!!</p></h4>
            <div id="error_modal"></div>
        </div>
        <div class="modal-body">
            <?php
//                código do processo
            criar_input_hidden('codigo_processo', array(), $id_processo);
            ?>


            <div class="row">
                <div class="col-sm-8">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Requerente', 'requerente', 'requerente', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Requerente'), $requerente);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Assunto', 'assunto', 'assunto', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe o Assunto'), $descricao_assunto);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    //   INPUT -                              
                    criar_input_text('Origem', 'origem', 'origem', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '30', 'placeholder' => 'Informe a Origem'), $descricao_origem);
                    ?>
                </div>
            </div>

            <?php
            $retorno_cargas = listar_cargas_processo($pdo, $id_processo);
            if (is_array($retorno_cargas)) {
                mostrar_tabela_cargas($retorno_cargas);
            } else {
                mostrar_mensagem('DESCULPE MAIS ALGO DEU ERRADO NA CARGA');
            }
            ?>


        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="id_btn_enviar_carga">EXCLUIR </button>
        </div>
    </form>
    <?php
}
?>

<?php

function mostrar_tabela_cargas($retorno_cargas) {
    $tabela = " <hr />";
    $tabela = $tabela . " <p>HISTÓRICO DE CARGAS </p>";
    $tabela = $tabela . " <div style='overflow: auto; max-width: 100%; max-height: 200px'>";
    $tabela = $tabela . "<table class='table table-striped table-hover'>";
    $tabela = $tabela . "<tr>";
    $tabela = $tabela . "<th> </th>";
    $tabela = $tabela . "<th>DATA </th>";
    $tabela = $tabela . "<th>SETOR</th>";
    $tabela = $tabela . "<th>SEQUENCIA</th>";
    $tabela = $tabela . "</tr>";

    $quantidade_array = count($retorno_cargas);
    for ($i = 0; $i < $quantidade_array; $i++) {
        $tabela = $tabela . "<tr>";

        if ($retorno_cargas[$i]['sequencia_carga'] != 0) {
            $tabela = $tabela . "<td><input type='radio' name='txt_carga' id='id_carga' value='" . $retorno_cargas[$i]['id_carga'] . "' required='true'/></td>";
        } else {
            $tabela = $tabela . "<th> </th>";
        }
        $tabela = $tabela . "<td>" . $retorno_cargas[$i]['data_carga'] . "</td>";
        $tabela = $tabela . "<td>" . $retorno_cargas[$i]['setor_entrada'] . "</td>";
        $tabela = $tabela . "<td>" . $retorno_cargas[$i]['sequencia_carga'] . "</td>";
        $tabela = $tabela . "</tr>";
    }
    $tabela = $tabela . "</table>";
    $tabela = $tabela . "</div>";
    print $tabela;
}
?>



<?php

function mostrar_mensagem($msg) {
    print "<p class='text-danger'>{$msg}</p>";
}
?>
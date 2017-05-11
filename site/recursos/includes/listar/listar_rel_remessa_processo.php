<?php
include_once '../estrutura/controle/validar_secao.php';
include_once '../funcoes/function_letraMaiscula.php';
include_once '../funcoes/funcao_formata_data.php';

//verifico se a página está sendo chamada pelo méthod POST
// Se sim executa escript
// Senao dispara Erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {// dados formulario 
    $setor = letraMaiuscula($_POST['setor']);
    $data_inicial = letraMaiuscula($_POST['dt_inicial']);
    $data_final = letraMaiuscula($_POST['dt_final']);
    $codigo_setor = letraMaiuscula($_POST['codigo_setor']);

// validação 
    $array_erros = array();

    if (validar_estrutura_data($data_inicial)) {
        $data_inicial = dataAmericano($data_inicial);
    } else {
        $array_erros['txt_data_inicial'] = "POR FAVOR VERIFIQUE A DATA INICIAL !!! <br />";
    }

    if (validar_estrutura_data($data_final)) {
        $data_final = dataAmericano($data_final);
    } else {
        $array_erros['txt_data_final'] = "POR FAVOR VERIFIQUE A DATA FINAL !!! <br />";
    }

    if ((strlen($setor) < 3 ) || strlen($codigo_setor) < 1) {
        $array_erros['txt_setor'] = "POR FAVOR ENTRE COM SETOR VÁLIDO ";
    }

    if (empty($array_erros)) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>Arrecadação</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <script>
                    $(document).ready(function () {
                        $('#table').DataTable();
                    });
                </script>
            </head>
            <body>
                <form name="form_gerar_rel" id="id_form_gerar_rel" action="recursos/includes/relatorio/relatorio_remessa_processo.php" method="post" target="_blank">
                    <input type="hidden" value="<?php print $codigo_setor ?>" name="txt_setor_entrada" required="true" >
                    <div style="overflow: auto; max-width: 100%;">
                        <table id="table" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>TIPO PROCESSO</th>
                                    <th>NÚMERO PROCESSO</th>
                                    <th>ANO PROCESSO</th>
                                    <th>ASSUNTO</th>
                                    <th>REQUERENTE</th>
                                    <th>ORIGEM</th>
                                    <th>DT_CARGA</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // chamo a conexao com o banco de dados
                                include_once '../estrutura/conexao/conexao.php';
                                // preparo para realizar o comando sql
                                $sql = "SELECT * FROM carga_processo cp, cadastro_processo p, assunto a, tipo_processo t, requerente r, origem o";
                                $sql = $sql . " WHERE cp.tramite = 0";
                                $sql = $sql . " AND cp.idSetorOrigem  = '{$_SESSION['LOGIN_CODIGO_SETOR_USUARIO']}'";
                                $sql = $sql . " AND cp.idSetorEntrada = '{$codigo_setor}'";
                                $sql = $sql . " AND cp.dataCarga >= '{$data_inicial}'";
                                $sql = $sql . " AND cp.dataCarga <= '{$data_final}'";
                                $sql = $sql . " AND cp.idProcesso= p.idProcesso";
                                $sql = $sql . " AND p.tipoProcesso= t.id_tipo_processo";
                                $sql = $sql . " AND p.idAssunto= a.idAssunto";
                                $sql = $sql . " AND p.idRequerente= r.idRequerente";
                                $sql = $sql . " AND p.idOrigem= o.idOrigem";
                                
                                $query = $pdo->prepare($sql);

//                            print $sql;
                                //executo o comando sql
                                $query->execute();



                                //loop para listar todos os dados encontrados
                                for ($i = 0; $dados = $query->fetch(); $i++) {
                                 
                                    ?>   	


                                    <tr>
                                        <td><input type="checkbox" name="txt_op[]" value="<?php echo $dados['idCarga']; ?>" ></td>
                                        <td><?php echo $dados['descricao_tipo_processo']; ?></td>
                                        <td><?php echo $dados['numeroProcesso']; ?></td>
                                        <td><?php echo $dados['anoProcesso']; ?></td>
                                        <td><?php echo $dados['descricao_assunto'] . " " . $dados['complemento_assunto']; ?></td>
                                        <td><?php echo $dados['requerente']; ?></td>
                                        <td><?php echo $dados['descricao_origem']; ?></td>
                                        <td><?php echo dataBrasileiro($dados['dataCarga']); ?></td>
                                    </tr>


                                    <?php
                                }
                                $pdo = null;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <?php if(!empty($i)){ ?>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="id_gerar_relatorio" >GERAR RELATÓRIO</button>
                        </div>
                        <?php } ?>
                    </div>
                </form>
            </body>
        </html>


        <?php
    } else {
        $msg_erro = '';
        foreach ($array_erros as $msg) {
            $msg_erro = $msg_erro . $msg;
        }

        echo '<script>window.alert("' . $msg_erro . '");
               location.href = "../../../cadastro_assunto.php";
        </script>';
    }


// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../logout.php"));
}
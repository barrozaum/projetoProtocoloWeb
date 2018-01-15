<?php
include_once '../estrutura/controle/validar_secao.php';
// funcao para conversão de datas
include_once '../funcoes/funcao_formata_data.php';
//função aqu diz os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';


//parametros enviados pelo formulario de pesquisa
$numero_protocolo = $_POST['numero'];
$ano_protocolo = $_POST['ano'];
$requerente_protocolo = $_POST['requerente'];
$assunto_protocolo = $_POST['assunto'];
$observacao_protocolo = $_POST['observacao'];
$clausa_where = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Processo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            $(document).ready(function () {
                $('#table').DataTable();
            });
        </script>
    </head>
    <body>




        <div style="overflow: auto; max-width: 100%;">
            <table id="table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NÚMERO</th>
                        <th>ANO</th>
                        <th>DATA</th>
                        <th>REQUERENTE</th>
                        <th>ASSUNTO</th>
                        <th>OBSERVAÇÃO</th>
                        <th>ORIGEM</th>
                        <th>NUM. PROC.</th>
                        <th>ANO PROC.</th>
                        <th>TIPO PROC.</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql

                    $sql = "SELECT * FROM protocolo ";


//                    verificico se o campo numero e ano foi preenchido corretamente
                    if (($numero_protocolo !== "000000" && $ano_protocolo !== "0000") && (strlen($numero_protocolo) == 6 && strlen($ano_protocolo) == 4)) {
                        $sql = $sql . " WHERE numero_protocolo = '{$numero_protocolo}' ";
                        $sql = $sql . " AND ano_protocolo = '{$ano_protocolo}'";
                        $clausa_where = 1;
                    }

                    if (strlen($requerente_protocolo) > 2) {
                        if ($clausa_where == 0) {
                            $sql = $sql . " WHERE requerente_protocolo like '%{$requerente_protocolo}%' ";
                        } else {
                            $sql = $sql . " AND requerente_protocolo like '%{$requerente_protocolo}%' ";
                        }
                    }
                    if (strlen($assunto_protocolo) > 2) {
                        if ($clausa_where == 0) {
                            $sql = $sql . " WHERE assunto_protocolo like '%{$assunto_protocolo}%' ";
                        } else {
                            $sql = $sql . " AND assunto_protocolo like '%{$assunto_protocolo}%' ";
                        }
                    }
                    if (strlen($observacao_protocolo) > 2) {
                        if ($clausa_where == 0) {
                            $sql = $sql . " WHERE observacao_protocolo like '%{$observacao_protocolo}%' ";
                        } else {
                            $sql = $sql . " AND observacao_protocolo like '%{$observacao_protocolo}%' ";
                        }
                    }




                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();

                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>      


                        <tr>
                            <td><?php echo $dados['numero_protocolo']; ?></td>
                            <td><?php echo $dados['ano_protocolo']; ?></td>
                            <td><?php echo dataBrasileiro($dados['data_protocolo']); ?></td>
                            <td><?php echo $dados['requerente_protocolo']; ?></td>
                            <td><?php echo $dados['assunto_protocolo']; ?></td>
                            <td><?php echo $dados['observacao_protocolo']; ?></td>
                            <td><?php echo $dados['origem_protocolo']; ?></td>
                            <td><?php echo $dados['numero_processo_protocolo']; ?></td>
                            <td><?php echo $dados['ano_processo_protocolo']; ?></td>
                            <td><?php echo fun_retorna_descricao_tipo_processo($pdo,$dados['tipo_processo_protocolo']); ?></td>

                        </tr>

                        <?php
                    }
                    $pdo = null;
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>



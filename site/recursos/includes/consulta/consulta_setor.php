<?php
include_once '../estrutura/controle/validar_secao.php';
// funcao para conversão de datas
include_once '../funcoes/funcao_formata_data.php';
//função aqu diz os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';


//parametros enviados pelo formulario de pesquisa
$setor = $_POST['setor'];
$data_inicial = dataAmericano($_POST['dt_inicial']);
$data_final = dataAmericano($_POST['dt_final']);
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
                        <th>TIPO</th>
                        <th>ANO</th>
                        <th>SETOR</th>
                        <th>ASSUNTO</th>
                        <th>REQUERENTE</th>
                        <th>DATA</th>
                        <th>CONSULTAR</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "SELECT * ";
                    $sql = $sql . " FROM setor s, carga_processo cp, cadastro_processo c, assunto a, requerente r ";
                    $sql = $sql . " WHERE s.setor like '%$setor%'";
                    $sql = $sql . " AND s.idSetor = cp.idSetorOrigem";
                    $sql = $sql . " AND s.idSetor = cp.idSetorEntrada";
                    $sql = $sql . " AND cp.tramite = '1'"; // igual a 1 significa recebido e parado
                    $sql = $sql . " AND cp.idProcesso = c.idProcesso"; // igual a 1 significa recebido e parado
                    $sql = $sql . " AND c.idAssunto = a.idAssunto ";
                    $sql = $sql . " AND c.idRequerente = r.idRequerente ";
                    $sql = $sql . " AND cp.dataRecebimento >= '$data_inicial' ";
                    $sql = $sql . " AND cp.dataRecebimento <= '$data_final' ";
                    $sql = $sql . " ORDER BY  cp.dataRecebimento DESC";
                    $query = $pdo->prepare($sql);

                    //executo o comando sql
                    $query->execute();

                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados['numeroProcesso']; ?></td>
                            <td><?php echo fun_retorna_descricao_tipo_processo($pdo, $dados['tipoProcesso']); ?></td>
                            <td><?php echo $dados['anoProcesso']; ?></td>
                            <td><?php echo $dados['setor']; ?></td>
                            <td><?php echo $dados['descricao_assunto'].' '.  $dados['complemento_assunto']; ?></td>
                            <td><?php echo $dados['requerente']; ?></td>
                            <td><?php echo dataBrasileiro($dados['dataProcesso']); ?></td>
                            <td><a href="#" id="id_consultar_processo"  data-id="<?php echo $dados['idProcesso']; ?>"><img src="recursos/imagens/estrutura/lupa.png" alt="consultar" height="20px;"></a></td>

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



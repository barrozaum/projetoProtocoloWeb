<?php
include_once '../estrutura/controle/validar_secao.php';
// funcao para conversão de datas
include_once '../funcoes/funcao_formata_data.php';
//função aqu diz os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';


//parametros enviados pelo formulario de pesquisa
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

//                    seleciono os processos que não estão em movimento
                    $sql_carga = "SELECT cp.idProcesso, MAX(cp.seq_carga) AS maior_sequencia ";
                    $sql_carga = $sql_carga . " FROM carga_processo cp";
                    $sql_carga = $sql_carga . " WHERE idProcesso NOT IN ("; // select dentro de select
                    $sql_carga = $sql_carga . "  SELECT idProcesso"; // 
                    $sql_carga = $sql_carga . "  FROM carga_processo "; // 
                    $sql_carga = $sql_carga . "  WHERE tramite = 0"; // 
                    $sql_carga = $sql_carga . "   ORDER BY seq_carga desc) "; // fim do select interno
                    $sql_carga = $sql_carga . " GROUP by idProcesso "; // fim do select interno
                    $query = $pdo->prepare($sql_carga);
                    $query->execute();
                    for ($i = 0; $dados = $query->fetch(); $i++) {

                        $sql_processo = "SELECT * FROM carga_processo cp, cadastro_processo c, tipo_processo t ";
                        $sql_processo = $sql_processo . " WHERE cp.idProcesso =  '{$dados['idProcesso']}'";
                        $sql_processo = $sql_processo . " AND cp.seq_carga=  '{$dados['maior_sequencia']}'";
                        $sql_processo = $sql_processo . " AND cp.idSetorEntrada = '{$_POST['txt_codigo_setor']}'";
                        $sql_processo = $sql_processo . " AND cp.idProcesso = c.idProcesso";
                        $sql_processo = $sql_processo . " AND c.tipoProcesso = t.id_tipo_processo";
                        $sql_processo = $sql_processo . " AND  cp.dataCarga >= '{$data_inicial}'";
                        $sql_processo = $sql_processo . " AND  cp.dataCarga <= '{$data_final}'";
                        $sql_processo = $sql_processo . " LIMIT 1";

                        $query_processo = $pdo->prepare($sql_processo);
                        $query_processo->execute();
                         for ($contador = 0; $dados_processo = $query_processo->fetch(); $contador++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados_processo['numeroProcesso']; ?></td>
                            <td><?php echo $dados_processo['descricao_tipo_processo']; ?></td>
                            <td><?php echo $dados_processo['anoProcesso']; ?></td>
                            <td><?php echo $dados_processo['descricao_assunto']; ?></td>
                            <td><?php echo $dados_processo['descricao_requerente']; ?></td>
                            <td><?php echo dataBrasileiro($dados_processo['dataProcesso']); ?></td>
                            <td><a href="#" id="id_consultar_processo"  data-id="<?php echo $dados_processo['idProcesso']; ?>"><img src="recursos/imagens/estrutura/lupa.png" alt="consultar" height="20px;"></a></td>

                        </tr>


                        <?php
                        }
                    }
                    $pdo = null;
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>



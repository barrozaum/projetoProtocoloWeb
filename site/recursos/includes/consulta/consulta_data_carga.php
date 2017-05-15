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
                        <th>DATA CARGA</th>
                        <th>PARECER</th>
                        <th>CONSULTAR</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "SELECT * ";
                    $sql = $sql . " FROM  carga_processo cp, cadastro_processo c , tipo_processo t ";
                    $sql = $sql . " WHERE cp.dataCarga >= '$data_inicial'";
                    $sql = $sql . " AND cp.dataCarga <= '$data_final' ";
                    $sql = $sql . " AND cp.idProcesso = c.idProcesso ";
                    $sql = $sql . " AND c.tipoProcesso = t.id_tipo_processo";
                    $sql = $sql . " ORDER BY  cp.DataCarga DESC   ";
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();
  
                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados['numeroProcesso']; ?></td>
                            <td><?php echo $dados['descricao_tipo_processo']; ?></td>
                            <td><?php echo $dados['anoProcesso']; ?></td>
                            <td><?php echo $dados['descricao_assunto']; ?></td>
                            <td><?php echo $dados['descricao_requerente']; ?></td>
                            <td><?php echo dataBrasileiro($dados['dataCarga']); ?></td>
                            <td><?php echo $dados['parecer']; ?></td>
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



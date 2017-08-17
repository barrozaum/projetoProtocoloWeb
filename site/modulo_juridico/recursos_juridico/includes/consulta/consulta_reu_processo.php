<?php
include_once '../../../../recursos/includes/estrutura/controle/validar_secao.php';
// funcao para conversão de datas
include_once '../../../../recursos/includes/funcoes/funcao_formata_data.php';
//função aqu diz os tipos de processos
include_once '../../../../recursos/includes/funcoes/func_retorna_tipos_processos_existentes.php';


//parametros enviados pelo formulario de pesquisa
$reu_processo = $_POST['reu_processo'];
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
                        <th>PROCESSO</th>
                        <th>ANO</th>
                        <th>REU</th>
                        <th>AUTOR</th>
                        <th>AÇÃO</th>
                        <th>DT_INI_PRO</th>
                        <th>CONSULTAR</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "SELECT * ";
                    $sql = $sql . " FROM  processo_judicial ";
                    $sql = $sql . " WHERE  jud_reu like'%$reu_processo%' ";
                    $sql = $sql . " AND jud_data_inicio >= '$data_inicial' ";
                    $sql = $sql . " AND jud_data_inicio <= '$data_final' ";
                    $sql = $sql . " ORDER BY  id_processo_judicial   ";
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();



//               ?     FROM requerente r, cadastroProcesso cp , assunto a
//	WHERE r.requerente LIKE  '%$decRequerente%' AND r.idRequerente = cp.idRequerente AND cp.idAssunto= a.idAssunto AND cp.dataProcesso >= '$dataAmericanaInicial' AND cp.dataProcesso <= '$dataAmericanaFinal' ORDER BY r.idRequerente  " ;
                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados['jud_numero']; ?></td>
                            <td><?php echo $dados['jud_ano_processo']; ?></td>
                            <td><?php echo $dados['jud_reu']; ?></td>
                            <td><?php echo $dados['jud_autor']; ?></td>
                            <td><?php echo $dados['jud_acao']; ?></td>
                            <td><?php echo dataBrasileiro($dados['jud_data_inicio']); ?></td>
                            <td><a href="#" id="id_consultar_processo"  data-id="<?php echo $dados['id_processo_judicial']; ?>"><img src="../recursos/imagens/estrutura/lupa.png" alt="consultar" height="20px;"></a></td>

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



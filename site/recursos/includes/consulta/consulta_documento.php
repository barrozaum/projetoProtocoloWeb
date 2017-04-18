<?php
include_once '../estrutura/controle/validar_secao.php';
// funcao para conversão de datas
include_once '../funcoes/funcao_formata_data.php';
//função aqu diz os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';


//parametros enviados pelo formulario de pesquisa
$documento = $_POST['documento'];
$numero_documento = $_POST['numero_documento'];
$ano_documento = $_POST['ano_documento'];
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
                        <th>DOCUMENTO</th>
                        <th>NÚMERO DOCUMENTO</th>
                        <th>ANO DOCUMENTO</th>
                        <th>CONSULTAR</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "SELECT * ";
                    $sql = $sql . " FROM  documento d, documento_processo dp, cadastro_processo c , requerente r, assunto a ";
                    $sql = $sql . " WHERE d.descricao_documento LIKE  '%$documento%' ";
                    $sql = $sql . " AND d.idDocumento = dp.idDocumento";
//                    
                    if ($numero_documento != "") {
                        $sql = $sql . " AND dp.numeroDocumento = '$numero_documento'";
                    }
//                    
                    if ($ano_documento != "") {
                        $sql = $sql . " AND dp.anoDocumento = '$ano_documento'";
                    }
//                    
                    $sql = $sql . " AND a.idAssunto = c.idAssunto ";
                    $sql = $sql . " AND c.idRequerente = r.idRequerente ";
                    $sql = $sql . " AND dp.idProcesso = c.idProcesso ";
                    $sql = $sql . " ORDER BY  c.idProcesso   ";
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();

                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados['numeroProcesso']; ?></td>
                            <td><?php echo fun_retorna_tipo_processo_existente($dados['tipoProcesso']); ?></td>
                            <td><?php echo $dados['anoProcesso']; ?></td>
                            <td><?php echo $dados['descricao_documento']; ?></td>
                            <td><?php echo $dados['requerente']; ?></td>
                            <td><?php echo dataBrasileiro($dados['dataProcesso']); ?></td>
                            <td><?php echo $dados['descricao_documento']; ?></td>
                            <td><?php echo $dados['numeroDocumento']; ?></td>
                            <td><?php echo $dados['anoDocumento']; ?></td>
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



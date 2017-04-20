<?php
include_once '../estrutura/controle/validar_secao.php';
// funcao para conversão de datas
include_once '../funcoes/funcao_formata_data.php';
//função aqu diz os tipos de processos
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';


//parametros enviados pelo formulario de pesquisa
$origem = $_POST['origem'];
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
                        <th>ORIGEM</th>
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
//                     $sql = $sql . " FROM  origem a, cadastro_processo c";
                    $sql = $sql . " FROM  origem o, assunto a, cadastro_processo c , requerente r ";
                    $sql = $sql . " WHERE o.descricao_origem LIKE  '%$origem%' ";
                    $sql = $sql . " AND o.idOrigem = c.idOrigem ";
                    $sql = $sql . " AND a.idAssunto = c.idAssunto ";
                    $sql = $sql . " AND c.idRequerente = r.idRequerente ";
                    $sql = $sql . " AND c.dataProcesso >= '$data_inicial' ";
                    $sql = $sql . " AND c. dataProcesso <= '$data_final' ";
                    $sql = $sql . " ORDER BY  c.idProcesso   ";
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();




//                    $sql1 = "SELECT * 
//	FROM  origem o, assunto a, cadastroProcesso c , requerente r
//	WHERE o.nomeOrigem LIKE  '%$decOrigem%' AND o.idOrigem = c.idOrigem AND a.idAssunto = c.idAssunto AND c.idRequerente = r.idRequerente AND c.dataProcesso >= '$dataAmericanaInicial' AND c. dataProcesso <= '$dataAmericanaFinal'ORDER BY a.idAssunto";
//	
                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados['numeroProcesso']; ?></td>
                            <td><?php echo fun_retorna_descricao_tipo_processo($pdo, $dados['tipoProcesso']); ?></td>
                            <td><?php echo $dados['anoProcesso']; ?></td>
                            <td><?php echo $dados['descricao_origem']; ?></td>
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



<?php
include_once '../estrutura/controle/validar_secao.php';
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

        <div style="overflow: auto; max-width: 100%;">
            <table id="table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Alterar</th>
                        <th>Excluir</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "select * FROM tipo_processo order by descricao_tipo_processo";
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();

                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        ?>   	


                        <tr>
                            <td><?php echo $dados['id_tipo_processo']; ?></td>
                            <td><?php echo $dados['descricao_tipo_processo']; ?></td>
                            <td><a href="#" id="edit-editar" data-id="<?php echo $dados['id_tipo_processo']; ?>|<?php echo $dados['descricao_tipo_processo']; ?>"><img src="recursos/imagens/estrutura/alterar.png" height="20px;" alt="alterar"></a></td>
                            <td><a href="#" id="edit-excluir"  data-id="<?php echo $dados['id_tipo_processo']; ?>|<?php echo $dados['descricao_tipo_processo']; ?>"><img src="recursos/imagens/estrutura/lixeira.png" alt="excluir" height="20px;"></a></td>
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



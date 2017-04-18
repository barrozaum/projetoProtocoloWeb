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
                        <th>Requerente</th>
                        <th>Logradouro</th>
                        <th>N° End</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Uf</th>
                        <th>Cep</th>
                        <th>Tel</th>
                        <th>Cel</th>
                        <th>Alterar</th>
                        <th>Excluir</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "select * FROM requerente order by requerente Desc";
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();

                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
                        $param = $dados['idRequerente'];
                        $param = $param . "|" . $dados['requerente'] . "|" . $dados['tel'];
                        $param = $param . "|" . $dados['cel'] . "|" . $dados['cep'];
                        $param = $param . "|" . $dados['logradouro'] . "|" . $dados['bairro'];
                        $param = $param . "|" . $dados['cidade'] . "|" . $dados['uf'];
                        $param = $param . "|" . $dados['numeroEnd'] . "|" . $dados['complemento'];
                        ?>   	


                        <tr>
                            <td><?php echo $dados['idRequerente']; ?></td>
                            <td><?php echo $dados['requerente']; ?></td>
                            <td><?php echo $dados['logradouro']; ?></td>
                            <td><?php echo $dados['numeroEnd']; ?></td>
                            <td><?php echo $dados['complemento']; ?></td>
                            <td><?php echo $dados['bairro']; ?></td>
                            <td><?php echo $dados['cidade']; ?></td>
                            <td><?php echo $dados['uf']; ?></td>
                            <td><?php echo $dados['cep']; ?></td>
                            <td><?php echo $dados['cel']; ?></td>
                            <td><?php echo $dados['tel']; ?></td>
                            <td><a href="#" id="edit-editar" data-id="<?php echo $param; ?>"><img src="recursos/imagens/estrutura/alterar.png" height="20px;" alt="alterar"></a></td>
                            <td><a href="#" id="edit-excluir"  data-id="<?php echo $param; ?>"><img src="recursos/imagens/estrutura/lixeira.png" alt="excluir" height="20px;"></a></td>

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



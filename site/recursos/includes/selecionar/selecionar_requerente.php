<?php
include_once '../estrutura/controle/validar_secao.php';

if ($_GET['janela'] == 1) {
    estruraPagina();
}
if ($_GET['janela'] == 2) {
    dadosPagina();
}
?>

<?php

function estruraPagina() {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Parvaim</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="../../js/jquery.min.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="../../css/jquery.dataTables.min.css">

            <script languagem = "JavaScript">
                function opcao_selecionada(codigo, descricao) {
                    opener.document.getElementById('id_codigo_requerente').value = codigo;
                    opener.document.getElementById('id_requerente').value = descricao;
                    window.close();
                }
            </script>
            <script>
                $(document).ready(function () {
                    $('#table').DataTable();
                });
            </script>
        </head>
        <body>
            <div id="carregamento">
                <script>
                    $(document).ready(function () {
                        var carrega = '<div style="margin-top:50px; margin-left:50%"><img src="../../imagens/ajax-loader.gif" alt="Atender" width="20px"></div>';
                        $('#carregamento').html(carrega);
                        $('#carregamento').load('selecionar_requerente.php?janela=2');
                    });
                </script>
            </div>
        </body>
    </html>

    <?php
}
?>
<?php

function dadosPagina() {
    ?>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>OP</th>
                <th>Código</th>
                <th>Requerente</th>
                <th>Logradouro</th>
                <th>Tel (Fixo)</th>
                <th>Tel (Cel)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // chamo a conexao com o banco de dados
            include_once '../estrutura/conexao/conexao.php';
            // preparo para realizar o comando sql
            $sql = "select * FROM requerente order by requerente";
            $query = $pdo->prepare($sql);
            //executo o comando sql
            $query->execute();

            //loop para listar todos os dados encontrados
            for ($i = 0; $dados = $query->fetch(); $i++) {
                ?>   	


                <tr>
                    <td height="5" align ="center"><input type="radio" name="op" onclick="opcao_selecionada('<?php echo $dados['idRequerente']; ?>', '<?php echo $dados['requerente']; ?>');"> </td>  
                    <td><?php echo $dados['idRequerente']; ?></td>
                    <td><?php echo $dados['requerente']; ?></td>
                    <td><?php echo $dados['logradouro']; ?></td>
                    <td><?php echo $dados['tel']; ?></td>
                    <td><?php echo $dados['cel']; ?></td>
                </tr>
          <?php
            }
            $pdo = null;
            ?>
          
        </tbody>
    </table>
    <?php
}
?>
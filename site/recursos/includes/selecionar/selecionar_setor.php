<?php
include_once '../estrutura/controle/validar_secao.php';

if ($_GET['janela'] == 1) {
    estruraPagina();
}
if ($_GET['janela'] == 2) {
    dadosPagina();
}

if ($_GET['janela'] == 3) {
    estruturaPaginaUsuario();
}
?>

<?php

function estruturaPaginaUsuario() {
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
                function opcao_selecionada(codigo, secretaria, coordenadoria, departamento) {
                    var setor_escolhido = secretaria + " / " + coordenadoria + " / " + departamento;
                    opener.document.getElementById('id_alterar_colaborador_codigo_setor').value = codigo;
                    opener.document.getElementById('id_alterar_colaborador_setor').value = setor_escolhido;
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
                        $('#carregamento').load('selecionar_setor.php?janela=2');
                    });
                </script>
            </div>
        </body>
    </html>

    <?php
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
                    function opcao_selecionada(codigo, secretaria, coordenadoria, departamento) {
                        var setor_escolhido = secretaria + " / " + coordenadoria + " / " + departamento;
                        opener.document.getElementById('id_codigo_setor').value = codigo;
                        opener.document.getElementById('id_setor').value = setor_escolhido;
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
                        var carrega = '<div style="margin-top:50px; margin-left:50%"><img src="../../imagens/ajax-loader.gif" alt="carregando ..." width="20px"></div>';
                        $('#carregamento').html(carrega);
                        $('#carregamento').load('selecionar_setor.php?janela=2');
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
                <th>Secretaria</th>
                <th>Coordenadoria</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
//            utilizo macete para nao deixar cadastrar carga pro mesmo setor
            // chamo a conexao com o banco de dados
            include_once '../estrutura/conexao/conexao.php';
            // preparo para realizar o comando sql
            $sql = "select * FROM setor order by setor";
            $query = $pdo->prepare($sql);
            //executo o comando sql
            $query->execute();

            //loop para listar todos os dados encontrados
            for ($i = 0; $dados = $query->fetch(); $i++) {

                if (isset($_SESSION['NAO_MOSTRAR_SETOR']) && $_SESSION['LOGADO_PERFIL_USUARIO'] == 0) {
                    if ($_SESSION['LOGIN_CODIGO_SETOR_USUARIO'] === $dados['idSetor']) {
                        continue;
                    }
                }

                if ($dados['somente_protocolo'] === "N") {
                    ?>   	


                    <tr>
                        <td height="5" align ="center"><input type="radio" name="op" onclick="opcao_selecionada('<?php echo $dados['idSetor']; ?>', '<?php echo $dados['descSecretaria']; ?>', '<?php echo $dados['descCoordenadoria']; ?>', '<?php echo $dados['descDepartamento']; ?>');"> </td>  
                        <td><?php echo $dados['idSetor']; ?></td>
                        <td><?php echo $dados['descSecretaria']; ?></td>
                        <td><?php echo $dados['descCoordenadoria']; ?></td>
                        <td><?php echo $dados['descDepartamento']; ?></td>
                    </tr>
                    <?php
                    } else if($_SESSION['LOGIN_CODIGO_SETOR_USUARIO'] == 1) {
                    ?>

                    <tr>
                        <td height="5" align ="center"><input type="radio" name="op" onclick="opcao_selecionada('<?php echo $dados['idSetor']; ?>', '<?php echo $dados['descSecretaria']; ?>', '<?php echo $dados['descCoordenadoria']; ?>', '<?php echo $dados['descDepartamento']; ?>');"> </td>  
                        <td><?php echo $dados['idSetor']; ?></td>
                        <td><?php echo $dados['descSecretaria']; ?></td>
                        <td><?php echo $dados['descCoordenadoria']; ?></td>
                        <td><?php echo $dados['descDepartamento']; ?></td>
                    </tr>
                    <?php
                }
            }
            $pdo = null;
            ?>

        </tbody>
    </table>
    <?php
}
?>
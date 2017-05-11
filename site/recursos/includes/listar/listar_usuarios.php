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
                        <th>idUsuario</th>
                        <th>Login</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Setor</th>
                        <th>Status</th>
                        <th>Perfil</th>
                        <th>Alterar</th>
                        <th>Bloquear</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    // chamo a conexao com o banco de dados
                    include_once '../estrutura/conexao/conexao.php';
                    // preparo para realizar o comando sql
                    $sql = "SELECT * FROM usuario u, setor s ";
                    $sql = $sql. " WHERE u.idSetor = s.idSetor ";
                    $sql = $sql. " AND u.status = 0";
                    $sql = $sql. " ORDER BY u.login";
                    
                    $query = $pdo->prepare($sql);
                    //executo o comando sql
                    $query->execute();

                    //loop para listar todos os dados encontrados
                    for ($i = 0; $dados = $query->fetch(); $i++) {
//                        validando usuario ativo
                        if($dados['status'] == 0){
                            $ativo = "ATIVO";
                        }else{
                            $ativo = "INATIVO";
                        }
                        
//                        prfil do usuário
                        if($dados['perfil'] == 1){
                            $perfil = "ADMINISTRADOR";
                        }else{
                            $perfil = "USUARIO";
                        }
                        
                        $param = $dados['idUsuario'] . "|" ;
                          $param .= $dados['login']. "|";
                          $param .= $dados['nome']. "|";
                          $param .= $dados['sobrenome']. "|";
                          $param .= $dados['email']. "|";
                          $param .= $dados['idSetor']. "|";
                          $param .= $dados['setor']. "|";
                          $param .= $ativo. "|";
                          $param .= $perfil;
                        ?>   	


                        <tr>
                            <td><?php echo $dados['idUsuario']; ?></td>
                            <td><?php echo $dados['login']; ?></td>
                            <td><?php echo $dados['nome']; ?></td>
                            <td><?php echo $dados['sobrenome']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo $dados['setor']; ?></td>
                            <td><?php echo $ativo; ?></td>
                            <td><?php echo $perfil; ?></td>
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



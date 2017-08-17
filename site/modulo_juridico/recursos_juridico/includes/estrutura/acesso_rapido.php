<?php
//valida para saber se o usuário está logado
include "../../../../recursos/includes/estrutura/controle/validar_secao.php";
include_once '../../../../recursos/includes/funcoes/funcao_formata_data.php';
?>
<div id="listar_processo_prazos_vencendo">
    <div class="mainbox col-lg-10 col-lg-offset-1  col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1"> 

        <div class="row alert alert-danger text-center">
            <p color>LISTA PROCESSOS JUDICIAIS - PRAZO VENCENDO</p>
        </div>    
    </div>    
    <div class="row">
        <div class="mainbox col-lg-10 col-lg-offset-1  col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1"> 
            <div style="max-height:350px; overflow-y: auto;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>PROCESSO</th>
                            <th>ANO</th>
                            <th>REU</th>
                            <th>AUTOR</th>
                            <th>AÇÃO</th>
                            <th>PRAZO</th>
                            <th>OBSERVAÇÃO</th>
                            <th>CONSULTAR</th>
                        </tr>
                    </thead >
                    <tbody > 

                        <?php
//                        dataatual
                        $data_atual = dataAmericano(date('d/m/Y'));
                        // chamo a conexao com o banco de dados
                        include_once '../../../../recursos/includes/estrutura/conexao/conexao.php';
                        // preparo para realizar o comando sql
                        $sql = " SELECT * ";
                        $sql = $sql . " FROM prazo_processo_judicial ppj, processo_judicial pj";
                        $sql = $sql . " WHERE ppj.prazo_processo between '{$data_atual}' AND  DATE_ADD(DATE(NOW()),  INTERVAL 10 DAY) ";
                        $sql = $sql . " AND ppj.ativo = 1";
                        $sql = $sql . " AND pj.finalizado = 0";
                        $sql = $sql . " AND ppj.id_processo_judicial = pj.id_processo_judicial ";
                        $sql = $sql . " ORDER BY ppj.prazo_processo ASC";
                        $query = $pdo->prepare($sql);
                        //executo o comando sql
                        $query->execute();

                        //loop para listar todos os dados encontrados
                        for ($i = 0; $dados = $query->fetch(); $i++) {
                            ?>   	
                            <tr>
                                <td><?php echo $dados['jud_numero']; ?></td>
                                <td><?php echo $dados['jud_ano_processo']; ?></td>
                                <td><?php echo $dados['jud_reu']; ?></td>
                                <td><?php echo $dados['jud_autor']; ?></td>
                                <td><?php echo $dados['jud_acao']; ?></td>
                                <td><?php echo dataBrasileiro($dados['prazo_processo']); ?></td>
                                <td><?php echo $dados['observacao_processo_judicial']; ?></td>
                                <td align="center"><a href="#" id="id_consulta_dados_processo_juridico" data-id="<?php echo $dados['id_processo_judicial']; ?>"><img src="../recursos/imagens/estrutura/lupa.png" height="20px;" alt="consultar" title="consulta dados do processo"></a></td>
                            
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </div>
                </table>
            </div>
        <div class="alert alert-info"><p class="text-left">Total Encontrados :  <?php print $i;?></p></div>
    </div>
</div>
<?php 
//se o usuario não for adm
// ele nao pode cadastrar novos processos apenas consultar
if($_SESSION['PERMISSAO_MENU_JURIDICO'] == 1){
?>
<hr />
<div id="listar_novos_processo_judiciais">
    <div class="mainbox col-lg-10 col-lg-offset-1  col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1"> 
        <div class="row alert alert-success text-center">
            <p color>LISTA PROCESSOS PROTOCOLADOS</p>
        </div>    
    </div>    
    <div class="row">
        <div class="mainbox col-lg-10 col-lg-offset-1  col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1"> 

            <div style="max-height:400px; overflow-y: auto;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NÚMERO</th>
                            <th>ANO</th>
                            <th>REQUERENTE</th>
                            <th>ASSUNTO</th>
                            <th>DATA ABERTURA</th>
                            <th>CONSULTAR</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // chamo a conexao com o banco de dados
                        // preparo para realizar o comando sql
                        $sql = "SELECT * FROM cadastro_processo  WHERE tipoProcesso = 4   AND juridico = 0 ";

                        $query = $pdo->prepare($sql);
                        //executo o comando sql
                        $query->execute();

                        //loop para listar todos os dados encontrados
                        for ($i = 0; $dados = $query->fetch(); $i++) {
                            ?>   	
                            <tr>
                                <td><?php echo $dados['numeroProcesso']; ?></td>
                                <td><?php echo $dados['anoProcesso']; ?></td>
                                <td><?php echo $dados['descricao_requerente']; ?></td>
                                <td><?php echo $dados['descricao_assunto']; ?></td>
                                <td><?php echo dataBrasileiro($dados['dataProcesso']); ?></td>
                                <td align="center"><a href="#" id="id_validar_processo_juridico" data-id="<?php echo $dados['idProcesso']; ?>"><img src="../recursos/imagens/estrutura/lupa.png" height="20px;" alt="alterar"></a></td>
                            </tr>
                            <?php
                        }
                        $pdo = null;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>
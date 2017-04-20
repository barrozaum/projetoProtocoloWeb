<?php

function fun_montar_etiqueta($param1, $param2, $param3) {

    // filtro das variaveis
    include_once '../funcoes/function_letraMaiscula.php';
    $tipo_processo = letraMaiuscula($param1);
    $numero_processo = letraMaiuscula($param2);
    $ano_processo = letraMaiuscula($param3);


//    conexao com o banco de dados
    include_once '../estrutura/conexao/conexao.php';
    $sql = "SELECT * FROM cadastro_processo ";
    $sql = $sql . "  WHERE tipoProcesso = '{$tipo_processo}'";
    $sql = $sql . "  AND numeroProcesso = '{$numero_processo}'";
    $sql = $sql . "  AND anoProcesso = '{$ano_processo}'";
    $query = $pdo->prepare($sql);
    //executo o comando sql
    $query->execute();


    if ($dados = $query->fetch()) {
        $id_processo = $dados['idProcesso'];
        $data_processo = dataBrasileiro($dados['dataProcesso']);
        $tipo_processo = fun_retorna_descricao_tipo_processo($pdo, $dados['tipoProcesso']);
        $requerente = fun_retorna_descricao_requerente($pdo, $dados['idRequerente']);
        $assunto = fun_retorna_descricao_assunto($pdo, $dados['idAssunto']);
        $origem = fun_retorna_descricao_origem($pdo, $dados['idOrigem']);

        fun_desenha_etiqueta($pdo, $id_processo, $data_processo, $numero_processo, $ano_processo, $tipo_processo, $requerente, $assunto, $origem);
    } else {
        fun_desenha_erro();
    }
}

function fun_desenha_erro() {
    ?>
    <table style="height: auto; margin-left: 10%" border="0" >
        <tr>			
            <td style="vertical-align: top;" > <br />
                <table style="width:80%;" cellpadding="0" cellspacing="0" border="0" align="center" >

                    <tr>
                        <td valign="top" height="62">
                            <table align="center" width="100%" border="1" height="52" cellspacing="0" >
                                <td colspan="3" height="20">
                                    <p style='color: red'>PROCESSO NÃO ENCONTRADO EM NOSSA BASE DE DADOS, POR FAVOR VERIFIQUE OS DADOS !!! </p>
                                </td>


                                <tr style="text-align: center;">
                                    <td colspan="3" height="20">
                                        <a href="#" onclick="window.close()">Sair</a>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>


                </table>
            </td>
        </tr>
    </table>
    <?php
}

function fun_desenha_etiqueta($pdo, $id_processo, $data_processo, $numero_processo, $ano_processo, $tipo_processo, $requerente, $assunto, $origem) {
    ?>
    <table style="height: auto;" border="0" >
        <tr>			
            <td style="vertical-align: top;" > <br />
                <table style="width:10cm;" cellpadding="0" cellspacing="0" border="0" align="center" >

                    <tr>
                        <td valign="top" height="62">
                            <table align="center" width="100%" border="1" height="52" cellspacing="0" bordercolor="#000000">
                                <tr bgcolor="#CCCCCC">
                                    <td colspan="3" height="20">
                                        <div align="center">
                                            <b>
                                                <font size="4"> Número Processo : </font>
                                                <font size="5"><?php print $numero_processo . "/" . $ano_processo; ?> </font>
                                            </b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="38" valign="top" width="100%">
                                        <table width="100%" border="0" cellspacing="0" >
                                            <tr>
                                                <td valign="top"><font size="3">PROTOCOLADO EM:  :</font> <font size="4">&nbsp  <?php print $data_processo; ?></font></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><font size="3">TIPO PROCESSO :</font> <font size="4"> &nbsp  <?php print $tipo_processo; ?></font></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><font size="3">REQUERENTE :</font> <font size="4"> &nbsp <?php print $requerente; ?></font></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><font size="3">ASSUNTO :</font> <font size="4"> &nbsp  <?php print $assunto; ?></font></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><font size="3">ORIGEM :</font> <font size="4"> &nbsp  <?php print $origem; ?></font></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                fun_buscar_documentos_processo($pdo, $id_processo);
                                                ?>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td valign="top" height="10">
                            <div align="center">
                                <p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
}
?>



<?php

function fun_buscar_documentos_processo($pdo, $id_processo) {
    $sql_doc = "SELECT * FROM documento_processo WHERE idProcesso = '{$id_processo}'";

    $query = $pdo->prepare($sql_doc);

//executo o comando sql
// Faço uma comparação para saber se a busca trouxe algum resultado
    $query->execute();
// crio um array através do comando fetchAll
    $result = $query->fetchAll();
// após executar o comando fetchAll() conto a quantidade de registro atráves do rowCount()
    $numero_registro = $query->rowCount();

// se existir algum registro encontrado    
    if ($numero_registro > 0) {
        ?>
        <td colspan="3" height="38" valign="top" width="100%">
            <table align="center" width="100%" border="1" height="52" cellspacing="0" bordercolor="#000000">
                <tr bgcolor="#CCCCCC">
                    <td colspan="4" height="auto">
                        <div align="LEFT">
                            <b><font size="3"> DOCUMENTOS</font></b>
                        </div>
                    </td>
                </tr>
                <?php
//             
                for ($i = 0; $i < $numero_registro; $i++) {
                    ?>
                    <tr>
                        <td valign="top"><font size="2">TIPO  : &nbsp  <?php print fun_retorna_descricao_documento($pdo, $result[$i]['idDocumento']); ?></font></td>
                        <td valign="top"><font size="2">NÚMERO : &nbsp  <?php print $result[$i]['numeroDocumento']; ?></font></td>
                        <td valign="top" colspan="2"><font size="1">ANO : &nbsp <?php print $result[$i]['numeroDocumento']; ?></font></td>
                    </tr>

                    <?php
                }
                ?>


            </table>
        </td>

        <?php
    }
}
?>
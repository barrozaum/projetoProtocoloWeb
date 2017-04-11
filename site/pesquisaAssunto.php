    <?php
    session_start();

    include ('recursos/includes/verSessao.inc');
    //$idUsuario = $_SESSION[idUsuario];
    //$idSetorUsuario =$_SESSION[idSetorUsuario];

    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">


    </head>

    <body>
    <form name="f2" action="consultaDados.php" method="post">

    <?php
    $datainicial=preg_replace("/[^0-9]\//", "", $_REQUEST['datainicial']);

    if(($datainicial != '00-00-0000') && ($datainicial != "")){
    //VARIAVEL COM A DATA NO FORMATO AMERICANO
    $dataAmericana= $datainicial;
     
    //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
    $partesdadata = explode('/',$dataAmericana);
     
    //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
    //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
    $dataAmericanaInicial= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
     
    //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
    }else{
      $dataAmericanaInicial  = '0000-00-00';
    }
    ?>


        <?php
        $dataFinal=preg_replace("/[^0-9]\//", "", $_REQUEST['datafinal']);

        if(($dataFinal != '00-00-0000') && ($dataFinal != "")){
        //VARIAVEL COM A DATA NO FORMATO AMERICANO
        $dataAmericana= $dataFinal;
         
        //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
        $partesdadata = explode('/',$dataAmericana);
         
        //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
        //INVERTENDdataAmericanaFinalO AS POSICOES E COLOCANDO AS BARRAS
        $dataAmericanaFinal= $partesdadata[2].'-'.$partesdadata[1].'-'.$partesdadata[0];
         
        //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
        }else{
          $dataAmericanaFinal  = '0000-00-00';
        }
        ?>


    <?php
    $i=0;
    $codAssunto = preg_replace("/[^0-9]/", "", $_REQUEST['assunto']);

    $decAssunto = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['nomeAssunto']);

    if(($codAssunto != "")&&($codAssunto !=0)){
    include('recursos/includes/verConexao.inc');


    $sql="SELECT *
    FROM cadastroProcesso cp, requerente r, assunto a
    WHERE  a.idAssunto =  $codAssunto AND cp.idAssunto = a.idAssunto  AND cp.idRequerente = r.idRequerente AND cp.dataProcesso >= '$dataAmericanaInicial' AND cp. dataProcesso <= '$dataAmericanaFinal' ORDER BY cp.idProcesso";

        $resultado=mysql_query($sql,$conexao) ;

        if (mysql_num_rows($resultado) == 0) {
        ?>

         <div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
            </div>
        <?php
         }else{
        ?>
        <div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
        <table width="100%">
        <thead class="fixedHeader">
        <tr bgcolor="#f5f5dc">
            <th></th>
            <th>NÚMERO</th>
            <th>TIPO</th>
            <th>ANO</th>
            <th>ASSUNTO</th>
            <th>REQUERENTE</th>
            <th>DATA</th>
        </tr>


            <?php

            while($dados=mysql_fetch_array($resultado)){


                if ($i% 2 == 0)
                    $cor = "#CCCCCC";
                else
                    $cor = "#FFFFFF";

                if($dados['tipoProcesso'] == '1')
                    $tipo = "COMUNICAÇÃO INTERNA";
                else
                    $tipo = "COMUNICAÇÃO EXTERNA";
            ?>

            <?php
            //Formata a data americana em brasileira

            //VARIAVEL COM A DATA NO FORMATO AMERICANO
            $data_americano = $dados['dataProcesso'];

            //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
            $partes_da_data = explode('-',$data_americano);

            //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
            //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
            $data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];

            //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
            ?>




            <tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
            <td height="5" align ="center"><input type="radio" name="op" value="<?php echo $dados['idProcesso']; ?>"></th>
            <td height="5" align ="center"><?php echo $dados['numeroProcesso']; ?></th>
            <td height="5" align ="center"><?php echo $tipo; ?></th>
            <td height="5" align ="center"><?php echo $dados['anoProcesso']; ?></th>
            <td height="5" align ="center"><?php echo $dados['nomeAssunto']; ?></th>
            <td height="5" align ="center"><?php echo $dados['requerente']; ?></th>
            <td height="5" align ="center"><?php echo $data_brasileiro; ?></th>

            </tr>

            <?php
             $i++;
             }
            ?>
            </table>
            </div>

          <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />

            <input type="submit"  value ="    CONSULTAR    ">
            </form>
        <?php
        }
        ?>

    <?php
    }else{
    ?>



        <?php

        include('recursos/includes/verConexao.inc');
        $i = 0;
        $sql1 = "SELECT *
        FROM  assunto a, cadastroProcesso c , requerente r
        WHERE a.nomeAssunto LIKE  '%$decAssunto%' AND a.idAssunto = c.idAssunto AND c.idRequerente = r.idRequerente AND c.dataProcesso >= '$dataAmericanaInicial' AND c. dataProcesso <= '$dataAmericanaFinal'ORDER BY  c.idProcesso   ";
        $resultado1=mysql_query($sql1,$conexao);
        if (mysql_num_rows($resultado1) == 0) {
        ?>
            <div id="cadastrados">
             <strong>NENHUM PROCESSO ENCONTRADO !!!</strong>
            </div>

              <?php

            }else{
            ?>
        <div style="max-height: 400px; margin-top:20px;  overflow: auto; " >
        <table width="100%">
        <thead class="fixedHeader">
        <tr bgcolor="#f5f5dc">
      
                <th></th>
                <th>NÚMERO</th>
                <th>TIPO</th>
                <th>ANO</th>
                <th>ASSUNTO</th>
                <th>REQUERENTE</th>
                <th>DATA</th>
                </tr>


                <?php

                while($dados1=mysql_fetch_array($resultado1)){


                    if ($i% 2 == 0)
                        $cor = "#CCCCCC";
                    else
                        $cor = "#FFFFFF";

                    if($dados1['tipoProcesso'] == '1')
                        $tipo = "COMUNICAÇÃO INTERNA";
                    else
                        $tipo = "COMUNICAÇÃO EXTERNA";
                ?>

                <?php
                //Formata a data americana em brasileira

                //VARIAVEL COM A DATA NO FORMATO AMERICANO
                $data_americano = $dados1['dataProcesso'];

                //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
                $partes_da_data = explode('-',$data_americano);

                //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
                //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
                $data_brasileiro = $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];

                //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
                ?>




             <tr bgcolor="<?php echo $cor; ?>" style="cursor:default" onMouseOver="javascript:this.style.backgroundColor='green'" onMouseOut="javascript:this.style.backgroundColor=''"> 
         
                <td height="5" align ="center"><input type="radio" name="op" value="<?php echo $dados1['idProcesso']; ?>"></th>
                <td height="5" align ="center"><?php echo $dados1['numeroProcesso']; ?></th>
                <td height="5" align ="center"><?php echo $tipo; ?></th>
                <td height="5" align ="center"><?php echo $dados1['anoProcesso']; ?></th>
                <td height="5" align ="center"><?php echo $dados1['nomeAssunto']; ?></th>
                <td height="5" align ="center"><?php echo $dados1['requerente']; ?></th>
                <td height="5" align ="center"><?php echo $data_brasileiro; ?></th>

            </tr>

                <?php
                 $i++;
                }
                ?>
                </table>
                </div>


                <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br />
                <input type="submit"  value ="    CONSULTAR    ">
                </form>
            <?php
            }
            ?>

    <?php
    }
    ?>
    
    
    </body>
    
    </html>

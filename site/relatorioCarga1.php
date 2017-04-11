<?php
session_start();

include ('recursos/includes/verSessao.inc');
$i= 0;
$cor = "";
?>

 <?php
$tipoProcesso = $_REQUEST['tipoProcesso'];

$anoProcesso = $_REQUEST['anoProcesso'] ;

$numeroProcesso = $_REQUEST['numeroProcesso'];

include('recursos/includes/verConexao.inc');
        
$sql="SELECT * FROM cadastroProcesso WHERE numeroProcesso = $numeroProcesso AND anoProcesso = $anoProcesso AND tipoProcesso = $tipoProcesso ";
$resultado=mysql_query($sql,$conexao) ;

if (mysql_num_rows($resultado) == 0) {
?>

<script languagem="javascript"> window.alert('NENHUM PROCESO ENCONTRADO !!!'); location.href="relatorioCarga.php";</script>

<?php

}else{
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="recursos/css/estiloedicaorelatorio.css"/>
        <link rel="stylesheet" type="text/css" href="recursos/css/print.css" media='print' />
        
        <STYLE TYPE="text/css"> 
        #quebralinha { 
        page-break-after: always; 
        } 
        </STYLE> 
        
        <script type="text/javascript">
            window.print();
        </script>

    <title>Parvaim</title>  
</head>
   
    



<body>
    <div id="externo">


 

        <?php
        while($dados = mysql_fetch_array($resultado)){
        $idProcesso = $dados['idProcesso'];
        }
        ?>
    
           <?php 
            include('recursos/includes/verConexao.inc');
            $sql1="SELECT * 
            FROM cargaProcesso 
            WHERE idProcesso = $idProcesso ORDER BY idCarga";
            $resultado = mysql_query($sql1,$conexao);
            $total = mysql_num_rows($resultado);
            $total;
           
            $registros = 40;
            $repeticao = $total / $registros;
            $repeticao;
            $inicial = 0;
            $cont = 0;
            while ($cont < $repeticao) {
            
            ?>   


                <?php if ($tipoProcesso == 1){
                $tP ="COMUNICACAO INTERNA";
                }else{
                $tP ="COMUNICACAO EXTERNA" ;
                }
                ?>
                
                <?php 
                if($cont != 0){ 
                ?>
                  <div id="quebralinha">
                  </div>

                <?php 
                }
                ?>



                <div id="TITULO">
                <h3>RELATÓRIO CARGA PROCESSO</h3>
                
                <strong> NÚMERO  :  </strong><?php echo $numeroProcesso ;?>
                <strong> TIPO  :   </strong><?php echo $tP;?><br />
                <strong> ANO   :  </strong> <?php echo $anoProcesso ;?><br />
                
                <strong> DATA:  </strong> <?php echo date('d/m/Y H:i:s');?><br />
                
                
                
                </div>
                
                
                <div id="LOGO">
                <img src="recursos/imagens/icones/logo.png" alt="LOGO">
                </div>
        
            
            
            
            
            <table width="100%" border="1px">
            <thead class="fixedHeader">
              <tr id="celula">
                <th align="center">USUÁRIO CARGA</th> 
                <th align="center">DATA CARGA</th>
                <th align="center">PARECER </th>
                <th align="center">SETOR ENTRADA</th>
                <th align="center">USUÁRIO RECEBIMENTO</th>
                <th align="center">DATA RECEBIMENTO</th>
            </tr>
            
       
            <?php
            $sql="SELECT * 
            FROM cargaProcesso 
            WHERE idProcesso = $idProcesso ORDER BY  idCarga limit $inicial,$registros";
            $resultado = mysql_query($sql,$conexao);
           
            while($dados=mysql_fetch_array($resultado)){
  
            
            if ($i% 2 == 1)
                $cor = "#FFFFFF";
            else
                $cor = "#CCCCCC";
            
            $idCarga = $dados['idCarga'];
              
            $usuarioCarga = $dados['idUsuarioCarga'];
                if($usuarioCarga == "")
                $usuarioCarga = 0;
            
            $usuarioRecebimento = $dados['idUsuarioRecebimento'];
                if($usuarioRecebimento == "")
                $usuarioRecebimento = 0;
            
            $setorPresente = $dados['idSetorPresente'];
            $Obs= $dados['parecer'];
            $Recebido = $dados['tramite'];
            ?>  
                
            <?php       
            //Formata a data americana em brasileira
            
            //VARIAVEL COM A DATA NO FORMATO AMERICANO
            $data_americano = $dados['dataCarga'];
            
            //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
            $partes_da_data = explode('-',$data_americano);
            
            //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
            //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
            $dataCarga= $partes_da_data[2].'/'.$partes_da_data[1].'/'.$partes_da_data[0];
            
            //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
            ?>
            
            <?php       
            //Formata a data americana em brasileira
            
            //VARIAVEL COM A DATA NO FORMATO AMERICANO
            $dataAmericano = $dados['dataRecebimento'];
            
            //AGORA VAMOS EXPLODIR ELA PELOS HIFENS E SERÁ CRIADO UM ARRAY COM AS PARTES
            $partes = explode('-',$dataAmericano);
            
            //AGORA REMONTAMOS A DATA NO FORMATO BRASILEIRO, OU SEJA,
            //INVERTENDO AS POSICOES E COLOCANDO AS BARRAS
            $dataRecebimento= $partes[2].'/'.$partes[1].'/'.$partes[0];
            
            //UFA! PRONTINHO, AGORA TEMOS A DATA NO BOM E VELHO FORMATO BRASILEIRO
            ?>
               
             
             
             
            
             
             <?php 
             include('recursos/includes/verConexao.inc');
             $nomeUsuarioRecebimento = "";
             $sql7 = "SELECT * FROM usuario WHERE idUsuario = $usuarioRecebimento ";
             $resultado7 = mysql_query($sql7,$conexao);
             while($dados7 = mysql_fetch_array($resultado7)){
             $nomeUsuarioRecebimento = $dados7['login'];
             }
             ?>
             
              <?php 
             include('recursos/includes/verConexao.inc');
             
             $sql9 = "SELECT * FROM usuario WHERE idUsuario = $usuarioCarga ";
             $resultado9 = mysql_query($sql9,$conexao);
             while($dados9 = mysql_fetch_array($resultado9)){
             $nomeUsuarioCarga = $dados9['login'];
             }
             ?>
             
             
             
             <?php 
             include('recursos/includes/verConexao.inc');
             
             $sql8 = "SELECT * FROM setor WHERE idSetor = $setorPresente ";
             $resultado8 = mysql_query($sql8,$conexao);
             while($dados8 = mysql_fetch_array($resultado8)){
             $setorPresente = $dados8['descDepartamento'];
             }
             ?>
             
             
             
        
            <tr bgcolor="<?php echo $cor; ?>">
                <td height="5" align ="center"><?php echo $nomeUsuarioCarga ; ?></td>
                <td height="5" align ="center"><?php echo $dataCarga; ?></td>
                <td height="5" align ="center"><?php echo $Obs;?></td>
                <td height="5" align ="center"><?php echo $setorPresente; ?></td>
                <td height="5" align ="center"><?php echo $nomeUsuarioRecebimento ; ?></td>
                <td height="5" align ="center"><?php echo $dataRecebimento; ?></td>
            </tr>
            
            <?php
              $i++;
             }
            ?>             

            </table>

           <BR /> RESULTADOS ENCONTRADOS <strong><?php echo $i; ?></strong><br /> <br />

           <?php 
           $cont++;
           $inicial += $registros; 
           $total += $i;    
           }// fin do while
            
           ?>

      
       
     


        <div id="imprimir">
        <form>
            
            <input type="button"  name="Button" value="    Imprimir    " onclick="window.print()">
            <input type="button" onClick="window.location.assign('relatorioCarga.php')" value="    Voltar    "> 
        </form>
        </div> 




    </div>
     
</body>
    
</html>
                
  

<?php 
}
?> 
        
    

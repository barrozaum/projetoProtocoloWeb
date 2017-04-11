    <?php
    session_start();

    include ('recursos/includes/verSessao.inc');
    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <title>Cadastro Assunto</title>
    </head>

    <body>

    <?php
    $descricao = preg_replace("/[^a-zA-Z0-9ãÃáÁàÀâÂéÉèÈêÊíÍìÌîÎõÕóÓòÒôÔúÚùÙûÛçÇ ]/", "", $_REQUEST['descricao']);
    $cod = preg_replace("/[^0-9]/", "", $_REQUEST['cod']);
    ?>

    <script languagem = "Javascript">
    opener.f1.codAssunto.value="<?php echo $cod; ?>";
    opener.f1.nomeAssunto.value="<?php echo $descricao; ?>";
    opener.f1.verificaAssunto.value="1";
    </script>


    <?php
    include('recursos/includes/verConexao.inc');

    $sql="insert into assunto (idAssunto,nomeAssunto,idUsuario) values ($cod,'$descricao',$idUsuario)";

	if(mysql_query($sql,$conexao)){
	?>         
    <script language='JavaScript'>
     window.alert('ASSUNTO CADASTRADO COM SUCESSO !!!');
    </script>
	
    <?php        
	}else{
	?>
    	  <script language='JavaScript'> 
          window.alert('ERRO AO CADASTRAR ASSUNTO !!!');
          </script>
	<?php	
	}
    ?>
        <script language='JavaScript'> 
          window.close();
        </script>


    </body>
    </html>


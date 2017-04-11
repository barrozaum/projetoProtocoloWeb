<?php
session_start();

include ('recursos/includes/verSessao.inc');
$idUsuario = $_SESSION[idUsuario];	
$idSetorUsuario =$_SESSION[idSetorUsuario];	

?>
<?php

$funcionarios=$_REQUEST['op'];
if ($funcionarios == "")
	echo "<script>
	alert('Informe o Usuario');
	location.href='manBloqUsuario.php';
	</script>";
	
else{	
						
$motivo=$_REQUEST['motivo'];

if ($motivo == "")

echo "<script>
	alert('Informe o Motivo');
	location.href='manBloqUsuario.php';
	</script>";
	
	else{
?>


<?php
	
	
	$cadastro=$_SESSION['quem'];
				
	$setor_usuario=$_SESSION['setor'];

	$dt =date('Y/m/d'); 

	$hora =date(' h:i:s');
	
	//include('verconec.inc');
		
	$alterar = mysql_query("UPDATE usuario SET status='1', motivo='$motivo', usuarioBloq = '$cadastro', dataBloq='$dt' WHERE id='$funcionarios' ") or die(mysql_error());
  
 	 if(!mysql_query($alterar,$conexao)){
  
        
          echo "<script language='JavaScript'> window.alert('Cadastrada com Sucesso.');</script>";
        	 echo "<script>location.href='manBloqUsuario.php';</script>";
          
	
		}else{
	
	
	    echo "<script language='JavaScript'> window.alert('Erro ao cadastra.');</script>";
	
	    echo "<script>location.href='manBloqUsuario.php';</script>";
        
	}	
	}
	}?>
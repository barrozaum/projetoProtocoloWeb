<?php
session_start();

include ('recursos/includes/verSessao.inc');
//$idUsuario = $_SESSION[idUsuario];
//$idSetorUsuario =$_SESSION[idSetorUsuario];
$outrasOp = $_SESSION['outrasOp'];
$nomeUsuario= $_SESSION['nomeUsuario'];
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicao.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estilomenu.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/conteudo.css"/>



		<?php
		// Inclui o menu do site
		include('recursos/includes/verScript.inc');
		?>

		<script languagem = "javascript">
		function valida(){

			var u = document.f1.usuarioLogin.value.toUpperCase();
			var a = document.f1.antigaSenha.value.toUpperCase();
			var n = document.f1.novaSenha.value.toUpperCase();
			var c = document.f1.confirmSenha.value.toUpperCase();


			if(u == ""){
			window.alert("VERIFIQUE O CAMPO COLABORADOR !!!");
			document.f1.usuarioLogin.focus();
			
			}else if(a == ""){
			window.alert("VERIFIQUE O CAMPO SENHA ATUAL !!!");
			document.f1.antigaSenha.focus();

			}else if(n == ""){
			window.alert("VERIFIQUE O CAMPO NOVA SENHA !!!");
			document.f1.novaSenha.focus();

			}else if(c == ""){
			window.alert("VERIFIQUE O CAMPO CONFIRMA NOVA SENHA !!!");
			document.f1.confirmSenha.focus();

			}else if(n != c){
			window.alert("SENHAS NÃO CONFEREM !!!");
			
			document.f1.novaSenha.value="";
			document.f1.confirmSenha.value="";
			document.f1.novaSenha.focus();
			}else
			document.f1.submit();
			}
		</script>
	<title>Parvaim</title>
</head>





<body class="laterais">
		<div id="externo">
			<div id="cabecalho">
				<a href="inicial.php"><h1 id="titulo"><span>Parvaim</span></h1></a>
			</div>

			<div id="menu">
				<?php
				// Inclui o menu do site
				include('recursos/includes/verMenu.inc');
				?>
			</div>



			<div id="centro1">

			</div>

			<div id="centro">

				<div id="conteudo">

				<h3>ALTERAR SENHA</h3>
				<br />
				<br />


                <form name="f1" action="manSenha1.php" method="post">

				<?php
				if ($outrasOp == 0){
				?>
					<label>COLABORADOR:
					<input type="text" value="<?php echo $nomeUsuario; ?>" name="login" readonly="TRUE"/>
					<input type="hidden" value="<?php echo $idUsuario; ?>" name="usuarioLogin" />
					</label>
					<br />
					<br />

				<?php
				}else{
				?>

					<label>COLABORADORES:
					<select name = "usuarioLogin">
					<option value=''>ESCOLHA O COLABORADOR</option>
					<?php
					include('recursos/includes/verConexao.inc');
					$sql="SELECT * FROM usuario ORDER BY login";
					$resultado=mysql_query($sql,$conexao) ;
					while($dados=mysql_fetch_array($resultado)){
					echo'<option value="'.$dados["idUsuario"].'">'.$dados["login"].'</option>';
					}
					?>
					</select>
					</label>
					<br />
					<br />

				<?php
				}
				?>




				<label>SENHA ATUAL:
					<input type="password" name="antigaSenha" value="" maxlength="20" size="20px" />
				</label>
				<br />
				<br />

				<label>NOVA SENHA:
					<input type="password" name="novaSenha" value=""  maxlength="20" size="20px"/>

				</label>
				<br />
				<br />

				<label>CONFIRME NOVA SENHA:
					<input type="password" name="confirmSenha" value="" maxlength="20" size="20px"  />
				</label>
				<br />
				<br />


				<input type="button" value="    ENVIAR    " onclick="javascript: valida(); "/>
				<input type="reset" value="    CORRIGIR    "/>

				</form>
				</div>


			</div>
			<div id="rodape">
				<div id="usuario">

				<?php
				// Incluiinformações do usuario
				include('recursos/includes/inforUsuario.inc');
				?>

				</div>
			</div>
		</div>
	</body>

</html>

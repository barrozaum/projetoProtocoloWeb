<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta HTTP-EQUIV="refresh" CONTENT="60">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="recursos/css/estilologin.css"/>
		<link rel="stylesheet" type="text/css" href="recursos/css/estiloedicaologin.css"/>
		
		<script language="JavaScript">

		function validaSenha(){
		   var login= document.f1.txtlogin.value;
		   var senha= document.f1.txtsenha.value;
		 

		   if(login == ""){
		   	window.alert('Campo Login não Preenchido !!!');
		   	document.f1.txtlogin.focus();
		   }else if(senha == ""){
		   	window.alert('Campo Senha não Preenchido !!!');
		   	document.f1.txtsenha.focus();
		   } else{
		  
		   document.f1.txtlogin.value = login.toUpperCase();
		   document.f1.txtsenha.value = senha.toUpperCase();
		   document.f1.submit();
		   }

		}
		</script>
			

		<script type="text/javascript">
		
		function submitenter(myfield,e)
		{


		var keycode;
		var login= document.f1.txtlogin.value;
		var senha= document.f1.txtsenha.value;
		
		if (window.event) keycode = window.event.keyCode;
		else if (e) keycode = e.which;
		else return true;
		
	
		if (keycode == 13)
		   {
		   
			    if(login == ""){
			    	window.alert('Campo Login não Preenchido !!!');
			    	document.f1.txtlogin.focus();
			   	}else if(senha == ""){
			    	window.alert('Campo Senha não Preenchido !!!');
			    	document.f1.txtsenha.focus();
			   } else{
				 document.f1.txtlogin.value = login.toUpperCase();
				 document.f1.txtsenha.value = senha.toUpperCase();
			  	 document.f1.submit();
			   }


		   }
		
		   
		}
		</script>
		
		
		
		
		
	<title>Parvaim</title>	
</head>
	
		
		
		
					
<body class="laterais">
		<div id="externo">
			<div id="cabecalho">
			
						<h1 id="titulo"><span>Parvaim</span></h1>
			
			</div>
			
			<div id="menu">
					
							
					
			</div>
		
		
			<div id="centro">
			
			
				<div id="conteudo">
						
					
						
					<form name ="f1" action="logar.php" method="post">
					<input id="login" type="text" name="txtlogin" placeholder="Digite seu login" value="" onKeyPress="submitenter(this,event)"/>
					
					
					<input id="senha" type="password" name="txtsenha" placeholder="Digite sua senha" value="" onKeyPress="submitenter(this,event)"/>
				
				
					<div id="botao">
					<input id="enviar" type="button" value="              " onclick="javascript: validaSenha();"  />
					</div>
					
				
					</form>
				</div>
			</div>
			<div id="rodape">
				 
			</div>
		</div>
	</body>
	
</html>
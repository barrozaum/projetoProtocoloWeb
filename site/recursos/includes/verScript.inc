<script type="text/javascript" src="recursos/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="recursos/js/jquery1.js"></script>

<script type="text/javascript" src="recursos/js/jquery.maskedinput.js"></script>	

<!--Script para deixar digitar apenas caracteres que não sejem numeros-->
<script type="text/javascript">
	{
	function carcater()
	  {
	tecla = event.keyCode;
	if (tecla < 48 || tecla > 57)
	    {
	    return true;
	    }
	else
	    {
	    return false;
	    }
	  }
	}
	</script>
<!-- Fim dos scripts-->	


<!--     ----------------------------------------------------------------------------------------------  -->
<!--Script paracancelar o enter -->
<script type="text/javascript">
	{
	function cancelaEnter()
	  {
	tecla = event.keyCode;
	if (tecla != 13)
	    {
	    return true;
	    }
	else
	    {
	    return false;
	    }
	  }
	}
	</script>
<!-- Fim dos scripts-->	


<!--     ----------------------------------------------------------------------------------------------  -->


<script type="text/javascript">
function mascaraData(nomeCampo){
	valor = nomeCampo.value;

	if(valor == 0){
	$("input.data").mask("99/99/9999");
	nomeCampo.value=1;
	}
}

</script><!--     ----------------------------------------------------------------------------------------------  -->
<script type="text/javascript">
function mascaraCep(nomeCampo){
	valor = nomeCampo.value;

	if(valor == 0){
	$("input.cep").mask("99.999-999");
	nomeCampo.value=1;
	}
}

</script>

<script type="text/javascript">
function mascaraTelefoneFixo(nomeCampo){
	valor = nomeCampo.value;

	if(valor == 0){
	$("input.tel").mask("(99)9999-9999");
	nomeCampo.value=1;
	}
}

</script>



<script type="text/javascript">
function mascaraTelefoneCelular(nomeCampo){
	valor = nomeCampo.value;

	if(valor == 0){
	$("input.cel").mask("(99) 9-9999-9999");
	nomeCampo.value=1;
	}
}

</script>


<!-- ----------------------------------------------------------------------------------------------  -->
<script type="text/javascript">
	function maiusculo(nameCampo){
			var d = nameCampo.value;
			var de = d.toUpperCase();
			nameCampo.value=de;
	}
</script>
<!-- ----------------------------------------------------------------------------------------------  -->




<!--Script para deixar digitar apenas numeros -->
	<script type="text/javascript">
	{
	function numeros()
	  {
	tecla = event.keyCode;
	if (tecla >= 48 && tecla <= 57)
	    {
	    return true;
	    }
	else
	    {
	    return false;
	    }
	  }
	}
	</script>
<!-- Fim dos scripts-->	




<!--     ----------------------------------------------------------------------------------------------  -->


<!-- Script para criação de campos automáticos-->
<script type="text/javascript">
$(function () {
  function removeCampo() {
	$(".excluir").unbind("click");
	$(".excluir").bind("click", function () {
	   if($("tr.linha").length > 1){
		$(this).parent().parent().remove();
	   }
	});
  }
 
  $(".mais").click(function () {
	novoCampo = $("tr.linha:first").clone();
	novoCampo.find("input").val("");

	novoCampo.insertAfter("tr.linha:last");
	removeCampo();
  });
});
</script>


<!--     ----------------------------------------------------------------------------------------------  -->

<script type="text/javascript">
$(function () {
  function removeCampo() {
	$(".deletar").unbind("click");
	$(".deletar").bind("click", function () {
	   if($("tr.linhas").length > 1){
		$(this).parent().parent().remove();
	   }
	});
  }
 
  $(".adiciona").click(function () {
	novoCampo = $("tr.linhas:first").clone();
	novoCampo.find("input").val("");
	novoCampo.find("select").val("");
	novoCampo.insertAfter("tr.linhas:last");
	removeCampo();
  });
});
</script>

<!-- Fim do script para criação de campos -->


		
		
<!--Inicio da verificação das datas com mascaras nos  campos -->

<script type="text/javascript">
function validarData(campo){
var expReg = /^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[1-2][0-9]\d{2})$/;
var msgErro = 'Formato inválido de data.';

if ((campo.value.match(expReg)) && (campo.value!='')){
var dia = campo.value.substring(0,2);
var mes = campo.value.substring(3,5);
var ano = campo.value.substring(6,10);

if(dia < 1 ) {
 alert("Dia Inválido.");
     // alert(msgErro);
    campo.focus();
    return false;
             }
	     
if(mes < 1 ) {
 alert("Mês Inválido.");
     // alert(msgErro);
    campo.focus();
    return false;
             }		     
	
if(ano < 1 ) {
 alert("Mês Inválido.");
     // alert(msgErro);
    campo.focus();
    return false;
             }		


if(mes==4 || mes==6 || mes==9 || mes==11 && dia > 30){
      alert("Lembre-se !!! O mês especificado contém no máximo 30 dias.");
      return false;
}else{

 if(ano%4!=0 && mes==2 && dia>28){
 alert("Data incorreta!! O mês especificado contém no máximo 28 dias.");
 return false;
 }
 else{

        if(ano%4==0 && mes==2 && dia>29 ){
        alert("Data incorreta!! O mês especificado contém no máximo 29 dias.");
        return false;
        }
    }
}


}
else{
alert(msgErro);
campo.focus();
return false;
}
}
</script>
<!-- Fim do script verificação das datas com mascaras nos  campos -->

		
	
<!--     ----------------------------------------------------------------------------------------------  -->
	
	
			
<!--Inicio do script para confirmar o cadastro -->		
<script language="javascript">
function confirma() {
   
   if(confirm('Deseja Continuar')) {
       return true;
       } else {
       return false;
       }
  }
</script>
<!--Fim do script -->		

<!--     ----------------------------------------------------------------------------------------------  -->

	
<!--Inicio do script para Selecionar todos os checkbox -->		

<script language="JavaScript">



function selecionar_tudo(){
	for (i=0;i<document.f1.elements.length;i++)
		if(document.f1.elements[i].type == "checkbox")	
			document.f1.elements[i].checked=1
}
function deselecionar_tudo(){
	for (i=0;i<document.f1.elements.length;i++)
		if(document.f1.elements[i].type == "checkbox")	
			document.f1.elements[i].checked=0
}
</script>
<!--Fim do script -->		

<!--     ----------------------------------------------------------------------------------------------  -->

<!-- Script para validação do email do usuário -->
<script language="JavaScript">
function ValidaEmail()
{
  var obj = eval("document.forms[0].email");
  var txt = obj.value;
  if ( (txt.length != 0 )&& ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7)))
  {
    alert('Email incorreto');
	obj.focus();
  }
}
</script>


<!--     ----------------------------------------------------------------------------------------------  -->
<!-- Fim do script-->

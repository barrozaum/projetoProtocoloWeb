<script language = "javascript">
			function valida() {
			 var setorEntrada= document.getElementById('setorEntrada').value;
		     var verificaSetor= document.getElementById('verificaSetor').value;
		     var idSetorUsuario = <?php echo $idSetorUsuario ; ?>;
		    
		     var data = document.getElementById('data').value;
		     var dia = data.substring(0,2);
		     var barraDia = data.substring(2,3);
		     var mes = data.substring(3,5);
		     var barraAno = data.substring(5,6);
		     var ano = data.substring(6,10);

		     	if (barraDia != '/' || barraAno != '/')
		     		window.alert("Data Inválido !!!");
				else if (dia < 1 || dia > 31)
					window.alert("Dia Inválido !!!");
				else if (mes < 1 || mes > 12) 
					window.alert("Mês Inválido !!!");
				else if (ano.length < 4 || ano > 2100 )
					window.alert("Ano Inválido !!!");
				else if((mes==4 || mes==6 || mes==9 || mes==11) && (dia > 30))
      				window.alert("Lembre-se !!! O mês especificado contém no máximo 30 dias.");
				else if(ano%4!=0 && mes==2 && dia>28)
 					window.alert("Data incorreta!! O mês especificado contém no máximo 28 dias."); 
			    else if (setorEntrada == ""){
					window.alert("VERIFIQUE O CAMPO SETOR !!!");
					document.getElementById('setorEntrada').focus();
			    }
				else if(verificaSetor == ""){
					window.alert("SETOR NÃO CADASTRADO!!!");
					document.getElementById('setorEntrada').focus();
				}
				else if(setorEntrada == idSetorUsuario ){
					window.alert("NÃO É POSSIVEL ENVIAR CARGA PARA O SEU SETOR !!!");
					document.getElementById('setorEntrada').focus();
				}
				else
				document.f2.submit();			
			}
		
		</script>
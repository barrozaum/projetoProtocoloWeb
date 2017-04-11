<!-- Verifica se os dados do formulario estão preenchidos corretamente -->

<?php

//Verifica se existe palavras com acentos e troca para ficar sem

$novoAssunto =$_POST['novoAssunto'];

//Possibilidades letras A
$novoAssunto =str_replace("á","a",$novoAssunto );
$novoAssunto =str_replace("Á","a",$novoAssunto );
$novoAssunto =str_replace("à","a",$novoAssunto );
$novoAssunto =str_replace("À","a",$novoAssunto );
$novoAssunto =str_replace("ã","a",$novoAssunto );
$novoAssunto =str_replace("Ã","a",$novoAssunto );
$novoAssunto =str_replace("â","a",$novoAssunto );
$novoAssunto =str_replace("Â","a",$novoAssunto );

//Possibilidades letras E
$novoAssunto =str_replace("é","e",$novoAssunto );
$novoAssunto =str_replace("É","e",$novoAssunto );
$novoAssunto =str_replace("è","e",$novoAssunto );
$novoAssunto =str_replace("È","e",$novoAssunto );
$novoAssunto =str_replace("ê","e",$novoAssunto );
$novoAssunto =str_replace("Ê","e",$novoAssunto );


//Possibilidades letras i
$novoAssunto =str_replace("í","i",$novoAssunto );
$novoAssunto =str_replace("Í","i",$novoAssunto );
$novoAssunto =str_replace("ì","i",$novoAssunto );
$novoAssunto =str_replace("Ì","i",$novoAssunto );
$novoAssunto =str_replace("î","i",$novoAssunto );
$novoAssunto =str_replace("Î","i",$novoAssunto );

//Possibilidades letras o
$novoAssunto =str_replace("ó","o",$novoAssunto );
$novoAssunto =str_replace("Ó","o",$novoAssunto );
$novoAssunto =str_replace("ò","o",$novoAssunto );
$novoAssunto =str_replace("Ò","o",$novoAssunto );
$novoAssunto =str_replace("õ","o",$novoAssunto );
$novoAssunto =str_replace("Õ","o",$novoAssunto );
$novoAssunto =str_replace("ô","o",$novoAssunto );
$novoAssunto =str_replace("Ô","o",$novoAssunto );

//Possibilidades letras u
$novoAssunto =str_replace("ú","u",$novoAssunto );
$novoAssunto =str_replace("Ú","u",$novoAssunto );
$novoAssunto =str_replace("ù","u",$novoAssunto );
$novoAssunto =str_replace("Ù","u",$novoAssunto );
$novoAssunto =str_replace("û","u",$novoAssunto );
$novoAssunto =str_replace("Û","u",$novoAssunto );

$novoAssunto =str_replace("ç","c",$novoAssunto );
$novoAssunto =str_replace("Ç","c",$novoAssunto );


$novoAssunto =strtoupper($novoAssunto );//codigo pra colocar os caracteres em Maiusculo


?>


<?php

//Verifica se existe palavras com acentos e troca para ficar sem
$pAssunto=$_REQUEST['assunto'];


//Possibilidades letras A
$pAssunto=str_replace("á","a",$pAssunto);
$pAssunto=str_replace("Á","a",$pAssunto);
$pAssunto=str_replace("à","a",$pAssunto);
$pAssunto=str_replace("À","a",$pAssunto);
$pAssunto=str_replace("ã","a",$pAssunto);
$pAssunto=str_replace("Ã","a",$pAssunto);
$pAssunto=str_replace("â","a",$pAssunto);
$pAssunto=str_replace("Â","a",$pAssunto);

//Possibilidades letras E
$pAssunto=str_replace("é","e",$pAssunto);
$pAssunto=str_replace("É","e",$pAssunto);
$pAssunto=str_replace("è","e",$pAssunto);
$pAssunto=str_replace("È","e",$pAssunto);
$pAssunto=str_replace("ê","e",$pAssunto);
$pAssunto=str_replace("Ê","e",$pAssunto);


//Possibilidades letras i
$pAssunto=str_replace("í","i",$pAssunto);
$pAssunto=str_replace("Í","i",$pAssunto);
$pAssunto=str_replace("ì","i",$pAssunto);
$pAssunto=str_replace("Ì","i",$pAssunto);
$pAssunto=str_replace("î","i",$pAssunto);
$pAssunto=str_replace("Î","i",$pAssunto);

//Possibilidades letras o
$pAssunto=str_replace("ó","o",$pAssunto);
$pAssunto=str_replace("Ó","o",$pAssunto);
$pAssunto=str_replace("ò","o",$pAssunto);
$pAssunto=str_replace("Ò","o",$pAssunto);
$pAssunto=str_replace("õ","o",$pAssunto);
$pAssunto=str_replace("Õ","o",$pAssunto);
$pAssunto=str_replace("ô","o",$pAssunto);
$pAssunto=str_replace("Ô","o",$pAssunto);

//Possibilidades letras u
$pAssunto=str_replace("ú","u",$pAssunto);
$pAssunto=str_replace("Ú","u",$pAssunto);
$pAssunto=str_replace("ù","u",$pAssunto);
$pAssunto=str_replace("Ù","u",$pAssunto);
$pAssunto=str_replace("û","u",$pAssunto);
$pAssunto=str_replace("Û","u",$pAssunto);

$pAssunto=str_replace("ç","c",$pAssunto);
$pAssunto=str_replace("Ç","c",$pAssunto);


$pAssunto=strtoupper($pAssunto);//codigo pra colocar os caracteres em Maiusculo

?>



<?php

//Verifica se existe palavras com acentos e troca para ficar sem
$logradouro=$_REQUEST['logradouro'];

//Possibilidades letras A
$logradouro=str_replace("á","a",$logradouro);
$logradouro=str_replace("Á","a",$logradouro);
$logradouro=str_replace("à","a",$logradouro);
$logradouro=str_replace("À","a",$logradouro);
$logradouro=str_replace("ã","a",$logradouro);
$logradouro=str_replace("Ã","a",$logradouro);
$logradouro=str_replace("â","a",$logradouro);
$logradouro=str_replace("Â","a",$logradouro);

//Possibilidades letras E
$logradouro=str_replace("é","e",$logradouro);
$logradouro=str_replace("É","e",$logradouro);
$logradouro=str_replace("è","e",$logradouro);
$logradouro=str_replace("È","e",$logradouro);
$logradouro=str_replace("ê","e",$logradouro);
$logradouro=str_replace("Ê","e",$logradouro);


//Possibilidades letras i
$logradouro=str_replace("í","i",$logradouro);
$logradouro=str_replace("Í","i",$logradouro);
$logradouro=str_replace("ì","i",$logradouro);
$logradouro=str_replace("Ì","i",$logradouro);
$logradouro=str_replace("î","i",$logradouro);
$logradouro=str_replace("Î","i",$logradouro);

//Possibilidades letras o
$logradouro=str_replace("ó","o",$logradouro);
$logradouro=str_replace("Ó","o",$logradouro);
$logradouro=str_replace("ò","o",$logradouro);
$logradouro=str_replace("Ò","o",$logradouro);
$logradouro=str_replace("õ","o",$logradouro);
$logradouro=str_replace("Õ","o",$logradouro);
$logradouro=str_replace("ô","o",$logradouro);
$logradouro=str_replace("Ô","o",$logradouro);

//Possibilidades letras u
$logradouro=str_replace("ú","u",$logradouro);
$logradouro=str_replace("Ú","u",$logradouro);
$logradouro=str_replace("ù","u",$logradouro);
$logradouro=str_replace("Ù","u",$logradouro);
$logradouro=str_replace("û","u",$logradouro);
$logradouro=str_replace("Û","u",$logradouro);

$logradouro=str_replace("ç","c",$logradouro);
$logradouro=str_replace("Ç","c",$logradouro);


$logradouro=strtoupper($logradouro);//codigo pra colocar os caracteres em Maiusculo

?>






<?php

//Verifica se existe palavras com acentos e troca para ficar sem

$complemento=$_REQUEST['complemento'];

//Possibilidades letras A
$complemento=str_replace("á","a",$complemento);
$complemento=str_replace("Á","a",$complemento);
$complemento=str_replace("à","a",$complemento);
$complemento=str_replace("À","a",$complemento);
$complemento=str_replace("ã","a",$complemento);
$complemento=str_replace("Ã","a",$complemento);
$complemento=str_replace("â","a",$complemento);
$complemento=str_replace("Â","a",$complemento);

//Possibilidades letras E
$complemento=str_replace("é","e",$complemento);
$complemento=str_replace("É","e",$complemento);
$complemento=str_replace("è","e",$complemento);
$complemento=str_replace("È","e",$complemento);
$complemento=str_replace("ê","e",$complemento);
$complemento=str_replace("Ê","e",$complemento);


//Possibilidades letras i
$complemento=str_replace("í","i",$complemento);
$complemento=str_replace("Í","i",$complemento);
$complemento=str_replace("ì","i",$complemento);
$complemento=str_replace("Ì","i",$complemento);
$complemento=str_replace("î","i",$complemento);
$complemento=str_replace("Î","i",$complemento);

//Possibilidades letras o
$complemento=str_replace("ó","o",$complemento);
$complemento=str_replace("Ó","o",$complemento);
$complemento=str_replace("ò","o",$complemento);
$complemento=str_replace("Ò","o",$complemento);
$complemento=str_replace("õ","o",$complemento);
$complemento=str_replace("Õ","o",$complemento);
$complemento=str_replace("ô","o",$complemento);
$complemento=str_replace("Ô","o",$complemento);

//Possibilidades letras u
$complemento=str_replace("ú","u",$complemento);
$complemento=str_replace("Ú","u",$complemento);
$complemento=str_replace("ù","u",$complemento);
$complemento=str_replace("Ù","u",$complemento);
$complemento=str_replace("û","u",$complemento);
$complemento=str_replace("Û","u",$complemento);

$complemento=str_replace("ç","c",$complemento);
$complemento=str_replace("Ç","c",$complemento);


$complemento=strtoupper($complemento);//codigo pra colocar os caracteres em Maiusculo

?>




<?php

//Verifica se existe palavras com acentos e troca para ficar sem

$bairro=$_REQUEST['bairro'];

//Possibilidades letras A
$bairro=str_replace("á","a",$bairro);
$bairro=str_replace("Á","a",$bairro);
$bairro=str_replace("à","a",$bairro);
$bairro=str_replace("À","a",$bairro);
$bairro=str_replace("ã","a",$bairro);
$bairro=str_replace("Ã","a",$bairro);
$bairro=str_replace("â","a",$bairro);
$bairro=str_replace("Â","a",$bairro);

//Possibilidades letras E
$bairro=str_replace("é","e",$bairro);
$bairro=str_replace("É","e",$bairro);
$bairro=str_replace("è","e",$bairro);
$bairro=str_replace("È","e",$bairro);
$bairro=str_replace("ê","e",$bairro);
$bairro=str_replace("Ê","e",$bairro);


//Possibilidades letras i
$bairro=str_replace("í","i",$bairro);
$bairro=str_replace("Í","i",$bairro);
$bairro=str_replace("ì","i",$bairro);
$bairro=str_replace("Ì","i",$bairro);
$bairro=str_replace("î","i",$bairro);
$bairro=str_replace("Î","i",$bairro);

//Possibilidades letras o
$bairro=str_replace("ó","o",$bairro);
$bairro=str_replace("Ó","o",$bairro);
$bairro=str_replace("ò","o",$bairro);
$bairro=str_replace("Ò","o",$bairro);
$bairro=str_replace("õ","o",$bairro);
$bairro=str_replace("Õ","o",$bairro);
$bairro=str_replace("ô","o",$bairro);
$bairro=str_replace("Ô","o",$bairro);

//Possibilidades letras u
$bairro=str_replace("ú","u",$bairro);
$bairro=str_replace("Ú","u",$bairro);
$bairro=str_replace("ù","u",$bairro);
$bairro=str_replace("Ù","u",$bairro);
$bairro=str_replace("û","u",$bairro);
$bairro=str_replace("Û","u",$bairro);

$bairro=str_replace("ç","c",$bairro);
$bairro=str_replace("Ç","c",$bairro);


$bairro=strtoupper($bairro);//codigo pra colocar os caracteres em Maiusculo

?>


<?php

//Verifica se existe palavras com acentos e troca para ficar sem
$cidade=$_REQUEST['cidade'];

//Possibilidades letras A
$cidade=str_replace("á","a",$cidade);
$cidade=str_replace("Á","a",$cidade);
$cidade=str_replace("à","a",$cidade);
$cidade=str_replace("À","a",$cidade);
$cidade=str_replace("ã","a",$cidade);
$cidade=str_replace("Ã","a",$cidade);
$cidade=str_replace("â","a",$cidade);
$cidade=str_replace("Â","a",$cidade);

//Possibilidades letras E
$cidade=str_replace("é","e",$cidade);
$cidade=str_replace("É","e",$cidade);
$cidade=str_replace("è","e",$cidade);
$cidade=str_replace("È","e",$cidade);
$cidade=str_replace("ê","e",$cidade);
$cidade=str_replace("Ê","e",$cidade);


//Possibilidades letras i
$cidade=str_replace("í","i",$cidade);
$cidade=str_replace("Í","i",$cidade);
$cidade=str_replace("ì","i",$cidade);
$cidade=str_replace("Ì","i",$cidade);
$cidade=str_replace("î","i",$cidade);
$cidade=str_replace("Î","i",$cidade);

//Possibilidades letras o
$cidade=str_replace("ó","o",$cidade);
$cidade=str_replace("Ó","o",$cidade);
$cidade=str_replace("ò","o",$cidade);
$cidade=str_replace("Ò","o",$cidade);
$cidade=str_replace("õ","o",$cidade);
$cidade=str_replace("Õ","o",$cidade);
$cidade=str_replace("ô","o",$cidade);
$cidade=str_replace("Ô","o",$cidade);

//Possibilidades letras u
$cidade=str_replace("ú","u",$cidade);
$cidade=str_replace("Ú","u",$cidade);
$cidade=str_replace("ù","u",$cidade);
$cidade=str_replace("Ù","u",$cidade);
$cidade=str_replace("û","u",$cidade);
$cidade=str_replace("Û","u",$cidade);

$cidade=str_replace("ç","c",$cidade);
$cidade=str_replace("Ç","c",$cidade);


$cidade=strtoupper($cidade);//codigo pra colocar os caracteres em Maiusculo

?>






<?php

//Verifica se existe palavras com acentos e troca para ficar sem

$obs=$_REQUEST['obs'];                  

//Possibilidades letras A
$obs=str_replace("á","a",$obs);
$obs=str_replace("Á","a",$obs);
$obs=str_replace("à","a",$obs);
$obs=str_replace("À","a",$obs);
$obs=str_replace("ã","a",$obs);
$obs=str_replace("Ã","a",$obs);
$obs=str_replace("â","a",$obs);
$obs=str_replace("Â","a",$obs);

//Possibilidades letras E
$obs=str_replace("é","e",$obs);
$obs=str_replace("É","e",$obs);
$obs=str_replace("è","e",$obs);
$obs=str_replace("È","e",$obs);
$obs=str_replace("ê","e",$obs);
$obs=str_replace("Ê","e",$obs);


//Possibilidades letras i
$obs=str_replace("í","i",$obs);
$obs=str_replace("Í","i",$obs);
$obs=str_replace("ì","i",$obs);
$obs=str_replace("Ì","i",$obs);
$obs=str_replace("î","i",$obs);
$obs=str_replace("Î","i",$obs);

//Possibilidades letras o
$obs=str_replace("ó","o",$obs);
$obs=str_replace("Ó","o",$obs);
$obs=str_replace("ò","o",$obs);
$obs=str_replace("Ò","o",$obs);
$obs=str_replace("õ","o",$obs);
$obs=str_replace("Õ","o",$obs);
$obs=str_replace("ô","o",$obs);
$obs=str_replace("Ô","o",$obs);

//Possibilidades letras u
$obs=str_replace("ú","u",$obs);
$obs=str_replace("Ú","u",$obs);
$obs=str_replace("ù","u",$obs);
$obs=str_replace("Ù","u",$obs);
$obs=str_replace("û","u",$obs);
$obs=str_replace("Û","u",$obs);

$obs=str_replace("ç","c",$obs);
$obs=str_replace("Ç","c",$obs);


$obs=strtoupper($obs);//codigo pra colocar os caracteres em Maiusculo

?>




<?php

//Verifica se existe palavras com acentos e troca para ficar sem

$requerente=$_REQUEST['requerente'];
//Possibilidades letras A
$requerente=str_replace("á","a",$requerente);
$requerente=str_replace("Á","a",$requerente);
$requerente=str_replace("à","a",$requerente);
$requerente=str_replace("À","a",$requerente);
$requerente=str_replace("ã","a",$requerente);
$requerente=str_replace("Ã","a",$requerente);
$requerente=str_replace("â","a",$requerente);
$requerente=str_replace("Â","a",$requerente);

//Possibilidades letras E
$requerente=str_replace("é","e",$requerente);
$requerente=str_replace("É","e",$requerente);
$requerente=str_replace("è","e",$requerente);
$requerente=str_replace("È","e",$requerente);
$requerente=str_replace("ê","e",$requerente);
$requerente=str_replace("Ê","e",$requerente);


//Possibilidades letras i
$requerente=str_replace("í","i",$requerente);
$requerente=str_replace("Í","i",$requerente);
$requerente=str_replace("ì","i",$requerente);
$requerente=str_replace("Ì","i",$requerente);
$requerente=str_replace("î","i",$requerente);
$requerente=str_replace("Î","i",$requerente);

//Possibilidades letras o
$requerente=str_replace("ó","o",$requerente);
$requerente=str_replace("Ó","o",$requerente);
$requerente=str_replace("ò","o",$requerente);
$requerente=str_replace("Ò","o",$requerente);
$requerente=str_replace("õ","o",$requerente);
$requerente=str_replace("Õ","o",$requerente);
$requerente=str_replace("ô","o",$requerente);
$requerente=str_replace("Ô","o",$requerente);

//Possibilidades letras u
$requerente=str_replace("ú","u",$requerente);
$requerente=str_replace("Ú","u",$requerente);
$requerente=str_replace("ù","u",$requerente);
$requerente=str_replace("Ù","u",$requerente);
$requerente=str_replace("û","u",$requerente);
$requerente=str_replace("Û","u",$requerente);

$requerente=str_replace("ç","c",$requerente);
$requerente=str_replace("Ç","c",$requerente);


$requerente=strtoupper($requerente);//codigo pra colocar os caracteres em Maiusculo

?>

<?php
 $n= $_POST['nome'];
 
 //Possibilidades letras A
 $n=str_replace("á","a",$n);
 $n=str_replace("Á","a",$n);
 $n=str_replace("à","a",$n);
 $n=str_replace("À","a",$n);
 $n=str_replace("ã","a",$n);
 $n=str_replace("Ã","a",$n);
 
 
 //Possibilidades letras E
 $n=str_replace("é","e",$n);
 $n=str_replace("É","e",$n);
 $n=str_replace("è","e",$n);
 $n=str_replace("È","e",$n);

 
 //Possibilidades letras i
 $n=str_replace("í","i",$n);
 $n=str_replace("Í","i",$n);
 $n=str_replace("ì","i",$n);
 $n=str_replace("Ì","i",$n);
 
 //Possibilidades letras o
 $n=str_replace("ó","o",$n);
 $n=str_replace("Ó","o",$n);
 $n=str_replace("ò","o",$n);
 $n=str_replace("Ò","o",$n);
 $n=str_replace("õ","o",$n);
 $n=str_replace("Õ","o",$n);
 
 
 //Possibilidades letras u
 $n=str_replace("ú","u",$n);
 $n=str_replace("Ú","u",$n);
 $n=str_replace("ù","u",$n);
 $n=str_replace("Ù","u",$n);
 
 $n=str_replace("ç","c",$n);
 $n=str_replace("Ç","c",$n);

 $n=strtoupper($n);

 echo $n;
?>
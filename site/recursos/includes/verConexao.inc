<?
  if($conexao = mysql_connect("186.202.152.83", "parvaim19","Prvm911329")){
     mysql_select_db("parvaim19", $conexao);
  }
  else{
     echo "Sem conexão";
     exit(0);
  }
?>
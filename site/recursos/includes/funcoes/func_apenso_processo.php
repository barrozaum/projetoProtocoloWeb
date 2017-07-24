<?php

function fun_inserindo_apenso($pdo, $id_processo_pai, $id_processo_filho, $usuario_ativo) {
//   limpo antes de inserir
    

        $sql_insercao = "INSERT INTO apenso (id_processo_pai, id_processo_filho, data_apenso, usuario)";
        $sql_insercao = $sql_insercao . " VALUES ";
        $sql_insercao = $sql_insercao . " ($id_processo_pai, $id_processo_filho, now(), '$usuario_ativo' )";
        if ($query_insercao = $pdo->query($sql_insercao)) {
            return TRUE;
        } else {
            return FALSE;
        }
  
}

function fun_excluindo_apenso($pdo, $id_processo_pai) {
//    primeiro listo os processo para alterar
//    no campo apensado na tabela cadastro_processo
    $sql_exclusao = "DELETE FROM apenso WHERE id_processo_pai = '{$id_processo_pai}'";
    if ($query_exclusao = $pdo->query($sql_exclusao)) {
        return TRUE;
    } else {
        return FALSE;
    }
}


function fun_verifica_apenso($pdo, $id_processo){
    $sql_filho = "SELECT * FROM apenso WHERE id_processo_filho = '{$id_processo}'";
    $resultado = $pdo->query($sql_filho);
        /* Check the number of rows that match the SELECT statement */
        if ($resultado->fetchColumn() > 0) {
            return  1;
        } else {
            return 0;
        }
    
    }
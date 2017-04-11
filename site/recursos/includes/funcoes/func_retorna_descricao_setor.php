<?php

function func_retorna_descricao_setor($pdo, $codigo_setor) {
    $sql_desc_setor = "SELECT * FROM setor WHERE idSetor = {$codigo_setor} LIMIT 1";
    $query_desc_setor = $pdo->prepare($sql_desc_setor);
    if ($query_desc_setor->execute()) {
        $dados = $query_desc_setor->fetch();
        return $dados['setor'];
    } else {
        return "";
    }
}

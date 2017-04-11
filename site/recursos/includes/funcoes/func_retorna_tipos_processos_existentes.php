<?php
// retorna os tipos de processos que posso cadastrar

function fun_retorna_tipo_processo_existente($pdo){
 
    $array = array('1' => 'COMUNICACAO INTERNA', '2' => 'COMUNICACAO EXTERNA');
    return $array; 
}
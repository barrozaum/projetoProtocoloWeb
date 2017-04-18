<?php

// retorna os tipos de processos que posso cadastrar

function fun_retorna_tipo_processo_existente($numero = 0) {
$array = array('1' => 'COMUNICACAO INTERNA', '2' => 'COMUNICACAO EXTERNA');
    if ($numero == 0) {
        
        return $array;
    }else{
        
        
        return $array[$numero];
    }
}

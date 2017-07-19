<?php

if(!isset($_SESSION))
{
   session_start();
}

//essa função é executado no momento em que eu cadastro o processo no sistema
function inserindo_carga($pdo, $id_proceso) {
    $dia_atual = date('Y-m-d');
    $hora_carga = date('H:i:s');

    $sql_carga = "INSERT INTO carga_processo ";
    $sql_carga = $sql_carga . "(idProcesso, idSetorOrigem, idSetorEntrada, idSetorPresente, tramite, idUsuarioCarga, dataCarga, idUsuarioRecebimento, dataRecebimento, seq_carga, data_carga_sistema, data_recebimento_sistema, hora_carga, hora_recebimento)";
    $sql_carga = $sql_carga . " VALUES ";
    $sql_carga = $sql_carga . "({$id_proceso},{$_SESSION['LOGIN_CODIGO_SETOR_USUARIO']},{$_SESSION['LOGIN_CODIGO_SETOR_USUARIO']},{$_SESSION['LOGIN_CODIGO_SETOR_USUARIO']}, 1,  {$_SESSION['LOGIN_ID_USUARIO']}, '{$dia_atual}',  {$_SESSION['LOGIN_ID_USUARIO']}, '{$dia_atual}', 0, '{$dia_atual}', '{$dia_atual}', '{$hora_carga}', '{$hora_carga}')";


    $executa = $pdo->query($sql_carga);
}

//esta função serve para saber se o proceso pode receber carga
function processo_pode_dar_carga($pdo, $id_processo, $codigo_setor_usuario_carga) {
    global $id_ultima_carga;
    global $seq_carga;
//        validando para saber se o processo pode sofrer carga
//        seleciono as cargas do processo 
    $sql_carga = "SELECT * FROM carga_processo ";
    $sql_carga = $sql_carga . " WHERE idProcesso = '{$id_processo}'";
    $sql_carga = $sql_carga . " ORDER BY seq_carga DESC";
    $sql_carga = $sql_carga . " LIMIT 1";
    $query_carga = $pdo->query($sql_carga);
    $query_carga->execute();
    if ($dados = $query_carga->fetch()) {
        $idSetorEntrada = $dados['idSetorEntrada'];
        $tramite = $dados['tramite'];
        $id_ultima_carga = $dados['idCarga'];
        $seq_carga = $dados['seq_carga'];
        if ($tramite != 1) {
            return "PROCESSO ENCONTRA-SE EM MOVIMENTO !!!";
        } else if ($idSetorEntrada != $codigo_setor_usuario_carga) {
            return "PROCESSO NÃO ENCONTRA-SE EM SEU SETOR !!!";
        } else {
            return "sim";
        }
    } else {
        return "CARGA PROCESSO NÃO ENCONTRADA !!!";
    }
}

//esta função é executada pelo programa cadastro carga
function cadastro_carga_processo($pdo, $codigo_processo, $data_carga, $parecer_carga, $codigo_setor_origem_processo, $codigo_setor_carga, $sequencia_carga) {
    $data_atual = date('Y-m-d');
    $hora_carga = date('H:i:s');
    $sequencia_carga += 1;

    $sql_carga = "INSERT INTO carga_processo ";
    $sql_carga = $sql_carga . "(idProcesso, idSetorOrigem, idSetorEntrada,  tramite, idUsuarioCarga, dataCarga, seq_carga, data_carga_sistema, parecer,usuario_acao, hora_carga)";
    $sql_carga = $sql_carga . " VALUES ";
    $sql_carga = $sql_carga . "({$codigo_processo}, {$codigo_setor_origem_processo},{$codigo_setor_carga},  0,  {$_SESSION['LOGIN_ID_USUARIO']}, '{$data_carga}',  {$sequencia_carga}, '{$data_atual}', '{$parecer_carga}', '{$_SESSION['LOGIN_USUARIO']}','{$hora_carga}')";


   $executa = $pdo->query($sql_carga);
    
}

//esta função é executada pelo programa cadastro carga
function cadastro_recebimento_processo($pdo, $id_carga_processo, $data_recebimento_americana) {
    $data_atual = date('Y-m-d');
    $hora_recebimento = date('H:i:s');

    
    $sql_carga = "UPDATE carga_processo ";
    $sql_carga = $sql_carga . "SET idUsuarioRecebimento = '{$_SESSION['LOGIN_ID_USUARIO']}' , ";
    $sql_carga = $sql_carga . " dataRecebimento= '{$data_recebimento_americana}' , ";
    $sql_carga = $sql_carga . " data_recebimento_sistema = '{$data_atual}' , ";
    $sql_carga = $sql_carga . " hora_recebimento = '{$hora_recebimento}' , ";
    $sql_carga = $sql_carga . " tramite = '1' ";
    $sql_carga = $sql_carga . " WHERE idCarga = '{$id_carga_processo}' ";
    

   $executa = $pdo->query($sql_carga);
}

function listar_cargas_processo($pdo, $id_processo) {

//        validando para saber se o processo pode sofrer carga
//        seleciono as cargas do processo 
    $sql_carga = "SELECT * FROM carga_processo cp";
    $sql_carga = $sql_carga . " WHERE cp.idProcesso = '{$id_processo}'";
    $sql_carga = $sql_carga . " ORDER BY seq_carga DESC";
    

    $query_carga = $pdo->query($sql_carga);
    if ($query_carga->execute()) {

        $array = array();
        //loop para listar todos os dados encontrados
        for ($i = 0; $dados_carga = $query_carga->fetch(); $i++) {
            $idCarga = $dados_carga['idCarga'];
            $descricao_setor_origem = func_retorna_descricao_setor($pdo, $dados_carga['idSetorOrigem']);
            $descricao_setor_entrada = func_retorna_descricao_setor($pdo, $dados_carga['idSetorEntrada']);
            $parecer = $dados_carga['parecer'];
            $nome_usuario_carga = func_retorna_usuario($pdo, $dados_carga['idUsuarioCarga']);
            $data_carga = dataBrasileiro($dados_carga['dataCarga']);
            $nome_usuario_recebimento = func_retorna_usuario($pdo, $dados_carga['idUsuarioRecebimento']);
            $data_recebimento = dataBrasileiro($dados_carga['dataRecebimento']);
            $sequencia_carga = $dados_carga['seq_carga'];


            $array[$i] = array(
                "id_carga" => $idCarga,
                "setor_origem" => $descricao_setor_origem,
                "setor_entrada" => $descricao_setor_entrada,
                "parecer" => $parecer,
                "nome_usuario_carga" => $nome_usuario_carga,
                "data_carga" => $data_carga,
                "nome_usuario_recebimento" => $nome_usuario_recebimento,
                "data_recebimento" => $data_recebimento,
                "sequencia_carga" => $sequencia_carga,
            );
        }
       return $array;
    } else {
        return "CARGA PROCESSO NÃO ENCONTRADA !!!";
    }
}


// essa função vai verifiar a ultima carga do processo e ver se 
// está para o setor do usuário que vai receber a o processo
function fun_posso_receber_processo_por_numero($pdo, $id_proceso,$codigo_setor_usuario_carga){
    global $id_ultima_carga;
    global $id_ultimo_parecer;
    global $seq_carga;
    $sql_carga = " SELECT * FROM carga_processo WHERE idProcesso = " . $id_proceso;
    $sql_carga = $sql_carga . " ORDER BY seq_carga DESC ";
    $sql_carga = $sql_carga . " LIMIT 1 ";
    
    $query_carga = $pdo->query($sql_carga);
    $query_carga->execute();
    if ($dados = $query_carga->fetch()) {
        $idSetorEntrada = $dados['idSetorEntrada'];
        $tramite = $dados['tramite'];
        $id_ultimo_parecer = $dados['parecer'];
        $id_ultima_carga = $dados['idCarga'];
        $seq_carga = $dados['seq_carga'];
       
        
        if ($tramite != 0) {
            return "PROCESSO ENCONTRA-SE EM ALGUM SETOR!!!";
            
        } else if ($idSetorEntrada != $codigo_setor_usuario_carga) {
            return "PROCESSO NÃO POSSUI CARGA PARA O SEU SETOR !!!";
        } else {
            return "sim";
        }
    }else{
        return "CARGA PROCESSO NÃO ENCONTRADA !!!";
    }
}
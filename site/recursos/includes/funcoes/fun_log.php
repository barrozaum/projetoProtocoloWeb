<?php

//Log ASSUNTO
function fun_log_assunto($pdo, $tipo_comando, $comando_sql) {
//    retiro ' se existir
    $comando_sql = str_replace("'", '', $comando_sql);


//id_usuário ue executa o comando
    $ID_USUARIO_LOGADO = $_SESSION['LOGIN_ID_USUARIO'];
    $DATA_ATUAL = date('Y-m-d');

//    comando sql para log
    $sql_log = "INSERT INTO log_assunto (tipo_comando, comando_sql, data_comando, usuario_comando)";
    $sql_log = $sql_log . " VALUES ";
    $sql_log = $sql_log . "('{$tipo_comando}', '{$comando_sql}' , '{$DATA_ATUAL}', '{$ID_USUARIO_LOGADO}')";

    $query_log = $pdo->prepare($sql_log);
    if ($query_log->execute()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//----------------------------------------------------------------------
// LOG DOCUMENTO

function fun_log_documento($pdo, $tipo_comando, $comando_sql) {
//    retiro ' se existir
    $comando_sql = str_replace("'", '', $comando_sql);


//id_usuário ue executa o comando
    $ID_USUARIO_LOGADO = $_SESSION['LOGIN_ID_USUARIO'];
    $DATA_ATUAL = date('Y-m-d');

//    comando sql para log
    $sql_log = "INSERT INTO log_documento (tipo_comando, comando_sql, data_comando, usuario_comando)";
    $sql_log = $sql_log . " VALUES ";
    $sql_log = $sql_log . "('{$tipo_comando}', '{$comando_sql}' , '{$DATA_ATUAL}', '{$ID_USUARIO_LOGADO}')";

    $query_log = $pdo->prepare($sql_log);
    if ($query_log->execute()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//----------------------------------------------------------------------
// LOG ORIGEM
function fun_log_origem($pdo, $tipo_comando, $comando_sql) {
//    retiro ' se existir
    $comando_sql = str_replace("'", '', $comando_sql);


//id_usuário ue executa o comando
    $ID_USUARIO_LOGADO = $_SESSION['LOGIN_ID_USUARIO'];
    $DATA_ATUAL = date('Y-m-d');

//    comando sql para log
    $sql_log = "INSERT INTO log_origem (tipo_comando, comando_sql, data_comando, usuario_comando)";
    $sql_log = $sql_log . " VALUES ";
    $sql_log = $sql_log . "('{$tipo_comando}', '{$comando_sql}' , '{$DATA_ATUAL}', '{$ID_USUARIO_LOGADO}')";

    $query_log = $pdo->prepare($sql_log);
    if ($query_log->execute()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//----------------------------------------------------------------------

//----------------------------------------------------------------------
// LOG Setor
function fun_log_setor($pdo, $tipo_comando, $comando_sql) {
//    retiro ' se existir
    $comando_sql = str_replace("'", '', $comando_sql);


//id_usuário ue executa o comando
    $ID_USUARIO_LOGADO = $_SESSION['LOGIN_ID_USUARIO'];
    $DATA_ATUAL = date('Y-m-d');

//    comando sql para log
    $sql_log = "INSERT INTO log_setor (tipo_comando, comando_sql, data_comando, usuario_comando)";
    $sql_log = $sql_log . " VALUES ";
    $sql_log = $sql_log . "('{$tipo_comando}', '{$comando_sql}' , '{$DATA_ATUAL}', '{$ID_USUARIO_LOGADO}')";

    $query_log = $pdo->prepare($sql_log);
    if ($query_log->execute()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//----------------------------------------------------------------------

//----------------------------------------------------------------------
// LOG Requerente
function fun_log_requerente($pdo, $tipo_comando, $comando_sql) {
//    retiro ' se existir
    $comando_sql = str_replace("'", '', $comando_sql);


//id_usuário ue executa o comando
    $ID_USUARIO_LOGADO = $_SESSION['LOGIN_ID_USUARIO'];
    $DATA_ATUAL = date('Y-m-d');

//    comando sql para log
    $sql_log = "INSERT INTO log_requerente (tipo_comando, comando_sql, data_comando, usuario_comando)";
    $sql_log = $sql_log . " VALUES ";
    $sql_log = $sql_log . "('{$tipo_comando}', '{$comando_sql}' , '{$DATA_ATUAL}', '{$ID_USUARIO_LOGADO}')";

    $query_log = $pdo->prepare($sql_log);
    if ($query_log->execute()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//----------------------------------------------------------------------
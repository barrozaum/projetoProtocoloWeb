<?php

if(!isset($_SESSION))
{
   session_start();
}

//cria um modal contendoo titulo e a mensagem de erro
function criar_modal_erros($titulo, $msg) {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> <p class="text-info"><?php print $titulo; ?></p></h4>
    </div>
    <div class="modal-body"><p class="text-danger"><?php print $msg; ?></p></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default"  data-dismiss="modal" >FECHAR </button>
    </div>
    <?php
}

function conteudo_modal_erros($msg) {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> <p class="text-info"><?php print $titulo; ?></p></h4>
    </div>
    <div class="modal-body"><p class="text-danger"><?php print $msg; ?></p></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default"  data-dismiss="modal" >FECHAR </button>
    </div>
    <?php
}

<?php
session_start();
?>
<footer style="color: black; background-color: #e7e7e7">
    <div class="container" >
        <div class="row">
            <div class="col-sm-4">
                <h3>Usuário</h3>
                <hr>
                <p>Login : <?php print strtoupper($_SESSION['LOGIN_USUARIO']);?></p>
                <p>Setor : <?php print $_SESSION['LOGIN_DESCRICAO_SETOR_USUARIO'];?></p>
            </div>

            <div class="col-sm-4">
                <h3>Institucional</h3>
                <hr>
                <p><a href="#">Ajuda (Manual)</a></p>
              </div>
            <div class="col-sm-4">
                <h3>FALE CONSOCO</h3>
                <hr>
                <p>E-mail: parvaim@parvaim.com.br</p>
                <p>Tel: (21) 2651-1048</p>
                <p>Tel: (21) 2651-2338</p>
                <p>Cel: (21) 9-9966-5985</p>
            </div>
        </div>
    </div>
</footer>

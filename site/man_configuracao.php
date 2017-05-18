<?php
//valida para saber se o usuário está logado
include "recursos/includes/estrutura/controle/validar_secao.php";
//funcao input
include_once './recursos/includes/funcoes/funcaoCriacaoInput.php';
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Protocolo</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="recursos/css/bootstrap.css" rel="stylesheet">
        <link href="recursos/css/menu.css" rel="stylesheet">
        <script src="recursos/js/jquery.min.js"></script>
        <script src="recursos/js/bootstrap.min.js"></script>
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
        <script src="recursos/js/estrutura.js"></script>
        <script src="recursos/js/buscaCep.js"></script>
        <script src="recursos/js/camposNumeros.js"></script>
        <script src="recursos/js/mascaraCpfCnpj.js"></script>
        <script src="recursos/js/valida_cpf_cnpj.js"></script>
        <link rel="stylesheet" href="recursos/css/jquery.dataTables.min.css">
        <script src="recursos/js/jquery.dataTables.min.js"></script>
         <script>
            $(document).ready(function () {
                estruturaPagina();
            });

            function estruturaPagina() {
                $('#modal').load('recursos/includes/estrutura/modal_grande.html');
            }
        </script>
    </head>
    <body>
        <div id="cabecalho">
            <!-- Não apagar, pois é onde encontra-se o menu do site -->
        </div>

        <div class="container text center">
            <div class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0"> <!-- div que posiciona o formulário na tela -->
                <div class="well"><!-- div que coloca a cor no formulário -->
                    <div class="panel panel-default">
                        <!-- INICIO Dados do imóvel -->
                        <div class="panel-heading text-center">MANUTENÇÃO CONFIGURAÇÃO SISTEMA </div>
                        <div class="panel-body">
                            <!-- inicio dados inscrição-->
                            <form  method="post" action="recursos/includes/cadastrar/cadastra_configuracao_cliente.php" name="formularioItbi" id="formularioItbi" enctype="multipart/form-data">  <!-- inicio do formulário --> 
   
                                <div class="row">
                                    <div class="col-sm-7">
                                        <?php
                                        //   INPUT -                      
                                        criar_input_text('NOME CLIENTE', 'nome_cliente', 'nome_cliente', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'NOME DO CLIENTE'), $_SESSION['CONFIG_NOME_CLIENTE']);
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?php
                                        //   INPUT -                      
                                        criar_input_file('LOGO TIPO', 'logo_tipo_cliente', 'logo_tipo_cliente', array('accept' => "image/jpg"));
                                        ?>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-7">
                                        <?php
                                        //   INPUT -                      
                                        criar_input_text('UNIDADE', 'unidade_gestora', 'unidade_gestora', array('required' => 'true', 'maxlength' => '50', 'placeholder' => 'UNIDADE GESTORA'), $_SESSION['CONFIG_SECRETARIA']);
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?php
                                        //   INPUT -                           
                                        criar_input_text('CNPJ', 'cpf_cnpj_adquirinte', 'cpf_cnpj_adquirinte', array('required' => 'true', 'maxlength' => '17', 'placeholder' => 'INFORME CNPJ DO CLIENTE', 'onkeypress' => 'return SomenteNumero(event)', 'onkeyUp' => 'mascaraMutuario(this, cpfCnpj)', 'onblur' => 'validar_cpf_cnpj(this, \'id_tipo_pessoa_adquirinte\')'), $_SESSION['CONFIG_CNPJ'], 'somente os numeros');
                                        criar_input_hidden('tipo_pessoa_adquirinte', array('required' => 'true'), 'JURÍDICA');
                                        ?>

                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php
                                        criar_input_text('Cep', 'cep_adquirinte', 'cep_adquirinte', array('required' => 'true', 'maxlength' => '8', 'placeholder' => 'xx.xxx-xxx', 'onkeypress' => 'return SomenteNumero(event)', ' onblur' => 'retornaCep(this.id, txt_cep_adquirinte, txt_rua_adquirinte, txt_bairro_adquirinte, txt_cidade_adquirinte, txt_uf_adquirinte)'), $_SESSION['CONFIG_CEP'], 'somente os numeros');
                                        ?>
                                    </div> 
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <?php
                                            criar_input_text('Rua', 'rua_adquirinte', 'rua_adquirinte', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '50', 'placeholder' => 'RUA'), $_SESSION['CONFIG_ENDERECO'], 'conter no minímo 3 caracteres [a-z A-Z]');
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-5">
                                        <?php
                                        criar_input_text('Bairro', 'bairro_adquirinte', 'bairro_adquirinte', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '20', 'placeholder' => 'BAIRRO'), $_SESSION['CONFIG_BAIRRO'], 'conter no minímo 3 caracteres [a-z A-Z]');
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?php
                                        criar_input_text('Cidade', 'cidade_adquirinte', 'cidade_adquirinte', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '20', 'placeholder' => 'CIDADE'), $_SESSION['CONFIG_CIDADE'], 'conter no minímo 3 caracteres [a-z A-Z]');
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php
                                        criar_input_text('UF', 'uf_adquirinte', 'uf_adquirinte', array('readonly' => 'true', 'required' => 'true', 'maxlength' => '2', 'placeholder' => 'UF'), $_SESSION['CONFIG_UF'], 'conter no minímo 2 caracteres [a-z A-Z]');
                                        ?>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-sm-2">
                                        <?php
                                        criar_input_text('N°', 'numero_endereco_adquirinte', 'numero_endereco_adquirinte', array('required' => 'true', 'maxlength' => '5', 'placeholder' => 'xxxxx', 'onkeypress' => 'return SomenteNumero(event)'), $_SESSION['CONFIG_NUMERO_ENDERECO'], 'somente os numeros');
                                        ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php
                                        criar_input_text('Complemento', 'complemento_endereco_adquirinte', 'complemento_endereco_adquirinte', array('required' => 'true', 'maxlength' => '30', 'placeholder' => 'COMPLEMENTO'), $_SESSION['CONFIG_COMPLEMENTO'], 'caracteres [a-z A-Z]');
                                        ?>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success" >Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
          <div id="modal"></div>
        <div id="rodape">
            <!-- Não apagar, pois é onde encontra-se o rodape da página -->
        </div>
        <div id="rodape">
            <!-- Não apagar, pois é onde encontra-se o rodape da página -->
        </div>
    </body>
</html>
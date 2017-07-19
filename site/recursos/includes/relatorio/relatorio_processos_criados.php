<?php

include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcao_formata_data.php';
include_once '../funcoes/func_retorna_setor.php';
include_once '../funcoes/func_retorna_observacao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//massete para passar a conexao entre os médodos em problema

    global $con_pdo;
    $con_pdo = $pdo;



// incluo a biblioteca do fpdf 

    include '../estrutura/fpdf/fpdf.php';

//CRIO MINHA CLASSE E UTILIZO HERANÇA DELA DA CLASSE fpdf
    class PDF extends FPDF {

        // Sobre escrevo o método implementado pela classe FPDF
        function Header() {
// enviado pelo formulario
            // Arial bold 15
            $this->SetFont('Arial', 'B', 20);
            // Move to the right
            // Title
//        Image(caminho, espaco a esquerda, espaco a cima, largura, altura)
            $this->Image('../../imagens/estrutura/logo.jpg', 10, 10, 35, 15);
            $this->Cell(45, 0, '', 5, 0, 'R');
            $this->Cell(0, -5, $_SESSION['CONFIG_NOME_CLIENTE'], 5, 0, 'L');
            $this->Ln(5);
            $this->SetFont('Arial', '', 12);
            $this->Cell(45, 0, '', 5, 0, 'R');
            $this->Cell(170, 0, $_SESSION['CONFIG_SECRETARIA'], 3, 0, 'L');
            $this->Ln(7);

            $this->Cell(0, 0, "", 1, 0, 'L');
            $this->Ln(5);
            $this->SetFont('Arial', '', 16);

            $this->Cell(0, 0, utf8_decode("RELAÇÃO DE NOVOS PROCESSOS "), 3, 0, 'C');
            $this->Ln(5);
            $this->Cell(0, 0, "", 1, 0, 'L');
            // Line break
            $this->Ln(8);
            $this->parte1();
            $this->SetFillColor(255, 0, 0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128, 0, 0);
            $this->SetLineWidth(.1);
            $this->SetFont('Arial', '', 10);

            $headertabela = array('TIPO', 'NÚMERO', 'ANO', 'DATA', 'VALOR', 'ASSUNTO');
            // ALIMENTO O CABECALHO DA PAGINA
            $w = array(35, 20, 15, 20, 20, 90);

            for ($i = 0; $i < count($headertabela); $i++)
                $this->Cell($w[$i], 7, utf8_decode($headertabela[$i]), 1, 0, 'L', true);
            $this->Ln();
        }

// CRIEI A FUNÇÃO PARA ALIMETAR AS LINHA E DEIXAR COR SIM COR NÃO
        function parte1() {
            $data_inicial = dataAmericano($_POST['txt_dt_inicial']);
            $data_final = dataAmericano($_POST['txt_dt_final']);
            global $con_pdo;
            $this->SetFont('Arial', '', 12);
            $this->Cell(60, 0, utf8_decode("Periodo Pesquisa: " . $_POST['txt_dt_inicial'] . " - " . $_POST['txt_dt_final']), 0, 0, 'L');
            $this->Ln(5);
        }

// CRIEI A FUNÇÃO PARA ALIMETAR AS LINHA E DEIXAR COR SIM COR NÃO
        function parte2() {
//periodo de busca
            $data_inicial = dataAmericano($_POST['txt_dt_inicial']);
            $data_final = dataAmericano($_POST['txt_dt_final']);



            global $con_pdo;

            $this->SetFont('Arial', '', 8);


            if ($_POST['txt_tipo_processo'] == 0) {
                $sql = "SELECT * ";
                $sql = $sql . " FROM  cadastro_processo c,tipo_processo t ";
                $sql = $sql . " WHERE c.dataProcesso >= '$data_inicial'";
                $sql = $sql . " AND c.dataProcesso <= '$data_final' ";
                $sql = $sql . " AND c.tipoProcesso = t.id_tipo_processo";
                $sql = $sql . " ORDER BY c.numeroProcesso, c.dataProcesso DESC   ";
            } else {

                $sql = "SELECT * ";
                $sql = $sql . " FROM  cadastro_processo c";
                $sql = $sql . " WHERE c.dataProcesso >= '$data_inicial'";
                $sql = $sql . " AND c.dataProcesso <= '$data_final'";
                $sql = $sql . " AND c.tipoProcesso = {$_POST['txt_tipo_processo']}";
                $sql = $sql . " ORDER BY  c.numeroProcesso,  c.dataProcesso DESC   ";
            }

            $query = $con_pdo->prepare($sql);
            $query->execute();

            $linha = false;
            for ($i = 0; $dados = $query->fetch(); $i++) {
                if ($linha == true){
                    $linha = false;
                    $this->SetFillColor(100, 0, 0);
                }else{
                    $this->SetFillColor(205,205,205);
                    $linha = true;
                }
                if ($_POST['txt_tipo_processo'] == 1) {
                    $dados['descricao_tipo_processo'] = "PROCESSO INTERNO";
                } else if ($_POST['txt_tipo_processo'] == 2) {
                    $dados['descricao_tipo_processo'] = "PROCESSO EXTERNO";
                }

                
                
                $this->SetDrawColor(100, 1, 2);
                $this->SetLineWidth(.1);
                $this->Cell(35, 6, $dados['descricao_tipo_processo'], 1, 0, 'L', $linha);
                $this->Cell(20, 6, $dados['numeroProcesso'], 1, 0, 'R', $linha);
                $this->Cell(15, 6, $dados['anoProcesso'], 1, 0, 'R', $linha);
                $this->Cell(20, 6, dataBrasileiro($dados['dataProcesso']), 1, 0, 'R', $linha);
                $this->Cell(20, 6, $dados['valor'], 1, 0, 'R', $linha);
                $this->Cell(90, 6, $dados['descricao_assunto'], 1, 0, 'C', $linha);
                $this->Ln();
                $this->MultiCell(0, 5, utf8_decode("OBSERVAÇÃO: \n" . fun_retorna_descricao_observacao($con_pdo, $dados['idProcesso'])), 1, 'J', $linha);
            }
        }

    }

// INSTANCIO O OBJETO E PASSO L PARA QUE SEJA A FOLHA DEITADA
    $pdf = new PDF('L'); // P = Portrait, em milimetros, e A4 (297x210)
// UTILIZO O MÉTODO PARA CALCULAR O NUMERO DE PAGINAS
    $pdf->AliasNbPages();

// ESPECIFICO O TAMANHO DAS MARGINS
    $pdf->SetMargins(5, 15, 5, 5);

// Color and font restoration
    $pdf->SetFillColor(224, 235, 255);


// ADICIONO A PAGINA EM BRANCO
    $pdf->AddPage('P', 'A4');


// PREENCHO A PAGINA EM BRANCO COM O MÉTODO QUE EU CRIE ACIMA
    $pdf->parte2();

//fecho a conexao 
    $con_pdo = null;
    $pdo = null;

// FECHO E GERO O ARQUIVO NA TELA
    $pdf->Output();


// if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
} else {
    die(header("Location: ../../../pagina_erro_relatorio.php?cmd=1"));
}
?>
<?php

include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcao_formata_data.php';
include_once '../funcoes/func_retorna_setor.php';
include_once '../funcoes/func_retorna_tipos_processos_existentes.php';
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

            $this->Cell(0, 0, utf8_decode("RELAÇÃO DE PROTOCOLADOS "), 3, 0, 'C');
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

            $headertabela = array('NÚMERO', 'ANO', 'DATA', 'REQUERENTE', 'ASSUNTO', 'NUM. PROC.', 'ANO PROC.', 'TIPO PROC.');
            // ALIMENTO O CABECALHO DA PAGINA
            $w = array(20, 15, 22, 80, 80, 23, 23, 24);

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

            $sql = "SELECT * FROM protocolo WHERE data_protocolo BETWEEN '$data_inicial' AND '$data_final'";
            $query = $con_pdo->prepare($sql);
            $query->execute();

            $linha = false;
            for ($i = 0; $dados = $query->fetch(); $i++) {
                if ($linha == true) {
                    $linha = false;
                    $this->SetFillColor(100, 0, 0);
                } else {
                    $this->SetFillColor(205, 205, 205);
                    $linha = true;
                }



                $this->SetDrawColor(100, 1, 2);
                $this->SetLineWidth(.1);
                $this->Cell(20, 6, $dados['numero_protocolo'], 1, 0, 'C', $linha);
                $this->Cell(15, 6, $dados['ano_protocolo'], 1, 0, 'C', $linha);
                $this->Cell(22, 6, dataBrasileiro($dados['data_protocolo']), 1, 0, 'C', $linha);
                $this->Cell(80, 6, substr($dados['requerente_protocolo'], 0, 43), 1, 0, 'C', $linha);
                $this->Cell(80, 6, substr($dados['assunto_protocolo'], 0, 43), 1, 0, 'C', $linha);
                $this->Cell(23, 6, $dados['numero_processo_protocolo'], 1, 0, 'C', $linha);
                $this->Cell(23, 6, $dados['ano_processo_protocolo'], 1, 0, 'C', $linha);
                $this->Cell(24, 6, fun_retorna_descricao_tipo_processo($con_pdo, $dados['tipo_processo_protocolo']), 1, 0, 'C', $linha);
                $this->Ln();
                $this->MultiCell(0, 5, utf8_decode("OBSERVAÇÃO: \n       " . $dados['observacao_protocolo']), 1, 'J', $linha);
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
    $pdf->AddPage('L', 'A4');


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
<?php

//die(print_r($_POST));
include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/func_retorna_assunto.php';
include_once '../funcoes/func_retorna_requerente.php';
include_once '../funcoes/func_retorna_origem.php';

//massete para passar a conexao entre os médodos em problema
global $tipo;
global $numero;
global $ano;
global $con_pdo;
// valores pro robadao
$con_pdo = $pdo;
$tipo = $_POST['txt_tipo_processo'];
$numero = $_POST['txt_numero_processo'];
$ano = $_POST['txt_ano_processo'];

// incluo a biblioteca do fpdf 

include '../estrutura/fpdf/fpdf.php';

//CRIO MINHA CLASSE E UTILIZO HERANÇA DELA DA CLASSE fpdf
class PDF extends FPDF {

    // Sobre escrevo o método implementado pela classe FPDF
    function Header() {
// enviado pelo formulario
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        // Title
//        Image(caminho, espaco a esquerda, espaco a cima, largura, altura)
        $this->Image('../../imagens/estrutura/logo.jpg', 10, 10, 35, 15);
        $this->Cell(45, 0, '', 5, 0, 'R');
        $this->Cell(0, -5, $_SESSION['CONFIG_NOME_CLIENTE'], 5, 0, 'L');
        $this->Ln(5);
        $this->SetFont('Arial', '', 9);
        $this->Cell(45, 0, '', 5, 0, 'R');
        $this->Cell(170, 0, utf8_decode("RELAÇÃO DO ANDAMENTO DO PROCESSO"), 3, 0, 'L');
        $this->Ln(5);
        $this->Cell(45, 0, '', 5, 0, 'R');
        $this->Cell(170, 0, $_SESSION['CONFIG_SECRETARIA'], 3, 0, 'L');
        $this->Ln(5);

        $this->Cell(204, 0, "", 1, 0, 'L');
        $this->Ln(5);
        $this->SetFont('Arial', '', 12);

        $this->Cell(0, 0, utf8_decode("RELAÇÃO DO ANDAMENTO DO PROCESSO"), 3, 0, 'C');

        // Line break
        $this->Ln(5);

//        
        $this->parte1();

        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Arial', '', 7);

        $headertabela = array('DATA CARGA', 'SETOR');
        // ALIMENTO O CABECALHO DA PAGINA
        $w = array(40, 165);

        for ($i = 0; $i < count($headertabela); $i++)
            $this->Cell($w[$i], 7, utf8_decode($headertabela[$i]), 1, 0, 'C', true);
        $this->Ln();
    }

// CRIEI A FUNÇÃO PARA ALIMETAR AS LINHA E DEIXAR COR SIM COR NÃO
    function parte1() {
//        chama robadao
        global $numero;
        global $ano;
        global $tipo;
        global $con_pdo;

        // preparo para realizar o comando sql
        $sql_processo = "SELECT * FROM cadastro_processo";
        $sql_processo = $sql_processo . " WHERE tipoProcesso = '{$tipo}'";
        $sql_processo = $sql_processo . " AND numeroProcesso = '{$numero}'";
        $sql_processo = $sql_processo . " AND anoProcesso = '{$ano}'";
        $sql_processo = $sql_processo . " LIMIT 1 ";

        $query_processo = $con_pdo->prepare($sql_processo);
        $query_processo->execute();
        if ($dados = $query_processo->fetch()) {

            $this->Cell(40, 6, utf8_decode("Número"), 1, 0, 'C');
            $this->Cell(165, 6, $dados['numeroProcesso'], 1, 0, 'C');
            $this->Ln();
            $this->Cell(40, 6, "Ano", 1, 0, 'C');
            $this->Cell(165, 6, $dados['anoProcesso'], 1, 0, 'C');
            $this->Ln();
            $this->Cell(40, 6, "Assunto", 1, 0, 'C');
            $this->Cell(165, 6, fun_retorna_descricao_assunto($con_pdo, $dados['idAssunto']), 1, 0, 'C');
            $this->Ln();
            $this->Cell(40, 6, "Requerente", 1, 0, 'C');

            $this->Cell(165, 6, fun_retorna_descricao_requerente($con_pdo, $dados['idRequerente']), 1, 0, 'C');
            $this->Ln();
            $this->Cell(40, 6, "Origem", 1, 0, 'C');
            $this->Cell(165, 6, fun_retorna_descricao_origem($con_pdo, $dados['idOrigem']), 1, 0, 'C');
            $this->Ln();
        }
    }

// CRIEI A FUNÇÃO PARA ALIMETAR AS LINHA E DEIXAR COR SIM COR NÃO
    function parte2($pdo, $tipo, $numero, $ano) {


        $this->Cell(40, 6, utf8_decode("Número"), 1, 0, 'C');
        $this->Cell(165, 6, "Igor", 1, 0, 'C');
        $this->Ln();
        $this->Cell(40, 6, "Ano", 1, 0, 'C');
        $this->Cell(165, 6, "Igor", 1, 0, 'C');

        $this->Ln();
    }

}

?>
<?php

// INSTANCIO O OBJETO E PASSO L PARA QUE SEJA A FOLHA DEITADA
$pdf = new PDF('P'); // P = Portrait, em milimetros, e A4 (210x297)
// UTILIZO O MÉTODO PARA CALCULAR O NUMERO DE PAGINAS
$pdf->AliasNbPages();

// ESPECIFICO O TAMANHO DAS MARGINS
$pdf->SetMargins(3, 15, 20, 20);

// Color and font restoration
$pdf->SetFillColor(224, 235, 255);

// ESPECIFICO O TIPO E O TAMANHO DA FONT
$pdf->SetFont('Arial', '', 7);

// ADICIONO A PAGINA EM BRANCO
$pdf->AddPage('P', 'A4');


// PREENCHO A PAGINA EM BRANCO COM O MÉTODO QUE EU CRIE ACIMA
for ($i = 0; $i < 60; $i++)
    $pdf->parte2($pdo, $tipo, $numero, $ano);

// FECHO E GERO O ARQUIVO NA TELA
$pdf->Output();
?>
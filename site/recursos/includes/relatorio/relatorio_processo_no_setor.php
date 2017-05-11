<?php

include_once '../estrutura/controle/validar_secao.php';
include_once '../estrutura/conexao/conexao.php';
include_once '../funcoes/funcao_formata_data.php';
include_once '../funcoes/func_retorna_setor.php';

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

            $this->Cell(0, 0, utf8_decode("RELAÇÃO DE PROCESSOS NO SETOR "), 3, 0, 'C');
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

            $headertabela = array('TIPO', 'NÚMERO', 'ANO', 'ASSUNTO', 'REQUERENTE', 'DT_CARGA');
            // ALIMENTO O CABECALHO DA PAGINA
            $w = array(38, 20, 15, 95, 95, 25);

            for ($i = 0; $i < count($headertabela); $i++)
                $this->Cell($w[$i], 7, utf8_decode($headertabela[$i]), 1, 0, 'L', true);
            $this->Ln();
        }

// CRIEI A FUNÇÃO PARA ALIMETAR AS LINHA E DEIXAR COR SIM COR NÃO
        function parte1() {
            global $con_pdo;
            $this->SetFont('Arial', '', 11);
            $descricao_setor_origem_processo = func_retorna_descricao_setor($con_pdo, $_POST['txt_codigo_setor']);
            $this->Cell(60, 0, utf8_decode("SETOR PROCESSO: "), 0, 0, 'L');
            $this->Cell(40, 0, $descricao_setor_origem_processo, 0, 0, 'L');
            $this->Ln(5);
        }

// CRIEI A FUNÇÃO PARA ALIMETAR AS LINHA E DEIXAR COR SIM COR NÃO
        function parte2() {
//periodo de busca
            $data_inicial = dataAmericano($_POST['txt_dt_inicial']);
            $data_final = dataAmericano($_POST['txt_dt_final']);
            
            
            
            global $con_pdo;

            $this->SetFont('Arial', '', 8);


            $sql_carga = "SELECT cp.idProcesso, MAX(cp.seq_carga) AS maior_sequencia ";
            $sql_carga = $sql_carga . " FROM carga_processo cp";
            $sql_carga = $sql_carga . " WHERE idProcesso NOT IN ("; // select dentro de select
            $sql_carga = $sql_carga . "  SELECT idProcesso"; // 
            $sql_carga = $sql_carga . "  FROM carga_processo "; // 
            $sql_carga = $sql_carga . "  WHERE tramite = 0"; // 
            $sql_carga = $sql_carga . "   ORDER BY seq_carga desc) "; // fim do select interno
            $sql_carga = $sql_carga . " GROUP by idProcesso "; // fim do select interno


            $query = $con_pdo->prepare($sql_carga);
            $query->execute();
            $linha = false;
            for ($i = 0; $dados = $query->fetch(); $i++) {
                if ($linha == true)
                    $linha = false;
                else
                    $linha = true;

                $sql_processo = "SELECT * FROM carga_processo cp, cadastro_processo c, tipo_processo t, assunto a, requerente r ";
                $sql_processo = $sql_processo . " WHERE cp.idProcesso =  '{$dados['idProcesso']}'";
                $sql_processo = $sql_processo . " AND cp.seq_carga=  '{$dados['maior_sequencia']}'";
                $sql_processo = $sql_processo . " AND cp.idSetorEntrada = '{$_POST['txt_codigo_setor']}'";
                $sql_processo = $sql_processo . " AND cp.idProcesso = c.idProcesso";
                $sql_processo = $sql_processo . " AND c.tipoProcesso = t.id_tipo_processo";
                $sql_processo = $sql_processo . " AND  c.idAssunto = a.idAssunto";
                $sql_processo = $sql_processo . " AND  c.idRequerente = r.idRequerente";
                $sql_processo = $sql_processo . " AND  cp.dataCarga >= '{$data_inicial}'";
                $sql_processo = $sql_processo . " AND  cp.dataCarga <= '{$data_final}'";
                $sql_processo = $sql_processo . " LIMIT 1";

                $query_processo = $con_pdo->prepare($sql_processo);
                $query_processo->execute();
                for ($contador = 0; $dados_processo = $query_processo->fetch(); $contador++) {
                    $this->Cell(38, 6, $dados_processo['descricao_tipo_processo'], 1, 0, 'L', $linha);
                    $this->Cell(20, 6, $dados_processo['numeroProcesso'], 1, 0, 'R', $linha);
                    $this->Cell(15, 6, $dados_processo['anoProcesso'], 1, 0, 'R', $linha);
                    $this->Cell(95, 6, $dados_processo['descricao_assunto'] . ' ' . $dados_processo['complemento_assunto'], 1, 0, 'C', $linha);
                    $this->Cell(95, 6, $dados_processo['requerente'], 1, 0, 'C', $linha);
                    $this->Cell(25, 6, dataBrasileiro($dados_processo['dataCarga']), 1, 0, 'C', $linha);
                    $this->Ln();
                }
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
<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

require('../fpdf/fpdf.php');
include('../conexao.php');

function utf($texto) {
    return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
}

// ── Busca dados ───────────────────────────────────────────────────────────────
$sql = "SELECT a.id, a.data, a.horario, a.duracao_min, a.vagas,
               u.nome AS professor,
               COUNT(i.id) AS total_inscritos
        FROM aulas a
        JOIN usuarios u ON u.id = a.professor_id
        LEFT JOIN inscricoes i ON i.aula_id = a.id
        GROUP BY a.id
        ORDER BY a.data ASC, a.horario ASC";
$aulas = $conexao->query($sql)->fetchAll(PDO::FETCH_OBJ);

// ── Classe PDF personalizada ──────────────────────────────────────────────────
class RelatorioPDF extends FPDF {

    function Header() {
        // Faixa azul
        $this->SetFillColor(29, 113, 184);
        $this->Rect(0, 0, 210, 28, 'F');

        // Título
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(255, 255, 255);
        $this->SetXY(10, 7);
        $this->Cell(0, 8, utf('Vela Para Todos - FBVA'), 0, 1, 'L');

        $this->SetFont('Arial', '', 10);
        $this->SetXY(10, 16);
        $this->Cell(0, 6, utf('Relatório de Inscrições por Aula'), 0, 1, 'L');

        // Data de geração (direita)
        $this->SetFont('Arial', '', 9);
        $this->SetXY(0, 10);
        $this->Cell(200, 6, utf('Gerado em: ' . date('d/m/Y H:i')), 0, 1, 'R');

        // Faixa amarela
        $this->SetFillColor(249, 178, 51);
        $this->Rect(0, 28, 210, 3, 'F');

        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFillColor(249, 178, 51);
        $this->Rect(0, $this->GetY(), 210, 0.5, 'F');
        $this->Ln(2);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 6, utf('Federação Brasileira de Vela Adaptada  |  Página ' . $this->PageNo()), 0, 0, 'C');
    }

    function TituloSecao($texto) {
        $this->SetFillColor(232, 243, 251);
        $this->SetTextColor(25, 98, 158);
        $this->SetFont('Arial', 'B', 11);
        $this->SetX(10);
        $this->Cell(190, 8, $texto, 0, 1, 'L', true);
        $this->Ln(1);
    }

    function CabecalhoTabela($colunas, $larguras) {
        $this->SetFillColor(31, 122, 196);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 9);
        foreach ($colunas as $i => $col) {
            $this->SetX($i === 0 ? 10 : $this->GetX());
            $this->Cell($larguras[$i], 7, $col, 1, 0, 'C', true);
        }
        $this->Ln();
        $this->SetTextColor(50, 50, 50);
    }
}

// ── Geração do PDF ────────────────────────────────────────────────────────────
$pdf = new RelatorioPDF();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 20);
$pdf->AddPage();

// ── Resumo executivo ──────────────────────────────────────────────────────────
$total_aulas      = count($aulas);
$total_inscricoes = 0;
foreach ($aulas as $a) $total_inscricoes += $a->total_inscritos;
$media_ocupacao   = $total_aulas > 0 ? round($total_inscricoes / $total_aulas, 1) : 0;

$pdf->TituloSecao(utf('Resumo Executivo'));
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(50, 50, 50);

$pdf->SetX(10);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(60, 7, 'Total de aulas:', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, $total_aulas, 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetX(10);
$pdf->Cell(60, 7, utf('Total de inscrições:'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, $total_inscricoes, 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetX(10);
$pdf->Cell(60, 7, utf('Média de inscritos por aula:'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, $media_ocupacao, 0, 1, 'L');

$pdf->Ln(4);

// ── Listagem por aula ─────────────────────────────────────────────────────────
$pdf->TituloSecao(utf('Listagem de Aulas e Inscritos'));

$colunas = [utf('Data'), utf('Horário'), utf('Duração'), utf('Professor'), utf('Vagas'), utf('Inscritos'), utf('Ocupação')];
$larguras = [28, 22, 22, 48, 18, 22, 30];

$pdf->CabecalhoTabela($colunas, $larguras);

$fill = false;
foreach ($aulas as $aula) {
    $fill ? $pdf->SetFillColor(232, 243, 251) : $pdf->SetFillColor(255, 255, 255);

    $ocupacao  = $aula->vagas > 0 ? round(($aula->total_inscritos / $aula->vagas) * 100) . '%' : '0%';
    $data_fmt  = date('d/m/Y', strtotime($aula->data));
    $hora_fmt  = substr($aula->horario, 0, 5);
    $duracao = $aula->duracao_min . ' min';

    $pdf->SetX(10);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(28, 7, $data_fmt,              1, 0, 'C', $fill);
    $pdf->Cell(22, 7, $hora_fmt,              1, 0, 'C', $fill);
    $pdf->Cell(22, 7, $duracao,               1, 0, 'C', $fill);
    $pdf->Cell(48, 7, utf($aula->professor), 1, 0, 'L', $fill);
    $pdf->Cell(18, 7, $aula->vagas,           1, 0, 'C', $fill);
    $pdf->Cell(22, 7, $aula->total_inscritos, 1, 0, 'C', $fill);
    $pdf->Cell(30, 7, $ocupacao,              1, 1, 'C', $fill);

    // Lista de inscritos da aula
    $sqlInsc = "SELECT u.nome, i.inscrito_em
                FROM inscricoes i
                JOIN usuarios u ON u.id = i.aluno_id
                WHERE i.aula_id = :aula_id
                ORDER BY u.nome ASC";
    $stmtInsc = $conexao->prepare($sqlInsc);
    $stmtInsc->bindParam(':aula_id', $aula->id);
    $stmtInsc->execute();
    $inscritos = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

    if (count($inscritos) > 0) {
        $pdf->SetX(18);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(74, 74, 74);
        foreach ($inscritos as $inscrito) {
            $data_insc = date('d/m/Y H:i', strtotime($inscrito->inscrito_em));
            $pdf->SetX(18);
            $pdf->Cell(5,  5, '-', 0, 0, 'C');
            $pdf->Cell(80, 5, utf($inscrito->nome), 0, 0, 'L');
            $pdf->Cell(50, 5, utf('Inscrito em: ' . $data_insc), 0, 1, 'L');
        }
        $pdf->SetTextColor(50, 50, 50);
    }

    $pdf->Ln(1);
    $fill = !$fill;
}

// ── Saída ─────────────────────────────────────────────────────────────────────
$pdf->Output('I', 'relatorio_inscricoes.pdf');
?>
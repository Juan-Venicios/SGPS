<?php
include_once('../pdf/fpdf.php');
include_once('../config/conexao.php');
$pdf = new FPDF();
$pdf->AddPage();
$arquivo = "Altorização.pdf";
$tipo_pdf = "I";
$pdf->SetFont('Arial','B');
$pdf->Write('20','Altorisação');
$pdf->Output($arquivo, $tipo_pdf);
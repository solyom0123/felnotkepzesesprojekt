<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$date = $_POST['date'];
$headtable = $_POST["head"];
$maintable = $_POST["main"];
require_once('../tfpdf.php');

class PDF extends tFPDF {

// Page header
    function Header() {
        global $date;
        // Logo
        // Arial bold 15
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->SetFont('DejaVu', '', 14);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Jelenléti ív - ' . $date, 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function BasicTable($header, $data) {
        global $headtable;
        // if( $data==true){
        //}else{
        //}
    }

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
//$pdf->BasicTable('$header',true);

$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 10);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->Cell(100, 6, "A képzési program neve, OKJ száma", 0, 0);
$pdf->Cell(100, 6, $headtable[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program nyilvántartásba vételi száma: ", 0, 0);
$pdf->Cell(100, 6, $headtable[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési helyszíne:", 0, 0);
$pdf->Cell(100, 6, $headtable[2], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzés dátum:", 0, 0);
$pdf->Cell(100, 6, $headtable[3], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Óra megnevezése:", 0, 0);
$pdf->Cell(100, 6, $headtable[4], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Óra óraszáma:", 0, 0);
$pdf->Cell(100, 6, $headtable[5], 0, 0);
$pdf->Ln(20);
$pdf->SetFont('DejaVuB', '', 10);
$pdf->Cell(40, 6, "Tanuló neve", 1, 0);
$pdf->Cell(40, 6, "Születési dátum", 1, 0);
$pdf->Cell(40, 6, "Hiányzás Óraszáma", 1, 0);
$pdf->Cell(70, 6, "Aláírás", 1, 0);

$pdf->Ln(5);
$pdf->SetFont('DejaVu', '', 10);
for ($index = 0; $index < count($maintable); $index++) {
$pdf->Cell(40, 6, $maintable[$index][0], 1, 0);
$pdf->Cell(40, 6, $maintable[$index][1], 1, 0);
$pdf->Cell(40, 6, '', 1, 0);
$pdf->Cell(70, 6, "", 1, 0);
$pdf->Ln(5);
}
$pdf->Output();

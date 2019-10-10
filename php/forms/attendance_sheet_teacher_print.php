<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$date = $_POST['date'];
$headtable = $_POST["head"];
$maintable = $_POST["main"];
include_once '../../server.php';
$alma = array();
function alma(){
     global $alma;
    $conn = kapcsolodas();
    $dp = '';
    $ep = '';
    $exp = '';
    $mi = '';
    $sql = "select `name`, address from kepzokozpont ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            array_push($alma, $row["name"]);
            array_push($alma, $row["address"]);
        }
    } else {
        echo $sql;
        echo $conn->error;
    }
    lekapcsolodas($conn);
}
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
        $this->Cell(30, 10, 'Jelenléti ív - ' . $date, 0, 0);
        // Line break
        $this->Ln(20);
    }

// Page footer


    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, $this->PageNo() . '/{nb}' . ' oldal ', 0, 0);
    }


}

$pdf = new PDF();
$pdf->AliasNbPages();
//$pdf->BasicTable('$header',true);

alma();
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 10);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->Cell(100, 6, "A képző megnevezése:", 0, 0);
$pdf->Cell(100, 6, $alma[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program neve, OKJ száma", 0, 0);
$pdf->Cell(100, 6, $headtable[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program nyilvántartásba vételi száma: ", 0, 0);
$pdf->Cell(100, 6, $headtable[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési helyszíne:", 0, 0);
$pdf->Cell(100, 6, $alma[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzés dátuma:", 0, 0);
$pdf->Cell(100, 6, $headtable[3], 0, 0);
$pdf->Ln(5);
$pdf->SetFont('DejaVuB', '', 10);
$pdf->Cell(60, 10, "Modul", "LTB", 0);
$pdf->Cell(60, 10, "Tanegység", "TB", 0);
$pdf->Cell(20, 10, "Típus", "TRB", 0);
$pdf->Cell(20, 10, "Óraszám", 1, 0);
$pdf->Ln();
$pdf->Cell(70, 10, "Okatató Neve", 1, 0);
$pdf->Cell(90, 10, "Aláírás", 1, 0);
$pdf->Ln();
$pdf->SetFont('DejaVu', '', 8);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
  $fill = true;
for ($index = 0; $index < count($maintable); $index++) {
    $spmaintable = explode('-', $maintable[$index][0]);
    $pdf->Cell(60, 6, $spmaintable[0], "LTB",0,"",$fill);
    $pdf->Cell(60, 6, $spmaintable[1], "TB",0,"",$fill);
    $pdf->Cell(20, 6, $spmaintable[2], "TRB",0,"",$fill);
    $pdf->Cell(20, 6, $maintable[$index][2],1,0,"",$fill);
    $pdf->Ln();
    $pdf->Cell(70, 8, $maintable[$index][1], 1, 0,"",$fill);
    $pdf->Cell(90, 8, "", 1, 0,"",$fill);
    $pdf->Ln();
     $fill = !$fill;
}
$pdf->Output();

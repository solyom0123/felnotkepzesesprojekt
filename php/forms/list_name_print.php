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

class PDF extends tFPDF {

// Page header
    function Header() {
        global $date;
        // Logo
        // Arial bold 15
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->SetFont('DejaVu', '', 14);
        // Move to the right
        $this->Cell(110);
        // Title
        $this->Cell(30, 10, 'Névsor - ' . $date, 0, 0, 'C');
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
        $this->Cell(0, 10, $this->PageNo() . '/{nb}'. ' oldal ' , 0, 0, 'C');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
//$pdf->BasicTable('$header',true);

alma();
$pdf->AddPage("l","A4");
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 10);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->Cell(150, 6, "A képző megnevezése:", 0, 0);
$pdf->Cell(150, 6, $alma[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(150, 6, "A képzési program neve, OKJ száma", 0, 0);
$pdf->Cell(150, 6, $headtable[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(150, 6, "A képzési program nyilvántartásba vételi száma: ", 0, 0);
$pdf->Cell(150, 6, $headtable[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(150, 6, "A képzési helyszíne:", 0, 0);
$pdf->Cell(150, 6, $alma[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(150, 6, "A képzés dátum:", 0, 0);
$pdf->Cell(150, 6, $headtable[3], 0, 0);
$pdf->Ln(10);

$pdf->AddPage("l","A4");
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 10);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);

$pdf->SetFont('DejaVuB', '', 6);
$pdf->Cell(30, 6, "Név", 1, 0);
$pdf->Cell(30, 6, "Születési név", 1, 0);
$pdf->Cell(30, 6, "Anyja neve", 1, 0);
$pdf->Cell(20, 6, "Születési hely", 1, 0);
$pdf->Cell(20, 6, "Születési dátum", 1, 0);

$pdf->Cell(10, 6, "Neme", 1, 0);
$pdf->Cell(20, 6, "Állampolgárság", 1, 0);

$pdf->Cell(40, 6, "Cím", 1, 0);
$pdf->Cell(20, 6, "Telefonszám", 1, 0);
$pdf->Cell(15, 6, "Végzettség", 1, 0);
$pdf->Cell(30, 6, "Képzésbe történő felvétel", 1, 0);
$pdf->Cell(15, 6, "Tajszám", 1, 0);




$pdf->Ln();
$pdf->SetFont('DejaVu', '', 5);
for ($index = 0; $index < count($maintable); $index++) {
$pdf->Cell(30, 6, $maintable[$index][0], 1, 0);
$pdf->Cell(30, 6, $maintable[$index][1], 1, 0);
$pdf->Cell(30, 6, $maintable[$index][2], 1, 0);
$pdf->Cell(20, 6, $maintable[$index][3], 1, 0);
$pdf->Cell(20, 6,  $maintable[$index][4], 1, 0);
$pdf->Cell(10, 6, $maintable[$index][5], 1, 0);
$pdf->Cell(20, 6, $maintable[$index][6], 1, 0);
$pdf->Cell(40, 6,  $maintable[$index][7], 1, 0);
$pdf->Cell(20, 6, $maintable[$index][8], 1, 0);
$pdf->Cell(15, 6, $maintable[$index][9], 1, 0);
$pdf->Cell(30, 6,  $maintable[$index][10], 1, 0);
$pdf->Cell(15, 6, $maintable[$index][11], 1, 0);
$pdf->Ln();
}
$pdf->Output();

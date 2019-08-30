<?php

include_once '../../server.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$value = isset($_POST['param']) ? $_POST['param'] : null;
$headtable = array();
$maintable = array();
$sumtable = array();
$name = '';
$summissing = 0;
$sumdocm = 0;
$sumexm = 0;
$sumexamm = 0;
$sumother =0;

function collectDataForScPrint($id) {
    global $headtable, $name, $maintable, $sumtable, $summissing, $sumdocm, $sumexm, $sumexamm,$sumother;
    $conn = kapcsolodas();
    $dp = '';
    $ep = '';
    $exp = '';
    $mi = '';
    

    $sql = "select day_type as dt, exam ,(select student_full_name from students s where s.student_id = mc.student_id) as sname, mc.id as id,mc.`date` as date, mc.missing_hour_ammount as hour, (case when mc.replacement_day='false' then (select modul_name from modul where modul_id=mc.modul_id)  else 'Pótnap'  end) as mn, (case  when mc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=mc.cur_unit_id) else (select realname from helper_exam_data where `type`=mc.day_type) end) as sn  from missing_table mc where mc.active_education_id=" . $id[0] . " and mc.student_id=" . $id[1] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['date'].";".$row['hour'].";".$row['mn'].";".$row['sn']."//";
            $locarray = array();
            array_push($locarray, $row['date']);
            array_push($locarray, $row['mn']);
            array_push($locarray, $row["sn"]);
            array_push($locarray, $row["hour"]);
            $name = $row['sname'];
            $summissing+= intval($row["hour"]);
            if ($row["exam"] == "true") {
                $sumexamm += intval($row["hour"]);
            } else {
                if ($row["dt"] == "1" || $row["dt"] == "3") {
                    $sumdocm += intval($row["hour"]);
                } else  if ($row["dt"] == "2" ){
                    $sumexm += intval($row["hour"]);
                }else{
                    $sumother += intval($row["hour"]);
                }
            }
            array_push($maintable, $locarray);
        }
    } else {
        
    }
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,exam_date as ex,`name` as n, used_modul_id as mi, doctrine_week_plan as dp,elearn_week_plan as ep,exercise_week_plan as exp from schedule_plan_data where id=" . $id[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            array_push($headtable, 'képző neve');
            array_push($headtable, $row["c"]);
            array_push($headtable, $row["e"]);
            array_push($headtable, 'cim');
            array_push($headtable, $row["s"] . "-" . $row["ex"] . ':' . $row["n"]);

            $mi = $row['mi'];
            $dp = $row['dp'];
            $ep = $row['ep'];
            $exp = $row['exp'];
        }
    } else {
        echo $sql;
        echo $conn->error;
    }
    $sumcalc = 0;
    $dsum = 0;
    $esum = 0;
    $spMi = explode(";", $mi);

    for ($index = 0; $index < count($spMi) - 1; $index++) {

        $sql = "select  doctrine as d,exercise as e,writting_test as w,verbal_test as v,practical_test as p from modul where modul_id=" . $spMi[$index] . ";";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //$loc_array = array(, $row['s'], $row['n'],$row['n']);
                 $sumcalc += intval($row["d"]);
                $dsum += intval($row["d"]);
                $sumcalc += intval($row["e"]);
                $esum += intval($row["e"]);
                if (intval($row["w"]) > 0) {
                    $sumcalc += intval($row["w"]);
                    $dsum += intval($row["w"]);
                }
                if (intval($row["p"]) > 0) {
                    $sumcalc += intval($row["p"]);
                    $esum += intval($row["p"]);
                }
                if (intval($row["v"]) > 0) {
                    $sumcalc += intval($row["v"]);
                    $dsum += intval($row["v"]);
                }
            }
        } else {
            echo $sql;
            echo $conn->error;
        }
    }
    array_push($headtable, $sumcalc);


    $plan = "";
    $spd = explode(";", $ep);
    $eweek = calcweekplan($spd);
    $plan .= solvebackDaysPrint($eweek, 2);

    $spd = explode(";", $dp);
    $dweek = calcweekplan($spd);
    $plan .= solvebackDaysPrint($dweek, 0);

    $spd = explode(";", $exp);
    $expweek = calcweekplan($spd);
    $plan .= solvebackDaysPrint($expweek, 1);
    array_push($headtable, $plan);


    $locarray = array("gyakorlat:" . $esum . " óra,elmélet: " . $dsum . " óra", $sumcalc);
    array_push($sumtable, $locarray);
    $spMi = explode(";", $mi);

    for ($index = 0; $index < count($spMi) - 1; $index++) {

        $sql = "select  concat( modul_number,' modul ',modul_name )as mn,doctrine as d,exercise as e,writting_test as w,verbal_test as v,practical_test as p from modul where modul_id=" . $spMi[$index] . ";";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $esum = 0;
                $sumcalc = 0;
                $dsum = 0;
                //$loc_array = array(, $row['s'], $row['n'],$row['n']);
                $sumcalc += intval($row["d"]);
                $dsum += intval($row["d"]);
                $sumcalc += intval($row["e"]);
                $esum += intval($row["e"]);
                if (intval($row["w"]) > 0) {
                    $sumcalc += intval($row["w"]);
                    $dsum += intval($row["w"]);
                }
                if (intval($row["p"]) > 0) {
                    $sumcalc += intval($row["p"]);
                    $esum += intval($row["p"]);
                }
                if (intval($row["v"]) > 0) {
                    $sumcalc += intval($row["v"]);
                    $dsum += intval($row["v"]);
                }
                $text = "";
                if ($esum > 0) {
                    $text .= "gyakorlat:" . $esum . " óra";
                }

                if ($dsum > 0) {
                    if (strlen($text) == 0) {
                        $text .= "elmélet: " . $dsum . " óra";
                    } else {
                        $text .= ", elmélet: " . $dsum . " óra";
                    }
                }
                $locarray = array($row["mn"], $text, $sumcalc . " óra");
                array_push($sumtable, $locarray);
            }
        } else {
            echo $sql;
            echo $conn->error;
        }
    }
    lekapcsolodas($conn);
}
function calcweekplan($spd) {
    $dweek = array(0, 0, 0, 0, 0, 0, 0);
    for ($index = 0; $index < count($spd) - 1; $index++) {

        if (intval($spd[$index]) > 0) {
            $dweek[$index] += intval($spd[$index]);
        }
    }
    return $dweek;
}

function solvebackDaysPrint($eweek, $type) {
    $returnValue = '';
    for ($index = 0; $index < count($eweek); $index++) {
        if ($eweek[$index] > 0) {
            $returnValue .= solveDaynamePrint($index, $type, $eweek[$index]) . "\n";
        }
    }
    return $returnValue;
}

;

function solveDaynamePrint($index, $type, $value) {
    $dweek = '';


    switch ($index) {
        case 0:
            $dweek = "Hétfő";

            break;
        case 1:
            $dweek = "Kedd";

            break;
        case 2:
            $dweek = "Szerda";

            break;
        case 3:
            $dweek = "Csütörtök";

            break;
        case 4:
            $dweek = "Péntek";

            break;
        case 5:
            $dweek = "Szombat";

            break;
        case 6:
            $dweek = "Vasárnap";

            break;

        default:
            break;
    }
    if ($type == 0) {
        $dweek .= "-elmélet:";
    } else if ($type == 1) {
        $dweek .= "-gyakorlat:";
    } else {
        $dweek .= "-elearn:";
    }
    $dweek .= " " . getclock($value);
    $dweek .= "  (" . $value . " óra)";
    return $dweek;
}

function getclock($value) {
    $returnValue = "08:00";
    $hour = (($value * 45) / 60);
    $min = 0;
    if (is_int($hour)) {
        $returnValue .= "-" . (8 + $hour) . ":00";
    } else {
        $minutes = $hour - intval($hour);
        $returnValue .= "-" . (8 + intval($hour)) . ":" . (60 * $minutes);
    }
    return $returnValue;
}

require_once('../tfpdf.php');

class PDF extends tFPDF {

// Page header
    function Header() {
        global $name;
        // Logo
        // Arial bold 15
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->SetFont('DejaVu', '', 14);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Hiányzás összegző - '.$name, 0, 0);
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
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0);
    }

}

if ($value != null) {
    collectDataForScPrint($value);
}
//var_dump($sumtable);
$pdf = new PDF();
$pdf->AliasNbPages();
//$pdf->BasicTable('$header',true);

$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 10);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->Cell(100, 6, "A képző megnevezése:", 0, 0);
$pdf->Cell(100, 6, $headtable[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program neve, OKJ száma", 0, 0);
$pdf->Cell(100, 6, $headtable[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program nyilvántartásba vételi száma: ", 0, 0);
$pdf->Cell(100, 6, $headtable[2], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési helyszíne:", 0, 0);
$pdf->Cell(100, 6, $headtable[3], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzés dátum:", 0, 0);
$pdf->Cell(100, 6, $headtable[4], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzés óraszáma:", 0, 0);
$pdf->Cell(100, 6, $headtable[5], 0, 0);
$pdf->Ln(5);
//$pdf->Cell(100, 6, "A képzési napok megnevézese, óraszáma:", 0, 0);
//$pdf->MultiCell(100, 6, $headtable[6]);
//$pdf->Ln(5);
$pdf->SetFont('DejaVuB', '', 10);
$pdf->Cell(20, 10, "Dátum", "LT", 0);
$pdf->Cell(60, 10, "Modul ", "LTR", 0);
$pdf->Cell(60, 10, "Tanegység", "LTRB", 0);
$pdf->Cell(20, 10, "Óraszám", "TRL", 0);
$pdf->Ln();
$pdf->SetFont('DejaVu', '', 8);
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$fill = true;
for ($index = 0; $index < count($maintable); $index++) {
    $pdf->Cell(20, 6, $maintable[$index][0], 1, 0, "", $fill);
    $pdf->Cell(60, 6, $maintable[$index][1], 1, 0, "", $fill);
    $pdf->Cell(60, 6, $maintable[$index][2], 1, 0, "", $fill);
    $pdf->Cell(20, 6, $maintable[$index][3], 1, 0, "", $fill);
    $pdf->Ln();
    $fill = !$fill;
}
$pdf->Ln(10);
$pdf->Cell(100, 6, "A hiányzás összes óraszáma:", 0, 0);
$pdf->Cell(100, 6, $summissing, 0, 0);
$pdf->Ln(5);

$pdf->Cell(100, 6, "A hiányzás elméleti óraszáma:", 0, 0);
$pdf->Cell(100, 6, $sumdocm, 0, 0);
$pdf->Ln(5);

$pdf->Cell(100, 6, "A hiányzás gyakorlati óraszáma:", 0, 0);
$pdf->Cell(100, 6, $sumexm, 0, 0);
$pdf->Ln(5);

$pdf->Cell(100, 6, "A hiányzás vizsga óraszáma:", 0, 0);
$pdf->Cell(100, 6, $sumexamm, 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A hiányzás alkalmi óraszáma:", 0, 0);
$pdf->Cell(100, 6, $sumother, 0, 0);
$pdf->Ln(10);
for ($index1 = 1; $index1 < count($sumtable); $index1++) {
    $pdf->Cell(80, 6, $sumtable[$index1][0], 0, 0);
    $pdf->Cell(80, 6, $sumtable[$index1][1], 0, 0);
    $pdf->Cell(20, 6, $sumtable[$index1][2], 0, 0);
    $pdf->Ln();
}
$pdf->Ln(10);
$pdf->Cell(80, 6, "Összesen:", 0, 0);
$pdf->Cell(60, 6, $sumtable[0][0], 0, 0);
$pdf->Cell(20, 6, $sumtable[0][1], 0, 0);
$pdf->Ln(5);

$pdf->Output();

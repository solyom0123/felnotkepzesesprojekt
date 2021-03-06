<?php

include_once '../../server.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$value = isset($_POST['param']) ? $_POST['param'] : null;
$shour = isset($_POST['hour']) ? $_POST['hour'] : null;
$headtable = array();
$maintable = array();
$sumtable = array();
$sumunused = array();
$alma = array();

function bennevanUFM($array, $value) {
    $returnValue = false;
    for ($index = 0; $index < count($array); $index++) {
        if ($array[$index] == $value) {
            $returnValue = true;
        }
    }
    return $returnValue;
}

function collectDataForScPrint($id) {
    global $headtable, $sumunused, $maintable, $sumtable, $alma;
    $conn = kapcsolodas();
    $dp = '';
    $ep = '';
    $exp = '';
    $mi = '';
    $ufm = '';
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,(select max(`date`) from schedule_plan where schedule_plan_data_id=" . $id . ") as ex,`name` as n, used_modul_id as mi,used_finished_modul as ufm, doctrine_week_plan as dp,elearn_week_plan as ep,exercise_week_plan as exp from schedule_plan_data where id=" . $id . ";";
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
            $ufm = $row['ufm'];
            $exp = $row['exp'];
        }
    } else {
        //echo $sql;
        echo $conn->error;
    }
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
        //echo $sql;
        echo $conn->error;
    }
    $spMi = explode(";", $mi);
    $sumcalc = 0;
    $dsum = 0;
    $esum = 0;
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
    $spufm = explode(";", $ufm);

    for ($index = 0; $index < count($spufm) - 1; $index++) {

        $sql = "select  doctrine as d,exercise as e,writting_test as w,verbal_test as v,practical_test as p from modul where modul_id=" . $spufm[$index] . ";";
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
    $calcUseType = calcweekplantype($spd, array(array(), array(), array(), array(), array(), array(), array()), 2);
    $eweek = calcweekplan($spd, array(0, 0, 0, 0, 0, 0, 0));

    $spd = explode(";", $dp);
    $dweek = calcweekplan($spd, $eweek);
    $calcUseType = calcweekplantype($spd, $calcUseType, 0);


    $spd = explode(";", $exp);
    $expweek = calcweekplan($spd, $dweek);
    $calcUseType = calcweekplantype($spd, $calcUseType, 1);
    $plan .= solvebackDaysPrint($expweek, $calcUseType);
    array_push($headtable, $plan);

    $sql = "select sp.`date`,(select m.modul_number from modul m  where m.modul_id = sp.used_modul_id) as ei,sp.used_hours_type as t,sp.replace_day as r ,(case when sp.teacher_id=0 then 'Nincs oktató kiválasztva' else (select  t.teacher_full_name  from teachers t where t.teacher_id =sp.teacher_id) END)  as te,sp.modul_start_hour as s,sp.modul_end_hour as ed, sp.used_modul_id as us  from schedule_plan sp where schedule_plan_data_id=" . $id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if (!bennevanUFM($spufm, $row['us'])) {
                $locarray = array();

                array_push($locarray, $row['date']);

                if ($row["r"] == "false") {
                    if ($row["t"] == "1") {
                        array_push($locarray, $row["s"] . "-" . $row["ed"]);
                        array_push($locarray, "");
                        array_push($locarray, "");
                        array_push($locarray, "");
                    } else if ($row["t"] == "2") {
                        array_push($locarray, "");
                        array_push($locarray, "");
                        array_push($locarray, $row["s"] . "-" . $row["ed"]);
                        array_push($locarray, "");
                    } else {
                        array_push($locarray, "");
                        array_push($locarray, $row["s"] . "-" . $row["ed"]);
                        array_push($locarray, "");
                        array_push($locarray, "");
                    }
                } else {
                    array_push($locarray, "");
                    array_push($locarray, "");
                    array_push($locarray, "");
                    array_push($locarray, $row["s"] . "-" . $row["ed"]);
                }
                array_push($locarray, $row['ei']);
                array_push($locarray, $row['te']);
                array_push($maintable, $locarray);
            }
        }
    } else {
        echo $sql;
        echo $conn->error;
    }

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
    $spufm = explode(";", $ufm);

    for ($index = 0; $index < count($spufm) - 1; $index++) {

        $sql = "select  concat( modul_number,' modul ',modul_name )as mn,doctrine as d,exercise as e,writting_test as w,verbal_test as v,practical_test as p from modul where modul_id=" . $spufm[$index] . ";";
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
                array_push($sumunused, $locarray);
            }
        } else {
            echo $sql;
            echo $conn->error;
        }
    }
    lekapcsolodas($conn);
}

function calcweekplantype($spd, $startvalue, $type) {
    $dweek = $startvalue;
    for ($index = 0; $index < count($spd) - 1; $index++) {

        if (intval($spd[$index]) > 0) {
            array_push($dweek[$index], $type);
        }
    }
    return $dweek;
}

function calcweekplan($spd, $startvalue) {

    $dweek = $startvalue;
    for ($index = 0; $index < count($spd) - 1; $index++) {

        if (intval($spd[$index]) > 0) {
            $dweek[$index] += intval($spd[$index]);
        }
    }
    return $dweek;
}

function solvebackDaysPrint($eweek, $typearray) {
    $returnValue = '';
    for ($index = 0; $index < count($eweek); $index++) {
        if ($eweek[$index] > 0) {
            $returnValue .= solveDaynamePrint($index, $typearray[$index], $eweek[$index]) . "\n";
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
    for ($index = 0; $index < count($type); $index++) {
        if ($type[$index] == 0) {
            $dweek .= " elmélet";
        } else if ($type[$index] == 1) {
            $dweek .= " gyakorlat";
        } else {
            $dweek .= " e-learning";
        }
        if(count($type)>1&&$index !=count($type)-1){
        $dweek.=",";
        }
    }
    $dweek.=":";
    $dweek .= " " . getclock($value);
    $dweek .= "  (" . $value . " tanóra)";
    return $dweek;
}

function getclock($value) {
    global $shour;
    $returnValue = $shour . ":00";
    $hour = (($value * 45) / 60);
    $min = 0;
    if (is_int($hour)) {
        if (($shour + $hour) < 24) {
            $returnValue .= "-" . ($shour + $hour) . ":00";
        } else {
            $returnValue .= "-" . (($shour + $hour) - 24) . ":00";
        }
    } else {
        $minutes = $hour - intval($hour);
        if (($shour + intval($hour)) < 24) {
            $returnValue .= "-" . ($shour + intval($hour)) . ":00";
        } else {
            $returnValue .= "-" . (($shour + intval($hour)) - 24) . ":" . (60 * $minutes);
        }
    }
    return $returnValue;
}

require_once('../tfpdf.php');

class PDF extends tFPDF {

// Page header
    function Header() {
        // Logo
        // Arial bold 15
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->SetFont('DejaVu', '', 14);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Ütemterv ', 0, 0);
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
$pdf->Cell(100, 6, $alma[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program neve, OKJ száma", 0, 0);
$pdf->Cell(100, 6, $headtable[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési program nyilvántartásba vételi száma: ", 0, 0);
$pdf->Cell(100, 6, $headtable[2], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési helyszíne:", 0, 0);
$pdf->Cell(100, 6, $alma[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzés dátuma:", 0, 0);
$pdf->Cell(100, 6, $headtable[4], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzés óraszáma:", 0, 0);
$pdf->Cell(100, 6, $headtable[5], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési napok megnevézese, óraszáma:", 0, 0);
$pdf->MultiCell(100, 6, $headtable[6]);
$pdf->Ln(5);
$pdf->SetFont('DejaVuB', '', 10);
$pdf->Cell(20, 10, "Dátum", "LT", 0);
$pdf->Cell(80, 10, "Modul óraszám", 1, 0);
$pdf->Cell(20, 10, "Modul ", "LTR", 0);
$pdf->Cell(60, 10, "Oktató neve", "TRL", 0);

$pdf->Ln();
$pdf->Cell(20, 10, "", "LB", 0);
$pdf->Cell(20, 10, "elmélet", "LB", 0);
$pdf->Cell(20, 10, "e-learning", "LB", 0);
//$pdf->Cell(20, 10, "e-learning", "LB", 0);
//$pdf->Cell(20, 10, "gyakorlat", "LB", 0);
$pdf->Cell(20, 10, "gyakorlat", "LB", 0);
$pdf->Cell(20, 10, "alkalmi", "LB", 0);
$pdf->Cell(20, 10, "száma", "LBR", 0);
$pdf->Cell(60, 10, "", "LBR", 0);
$pdf->Ln();
$pdf->SetFont('DejaVu', '', 8);
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$fill = true;
for ($index = 0; $index < count($maintable); $index++) {
    $pdf->Cell(20, 6, $maintable[$index][0], 1, 0, "", $fill);
    $pdf->Cell(20, 6, $maintable[$index][1], 1, 0, "", $fill);//20 volt
    $pdf->Cell(20, 6, $maintable[$index][2], 1, 0, "", $fill);
    $pdf->Cell(20, 6, $maintable[$index][3], 1, 0, "", $fill);
    $pdf->Cell(20, 6, $maintable[$index][4], 1, 0, "", $fill);
    $pdf->Cell(20, 6, $maintable[$index][5], 1, 0, "", $fill);
    $pdf->Cell(60, 6, $maintable[$index][6], 1, 0, "", $fill);
    $pdf->Ln();
    $fill = !$fill;
}
$pdf->Ln(10);
$pdf->Cell(100, 6, "A képzés keretében teljesített modulok: ", "B", 0);
$pdf->Ln(10);

for ($index1 = 1; $index1 < count($sumtable); $index1++) {
    $pdf->Cell(80, 6, $sumtable[$index1][0], 0, 0);
    $pdf->Cell(80, 6, $sumtable[$index1][1], 0, 0);
    $pdf->Cell(20, 6, $sumtable[$index1][2], 0, 0);
    $pdf->Ln();
}
$pdf->Ln(10);
$pdf->Cell(100, 6, "Az előzetes tudásméréssel teljesített modulok: ", "B", 0);
$pdf->Ln(10);


for ($index1 = 0; $index1 < count($sumunused); $index1++) {
    $pdf->Cell(80, 6, $sumunused[$index1][0], 0, 0, "", true);
    $pdf->Cell(80, 6, $sumunused[$index1][1], 0, 0, "", true);
    $pdf->Cell(20, 6, $sumunused[$index1][2], 0, 0, "", true);
    $pdf->Ln();
}
$pdf->Ln(10);
$pdf->Cell(80, 6, "Összesen:", "BT", 0);
$pdf->Cell(80, 6, $sumtable[0][0], "BT", 0);
$pdf->Cell(20, 6, $sumtable[0][1], "BT", 0);
$pdf->Ln(5);
$pdf->Output();

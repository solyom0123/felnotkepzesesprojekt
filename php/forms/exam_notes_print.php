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
$summissing = false;
$notfinishexam = array();
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

function collectDataForScPrint($id) {
    global $headtable, $name, $maintable, $sumtable, $summissing,$notfinishexam;
    $conn = kapcsolodas();
    $dp = '';
    $ep = '';
    $exp = '';
    $mi = '';
       $ufm= '';
    $sql = "select"
            . " sc.id as id,"
            . " sc.`date`,"
            . " (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi'  end)  as mn,"
            . " (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_studymaterials_id) end) as et,"
            . " (select (case when (EXISTS(select mc.grade =1  from exam_table mc where mc.schedule_plan_data_id=".$id[0]." and mc.student_id=".$id[1]." and mc.schedule_plan_row_id =sc.id))=1 then 'megbukott'  else 'még nem vizsgázott'  end))  as grade  "
            . "from schedule_plan sc "
            . "where sc.schedule_plan_data_id=" . $id[0] . ""
            . " and sc.exam='true' "
            . "and sc.id not in "
            . "(select mc.schedule_plan_row_id "
            . "from exam_table mc"
            . " where mc.schedule_plan_data_id=" . $id[0] . " "
            . "and mc.student_id=" . $id[1] . " and mc.grade >1);";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['date'].";".$row['hour'].";".$row['mn'].";".$row['sn']."//";
            $locarray = array();
            array_push($locarray, $row['date']);
            array_push($locarray, $row['mn']);
            array_push($locarray, $row["et"]);
            array_push($locarray, $row["grade"]);
            array_push($notfinishexam, $locarray);
            
        }
        $summissing = false;
    } else {
        $summissing = true;
        echo $conn->error;
        
    }

    $sql = "select (select sc.used_hours_type from schedule_plan sc where sc.id = mc.schedule_plan_row_id ) as dt, "
            . "(select sc.exam from schedule_plan sc where sc.id = mc.schedule_plan_row_id ) as exam ,"
            . "(select student_full_name from students s where s.student_id = mc.student_id) as sname, "
            . "mc.id as id,"
            . "(select sc.`date` from schedule_plan sc where sc.id = mc.schedule_plan_row_id )  as date,"
            . " mc.grade as hour, "
            . "(select (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi'  end) from schedule_plan sc where sc.id = mc.schedule_plan_row_id )  as mn,"
            . "(select (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_studymaterials_id) end) from schedule_plan sc where sc.id = mc.schedule_plan_row_id) as sn  "
            . "from exam_table mc "
            . "where mc.schedule_plan_data_id=" . $id[0] . " "
            . "and mc.student_id=" . $id[1] . ";";
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
            array_push($maintable, $locarray);
        }
    } else {
        
    }
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,exam_date as ex,`name` as n, used_modul_id as mi,used_finished_modul as ufm, doctrine_week_plan as dp,elearn_week_plan as ep,exercise_week_plan as exp from schedule_plan_data where id=" . $id[0] . ";";
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
    }$spufm = explode(";", $ufm);
    
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
        $this->Cell(30, 10, 'Vizsga eredmény összegző - '.$name, 0, 0);
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
alma();
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
$pdf->Cell(60, 10, "Vizsga típus", "LTRB", 0);
$pdf->Cell(20, 10, "Osztályzat", "TRL", 0);
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

$pdf->Cell(100, 6, "A záróvizsgára alkalmas:", 0, 0);
if($summissing){
$pdf->Cell(100, 6, "Igen, alkalmas.", 0, 0);
}else{
$pdf->Cell(100, 6, "Nem, nem alkalmas.", 0, 0);    
$pdf->Ln(10);
$pdf->Cell(100, 6, "Hiányzó vagy bukott vizsgák:", 0, 0);
$pdf->Ln(5);
$pdf->SetFont('DejaVuB', '', 10);
$pdf->Cell(20, 10, "Dátum", 1, 0);
$pdf->Cell(60, 10, "Modul ", 1, 0);
$pdf->Cell(60, 10, "Vizsga típus", 1, 0);
$pdf->Cell(40, 10, "Osztályzat", 1, 0);
$pdf->Ln();
$pdf->SetFont('DejaVu', '', 8);
for ($index = 0; $index < count($notfinishexam); $index++) {
    $pdf->Cell(20, 6, $notfinishexam[$index][0], 1, 0, "", $fill);
    $pdf->Cell(60, 6, $notfinishexam[$index][1], 1, 0, "", $fill);
    $pdf->Cell(60, 6, $notfinishexam[$index][2], 1, 0, "", $fill);
    $pdf->Cell(40, 6, $notfinishexam[$index][3], 1, 0, "", $fill);
    $pdf->Ln();
    $fill = !$fill;
}

}

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

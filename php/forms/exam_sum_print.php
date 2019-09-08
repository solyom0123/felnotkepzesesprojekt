<?php

include_once '../../server.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

 *  */
$id = isset($_POST['id']) ? $_POST['id'] : null;
$headtable = array();
$maintable = array();
$sumtable = array();
$name = date("Y/m/d");
$summissing = 0;
$sumdocm = 0;
$sumexm = 0;
$sumexamm = 0;
$sumother = 0;

$alma = array();

function alma() {
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

function solveBackCurUnitNameModulName($course_date) {
    $returnText = array();
    $loc_array = array();
    for ($index = 0; $index < count($course_date); $index++) {
        $loc_array = array();
        $conn = kapcsolodas();
        array_push($loc_array, $course_date[$index][7]);

        array_push($loc_array, $course_date[$index][2] . " óra :");


        if ($course_date[$index][3] != "true") {
            $sql = "select modul_name as mn, modul_number as m from modul where modul_id=" . $course_date[$index][0];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    array_push($loc_array, $row["mn"] . " - " . $row['m']);
                }
            }
        } else {
            $returnText .= " Alkalmi:";
        }
        if ($course_date[$index][4] != "true") {
            $sql = "select study_materials_name as sn  from studymaterials where studymaterials_id=" . $course_date[$index][1];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    array_push($loc_array, $row["sn"]);

                    switch ($course_date[$index][5]) {
                        case "1":
                            array_push($loc_array, "elmélet");

                            break;
                        case "2":
                            array_push($loc_array, "gyakorlat");


                            break;
                        case "3":
                            array_push($loc_array, "elearn");
                            break;

                        default:
                            array_push($loc_array, "alkalmi");

                            break;
                    }
                }
            }
        } else {
            switch ($course_date[$index][1]) {
                case "1":
                    array_push($loc_array, "szóbeli vizsga");

                    break;
                case "2":
                    array_push($loc_array, "irásbeli vizsga");

                    break;
                case "3":
                    array_push($loc_array, "gyakorlati vizsga");

                    break;

                default:

                    break;
            }
        }
        lekapcsolodas($conn);
        array_push($returnText, $loc_array);
    }
    return $returnText;
}

function collectDataForScPrint($id) {
    global $headtable, $maintable, $sumtable,$name;
    $conn = kapcsolodas();
    $dp = '';
    $ep = '';
    $exp = '';
    $mi = '';
    $ufm = '';
    $student_data = array();
    $course_date = array();
    $course_head = array();
    $fdate = '';
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,exam_date as ex,`name` as n, used_modul_id as mi,used_finished_modul as ufm, doctrine_week_plan as dp,elearn_week_plan as ep,exercise_week_plan as exp from schedule_plan_data where id=" . $id . ";";
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
            $name= $name. " - ".$row["n"];
            $mi = $row['mi'];
            $dp = $row['dp'];
            $ep = $row['ep'];
            $ufm = $row['ufm'];
            $exp = $row['exp'];
            $fdate = $row['ex'];
        }
    } else {
        echo $sql;
        echo $conn->error;
    }

    $sql = "select `date` as d,used_hours as uh, used_modul_id as m, used_studymaterials_id as s, replace_day as r, exam as e,used_hours_type as uht, id as id from schedule_plan where schedule_plan_data_id=" . $id . "  and  exam ='true';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["m"], $row['s'], $row['uh'], $row['r'], $row['e'], $row['uht'], $row['id'], $row['d']);
            array_push($course_date, $loc_array);
        }
    }

    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["id"], $row['fn'], $row['br']);
            array_push($student_data, $loc_array);
        }
    }
    if (count($course_date) > 0) {
        $course_head = solveBackCurUnitNameModulName($course_date);
        array_push($course_head, array($fdate, "", "Záróvizsgára alkalmas/erdemény", ""));
    }
    for ($actcourse = 0; $actcourse < count($course_head); $actcourse++) {
        array_push($maintable, array($course_head[$actcourse], 0));

        for ($actstudent = 0; $actstudent < count($student_data); $actstudent++) {
            $loc_array = array();

            array_push($loc_array, $student_data[$actstudent][1] . "-" . explode(" ", $student_data[$actstudent][2])[0]);
            if (count($course_head) - 1 > $actcourse) {
                $sql = "select grade from exam_table where schedule_plan_data_id=" . $id . " and student_id=" . $student_data[$actstudent][0] . " and schedule_plan_row_id=" . $course_date[$actcourse][6] . ";";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        array_push($loc_array, $row['grade']);
                    }
                } else {
                    echo $conn->error;
                    array_push($loc_array, 'Nem');
                }
            } else {
                $sql1 = "select"
                        . " sc.id as id,"
                        . " sc.`date`,"
                        . " (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi'  end)  as mn,"
                        . " (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_studymaterials_id) end) as et,"
                        . " (select (case when (EXISTS(select mc.grade =1  from exam_table mc where mc.schedule_plan_data_id=" . $id . " and mc.student_id=" . $student_data[$actstudent][0] . " and mc.schedule_plan_row_id =sc.id))=1 then 'megbukott'  else 'még nem vizsgázott'  end))  as grade  "
                        . "from schedule_plan sc "
                        . "where sc.schedule_plan_data_id=" . $id . ""
                        . " and sc.exam='true' "
                        . "and sc.id not in "
                        . "(select mc.schedule_plan_row_id "
                        . "from exam_table mc"
                        . " where mc.schedule_plan_data_id=" . $id . " "
                        . "and mc.student_id=" . $student_data[$actstudent][0] . " and mc.grade >1);";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    array_push($loc_array, 'Nem');
                } else {
                    //echo $conn->error;
                    $sql2 = "select"
                            . " mc.grade as g"
                            . " from finalexam_table mc"
                            . " where mc.schedule_plan_data_id=" . $id . " "
                            . "and mc.student_id=" . $student_data[$actstudent][0] . ";";
                    //echo $sql2;
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            array_push($loc_array, $row["g"]);
                        }
                    } else {

                        // echo $conn->error;
                        array_push($loc_array, 'Igen');
                    }
                }
            }
            array_push($maintable, array($loc_array, 1));
        }
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
        $this->Cell(20);
        // Title
        $this->Cell(30, 10, 'Vizsga összegző  - ' . $name, 0, 0);
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
        $this->Cell(0, 10,   $this->PageNo() . '/{nb}'.' oldal ', 0, 0);
    }

}

if ($id != null) {
    collectDataForScPrint($id);
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
$pdf->Cell(40, 10, "dátum", 1, 0);
$pdf->Cell(20, 10, "Óra", 1, 0);
$pdf->Cell(60, 10, "Modul ", 1, 0);
$pdf->Cell(40, 10, "Vizsga típus", 1, 0);
$pdf->Ln();
$pdf->Cell(20, 10, "", 0, 0);
$pdf->Cell(60, 10, "Tanuló adatai", 1, 0);
$pdf->Cell(40, 10, "érdemjegy ", 1, 0);
$pdf->Ln();
$pdf->SetFont('DejaVu', '', 8);
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$fill = true;
for ($index = 0; $index < count($maintable); $index++) {
    if ($maintable[$index][1] == 0) {
        $pdf->SetFillColor(211, 211, 211);

        $fill = true;
        $pdf->Cell(40, 10, $maintable[$index][0][0], 1, 0, "", $fill);
        $pdf->Cell(20, 10, $maintable[$index][0][1], 1, 0, "", $fill);
        $pdf->Cell(60, 10, $maintable[$index][0][2], 1, 0, "", $fill);
        $pdf->Cell(40, 10, $maintable[$index][0][3], 1, 0, "", $fill);
    } else {
        $pdf->SetFillColor(224, 235, 255);

        $pdf->Cell(20, 6, "", 0, 0, "", false);
        $pdf->Cell(60, 6, $maintable[$index][0][0], 1, 0, "", $fill);
        $pdf->Cell(40, 6, $maintable[$index][0][1], 1, 0, "", $fill);
    }
    $pdf->Ln();
    $fill = !$fill;
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
$pdf->Cell(80, 6, $sumtable[0][0], 0, 0);
$pdf->Cell(20, 6, $sumtable[0][1], 0, 0);
$pdf->Ln(5);

$pdf->Output();

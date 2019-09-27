<?php

include_once '../../server.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$value = isset($_POST['param']) ? $_POST['param'] : null;
$headtable = array();
$basic_data_table = array();
$sumtable = array();
$sumunused = array();
$name = '';
$summissing = 0;
$sumdocm = 0;
$sumexm = 0;
$sumexamm = 0;
$sumother =0;


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
    global $headtable, $name, $basic_data_table,$sumunused, $sumtable, $summissing, $sumdocm, $sumexm, $sumexamm,$sumother;
    $conn = kapcsolodas();
    $dp = '';
    $ep = '';
    $exp = '';
    $mi = '';
      $ufm= '';

    $sql = " select paymode as py,email as em,phone_number as p,nationality as n,mothers_name as mn,home_address as ha,gender as g,birth_place as b,birth_name as bn,birth_date as bd,taj as t,student_full_name as fn from students"
            . " where "
            . "student_id=" . $id[1] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['date'].";".$row['hour'].";".$row['mn'].";".$row['sn']."//";
            $locarray = array();
            array_push($basic_data_table, $row['fn']);
            array_push($basic_data_table, $row['mn']);
            array_push($basic_data_table, $row["bn"]);
            array_push($basic_data_table, $row["bd"]);
            array_push($basic_data_table, $row["b"]);
            array_push($basic_data_table, $row["g"]);
            array_push($basic_data_table, $row["n"]);
            array_push($basic_data_table, $row["ha"]);
            array_push($basic_data_table, $row["p"]);
            array_push($basic_data_table, $row["t"]);
            array_push($basic_data_table, $row["em"]);
            array_push($basic_data_table, $row["py"]);
            $name = "Felnőttképzési szerződés"  ;
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
                array_push($sumunused, $locarray);
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
function solveBackNumberHungarianName($num){
    switch ($num){
        case 1:{ return "egy";break;}
        case 2:{ return "kettő";break;}
        case 3:{ return "három";break;}
        case 4:{ return "négy";break;}
        case 5:{ return "öt";break;}
        case 6:{ return "hat";break;}
        case 7:{ return "hét";break;}
        case 8:{ return "nyolc";break;}
        case 9:{ return "kilenc";break;}
        case 10:{ return "tíz";break;}
    }
}
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
        $this->Cell(60);
        // Title
        $this->Cell(30, 10, $name, 0, 0);
        // Line break
        $this->Ln(20);
    }

// Page footer


    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
        $this->SetFont('DejaVuB', '', 10);
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
alma();
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->SetFont('DejaVuB', '', 14);

$pdf->Cell(100, 14, $alma[0], 0, 0);
$pdf->Ln(20);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(100, 6, "Székhely/levelezési cím:", 0, 0);
$pdf->Cell(100, 6, "cim", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Felnőttképzési engedély száma: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Bankszámla szám: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Tel.: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Képviseletre jogosult személy: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Elektronikus levelezési cím: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Cégjegyzékszám: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Adószám: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Statisztikai számjel: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Fax: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Kapcsolattartó személy: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Weblap: ", 0, 0);
$pdf->Cell(100, 6, "szam", 0, 0);
$pdf->Ln(13);
$pdf->Cell(200, 8,"Melyet kötöttek egyrészről: a ".$alma[0].", valamint a képzésben résztvevő",0,0);
$pdf->Ln(10);
$pdf->Cell(100, 6, "A résztvevő neve:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[0], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Anyja neve:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[1], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Születési neve: ", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[2], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Születési dátum:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[3], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Születési hely:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[4], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Neme:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[5], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Nemzetisége:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[6], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Otthoni címe:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[7], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Telefonszáma:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[8], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Tajszáma:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[9], 0, 0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "Email:", 0, 0);
$pdf->Cell(100, 6, $basic_data_table[10], 0, 0);
$pdf->Ln(10);
$pdf->Cell(200,8, "között az ".$headtable[1]." ".$headtable[2]." szakképzés oktatására. ",0,0);
$pdf->Ln(10);

$pdf->MultiCell(160,6, "Szerződő felek (továbbiakban: Felek) közösen megállapítják, és tudomásul veszik, hogy az Intézménynek saját képzési programja alapján – a felnőttképzésről szóló 2013. évi LXXVII. törvény 13. § (1) bekezdése szerint – a Résztvevő felnőttel [a törvény 13. § (3) bekezdése szerinti tartalom alapulvételével] felnőttképzési szerződést kell kötnie. ");
$pdf->Ln(10);
$pdf->Cell(100, 6, "A képzési csoport megnevezése:", 0, 0);
$pdf->Cell(100, 6, explode(":", $headtable[4])[1], 0, 0);
$pdf->Ln(5);

$sdate= explode("-",explode(":", $headtable[4])[0]);
$pdf->Cell(100, 6, "A képzés kezdés dátuma:", 0, 0);
$pdf->Cell(100, 6, $sdate[0].'-'.$sdate[1]."-".$sdate[2], 0, 0);
$pdf->Ln(5);

$pdf->Cell(100, 6, "A képzés befejezés dátuma:", 0, 0);
$pdf->Cell(100, 6, $sdate[3].'-'.$sdate[4]."-".$sdate[5], 0, 0);
$pdf->Ln(10);



$pdf->AddPage();
$pdf->Cell(100, 6, "Tananyagegységek: ", "B", 0);
$pdf->Ln(10);

for ($index1 = 1; $index1 < count($sumtable); $index1++) {
    $pdf->Cell(80, 6, $sumtable[$index1][0], 0, 0);
    $pdf->Cell(80, 6, $sumtable[$index1][1], 0, 0);
    $pdf->Cell(20, 6, $sumtable[$index1][2], 0, 0);
    $pdf->Ln();
}
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
$pdf->Ln(10);
$pdf->Cell(100, 6, "Az elméleti és gyakorlati oktatás helyszíne: ", 0, 0);
$pdf->Cell(100, 6, $alma[1], 0, 0);
$pdf->Ln(10);

$pdf->Cell(100, 6, "A képzés elvégzésével megszerezhető dokumentum: ", 0, 0);
$pdf->Cell(100, 6, "bizonyítvány (OKJ-s )" , 0, 0);
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A Résztvevő -képzés során nyújtott teljesítményének ellenőrzési és értékelési módja: A jelentkező vállalja, hogy tudásáról hetente írásbeli dolgozat, vagy gyakorlati számonkérés formájában számot ad. A szintvizsgákon és a modulzáró vizsgákon részt vesz. A vizsgákat vizsgabizottság előtt teszi le. A gyakorlati képzés idejére és a vizsgákhoz, a szükséges számú modellt szervezi. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A szakképesítő vizsgára bocsátás feltételei: A kötelező óraszám dokumentált megléte. Az elméleti, gyakorlati és modulzáró vizsgák letétele. Az összes fizetési kötelezettség teljesítése.");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A megengedett hiányzás mértéke: az elméleti tanórákról, a gyakorlati foglalkozásokról, a bemutatókról és a konzultációkról (összegezve: a képzésről) az összes óraszám 20 %-a. A megengedett hiányzás túllépése estén a résztvevő eredményes vizsgája nem biztosított.
A képzéstől való távolmaradás önmagában nem minősül a jelen Szerződés megszüntetésére irányuló nyilatkozatnak. (ld: felmondás/elállás)

");
$pdf->Ln(10);
$pdf->AddPage();
$pdf->MultiCell(160,6, "A felnőttképzéshez kapcsolódó szolgáltatás formája: Az előzetes tudásszint felmérés során -a  kialakított folyamatleírásunkkal összhangban   a résztvevő által benyújtott képzési dokumentumok elemzését végezzük el. A résztvevő a díjmentes szolgáltatást");
$pdf->Ln(10);
$pdf->Cell(30,6,"",0,0);
$pdf->Cell(30,6,"kérte",0,0);
$pdf->Cell(30,6,"",0,0);

$pdf->Cell(30,6,"nem kérte",0,0);
$pdf->Ln(10);
$pdf->Cell(30,6,"További igényelhető szolgáltatás: elhelyezkedési tanácsadás.",0,0);
$pdf->Ln(10);

$pdf->Cell(50, 6, "A képzés ütemezése: ", 0, 0);
$pdf->Cell(100, 6, "figyelembe véve az előzetesen megszerzett tudás beszámítását",0,0);
$pdf->Ln(5);
$pdf->Cell(100, 6, "A képzési napok megnevézese, óraszáma:", 0, 0);
$pdf->MultiCell(100, 6, $headtable[6]);
$pdf->Ln(10);
$pdf->Cell(100, 6, "Összes időtartama (tanóra):", 0, 0);
$pdf->Cell(100, 6, $headtable[5], 0, 0);
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A gyakorlati foglalkozással összefüggésben biztosított juttatások: a tanműhelyi felszerelések 
díjmentes használata");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A vizsga szervezésének módja és formája: A modulzáró vizsgákat a Valamilyen Oktatási Központ szervezi. Az eredményes modulzáró vizsgáról igazolást állít ki. A képzést állami, OKJ-s szakmai záróvizsga zárja. A szakmai vizsgát a Valamilyen Oktatási Központ saját jogon szervezi a 305/2013. Kormányrendelet figyelembe vételével. Formája: írásbeli, gyakorlati, szóbeli vizsga");
$pdf->Ln(10);
$pdf->Cell(20, 6, "A képzési díj: ", 0, 0);
$pdf->Cell(100, 6, "........................., azaz...............................................................",0,0);
$pdf->Ln(10);
$pdf->Cell(40, 6, "Szakképesítő vizsga díja: ", 0, 0);
$pdf->Cell(100, 6, "........................., azaz...............................................................",0,0);
$pdf->Ln(5);
$pdf->MultiCell(160,6, "(A javító vizsga díjak a 315/2013.(VIII.) Korm. rendelet 55. § alapján számítva.)");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A képzéshez nyújtott támogatás: uniós pályázati forrás, Mpa. alaprész, vállalati költség viselés.*
Állami, illetve európai uniós források terhére támogatásban részesülő képzés esetén a támogatás 
megnevezése:……………………………………………összege:………………………..…….……Ft
");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Jelen Szerződés aláírásával egyidejűleg az Intézmény a Résztvevő rendelkezésére bocsátja a képzési programot, amelynek átvételét Résztvevő jelen Szerződés aláírásával elimeri. ");
$pdf->Ln(10);
$pdf->AddPage();
$pdf->MultiCell(160,6, "A szerződésszegés/ elállás következményei: ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Amennyiben a Résztvevő jelen Szerződéstől a képzési program megismerésére (2013. évi LXXVII. tv. 20. § (11) i pontja alapján) biztosított, a Szerződés megkötésétől számított 3 munkanapon belül a eláll, a Résztvevő jogosult az általa befizetett képzési díj visszatérítésére. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Fentieken túl Szerződő felek a szerződéstől történő elállás esetére bánatpénzt kötnek ki, amelynek összegét 32 000 Ft-ban határozzák meg. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Amennyiben az Intézmény jelen Szerződéstől eláll, a Résztvevő jogosult az általa befizetett képzési díj visszatérítésére és a bánatpénzre. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Amennyiben a Résztvevő jelen Szerződéstől a képzési program megismerésére (2013. évi LXXVII. tv. 20. § (11) i pontja alapján) biztosított, a Szerződés megkötésétől számított 3 munkanapos határidőn túl, a képzés megkezdése előtt eláll, a Résztvevő jogosult az általa befizetett képzési díj bánatpénz összegével csökkentett összegének visszatérítésére. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Amennyiben a Résztvevő jelen Szerződéstől a képzés megkezdése után eláll, a Résztvevő jogosult az általa teljesített, a képzési díj elállásig számított időarányos részével és a bánatpénz összegével csökkentett befizetés összegének visszatérítésére. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "A Résztvevő szerződésszegése esetén –különösen amennyiben a Résztvevő a képzési díj esedékes részletének megfizetését felszólítás ellenére nem teljesíti- az Intézmény jogosult jelen Szerződést felmondani, Résztvevő pedig 20 000 Ft meghiúsulási kötbért köteles az Intézménynek megfizetni. A Résztvevő szerződészegése esetén legfeljebb az általa teljesített, a képzési díj szerződésszegésig számított időarányos részével és a meghiúsulási kötbér összegével csökkentett befizetés összegének visszatérítésére jogosult. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Jelen Szerződés megszűntetése (elállás, felmondás) csak írásban érvényes. Szerződő felek rögzítik, hogy az e-mail üzenet nem minősül írásbeli formának. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Az Intézmény – a Résztvevő kérésére – biztosítja az előzetesen megszerzett tudás mérését, értékelését, és ennek eredményét figyelembe veszi a képzés tartalmának, illetve folyamatának egyénre szabott alakításában, ezen belül különösen a képzés időtartamának, ütemezésének, továbbá a képzés díjának és a vizsgadíjának megállapításánál. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Az Intézmény kötelezettséget vállal arra, hogy a jelen Felnőttképzési szerződést, valamint a felnőttképzésről szóló 2013. évi LXXVII. törvény 16.§-ában részletezett képzési dokumentumokat – a vállalt képzés teljesítésével összefüggésben – vezeti, nyilvántartja és – a hatóság ellenőrzési jogköre gyakorlásának biztosítása érdekében – öt évig megőrzi. ");
$pdf->Ln(10);
$pdf->MultiCell(160,6, "Az Intézmény vállalja, hogy a felnőttképzésről szóló 2013. évi LXXVII. törvény 21. §-a alapján kezelt – Résztvevővel kapcsolatos – személyi adatokat, valamint a képzés megkezdéséhez és folytatásához – a Résztvevő oldaláról – szükséges feltételek meglétét igazoló dokumentumokat/felvilágosításokat – a törvényben meghatározott kivételtől eltekintve – harmadik személy számára csak a Résztvevő hozzájárulásával adja ki. ");
$pdf->Ln(10);
$pdf->AddPage();
$pdf->Cell(40,14,"",0,0);
$pdf->Cell(100,14,"Kiegészítés, a tanfolyam díjának megfizetéséről.","B",0);
$pdf->Ln(20);
$pdf->Cell(100,6," *A tanfolyam díját magam fizetem részletekben.",0,0);
$pdf->Ln(10);
$pdf->Cell(100,6," Képzési díj első részlete, a képzésen való részvétel megerősítésére ",0,0);
$pdf->Cell(20,6,"  ",0,0);
$pdf->Cell(50,6,"..............................",0,0);
$pdf->Ln(10);

$pdf->Cell(100,6," további részletek: havonta (.......... x ............) ",0,0);
$pdf->Cell(20,6,"  ",0,0);
$pdf->Cell(50,6,"..............................",0,0);
$pdf->Ln(10);
$pdf->Cell(100,6," Összesen ",0,0);
$pdf->Cell(20,6,"  ",0,0);
$pdf->Cell(50,6,"..............................",0,0);
$pdf->Ln(10);

$pdf->Cell(100,6," A szakképesítő vizsga díját a vizsgát megelőző 1 hónapon belül. ",0,0);
$pdf->Cell(20,6,"  ",0,0);
$pdf->Cell(50,6,"..............................",0,0);
$pdf->Ln(10);
$pdf->Cell(100,6,"*A tanfolyam díját nem magam fizetem ",0,0);
$pdf->Cell(20,6,"  ",0,0);
$pdf->Cell(50,6,"",0,0);

$pdf->Ln(10);
$pdf->MultiCell(160,6, "Alulírott…………………………………………………………………………………………............
(cég, vagy költségviselő neve, címe, adószáma) kijelentem, hogy a szakképzésben résztvevő képzési díját a fentebb részletezett módon befizetem. Tudomásul veszem, hogy a szakképzésben résztvevő a szakképző vizsgára, csak az összes tandíj és a vizsgadíj befizetése után mehet.
 ");
$pdf->Ln(20);
$pdf->Cell(100,6," Budapest,".date("Y-m-d"),0,0);
$pdf->Ln(40);
$pdf->Cell(50,6," ..........................................",0,0);
$pdf->Cell(10,6,"  ",0,0);
$pdf->Cell(50,6," ..........................................",0,0);
$pdf->Cell(10,6,"  ",0,0);
$pdf->Cell(50,6," ..........................................",0,0);
$pdf->Cell(20,6,"  ",0,0);

$pdf->Ln(5);
$pdf->Cell(50,6," szakképzésben résztvevő ",0,0);
$pdf->Cell(10,6,"  ",0,0);
$pdf->Cell(50,6," költségviselő",0,0);
$pdf->Cell(10,6,"  ",0,0);
$pdf->Cell(50,6, $alma[0],0,0);
$pdf->Cell(20,6,"  ",0,0);
$pdf->Ln(20);
$pdf->Cell(100,6, "A szerződés aláírásával egyidőben megkaptam a képzési szabályzatot, melyet elolvastam és elfogadok." ,0,0);
$pdf->Ln(10);
$pdf->Cell(50,6," ..........................................",0,0);

$pdf->Ln(5);
$pdf->Cell(50,6," szakképzésben résztvevő ",0,0);
$pdf->Ln(20);

$pdf->Cell(50,6," *A megfelelő részt szíveskedjen aláhúzni! ",0,0);
$pdf->Ln(20);
$pdf->Output();

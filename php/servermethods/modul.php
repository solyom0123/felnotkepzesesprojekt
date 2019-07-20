<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function insertModul($conn) {
    global $value;
    $sql = "INSERT INTO modul (modul_name,modul_number,education_id,doctrine,exercise,writting_test,verbal_test,practical_test)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "','" . $value[6] . "','" . $value[7] . "')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function list_modul($conn) {
    $sql = "select modul_id as id, modul_name as name, education_id as eid"
            . " from modul;  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['eid'] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

function list_modul_filter($conn) {
    global $value;
    $sql = "select modul_id as id, modul_name as name, education_id as eid"
            . " from modul where education_id=" . $value . " ;  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['eid'] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

function editModul($conn) {
    global $value;
    $sql = "UPDATE modul SET modul_name='" . $value[0] . "', modul_number='" . $value[1] . "', education_id ='" . $value[2] . "', doctrine='" . $value[3] . "',exercise='" . $value[4] . "',writting_test='" . $value[5] . "',verbal_test='" . $value[6] . "',practical_test='" . $value[7] . "' where modul_id=" . $value[8];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error' . $conn->error;
    }

    return $conn;
}

function getModul($conn) {
    global $value;

    $sql = "select modul_name as nev,modul_number as okj,education_id as id,doctrine as d, exercise as e, writting_test as w,verbal_test as v, practical_test as  p from modul where modul_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['okj'] . "/;/" . $row['id'] . "/;/" . $row['d'] . "/;/" . $row["e"] . "/;/" . $row['w'] . "/;/" . $row['v'] . "/;/" . $row['p'] . "/;/ ";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}

function list_modul_for_course_with_piece($conn) {
    global $value;
    $sql = "select count(*) as darab from modul where education_id=" . $value . " or education_id=-1;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["darab"] . "//";
        }
    } else {
        echo '0//' . $conn->error;
    }
    $sql = "select modul_id as id from modul where education_id=" . $value . " or education_id=-1;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . "//";
        }
    } else {
        echo $conn->error;
    }

    return $conn;
}

function enough_day($conn) {
    global $value;
    // var_dump($value);
    //$spValue= preg_split("(\/\/)", $value);
    $moduls_needed_plan_dec = 0;
    $moduls_needed_plan_exec = 0;
    $unusedweekdays = array();

    $endweek = 0;
    $allweek = 0;
    $endofsql = " ";
    
    if(count($value[7])>0){
       $i =0;
        foreach ($value[7] as $modulnumber) {
             
            $endofsql .=" modul_id=".$modulnumber." ";
            if ($i< count($value[7])-1) {
                $endofsql.="or";
            }
            $i++;
        }
    }
    $sql = "select SUM(doctrine) as doci from modul  where ".$endofsql.";  ";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_dec += $row["doci"];
        }
    } else {
        $moduls_needed_plan_dec = "0";
        echo $conn->error;
    }
    
    $sql = "select SUM(exercise) as exec from modul where ".$endofsql.";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_exec += $row["exec"];
        }
    } else {
        $moduls_needed_plan_dec = "0";
        echo $conn->error;
    }

    $sql = "select SUM(writting_test) as exam from modul where ".$endofsql.";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if($row["exam"]>0)
            $moduls_needed_plan_dec += $row["exam"];
        }
    } else {
        $moduls_needed_plan_dec += "0";
        echo $conn->error;
    }

    $sql = "select SUM(verbal_test) as exam from modul where ".$endofsql.";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if($row["exam"]>0)
            $moduls_needed_plan_dec += $row["exam"];
        }
    } else {
        $moduls_needed_plan_dec += "0";
        echo $conn->error;
    }

    $sql = "select SUM(practical_test) as exam from modul  where ".$endofsql.";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if($row["exam"]>0)
            $moduls_needed_plan_exec += $row["exam"];
        }
    } else {
        $moduls_needed_plan_exec += "0";
        echo $conn->error;
    }
    $sql = "select date,DAYOFWEEK(date) as napno from unable_dates where `date` between '" . $value[2] . "' and '" . $value[4] . "'    ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $unusedweekdays[$row['date']] = numberofday($row["napno"]);
        }
    } else {
        echo $conn->error;
    }
    //var_dump($unusedweekdays);
    $sumgetnumberofclassdoc = sumclassnumber($unusedweekdays, $value, "doc");
    $sumgetnumberofclassexec = sumclassnumber($unusedweekdays, $value, "exec");
    if (($sumgetnumberofclassdoc) != $moduls_needed_plan_dec) {
        echo (($sumgetnumberofclassdoc) - $moduls_needed_plan_dec) . "//";
    } else {
        echo 'ok//';
    }
    if (($sumgetnumberofclassexec) != $moduls_needed_plan_exec) {
        echo (($sumgetnumberofclassexec) - $moduls_needed_plan_exec) . "//";
    } else {
        echo 'ok//';
    }
    return $conn;
}

function numberofday($sqldate) {
    $numberofday = 0;
    if ($sqldate == 1) {
        $numberofday = 7;
    } elseif ($sqldate == 2) {
        $numberofday = 1;
    } elseif ($sqldate == 3) {
        $numberofday = 2;
    } elseif ($sqldate == 4) {
        $numberofday = 3;
    } elseif ($sqldate == 5) {
        $numberofday = 4;
    } elseif ($sqldate == 6) {
        $numberofday = 5;
    } elseif ($sqldate == 7) {
        $numberofday = 6;
    }
    return $numberofday;
}

function calcNextDayNo($dayno) {
    $calcdayno = 0;
    if ($dayno < 7) {
        $calcdayno = $dayno + 1;
    } else {
        $calcdayno = 1;
    }
    return $calcdayno;
}
function calcIndexType($type){
    $index = 0;
    if ($type == "doc") {
        $index = 0;
    } else {
        $index = 1;
    }
    return $index;
}
function sumclassnumber($unusedweekdays, $datedata, $type) {
    $begin = new DateTime($datedata[2]);
    $end = new DateTime($datedata[4]);

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    $actdayno = $datedata[3];
    $sum = 0;
    $index = calcIndexType($type);
    
    foreach ($period as $dt) {
        $actdat = $dt->format("Y-m-d");
        if (!array_key_exists($actdat, $unusedweekdays)) {
        //var_dump($dt->format("Y-m-d"));
        
            $sum += $datedata[$index][$actdayno-1];
          //  var_dump($sum);
        }
        $actdayno = calcNextDayNo($actdayno);
    }
    return $sum;
}
function list_modul_filter_with_non_ordered($conn) {
    global $value;
    $sql = "select modul_id as id, modul_name as name, education_id as eid"
            . " from modul where education_id=" . $value . " or education_id=-1;  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['eid'] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}
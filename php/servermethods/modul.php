<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function insertModul($conn) {
    global $value;
    $sql = "INSERT INTO modul (modul_name,modul_number,education_id,doctrine,exercise,writting_test,verbal_test,practical_test,mod_date)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "','" . $value[6] . "','" . $value[7] . "',NOW()) ";

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
    $sql = "select modul_id as id, modul_name as name,modul_number as no, education_id as eid"
            . " from modul where education_id=" . $value . " ;  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . " " . $row["no"] . ";" . $row['eid'] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
        echo $conn->error;
    }
    return $conn;
}

function editModul($conn) {
    global $value;
    $sql = "UPDATE modul SET modul_name='" . $value[0] . "', modul_number='" . $value[1] . "', education_id ='" . $value[2] . "', doctrine='" . $value[3] . "',exercise='" . $value[4] . "',writting_test='" . $value[5] . "',verbal_test='" . $value[6] . "',practical_test='" . $value[7] . "',mod_date = NOW() where modul_id=" . $value[8];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error' . $conn->error;
    }

    return $conn;
}
function passModul($conn) {
    global $value;
    $sql = "UPDATE modul SET pass_date=NOW() where modul_id=" . $value;

    if ($conn->query($sql) === TRUE) {
        //echo 'ok';
    } else {
        //echo 'error' . $conn->error;
    }

    return $conn;
}
function editModulModDate($conn,$id) {
   
    $sql = "UPDATE modul SET mod_date=NOW() where modul_id=" . $id;

    if ($conn->query($sql) === TRUE) {
       // echo 'ok';
    } else {
        //echo 'error' . $conn->error;
    }

    return $conn;
}
function ispassModul($id) {
   $conn = kapcsolodas();
   $pass=false;
    $sql = "select (select case when pass_date>=mod_date then 'true' else 'false' End) as state from modul where modul_id=" . $id . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
           if( $row["state"]=="true"){
               $pass= true;
           }
        }
    } else {
        echo "none/;/";
        echo $conn->error;
    }
    
    lekapcsolodas($conn);
    return $pass;
}
function getNameModul($id) {
   $conn = kapcsolodas();
   $pass='névtelen modul';
    $sql = "select modul_name as na from modul where modul_id=" . $id . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
           $pass =$row["na"];
        }
    } else {
        echo "none/;/";
        echo $conn->error;
    }
    
    lekapcsolodas($conn);
    return $pass;
}
function getModul($conn) {
    global $value;

    $sql = "select modul_name as nev,modul_number as okj,education_id as id,doctrine as d, exercise as e, writting_test as w,verbal_test as v, practical_test as  p,mod_date as md, pass_date as pd,(select case when pass_date>=mod_date then 'true' else 'false' End) as state from modul where modul_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['okj'] . "/;/" . $row['id'] . "/;/" . $row['d'] . "/;/" . $row["e"] . "/;/" . $row['w'] . "/;/" . $row['v'] . "/;/" . $row['p'] . "/;/" . $row['md'] . "/;/" . $row['pd']. "/;/" . $row['state'];
        }
    } else {
        echo "none/;/";
        echo $conn->error;
    }

    return $conn;
}
function getCalcModulNeeded($conn) {
    global $value;

    $sql = "select sum(doctrine) as d,sum(elearn) as e,sum(exercise) as ex from studymaterials where modul_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["d"]."/;/".$row["e"] . "/;/".$row["ex"] ;
        }
    } else {
        echo "0/;/0";
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
    $moduls_needed_el_doc = 0;
    $unusedweekdays = array();
    $biggest_doct_exam=0;
    $biggest_exe_exam=0;
    $endweek = 0;
    $allweek = 0;
    $endofsql = " ";
    $badmodul = array();
    if (count($value[8]) > 0) {
        $i = 0;
        foreach ($value[8] as $modulnumber) {
            if(!ispassModul($modulnumber)){
                array_push($badmodul, $modulnumber);
            }
            $endofsql .= " modul_id=" . $modulnumber . " ";
            if ($i < count($value[8]) - 1) {
                $endofsql .= "or";
            }
            $i++;
        }
    }
    $sql = "select SUM(doctrine) as doci from modul  where " . $endofsql . ";  ";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_dec += $row["doci"];
        }
    } else {
        $moduls_needed_plan_dec = "0";
        echo $sql."||". $conn->error;
    }

    $sql = "select SUM(exercise) as exec from modul where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_exec += $row["exec"];
        }
    } else {
        $moduls_needed_plan_dec = "0";
        echo $sql."||". $conn->error;
    }
    $sql = "select SUM(s.elearn) as exec from studymaterials s where " . $endofsql . " ;  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_el_doc += $row["exec"];
        }
    } else {
        $moduls_needed_el_doc = "0";
       echo $sql."||". $conn->error;
    }
    $sql = "select SUM(CASE WHEN writting_test>0 THEN writting_test ELSE 0 END) as exam from modul where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["exam"] > 0) {
                $moduls_needed_plan_dec += $row["exam"];
            }
        }
    } else {
        $moduls_needed_plan_dec += "0";
      echo $sql."||". $conn->error;
    }
     $sql = "select  max(verbal_test) as exam from modul where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["exam"] > 0) {
                $biggest_doct_exam += $row["exam"];
            }
        }
    } else {
        $biggest_doct_exam += "0";
       echo $sql."||". $conn->error;
    }
    $sql = "select  max(writting_test) as exam from modul where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["exam"] > 0) {
                if($row["exam"]>$biggest_doct_exam){
                $biggest_doct_exam = $row["exam"];
                }
                    
                }
        }
    } else {
        $biggest_doct_exam += "0";
       echo $sql."||". $conn->error;
    }
    
    $sql = "select max(practical_test) as exam from modul where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["exam"] > 0) {
                $biggest_exe_exam = $row["exam"];
            }
        }
    } else {
        $biggest_exe_exam += "0";
        echo $sql."||". $conn->error;
    }

    $sql = "select SUM(CASE WHEN verbal_test>0 THEN verbal_test ELSE 0 END) as exam from modul where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["exam"] > 0) {
                $moduls_needed_plan_dec += $row["exam"];
            }
        }
    } else {
        $moduls_needed_plan_dec += "0";
        echo $sql."||". $conn->error;
    }

    $sql = "select SUM(CASE WHEN practical_test>0 THEN practical_test ELSE 0 END) as exam from modul  where " . $endofsql . ";  ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["exam"] > 0) {
                $moduls_needed_plan_exec += $row["exam"];
            }
        }
    } else {
        $moduls_needed_plan_exec += "0";
     echo $sql."||". $conn->error;
    }
    $sql = "select date,DAYOFWEEK(date) as napno from unable_dates where `date` between '" . $value[3] . "' and '" . $value[5] . "'    ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $unusedweekdays[$row['date']] = numberofday($row["napno"]);
        }
    } else {
        echo $sql."||". $conn->error;
    }
    //var_dump($unusedweekdays);
    $sumgetnumberofclassdoc = sumclassnumber($unusedweekdays, $value, "doc");
    $sumgetnumberofclassexec = sumclassnumber($unusedweekdays, $value, "exec");
    $sumgetnumberofclassel = sumclassnumber($unusedweekdays, $value, "el");
    
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
    if (($sumgetnumberofclassel) != $moduls_needed_el_doc) {
        echo (($sumgetnumberofclassel) - $moduls_needed_el_doc) . "//";
    } else {
        echo 'ok//';
    }
     if(!enoughforExam("doc",$value,$biggest_doct_exam)){
          echo   "doc,".$biggest_doct_exam."//";
     }else{
         echo ''; 
     }
     if(!enoughforExam("exe",$value,$biggest_exe_exam)){
          echo   "exe,".$biggest_exe_exam."//";
     }else{
         echo ''; 
     }
     echo '/;/';
     if(count($badmodul)>0){
         echo 'true//';
     }else{
          echo 'false//';
     }
     for ($index = 0; $index < count($badmodul); $index++) {
         echo getNameModul($badmodul[$index]).';';
     }
    return $conn;
}
function enoughforExam($type,$array,$biggestExamHour){
    $enough =false;
    if($type=="doc"){
        for ($index = 0; $index < count($array); $index++) {
            if ($array[0][$index]>=$biggestExamHour) {
                $enough= true;
            }
        }
    }else{
        for ($index = 0; $index < count($array); $index++) {
            if ($array[1][$index]>=$biggestExamHour) {
                $enough= true;
            }
        }
    }
    return $enough;
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

function calcIndexType($type) {
    $index = 0;
    if ($type == "doc") {
        $index = 0;
    } else if($type=="el"){
        $index=2; 
    } else {
        $index = 1;
    }
    return $index;
}

function sumclassnumber($unusedweekdays, $datedata, $type) {
    $begin = new DateTime($datedata[3]);
    $end = new DateTime($datedata[5]);

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    $actdayno = $datedata[4];
    $sum = 0;
    $index = calcIndexType($type);

    foreach ($period as $dt) {
        $actdat = $dt->format("Y-m-d");
        if (!array_key_exists($actdat, $unusedweekdays)) {
            //var_dump($dt->format("Y-m-d"));

            $sum += $datedata[$index][$actdayno - 1];
            //  var_dump($sum);
        }
        $actdayno = calcNextDayNo($actdayno);
    }
    return $sum;
}

function list_modul_filter_with_non_ordered($conn) {
    global $value;
    $sql = "select modul_id as id, modul_name as name,modul_number as no, education_id as eid"
            . " from modul where education_id=" . $value . " or education_id=-1;  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . " " . $row["no"] . ";" . $row['eid'] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

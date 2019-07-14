<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function insertModul($conn) {
    global $value;
    $sql = "INSERT INTO modul (modul_name,modul_number,education_id,doctrine,exercise,writting_test,verbal_test,practical_test)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] ."','" . $value[3] ."','" . $value[4] ."','" . $value[5] ."','" . $value[6] ."','" . $value[7] ."')";

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
            . " from modul where education_id=".$value." ;  ";
    
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
    $sql = "UPDATE modul SET modul_name='" . $value[0] . "', modul_number='" . $value[1] . "', education_id ='" . $value[2] . "', doctrine='" . $value[3] . "',exercise='" . $value[4] . "',writting_test='" . $value[5] . "',verbal_test='" . $value[6] . "',practical_test='" . $value[7] . "' where modul_id=".$value[8];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error'.$conn->error;
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
            echo $row["nev"] . "/;/" . $row['okj'] . "/;/" . $row['id'] . "/;/" . $row['d'] ."/;/" . $row["e"] ."/;/" . $row['w'] ."/;/" . $row['v'] ."/;/" . $row['p'] .     "/;/ ";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}
function list_modul_for_course_with_piece($conn) {
    global $value;
    $sql = "select count(*) as darab from modul where education_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["darab"] . "//";
        }
    }else{
        echo '0//'.$conn->error;
    }
    $sql = "select modul_id as id from modul where education_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . "//" ;
        }
    } else {
        echo $conn->error;
    }

    return $conn;
}
function enough_day($conn) {
    global $value;
    //echo $value;
    $spValue= preg_split("(\/\/)", $value);
    $moduls_needed_plan_dec=0;
    $moduls_needed_plan_exec=0;
    $startweek=0;
    $endweek=0;
    $allweek =0;
    $sql = "select SUM(doctrine) as doci from modul  where education_id=" . $spValue[4] . ";  ";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_dec+=$row["doci"];
        }
    }else{
        $moduls_needed_plan_dec="0";
        echo $conn->error;
    }
    $sql = "select SUM(exercise) as exec from modul where education_id=" . $spValue[4] . ";  ";
    //echo $sql;
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_exec+=$row["exec"];
            
        }
    }else{
        $moduls_needed_plan_dec="0";
        echo $conn->error;
    }
    
    $sql = "select SUM(writting_test) as exam from modul where education_id=" . $spValue[4] . ";  ";
    //echo $sql;
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_dec+=$row["exam"];
            
        }
    }else{
        $moduls_needed_plan_dec+="0";
        echo $conn->error;
    }
    
    $sql = "select SUM(verbal_test) as exam from modul where education_id=" . $spValue[4] . ";  ";
    //echo $sql;
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_dec+=$row["exam"];
            
        }
    }else{
        $moduls_needed_plan_dec+="0";
        echo $conn->error;
    }
    
    $sql = "select SUM(practical_test) as exam from modul  where education_id=" . $spValue[4] . ";  ";
    //echo $sql;
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $moduls_needed_plan_exec+=$row["exam"];
            
        }
    }else{
        $moduls_needed_plan_exec+="0";
        echo $conn->error;
    }
    $sql = "select WEEK('".$spValue[2]."') as sweek, WEEK('".$spValue[3]."') as eweek    ";
    //echo $sql;
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $endweek = $row["eweek"];
            $startweek = $row["sweek"];
            
        }
    } else {
        echo $conn->error;
    }
    //echo $startweek." alma ".$endweek;
     if($startweek>$endweek){
         $allweek = (52-$startweek)+$endweek;
         
     }else if($startweek<$endweek){
         $allweek = $endweek-$startweek;
         
     }else if(($startweek==$endweek)&&($spValue[2]==$spValue[3])){
         $allweek = 0;
         
     } else if(($startweek==$endweek)&&($spValue[2]!=$spValue[3])){
         $allweek = 52;
         
     }
     //echo $allweek;
     if(($allweek*$spValue[0])!=$moduls_needed_plan_dec){
         echo (($allweek*$spValue[0])-$moduls_needed_plan_dec)."//";
     }else{
         echo 'ok//';
     }
     if(($allweek*$spValue[1])!=$moduls_needed_plan_exec){
         echo (($allweek*$spValue[1])-$moduls_needed_plan_exec)."//";
     }else{
         echo 'ok//';
     }        
    return $conn;
}
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printForm(){
    global $value,$coursedata,$date,$maintable;
  
    switch ($value[0]) {
        case 1:
            collectDataForMissingForm($value[1]);
            echo '/;/';
             echo 'attendance_sheet_print.php';
            break;

        default:
            break;
    }
}
function collectDataForMissingForm($dataArray){
    $conn = kapcsolodas();
    $date ='';
     $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,`name` as n from schedule_plan_data where id=" . $dataArray[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["c"].';';
            echo $row["e"].';';
            echo 'cim'.';';
           echo $row["s"]."-".$row["n"].';';
            
           } 
    }else{
        echo  $conn->error;
    }
    echo '/;/';
    $sql = "select "
            . "("
            . "case "
            .   "when replace_day='false' "
            .       "then "
            .           "(select modul_name "
            .               "from modul "
            .               "where modul_id=used_modul_id) "
            .       "else '' END) as m,"
            . " used_hours as uh,  "
            . "(case "
            .   "when used_hours_type=1 "
            .       "then 'elméleti' "
            .       "else "
            .           "(case "
            .               "when used_hours_type=2"
            .                   " then 'gyakorlati'  "
            .                   "else ("
            .                       "case "
            .                           "when used_hours_type=3 "
            .                               "then 'elearn' "
            .                               "else '' END "
            .                          ") END"
            . "             ) END"
            . " ) as t, "
            . "`date` as d,"
            . " (case"
            .       " when exam ='false' "
            .           "then "
            .               "(select study_materials_name "
            .                 "from studymaterials "
            .                 "where studymaterials_id= used_studymaterials_id)"
            .           " else "
            .               "(select realname "
            .               "from helper_exam_data "
            .               "where `type`= used_studymaterials_id) END) as c "
            . "from schedule_plan "
            . "where "
            .       "schedule_plan_data_id=" . $dataArray[0] . " "
            .       "and `date`='" . $dataArray[1] . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['m'].' - '.$row['c'].' - '.$row['t'].';';
            echo $row['uh'].';//';
            $date = $row['d'];
        }
    }else{
        echo  $conn->error;
    }
    echo '/;/';
    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $dataArray[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['fn'].';'. $row['br'].';//';
            
        }
        
    }else{
        echo  $conn->error;
    }
       
    echo '/;/';
    echo $date;
    lekapcsolodas($conn);
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function list_course($conn) {
    $sql = "select sc.id as i,sc.`name` as n,CONCAT(e.education_name,' : ',e.okj_number) as en from schedule_plan_data sc, education e, schedule_plan scp  where e.education_id=sc.course_id and scp.schedule_plan_data_id= sc.id and scp.`date`='" . date("Y-m-d") . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            $sql = "select s.student_id as i,s.student_full_name as n,s.birth_date as en from students s,education_students e  where e.student_id=s.student_id and e.active_education=" . $row["i"] . " and s.student_id not in (select su.student_id from signature su  where su.date='" . date("Y-m-d") . "') ;   ";
            $result1 = $conn->query($sql);
            if ($result1->num_rows > 0) {

                echo $row["i"] . ";" . $row["n"] . ';' . $row["en"] . "//";
            }
        }
    } else {
        echo 'none;//';
    }
    return $conn;
}

function save_img($conn, $img, $user) {
    var_dump($_POST);
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);
//saving
    $fileName = './sign_imgs/' . $user . 'sign' . date("Y-m-d") . '.png';
    file_put_contents($fileName, $fileData);
    $sql = "INSERT INTO `signature`( `signature_path`, `student_id`, `date`) VALUES ('" . $fileName . "','" . $user . "','" . date("Y-m-d") . "')";
    $conn->query($sql);

    return $conn;
}

function list_student($conn) {
    global $value;
    $sql = "select s.student_id as i,s.student_full_name as n,s.birth_date as en from students s,education_students e  where e.student_id=s.student_id and e.active_education=" . $value . " and s.student_id not in (select su.student_id from signature su  where su.date='" . date("Y-m-d") . "') ;   ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["i"] . ";" . $row["n"] . ';' . explode(" ", $row["en"])[0] . "//";
        }
    } else {
        echo 'none;//';
    }
    return $conn;
}

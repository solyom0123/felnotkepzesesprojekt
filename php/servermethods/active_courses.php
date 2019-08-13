<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function  send_active_course($conn) {
    global $value;
    $sql = "INSERT INTO education_students (active_education,student_id) ".
"VALUES ('" . $value[0] . "','" . $value[1] ."')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}
function  delete_active_course($conn) {
    global $value;
    $sql = "DELETE FROM education_students where student_id=".$value[1]." and active_education=".$value[0];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function get_active_course($conn) {
    global $value;
    //echo $value;
    $sql = "select sc.`name`, e.education_name as ename  from schedule_plan_data sc, education e where e.education_id= sc.course_id and sc.id = " . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['ename'] . ";" . $value . "/;/ " ;
        }
    } else {
        echo "none/;/";
    }
    echo"/:/:/";
    $sql = "select s.student_id as id, s.student_full_name as name,s.birth_date as b from education_students es, students s where es.student_id= s.student_id and es.active_education = " . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['b'] . "/;/ " ;
        }
    } else {
        echo "none/;/";
    }
     echo"/:/:/";
    $sql = "select s.student_id as id, s.student_full_name as name,s.birth_date as b from  students s where s.student_id not in (select student_id from education_students where active_education = " . $value . ") and s.student_id not in (select student_id from education_students );  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['b'] . "/;/ " ;
        }
    } else {
        echo "none/;/";
    }
     echo"/:/:/";
    return $conn;
}

function list_active_course($conn) {
    $sql = "select sc.id, sc.name,e.education_name as ename from schedule_plan_data sc,education e where sc.active=1 and e.education_id= sc.course_id order by sc.name ASC  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['ename'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

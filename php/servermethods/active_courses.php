<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function send_active_course($conn) {
    global $value;
    $spids = explode("_", $value[1]);
    for ($index = 0; $index < count($spids); $index++) {
        if ($spids[$index] != "") {

            $sql = "INSERT INTO education_students (active_education,student_id) " .
                    "VALUES ('" . $value[0] . "','" . $spids[$index] . "')";

            if ($conn->query($sql) === TRUE) {
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }
    return $conn;
}

function delete_active_course($conn) {
    global $value;
    $spids = explode("_", $value[1]);
    for ($index = 0; $index < count($spids); $index++) {
        if ($spids[$index] != "") {

    
    $sql = "DELETE FROM education_students where student_id=" . $spids[$index] . " and active_education=" . $value[0];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }
}
    }
    
    return $conn;
}

function get_active_course($conn) {
    global $value;
    //echo $value;
    $spOrder = explode("_", $value);
    $id = $spOrder[0];
    $order = solveOrderStudent($spOrder[1]);
    $ordertype = solveOrderTypeStudent($spOrder[2]);
    $orderold = solveOrderStudent($spOrder[3]);
    $ordertypeold = solveOrderTypeStudent($spOrder[4]);

    $sql = "select sc.`name`, e.education_name as ename  from schedule_plan_data sc, education e where e.education_id= sc.course_id and sc.id = " . $id . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['ename'] . ";" . $id . "/;/ ";
        }
    } else {
        echo "none/;/";
    }
    echo"/:/:/";
    $sql = "select s.student_id as id, s.student_full_name as name,s.birth_date as b from education_students es, students s where es.student_id= s.student_id and es.active_education = " . $id . " order by " . $orderold . " " . $ordertypeold . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['b'] . "/;/ ";
        }
    } else {
        echo "none/;/";
    }
    echo"/:/:/";
    $sql = "select s.student_id as id, s.student_full_name as name,s.birth_date as b from  students s where s.student_id not in (select student_id from education_students where active_education = " . $id . ") and s.student_id not in (select student_id from education_students ) order by " . $order . " " . $ordertype . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['b'] . "/;/ ";
        }
    } else {
        echo "none/;/";
        echo $conn->error;
    }
    echo"/:/:/";
    return $conn;
}

function list_active_course($conn) {
    global $value;
    $spOrder = explode("_", $value);
    $order = solveOrderActiveEducation($spOrder[0]);
    $ordertype = solveOrderTypeActiveEducation($spOrder[1]);
    $sql = "select sc.id, sc.name,e.education_name as ename,sc.start_day as s, sc.sign_day as si from schedule_plan_data sc,education e where sc.active=1 and e.education_id= sc.course_id order by " . $order . "  " . $ordertype;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['ename'] . ";" . $row['s'] . ";" . $row['si'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

function solveOrderActiveEducation($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "sc.name";

            break;
        case "2":
            $returnValue = "e.education_name";

            break;
        case "3":
            $returnValue = "sc.start_day";

            break;
        case "4":
            $returnValue = "sc.sign_day";

            break;

        default:
            $returnValue = "sc.name";

            break;
    }
    return $returnValue;
}

function solveOrderTypeActiveEducation($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "ASC";

            break;
        case "2":
            $returnValue = "DESC";

            break;
    }
    return $returnValue;
}

function solveOrderStudent($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "s.student_full_name";

            break;
        case "2":
            $returnValue = "s.birth_date";

            break;

        default:
            $returnValue = "s.student_full_name";

            break;
    }
    return $returnValue;
}

function solveOrderTypeStudent($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "ASC";

            break;
        case "2":
            $returnValue = "DESC";

            break;
    }
    return $returnValue;
}

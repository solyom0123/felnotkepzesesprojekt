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
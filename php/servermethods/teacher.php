<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function list_teacher($conn) {
    $sql = "select teacher_id as id, teacher_full_name as name  from teachers ;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

function insertTeacher($conn) {
    global $value;
    $sql = "INSERT INTO teachers (teacher_full_name, birth_name, mothers_name,birth_place,gender,nationality,phone_number,taj,birth_date,home_address)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "','" . $value[6] . "','" . $value[7] . "','" . $value[8] . "." . $value[9] . "." . $value[10] . "','" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function getTeacher($conn) {
    global $value;

    $sql = "select teacher_full_name as nev,birth_name as bnev,mothers_name as anev,birth_date as bd,birth_place as bp,gender as g,home_address as ha,nationality as n,phone_number as pn,taj  from teachers where teacher_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['bnev'] . "/;/" . $row['anev'] . "/;/" . $row['bd'] . "/;/" . $row['bp'] . "/;/" . $row['g'] . "/;/" . $row['ha'] . "/;/" . $row['n'] . "/;/" . $row['pn'] . "/;/" . $row['taj'] . "/;/";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}
function editTeacher($conn) {
    global $value;
    $sql = "UPDATE teachers SET teacher_full_name='" . $value[0] . "', birth_name='" . $value[1] . "', mothers_name ='" . $value[2] . "',birth_place='" . $value[3] . "',gender='" . $value[4] . "',nationality='" . $value[5] . "',phone_number='" . $value[6] . "',taj='" . $value[7] . "',birth_date='" . $value[8] . "." . $value[9] . "." . $value[10] . "',home_address='" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "' where teacher_id=".$value[16];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}
function list_teacher_cur_unit($conn){
    global $value;

     $sql = "select studymaterials_id as id, study_materials_name as name from studymaterials where studymaterials_id in (select studymaterials from studymaterials_teacher where teacher=".$value.") ;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}function list_teacher_cur_without_unit($conn){
    global $value;

     $sql = "select studymaterials_id as id, study_materials_name as name from studymaterials where studymaterials_id not in (select studymaterials from studymaterials_teacher where teacher=".$value.") ;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}
function insertConnection($conn) {
    global $value;
    $sql = "INSERT INTO studymaterials_teacher(teacher, studymaterials,file)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function getConnection($conn) {
    global $value;

    $sql = "select studymaterials as st,teacher as id, file   from studymaterials_teacher where teacher_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . "/;/" . $row['st'] . "/;/" . $row['file'] . "/;/" ;
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}
function editConnection($conn) {
    global $value;
    $sql = "UPDATE studymaterials_teacher SET teacher='" . $value[0] . "', studymaterials='" . $value[1] . "', `file` ='" . $value[2] . " where teacher='".$value[0]."' and  studymaterials='".$value[1]."'";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}
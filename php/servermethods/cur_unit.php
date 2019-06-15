<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function insertCurUnit($conn) {
    global $value;
    $sql = "INSERT INTO studymaterials (study_materials_name,description,modul_id, doctrine,exercise, elearn)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] ."','" . $value[3] ."','" . $value[4] ."','" . $value[5] ."')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}
function editCurUnit($conn) {
    global $value;
    $sql = "UPDATE studymaterials SET study_materials_name='" . $value[0] . "', description='" . $value[1] . "', modul_id ='" . $value[2] . "', doctrine='" . $value[3] . "',exercise='" . $value[4] . "',elearn='" . $value[5] . "' where studymaterials_id=".$value[6];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error'.$conn->error;
    }

    return $conn;
}
function getCurUnit($conn) {
    global $value;

    $sql = "select study_materials_name as nev,description as con,modul_id as id,doctrine as d, exercise as e, elearn as el from studymaterials where studymaterials_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['con'] . "/;/" . $row['id'] . "/;/" . $row['d'] ."/;/" . $row["e"] ."/;/" . $row['el'] .   "/;/ ";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}

function list_cur_unit_filter($conn) {
    global $value;
    $sql = "select studymaterials_id as id, study_materials_name as name, modul_id as eid"
            . " from studymaterials where modul_id=".$value." ;  ";
    
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
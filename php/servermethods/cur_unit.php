<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function insertCurUnit($conn,$bonus) {
    global $value;
    if($bonus){
    $bonus = "true";
    
    }else{
    $bonus ="false";    
    }
    $sql = "INSERT INTO studymaterials (study_materials_name,description,modul_id, doctrine,exercise, elearn,bonus)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] ."','" . $value[3] ."','" . $value[4] ."','" . $value[5] ."','" . $bonus ."')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
        if($value[2]!=-1){
            lekapcsolodas(editModulModDate(kapcsolodas(), $value[2]));
        }
    } else {
        echo 'error';
    }

    return $conn;
}
function editCurUnit($conn) {
    global $value;
    $used_modul_id =0;
    $sql = "select modul_id as id from studymaterials where studymaterials_id=" . $value[6] . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
        $used_modul_id =   $row['id']  ;
         if($used_modul_id!=-1){
            lekapcsolodas(editModulModDate(kapcsolodas(), $used_modul_id));
        }
            
        }
    } else {
        echo "none/;/";
    }
            
    $sql = "UPDATE studymaterials SET study_materials_name='" . $value[0] . "', description='" . $value[1] . "', modul_id ='" . $value[2] . "', doctrine='" . $value[3] . "',exercise='" . $value[4] . "',elearn='" . $value[5] . "' where studymaterials_id=".$value[6];
    
    if ($conn->query($sql) === TRUE) {
        echo 'ok';
         if($value[2]!=-1){
            lekapcsolodas(editModulModDate(kapcsolodas(), $value[2]));
        }
    } else {
        echo 'error'.$conn->error;
    }

    return $conn;
}
function file_list($conn){
      global $value;
$sql ='';
 $order = solveOrderFile($value[2]);
    $ordertype = solveOrderTypeCurunit($value[3]);
if($value[0]==0){
    $sql = "select file_name as fn,upload_time as ut,id  from teacher_files where teacher_id=" . $value[1] . "  order by ".$order." ". $ordertype."";
}else{
    $sql = "select file_name as fn,upload_time as ut,id from studymaterials_files where studymaterials_studymaterials_id=" . $value[1] . " order by ".$order." ". $ordertype." ";
    
}
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["fn"] . ";" . $row['ut'] . ";" . $row['id'] . "/;/";
        }
    } else {
        echo "none;/;/";
         echo $conn->error;
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
function searchforcurunitcourseid($conn){
     global $value;

    $sql = "select e.education_id as e from modul m, education e where m.education_id = e.education_id and m.modul_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["e"] ;
        }
    } else {
        echo "none";
    }

    return $conn;
}
function list_cur_unit_filter($conn) {
    global $value;
    $sql = "select studymaterials_id as id, study_materials_name as name, modul_id as eid"
            . " from studymaterials where modul_id=".$value." and bonus='false';  ";
    
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
function solveOrderFile($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "file_name";

            break;
        case "2":
            $returnValue = "upload_time";

            break;

        default:
            $returnValue = "file_name";

            break;
    }
    return $returnValue;
}


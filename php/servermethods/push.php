<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function insertPush($conn) {
    global $value;
    
    $sql = "INSERT INTO push_notice (`date`,           schedule_plan_data_id,         message)
                       VALUES (NOW(),'" . $value[1] . "','" . $value[0] . "') ";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function solveOrderPush($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "d";

            break;
        case "2":
            $returnValue = "sc";

            break;
        case "3":
            $returnValue = "m";

            break;
    }
    return $returnValue;
}

function list_push_notice($conn) {
    global $value;
    $spOrder = explode("_", $value);
    $order = solveOrderPush($spOrder[0]);
    $ordertype = solveOrderTypeActiveEducation($spOrder[1]);
    $sql = "select date as d, schedule_plan_data_id as sc,message as m from push_notice order by " . $order . "  " . $ordertype;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $conn1 = kapcsolodas();
            $sql1 = "select `name` from schedule_plan_data  where id =".$row["sc"];
            $result1 = $conn1->query($sql1);
            if ($result1->num_rows > 0) {
                // output data of each row
                while ($row1 = $result1->fetch_assoc()) {

                    echo $row["d"] . ";" . $row1['name'] . ";" . $row['m'] . "//";
                }
            } else {
                echo "none;//";
            }
            lekapcsolodas($conn1);
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

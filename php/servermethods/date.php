<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getDates($conn) {
    global $value;
    $sql = "select  LAST_DAY('".$value."') as last;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          echo $row["last"]. "//" ;
        }
    } else {
        echo "none/;/";
    }
    echo $value."//";
    $sql = "select `date` from unable_dates where date between '" . $value . "' and LAST_DAY('".$value."');  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
        while ($row = $result->fetch_assoc()) {
            echo $row["date"] . "/-/" ;
        }
    } else {
        echo "/-/";
    }

    return $conn;
}
function dateEdit($conn) {
    global $value;
    $sql = "select date from unable_dates where date = '".$value."';  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
       $sql = "delete from unable_dates where date='".$value."' ;  ";
    $result = $conn->query($sql);
    } else {
       $sql = "insert into unable_dates(date) values ('".$value."');  ";
       $result = $conn->query($sql);
    }
    echo $value;
    
   

    return $conn;
}
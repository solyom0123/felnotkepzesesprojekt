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

function editcheckdate($conn) {
    global $value;
     $sql = "select `date` from help_date where `date`= '".$value."'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
             
          $sql = "Delete FROM help_date where `date`='".$value."'";
        if ($conn->query($sql) === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
        }
    } else {
         $sql = "INSERT INTO help_date (`date`)
VALUES ('".$value."');";
        if ($conn->query($sql) === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    return $conn;
}
function editmonthpass($conn,$date) {
    global $value;
    $sql = "Delete FROM help_date where `date`=(select  LAST_DAY('".$date."') as last)";
        if ($conn->query($sql) === TRUE) {
          //  echo 'ok';
        } else {
           // echo 'error';
        }
    return $conn;
}

function checkdateOwen($conn){
    global $value;
    
    $sql = "select `date` from help_date where `date`= '".$value."'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "true";
        }
    } else {
        echo "false";
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
     lekapcsolodas(editmonthpass(kapcsolodas(), $value));
   
   

    return $conn;
}
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once './php/sign.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$value = isset($_POST['param']) ? $_POST['param'] : null;
$muv = isset($_POST['muv']) ? $_POST['muv'] : null;
if ($muv == "list_course") {
    lekapcsolodas(list_course(kapcsolodas()));
}else if ($muv == "list_student") {
    lekapcsolodas(list_student(kapcsolodas()));
}else if ($muv == "save_img") {
    lekapcsolodas(save_img(kapcsolodas(),$_POST["imgBase64"],$value));
}





function kapcsolodas() {
       $szerverneve = "mysql.nethely.hu";//"localhost"; //";;
    $felhasznalonev = "oktat";//'root'; //
    $password = 'corvin2019';//""; //
    $dbname = 'oktat';
    $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);

    mysqli_query($conn, "SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
function kapcsolodas2() {
    $szerverneve = "mysql.nethely.hu";//"localhost"; //";;
    $felhasznalonev = "oktat";//'root'; //
    $password ='corvin2019';// ""; //
    $dbname = 'oktat';
    $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);

    mysqli_query($conn, "SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function lekapcsolodas($conn) {
    $conn->close();
}


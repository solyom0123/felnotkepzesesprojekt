<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$value = isset($_POST['param'])?$_POST['param']:null;
$muv = isset($_POST['muv'])?$_POST['muv']:null;
if($muv=="new_modul"){
    lekapcsolodas(felvitelmodul(kapcsolodas()));
}

function kapcsolodas() {
	$szerverneve = "localhost";
	$felhasznalonev = "root"; 
	$password = '';
	$dbname = 'szakdogaterv';
    $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);
   
	    mysqli_query($conn,"SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
function felvitelmodul($conn){
    global $value;
    $sql = "INSERT INTO `modul`( `nev`, `kepzes_id`, `azon_kod`, `elmeleti_ora`, `gyakorlati_ora`) VALUES ('".$value[0]."','".$value[2]."','".$value[1]."','".$value[3]."','".$value[4]."') ;";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    
    return $conn;
}
function felvitelvizsga($conn){
    global $value;
    $sql = "INSERT INTO `vizsga`( `nev`, `kepzes_id`, `azon_kod`, `elmeleti_ora`, `gyakorlati_ora`) VALUES ('".$value[0]."','".$value[2]."','".$value[1]."','".$value[3]."','".$value[4]."') ;";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    
    return $conn;
}

function lekapcsolodas($conn) {
    $conn->close();
}
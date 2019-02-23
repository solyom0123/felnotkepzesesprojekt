<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function kapcsolodas() {
	$szerverneve = "localhost";
	$felhasznalonev = "root"; 
	$password = '';
	$dbname = 'epiz_21307036_hero_quiz';
    $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);
   
	    mysqli_query($conn,"SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
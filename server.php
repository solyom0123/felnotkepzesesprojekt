<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$value = isset($_POST['param'])?$_POST['param']:null;
$muv = isset($_POST['muv'])?$_POST['muv']:null;
if($muv=="new_modul"){
    lekapcsolodas(felvitelmodul(kapcsolodas()));
}else if($muv=="login"){
     lekapcsolodas(login(kapcsolodas()));
    
}else if($muv=="logged"){
     $_SESSION["uid"] = $value[0];  
}else if($muv=="session"){
    lookUpSession();  
}else if($muv=="user_name"){
     lekapcsolodas(user_name(kapcsolodas()));
      
}



function kapcsolodas() {
	$szerverneve = "mysql.nethely.hu";
	$felhasznalonev = "oktat"; 
	$password = 'corvin2019';
	$dbname = 'oktat';
    $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);
   
	    mysqli_query($conn,"SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}



function lekapcsolodas($conn) {
    $conn->close();
}
function lookUpSession(){
    var_dump($_SESSION);
}
function login($conn){
    global $value;
    $sql = "select user_id as id, password as pw  from `user` where user_name='".$value[0]."'  ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       if(password_verify($value[1], $row["pw"])){
           echo 'true;'.$row["id"];
       }else{
           echo 'false;';
       }
       
       
    }
} else {
    echo "false;";
}    
    return $conn;
}
function user_name($conn){
    global $value; 
    $sql = "select user_name as name  from `user` where user_id='".$value."'  ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
           echo $row["name"];
       
       
       
    }
} else {
    echo "none;";
}    
    return $conn;
}

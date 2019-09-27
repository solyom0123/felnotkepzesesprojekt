<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if(!isset($_SESSION['prev_sign'])){
    $_SESSION['prev_sign']= array();
    //var_dump($_SESSION['prev']);
}
 if(isset($_POST['ker'])){
     
    echo $_SESSION['prev_sign'][count($_SESSION['prev_sign'])-1];    
     unset($_SESSION['prev_sign'][count($_SESSION['prev_sign'])-1]);
 }else{
     ///var_dump($_SESSION['prev']);
     array_push($_SESSION['prev_sign'], $_POST["preva"]);
     
 }

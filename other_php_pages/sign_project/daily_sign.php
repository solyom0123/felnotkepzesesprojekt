<?php

////////////////////////////////////////////////////////////////////////
//a biztonásgos ip cím
//var_dump(get_ip_address());
//$secure_ip = "217.65.124.171";
$secure_ip = "78.139.22.17";


////////////////////////////////////////////////////////////
session_start();
//$_SESSION['page']= isset()$_GET["page"];
//$page= $_SESSION['page'];
function get_ip_address(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}
$secure =false;
$localIP = getHostByName(getHostName());
if($secure_ip == get_ip_address()){
$secure = true;
    
}    

?>
<?php 
if($secure){
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <title>Központi Képzés Adminisztráció</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/szin.css">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/buttons.css">
        <link rel="stylesheet" href="./css/usefull.css">
        <link rel="stylesheet" href="./css/wrappers.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        
        <link rel="stylesheet" href="./css/sign.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript" src="./js/bootstrap.js"></script>
        <script type="text/javascript" src="./js/navigation.js"></script>
        <script type="text/javascript" src="./js/sign_page.js"></script>
        <script>link("course_page");</script>
        </head>
    <body class=" body-set ">
        <div class="col-md-12">
            <!--        <nav class=" row navbar navbar-inverse col-12 header-wrapper " style="height: 100px">
            
                    </nav>-->
            <main class=" row col-md-12 mt-1">
                <div class="menu-wrapper ">
                    <div class="menu-wrapper  col-md-2">
                    </div>   
                </div>

                <div class="col-md-10 ">
                    <div class="tartalom-wrapper">
                        
                    </div>

                </div>
            </main>
            <footer class=" row col-md-12 mt-1">
                Copyright infó jön ide.<br>2019
            </footer>
        </div>
    </body>
</html>
<?php
}
?>
<?php
session_start();
 $_SESSION['page']=$_GET["page"];
   
$page= $_SESSION['page'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>DEMO ISKOLAKEZELŐ RENDSZER</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/buttons.css">
        <link rel="stylesheet" href="./css/usefull.css">
        <link rel="stylesheet" href="./css/wrappers.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body class="wd-1250">
        <nav class="navbar navbar-fixed-top navbar-inverse wd-1250">
            <?php include './php/header.php'; ?>
        </nav>
        <main class="wd-1250">
            <div class="menu ">
                <div class="menu-wrapper">
                    <?php 
                    if (isset($_SESSION['uid'])) {
                        include './php/menu.php';
                    } 
                    ?>
                </div>   
            </div>

            <div class="tartalom pd-t-20">
                <div class="tartalom-wrapper">
                    <?php
                    if (isset($_SESSION['uid'])) {
                        include './php/'. $page.".php";
                    } else {
                        include './php/login.php';
                        
                    }
                    ?>
                </div>

            </div>
        </main>
        <footer>
            Made by Készítő neve.<br>2018
        </footer>
    </body>
</html>

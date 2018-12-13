<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION["uid"])){
?>

            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?page=main_admin"><img width="100" src="img/logo_100x50.PNG" alt="COrvin Köz OKtatási Központ"></a>
                <a class="navbar-brand" href="index.php?page=main_admin">WebSiteName</a>
            </div>

            <div class="navbar-right pd-r-100">
                <ul class="nav  navbar-nav ">

                    <li class="dropdown  ">
                        <a class="dropdown-toggle" data-toggle="dropdown" >Bejelentkezés
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Tanár</a></li>
                            <li><a href="#">Diák</a></li>
                            <li><a href="#">Admin</a></li>
                        </ul>
                    </li>

                    </ul>
            </div>
<?php }else{ ?>
   <div class="navbar-header">
                <a class="navbar-brand" href="index.php?page=main_admin"><img src="img/logo_100x50.PNG"></a>
                <a class="navbar-brand" href="index.php?page=main_admin">WebSiteName</a>
            </div>

            <div class="navbar-right pd-r-100">
                <ul class="nav  navbar-nav ">

                    <li class="dropdown  ">
                        <a class="dropdown-toggle" data-toggle="dropdown" ><img class="logo" src="img/bell.png">
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Értesítés1</a></li>
                            <li><a href="#">Értesítés2</a></li>
                            <li><a href="#">értesítés3</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><?=$_SESSION["uname"]?></a></li>
                    <li class=""> <a href="./php/logout.php"><img class="logo" src="img/logout.png"></a></li>
                </ul>
            </div>
<?php } ?>
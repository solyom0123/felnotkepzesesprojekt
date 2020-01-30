<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION["uid"])){
?>

<div class="navbar-header" style="height: auto">
                <div onclick="link('login')" class="navbar-brand" ><img width="100" src="img/custom-logo.png" alt="Corvin köz Oktatási Központ"></div>
                <div onclick="link('login')" class="navbar-brand" >Corvin köz Oktatási Központ</div>
            </div>

            <div class="navbar-right pd-r-100">
               <!-- <ul class="nav  navbar-nav ">

                    <li class="dropdown  ">
                        <a class="dropdown-toggle" data-toggle="dropdown" >Bejelentkezés
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Oktató</a></li>
                            <li><a href="#">Résztvevő</a></li>
                            <li><a href="#">Adminisztrátor</a></li>
                        </ul>
                    </li>

                    </ul>-->
            </div>

<?php }else{ ?>
   <div class="navbar-header">
                <div onclick="link('main_admin')" class="navbar-brand" ><img width="100" src="img/custom-logo.png"></div>
                <div onclick="link('main_admin')" class="navbar-brand" >Corvin Köz Oktatási Központ</div>
            </div>

            <div class="navbar-right pd-r-100">
                <!--<ul class="nav  navbar-nav ">

                    <!--<li class="dropdown  ">
                        <a class="dropdown-toggle" data-toggle="dropdown" ><img class="logo" src="img/bell.png">
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Értesítés1</a></li>
                            <li><a href="#">Értesítés2</a></li>
                            <li><a href="#">értesítés3</a></li>
                        </ul>
                    </li>-->

                    <!--<li class=""><div class="user_name"></div></li>
					<li class=""><div></div></li>
					
                    <li class=""> <div onclick="link('logout');linkhead();link('login');linkside('')"><img class="logo" src="img/logout.png"></div></li>
                </ul>-->
            </div>
<?php } ?>
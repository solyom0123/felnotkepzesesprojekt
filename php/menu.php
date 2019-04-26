<?php
//$menu = ['basic_datas', 'course_start', 'actually_course', 'administrativ', 'main_admin'];
$active_menu = 0;
//for ($index = 0; $index < count($menu); $index++) {
//    if ($menu[$index] == $_SESSION['page']) {
//        $active_menu = $index + 1;
//    }
//}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"><img src="img/menu.png" width="20px" height="20px"></span>

    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav list-unstyled">
            <li class="nav-item active">
                <div onclick="link('basic_datas')" class="menu-button<?php
                if ($active_menu == 1) {
                    echo '-active';
                }
                ?>"> Alapadatok kezelése</div>
            </li>

            <li class="nav-item">
                <div onclick="link('course_start')" class="menu-button<?php
                if ($active_menu == 2) {
                    echo '-active';
                }
                ?>" >Tanfolyam indítása</div>
            </li>
            <li class="nav-item">
                <div onclick="link('actually_course')" class="menu-button<?php if ($active_menu == 3) {
                    echo '-active';
                } ?>" >Aktuális képzések</div></a>

            </li>
            <li class="nav-item">
                <div onclick="link('administrativ')" class="menu-button<?php
                     if ($active_menu == 4) {
                         echo '-active';
                     }
                     ?>" >Adminisztratív feladatok</div>
            </li>
            <li class="nav-item">
                <div onclick="link('main_admin')" class="menu-button<?php
                     if ($active_menu == 5) {
                         echo '-active';
                     }
                     ?>" >GYORSMENÜ</div>             </li>
            <li class="nav-item">
                <div onclick="link('logout');link('login');linkhead();linkside('')" class="menu-button" >Kijelentkezés</div>
            </li>
        </ul>
    </div>
</nav>

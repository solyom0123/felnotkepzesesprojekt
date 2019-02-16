<?php
$menu = ['basic_datas', 'course_start', 'actually_course', 'administrativ', 'main_admin'];
$active_menu = 0;
for ($index = 0; $index < count($menu); $index++) {
    if ($menu[$index] == $_SESSION['page']) {
        $active_menu = $index + 1;
    }
}
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
                    <a href="index.php?page=basic_datas"><div class="menu-button<?php if ($active_menu == 1) {
    echo '-active';
} ?>"> Alapadatok kezelése</div></a>
                </li>
                
                <li class="nav-item">
                    <a href="index.php?page=course_start"><div class="menu-button<?php if ($active_menu == 2) {
    echo '-active';
} ?>" >Tanfolyam indítása</div></a>
                </li>
                    <li class="nav-item">
                    <a href="index.php?page=actually_course"><div class="menu-button<?php if($active_menu==3){echo '-active';}?>" >Aktuális képzések</div></a>
                    
                </li>
                <li class="nav-item">
    <a href="index.php?page=administrativ"><div class="menu-button<?php if ($active_menu == 4) {
    echo '-active';
} ?>" >Adminisztratív feladatok</div></a>
                </li>
                  <li class="nav-item">
    <a href="index.php?page=main_admin"><div class="menu-button<?php if ($active_menu == 5) {
    echo '-active';
} ?>" >GYORSMENÜ</div></a>             </li>
                  <li class="nav-item">
    <a href="./php/logout.php"><div class="menu-button" >Kijelentkezés</div></a>
             </li>
            </ul>
        </div>
    </nav>

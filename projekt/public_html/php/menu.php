<?php
$menu =['basic_datas','course_start','actually_course','administrativ'];
$active_menu=0;
for ($index = 0; $index < count($menu); $index++) {
    if ($menu[$index]==$_SESSION['page']) {
        $active_menu=$index+1;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <div class="menu-wrapper">
                    
     <a href="index.php?page=basic_datas"><div class="menu-button<?php if($active_menu==1){echo '-active';}?>"> Alapadatok kezelése</div></a>
                    <a href="index.php?page=course_start"><div class="menu-button<?php if($active_menu==2){echo '-active';}?>" >Képzés indítása</div></a>
                    <a href="index.php?page=actually_course"><div class="menu-button<?php if($active_menu==3){echo '-active';}?>" >Aktuális képzések</div></a>
                    <a href="index.php?page=administrativ"><div class="menu-button<?php if($active_menu==4){echo '-active';}?>" >Adminisztratív feladatok</div></a>
                    <a href="./php/logout.php"><div class="menu-button" >Kijelentkezés</div></a>
                    
                   <!--<a href="kepzeseekkapcsolo.html"><div class="menu-button">Képzések</div></a>
                    <a href="modulokkapcsol.html"><div class="menu-button">Modulok</div></a>
                    <a href="diakokkapcsol.html"><div class="menu-button">Diákok</div></a>
                    <a href="tantargykapcsol.html"><div class="menu-button">Tantárgyak</div></a>
                    
                    <a href="tanárokkapcsol.html"><div class="menu-button">Tanárok</div></a>
                    <a href="dokumentumok.html"><div class="menu-button">Dokumentumok</div></a>
                    <a href="naptar.html"><div class="menu-button">Naptár beállítás</div></a>
                    <a href="orarend.html"><div class="menu-button">Órarend</div></a>
                    <a href="kepzesgen.html"><div class="menu-button">Képzés Generálás</div></a>-->
               
                 </div>   
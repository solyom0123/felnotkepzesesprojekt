<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 class="h2-default">Képzések listája (ez a lsita adatbázisból lesz a későbbiekben létrehozva)</h2>
<form class="form-wrapper">
    <div class="list-wrapper">
        <ul>
            <li><div class="label-default-s"><input name="kepzes" type="radio" checked><p>1. képzés</p></div></li>
            <li> <div class="label-default-s"><input name="kepzes" type="radio"><p>2. képzés</p></div></li>
        </ul>






    </div>

    <!--                        <div class="input-wrapper">
                                
                              
                            
                            </div>
                            <div class="tooltip-wrapper">
                               
                                
                            </div>    -->
    <div class="option-button-wrapper">
        <div onclick="link('course_start');setElozo('course_r_list')" ><div class="option-button">Kiválaszt!</div></div>
        <div onclick="megsem()" ><div class="option-button">Mégsem</div></div>


    </div>
</form>

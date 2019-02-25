<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 class="h2-default">Diák lista</h2>
<form >
    <div class="row col-md-12 list-wrapper">
        <ul>
            <li ><div class="row"><input name="kepzes" type="radio" checked class="col-md-6"><p class="col-md-6">1. diák</p></div></li>
            <li> <div class=" row"><input name="kepzes" type="radio" class="col-md-6"><p class="col-md-6">2. diák</p></div></li>
        </ul>






    </div>

    <!--                        <div class="input-wrapper">
                                
                              
                            
                            </div>
                            <div class="tooltip-wrapper">
                               
                                
                            </div>    -->
    <div class="col-md-12 list-wrapper ">
        <div onclick="link('user_in_form');setElozo('student_r_list')" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('user_in_form');setElozo('student_r_list')" ><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégse</div></div>


    </div>
</form>

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 class="h2-default">Alkalmi Oktatók névsora</h2>
<form >
    <div class="row col-md-12 list-wrapper">
        <ul id="list_items">
           <?php echo $_POST['param'];?>
        </ul>





         <div id="pagenerButtons"></div>
    </div>

    <div class="col-md-12 list-wrapper ">
        <div onclick="bonusteacherGet();" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('bonus_teacher_in_form');setElozo('bonus_teacher_list');teacher_cur_unit_List(-1)" ><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Vissza</div></div>


    </div>
</form>
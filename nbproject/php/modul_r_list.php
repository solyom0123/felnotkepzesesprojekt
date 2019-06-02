<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 class="h2-default">Választható modulok</h2>
<form >
    <div class="row col-md-12 list-wrapper">
        <ul>
          <?php echo $_POST['param'];?>
         </ul>






    </div>
    <div class="col-md-12 list-wrapper ">
        <div onclick="modulGet();setElozo('modul_r_list')" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('modul_in_form');setElozo('modul_r_list')"><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégsem</div></div>


    </div>
</form>

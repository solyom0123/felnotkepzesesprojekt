<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 >Választható tananyagegységek</h2>
<form >
    <div class="row col-md-12 list-wrapper2">
        <div class="form-group row">
            <label for="form-row-cur-unit" class="col-md-4 col-form-label">Alkalmi tananyagegységek:</label>
            <div class="col-md-4">
                <select id="form-row-cur-unit" >
                <?php echo $_POST['param'];?>
         </select>
            </div> 
                                        
        </div>
         
        <br>
        





    </div>
    <div class="col-md-12 list-wrapper2 ">
        <div onclick="bonusunitGet()" ><div class="btn col-md-3 btn btn-md btn-info">Kiválasztás</div></div>
		<div class="col-md-1"></div>
        <div onclick="link('bonus_unit_in_form');setElozo('bonus_unit_list')"><div class="btn col-md-3 btn btn-md btn-info">Új hozzáadása</div></div>
        <div class="col-md-1"></div>
        <div onclick="megsem()" ><div class="btn col-md-3 btn btn-md btn-info">Mégsem</div></div>


    </div>
</form>

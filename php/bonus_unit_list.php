<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 class="h2-default">Választható tanegységek</h2>
<form >
    <div class="row col-md-12 list-wrapper">
        <div class="form-group row">
            <label for="form-row-cur-unit" class="col-md-4 col-form-label">Alkalmi tananyagegységek:</label>
            <div class="col-md-4">
                <select id="form-row-cur-unit" >
                <?php echo $_POST['param'];?>
         </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válassza ki, melyik bónusz tananyagegséget szeretné szerkeszteni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
         
        <br>
        





    </div>
    <div class="col-md-12 list-wrapper ">
        <div onclick="bonusunitGet()" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('bonus_unit_in_form');setElozo('bonus_unit_list')"><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégsem</div></div>


    </div>
</form>

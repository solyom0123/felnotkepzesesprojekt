<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 >Választható modulok</h2>
<form >

    <div class="row col-md-12 list-wrapper">
        <div class="col-md-9">
        
        <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
            <div class="col-md-8">
                <select id="form-row-kepzes" class="col-md-8" onclick="modulRefesh(0,'modul-list')">
          <?php echo $_POST['param'];?>
         </select>
            </div> 
            <!--<div class="col-md-4">
                <a href="#" data-toggle="tooltip" title="Válassza ki, melyik képzéshez tartozik a modul!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>       -->                     
        </div>
         <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Modulok:</label>
            <div class="col-md-8">
               <select id="modul-list" >
         
         </select>
            </div> 
           <!-- <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válassza ki, melyik modul módosítaná!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>-->                            
        </div>
</div>
<div class="col-md-3">
		<button type="button" class="btn btn-info btn-md btn-block" onclick="megsem()">Vissza</button>
		<button type="button" class="btn btn-info btn-md btn-block" onclick="modulGet()">Kiválaszt</button>
        <button type="button" class="btn btn-info btn-md btn-block" onclick="link('modul_in_form');setElozo('modul_r_list')">Új modul</button>
</div>



    </div>
   <!-- <div class="col-md-12 list-wrapper ">
        <div onclick="modulGet()" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('modul_in_form');setElozo('modul_r_list')"><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégsem</div></div>


    </div>-->
</form>

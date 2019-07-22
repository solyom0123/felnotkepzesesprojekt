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
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
            <div class="col-md-4">
                <select id="form-row-kepzes" onclick="modulRefesh(0,'modul-list')">
          <?php echo $_POST['param'];?>
         </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válassza ki, melyik képzéshez tartozik a modul!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
         <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Modulok:</label>
            <div class="col-md-4">
               <select id="modul-list" onclick="tanegysegfrissit(0,'tanegyseg-list')" onchange="tanegysegfrissit(0,'tanegyseg-list')">
         
         </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válassza ki, melyik modulhoz tartozik a tananyagegység!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
  <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Tananyagegységek:</label>
            <div class="col-md-4">
              <select id="tanegyseg-list">
            
        </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válasszon egy tananyag egységet!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <br>
        





    </div>
    <div class="col-md-12 list-wrapper ">
        <div onclick="curunitGet()" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('cur_unit_in_form');setElozo('cur_unit_list')"><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégsem</div></div>


    </div>
</form>

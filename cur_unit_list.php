<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2 >Választható tanegységek</h2>
<form >
    
	<div class="col-md-9">
	<div class="row col-md-12 list-wrapper2">
        <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
            <div class="col-md-4">
                <select id="form-row-kepzes" onclick="modulRefesh(0,'modul-list')">
          <?php echo $_POST['param'];?>
         </select>
            </div> 
                                       
        </div>
         <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Modulok:</label>
            <div class="col-md-4">
               <select id="modul-list" onclick="tanegysegfrissit(0,'tanegyseg-list')" onchange="tanegysegfrissit(0,'tanegyseg-list')">
         
         </select>
            </div> 
                                        
        </div>
  <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Tananyagegységek:</label>
            <div class="col-md-4">
              <select id="tanegyseg-list">
            
        </select>
            </div> 
                                        
        </div>
        
        <br>
        




		</div>
    </div>
	<div class="col-md-3">
    <div class="col-md-12 list-wrapper2 ">
        <div onclick="curunitGet()" ><div class="col-md-4 btn btn-info btn-md btn-block">Kiválaszt</div></div>
        <div class="row"></div>
			 <div class="col-md-12"></div>
		
		<div onclick="link('cur_unit_in_form');setElozo('cur_unit_list')"><div class="col-md-4 btn btn-info btn-md btn-block">Új hozzáadása</div></div>
        <div class="row"></div>
			 <div class="col-md-12"></div>
        <div onclick="megsem()" ><div class="col-md-4 btn btn-info btn-md btn-block">Mégsem</div></div>


    </div>
</div>
</form>

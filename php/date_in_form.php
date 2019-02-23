<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Új datum felvitele</h2>
</div>
<form >
    <div class="form-group row">
        <label for="form-row-start" class="col-md-4 col-form-label">Dátum kezdete:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-start" id="form-row-start" type="date"  placeholder="kezdete">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-end" class="col-md-4 col-form-label">Dátum vége:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-end" id="form-row-end" type="date"  placeholder="vége">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    
    <div class="form-group row">
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <input class="option-button col-md-6 " name="form-row-name" id="form-row-name" type="button" value="Generál" placeholder="adat">
        </div> 
             
    </div>

    <div class="form-group row">
        <label for="form-row-name" class="col-md-6 col-form-label">Dátum:</label>
          <label for="form-row-name" class="col-md-6 col-form-label">Használható:</label>
<!--  
        <!--        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="adat">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>-->                            
    </div>
     <?php for ($index = 0; $index < 40; $index++) {
        
     ?>
    <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text" disabled  placeholder="adat">
        </div> 
         <div class="col-md-6">
             <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="checkbox"  >
        </div> 

    </div>
   <?php } ?>
    <div class="option-button-wrapper form-group row">


        <a href="index.php?page=basic_datas"><input type="submit" name="log-form" class="btn col-md-5 btn option-button" value="Felvitel"></a>
        <div class="col-md-2"> </div>
        <a href="index.php?page=basic_datas"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></a>


    </div>
</form>


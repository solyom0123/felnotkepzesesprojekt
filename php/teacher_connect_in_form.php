<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Oktatói adatlap: </h2>


<form >
    <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">OKTATHATÓ Tananyagegységek:</label>
            <div class="col-md-2">
                <select class="form-control" id="sel1">
                    <option>Tananyagegység 1</option>
                    <option>Tananyagegység 2</option>
                    <option>Tananyagegység 3</option>
                    <option>Tananyagegység 4</option>
                </select>
            </div> 
            <div class="col-md-2">
            <div onclick="link('cur_unit_in_form')" class="option-button">Új Tananyagegység HOZZÁRENDELÉSE</div>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="...!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
    <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Oktató:</label>
            <div class="col-md-2">
                <select class="form-control" id="sel1">
                    <option>Oktató 1</option>
                    <option>Oktató 2</option>
                    <option>Oktató 3</option>
                    <option>Oktató 4</option>
                </select>
            </div> 
            <div class="col-md-2">
            <div onclick="link('teacher_in_form')"  class="option-button">Új Oktató</div>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
<div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Alkalmasságot igazoló dokumentum:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="file"  >
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="option-button-wrapper form-group row">


        <div onclick="link('basic_datas')" ><input type="button" name="log-form" class="btn col-md-5 btn option-button" value="Rögzít!"></div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
    
</form>

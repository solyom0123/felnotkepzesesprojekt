<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Oktató adatlapok nyomtatása</h2></div>

    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Oktatók:</label>
            <div class="col-md-2">
                <select multiple class="form-control" id="sel1">
                    <option>Oktató 1</option>
                    <option>Oktató 2</option>
                    <option>Oktató 3</option>
                    <option>Oktató 4</option>
                </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
       
         <div class="form-group row">
        
             <div onclick="link('actually_course')" ><input type="button" name="log-form" class="btn col-md-5 btn option-button" value="Adatalpok nyomtatása"></div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>



        </div>
    </form>

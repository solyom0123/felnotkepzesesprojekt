<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="row "><h2 class="col-md-12 h2-default">Modul felvitele</h2></div>

    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Modul száma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Képzések:</label>
            <div class="col-md-2">
                <select class="form-control" id="sel1">
                    <option>Képzés 1</option>
                    <option>Képzés 2</option>
                    <option>Képzés 3</option>
                    <option>Képzés 4</option>
                </select>
            </div> 
            <div class="col-md-2">
            <a href="index.php?page=course_in_form" class="option-button">Új képzés</a>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Elméleti óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Gyakorlati óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Írásbeli:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="checkbox"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Szóbeli:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="checkbox"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Gyakorlati:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="checkbox"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
       
         <div class="form-group row">
        
             <a href="index.php?page=course_start"><input type="submit" name="log-form" class="btn col-md-5 btn option-button" value="Felvitel"></a>
        <div class="col-md-2"> </div>
        <a href="index.php?page=course_start"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></a>



        </div>
    </form>

                    
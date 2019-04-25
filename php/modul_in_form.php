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
            <label for="form-row-name" class="col-md-4 col-form-label">Modul neve:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
       
        <div class="form-group row">
            <label for="form-row-number" class="col-md-4 col-form-label">Modul száma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-number" type="text"  placeholder="Modul szám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
            <div class="col-md-4">
                <select class="form-control" id="form-row-kepzes">
                    <option value="1">Képzés 1</option>
                    <option value="2">Képzés 2</option>
                    <option value="4">Képzés 3</option>
                    <option value="5">Képzés 4</option>
                </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">Elméleti óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-elm" type="text"  placeholder="elméleti óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-gyak" class="col-md-4 col-form-label">Gyakorlati óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-gyakorlati" id="form-row-gyak" type="text"  placeholder="gyakorlati óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-irasbeli" class="col-md-4 col-form-label">Írásbeli:</label>
            <div class="col-md-2">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-irasbeli" type="checkbox"  >
            </div> 
    <div class="col-md-2">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-irasbeli-ora" type="text"  placeholder="szükséges óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szobeli" class="col-md-4 col-form-label">Szóbeli:</label>
            <div class="col-md-2">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-szobeli" type="checkbox"  >
            </div> 
            <div class="col-md-2">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-szobeli-ora" type="text"  placeholder="szükséges óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-gyakorlati" class="col-md-4 col-form-label">Gyakorlati:</label>
            <div class="col-md-2">
                <input class="form-control-plaintext" name="form-row-gyakorlati" id="form-row-gyakorlati" type="checkbox"  >
            </div> 
            <div class="col-md-2">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-gyak-ora" type="text"  placeholder="szükséges óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
       
         <div class="form-group row">
        
             <div onclick="elkuldmodul()" ><input type="button" name="log-form" class="btn col-md-5 btn option-button" value="Felvitel"></div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>



        </div>
    </form>

                    
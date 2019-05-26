<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="row "><h2 class="col-md-12 h2-default">Tananyagegység rögzítése</h2></div>

    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Név:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység megnevezése"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-con" class="col-md-4 col-form-label">Tartalom/témakör:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-con" type="text"  placeholder="Tartalom/témakör">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység témaköre"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
         <div class="form-group row">
            <label for="form-row-mod" class="col-md-4 col-form-label">Modul:</label>
            <div class="col-md-4">
                <select class="form-control" id="form-row-mod">
                    <option>Modul 1</option>
                    <option>Modul 2</option>
                    <option>Modul 3</option>
                    <option>Modul 4</option>
                </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Adja meg, melyik modulhozctartozik!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">Elméleti óraszáma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-elm" type="text"  placeholder="Elméleti óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység elméleti óraszáma"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
		
		<div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">E-learning óraszáma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-elm" type="text"  placeholder="Elméleti óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység e-learning óraszáma (opcionális)"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-gyak" class="col-md-4 col-form-label">Gyakorlati óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-gyak" type="text"  placeholder="Gyakorlati óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység gyakorlati óraszáma"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
       
         <div class="form-group row">
        
             <div onclick="link('modul_in_form')" ><input type="button" name="log-form" class="btn col-md-5 btn option-button" value="Rögzítés!"></div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>



        </div>
    </form>

                    
                    
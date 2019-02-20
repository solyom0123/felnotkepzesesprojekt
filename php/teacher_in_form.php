<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Új személy felvitele</h2>
</div>
<form method="POST" action="./php/login.php" >
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Név:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Adat:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="adat">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Adat1:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="adat">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Adat2:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="adat">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Adat3:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="adat">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Tanítható tananyagegységek:</label>
            <div class="col-md-2">
                <select class="form-control" id="sel1">
                    <option>tananyagegység 1</option>
                    <option>tananyagegység 2</option>
                    <option>tananyagegység 3</option>
                    <option>tananyagegység 4</option>
                </select>
            </div> 
            <div class="col-md-2">
            <a href="index.php?page=teacher_connect_in_form" class="option-button">Hozzáadás</a>
            <a href="" class="option-button">törlés</a>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
    <div class="option-button-wrapper form-group row">


        <a href="index.php?page=basic_datas"><input type="submit" name="log-form" class="btn col-md-5 btn option-button" value="Felvitel"></a>
        <div class="col-md-2"> </div>
        <a href="index.php?page=basic_datas"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></a>


    </div>
</form>


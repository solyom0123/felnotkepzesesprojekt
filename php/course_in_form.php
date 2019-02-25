<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="row "><h2 class="col-md-12 h2-default">Új akkreditált képzés adatai: </h2>


<form >
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Képzés neve:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Képzés neve">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
<div class="form-group row">
        <label for="form-row-azon" class="col-md-4 col-form-label">OKJ azonosítója:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-azon" type="text"  placeholder="OKJ azonosítója">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
<div class="form-group row">
        <label for="form-row-nyil" class="col-md-4 col-form-label">Nyilván tartási száma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-nyil" id="form-row-nyil" type="text"  placeholder="Nyilván tartási száma">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
<div class="form-group row">
        <label for="form-row-alk" class="col-md-4 col-form-label">Alkalmassági vizsga helyszinei:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-alk" id="form-row-alk" type="file"  >
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="option-button-wrapper form-group row">


        <div onclick="link('basic_datas')"><input type="button" name="log-form" class="btn col-md-5 btn option-button" value="Rögzít!"></div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
    
</form>

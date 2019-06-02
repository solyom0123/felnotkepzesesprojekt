<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="row "><h2 class="col-md-12 h2-default">Ütemterv</h2></div>

<form >
    <div class="form-group row">
        <label for="form-row-name" class="col-md-2 col-form-label">Dátum:</label>
        <label for="form-row-name" class="col-md-1 col-form-label">Elmélet óraszáma:</label>
        <label for="form-row-name" class="col-md-1 col-form-label">E-learning óraszáma:</label>
		<label for="form-row-name" class="col-md-1 col-form-label">Gyakorlat óraszáma:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">Modul :</label>
        <label for="form-row-name" class="col-md-3 col-form-label">Tananyagegység:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">Oktató:</label>

    </div>
    <?php for ($index = 0; $index < 40; $index++) {
        
     ?>
    <div class="form-group row">
        <div class="col-md-2">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Dátum">
        </div> 
        <div class="col-md-1">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Elmélet  óraszám">
        </div> 
		<div class="col-md-1">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="E-learning óraszám">
        </div>
        <div class="col-md-1">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Gyakorlat óraszám">
        </div> 
        <div class="col-md-2">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="modul">
        </div> 
        <div class="col-md-3">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="tananyagegység">
        </div> 



        <div class="col-md-2">
            <select class="form-control" id="sel1">
                <option>senki</option>
                
                <option>oktató 1</option>
                <option>oktató 2</option>
                <option>oktató 3</option>
                <option>oktató 4</option>
            </select>
        </div> 
       
    </div>

    <?php }
        
     ?>
    

    <div class="form-group row">

        <div onclick="link('course_start')"><input type="button" name="log-form" class="btn col-md-3 btn option-button" value="Elfogad"></div>
        <div class="col-md-1"></div>
        <div onclick="link('course_start')"><input type="button" name="log-form" class="btn col-md-3 btn option-button" value="Újra generál"></div>
        <div class="col-md-1"></div>
        <div onclick="megsem()"><input type="button" class="btn col-md-3 option-button" value="Mégsem"></div>



    </div>
</form>


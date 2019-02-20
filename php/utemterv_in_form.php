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
        <label for="form-row-name" class="col-md-2 col-form-label">modul elméleti óraszám:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">modul gyakorlati óraszám:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">modul :</label>
        <label for="form-row-name" class="col-md-2 col-form-label"> tananyag- egység:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">oktató:</label>

    </div>
    <?php for ($index = 0; $index < 40; $index++) {
        
     ?>
    <div class="form-group row">
        <div class="col-md-2">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Dátum">
        </div> 
        <div class="col-md-2">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Elméleti óraszám">
        </div> 
        <div class="col-md-2">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Gyakorlati">
        </div> 
        <div class="col-md-2">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="modul">
        </div> 
        <div class="col-md-2">
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

        <a href="index.php?page=course_start"><input type="submit" name="log-form" class="btn col-md-3 btn option-button" value="Elfogad"></a>
        <div class="col-md-1"></div>
        <a href="index.php?page=course_start"><input type="submit" name="log-form" class="btn col-md-3 btn option-button" value="Újra generál"></a>
        <div class="col-md-1"></div>
        <a href="index.php?page=course_start"><input type="button" class="btn col-md-3 option-button" value="Mégsem"></a>



    </div>
</form>


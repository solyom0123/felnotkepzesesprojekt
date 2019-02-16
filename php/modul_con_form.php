<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="row "><h2 class="col-md-12 h2-default">Modul hozzáadása</h2></div>

    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Modul:</label>
            <div class="col-md-2">
                <select  class="form-control" id="sel1">
                    <option>Modul 1</option>
                    <option>Modul 2</option>
                    <option>Modul 3</option>
                    <option>Modul 4</option>
                </select>
            </div> 
            <div class="col-md-2">
            <a href="index.php?page=modul_in_form" class="option-button">Új modul</a>
                
            </div>
                 <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
       
        </div>
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
            <div class="col-md-2">
            <a href="index.php?page=user_in_form" class="option-button">Új oktató</a>
                
            </div>
                 <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
       
            </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Tananyagegységek:</label>
            <div class="col-md-2">
                <select multiple class="form-control" id="sel1">
                    <option>Tananyagegység 1</option>
                    <option>Tananyagegység 2</option>
                    <option>Tananyagegység 3</option>
                    <option>Tananyagegység 4</option>
                </select>
            </div> 
            <div class="col-md-2">
            <a href="index.php?page=cur_unit_in_form" class="option-button">Új tananyagegység</a>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
       
         <div class="form-group row">
        
             <a href="index.php?page=course_start"><input type="submit" name="log-form" class="btn col-md-5 btn option-button" value="Hozzáadás"></a>
        <div class="col-md-2"> </div>
        <a href="index.php?page=course_start"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></a>



        </div>
    </form>

            

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);
?>
<div class="row "><h2 class="col-md-9 h2-default">Bejelentkezés</h2>
    </div>
    <form  >
        <div class="form-group row">
            <label for="log-form-email" class="col-md-3 col-form-label">E-mail:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext" id="name" type="text"  placeholder="user123">
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="form-group row">
            <label for="log-form-ps" class="col-md-3 col-form-label">Jelszó:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext"  id="pass" type="password"  placeholder="Jelszó">
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>  
 </div>
<!--        <div class="form-group row">
            <label for="log-form-r" class="col-sm-3 col-form-label">Nem vagyok robot:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext" name="log-form-r" id="log-form-r" type="checkbox"  >
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>  
        </div>-->
        <div class="form-group row">
        
            
            <div onclick="login('login')" name="log-form" class="btn col-md-4 btn option-button" >Belépés</div>
            <div class="col-md-1"> </div><input type="button" class="btn col-md-4 option-button" value="Elfelejtettem a jelszavam">


        </div>
    </form>
                 
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);
if (isset($_POST["log-form"])) {
    session_start();
    $_SESSION['uid'] = 1;
    $_SESSION['uname'] = $_POST["log-form-email"];
    header("Location: ../index.php?page=main_admin");
} else {
    ?>
<div class="row "><h2 class="col-md-9 h2-default">Bejelentkezés</h2>
    </div>
    <form method="POST" action="./php/login.php" >
        <div class="form-group row">
            <label for="log-form-email" class="col-md-3 col-form-label">E-mail:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext" name="log-form-email" id="log-form-email" type="email"  value="pl@freemail.hu">
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="form-group row">
            <label for="log-form-ps" class="col-md-3 col-form-label">Jelszó:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext" name="log-form-ps" id="log-ps" type="password"  placeholder="Jelszó">
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>  
        </div>
        <div class="form-group row">
            <label for="log-form-r" class="col-sm-3 col-form-label">Nem vagyok robot:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext" name="log-form-r" id="log-form-r" type="checkbox"  >
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>  
        </div>
        <div class="form-group row">
        
            
            <input type="submit" name="log-form" class="btn col-md-4 btn option-button" value="Belépés">
            <div class="col-md-1"> </div><input type="button" class="btn col-md-4 option-button" value="Elfelejtettem jelszavam">


        </div>
    </form>
<?php } ?>                    
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Résztvevő alapadatai</button>
   <?php if(isset($_POST['param'])){ ?>
    <button class="tablinks" onclick="openCity(event, 'edit');getLoginData()" >Résztvevő felhasználói adatai</button>
   <?php } ?> 
</div>
<div id="add" class="tabcontent">

    <div class="row "><h2 class="col-md-12 h2-default">Résztvevő alapadatai</h2>
    </div>
    <?php
    if (isset($_POST['param']) && $_POST['muv'] == "load") {
        echo $_POST['param'];
    } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
        echo $_POST['param'][0];
    }
    ?>
    <form  >
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
            <label for="form-row-szul-nev" class="col-md-4 col-form-label">Születési név:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-szul-nev" id="form-row-szul-nev" type="text"  placeholder="Születési név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy születési nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="form-group row">
            <label for="form-row-anyja-neve" class="col-md-4 col-form-label">Anyja neve:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-anyja-neve" id="form-row-anyja-neve" type="text"  placeholder="Anyja neve">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy anyja nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szul-hely" class="col-md-4 col-form-label">Születési hely:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-szul-hely" id="form-row-szul-hely" type="text"  placeholder="Születési hely">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy születési helyének nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-nem" class="col-md-4 col-form-label">Neme:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-nem" id="form-row-nem" type="text"  placeholder="Neme">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nemének nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szar" class="col-md-4 col-form-label">Állampolgárság:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-szar" id="form-row-szar" type="text"  placeholder="Állampolgárság">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy állampolgárságának nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-phone" class="col-md-4 col-form-label">Telefonszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-phone" id="form-row-phone" type="number"  placeholder="Telefonszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy telefonszámát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-taj" class="col-md-4 col-form-label">TAJ szám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-taj" id="form-row-taj" type="number"  placeholder="TAJ szám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy taj számát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="form-group row">
            <label for="form-row-szulev" class="col-md-12 col-form-label">Születési idő:</label>
        </div>
        <div class="form-group row">
            <label for="form-row-szulev" class="col-md-4 col-form-label">Év:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-szulev" id="form-row-szulev" type="number" min="1900" max=""  placeholder="Év">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy születési idejének évét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szulho" class="col-md-4 col-form-label">Hónap:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-szulho" id="form-row-szulho" type="number" min="1" max="12"  placeholder="Hónap">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy születési idejének havát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szulnap" class="col-md-4 col-form-label">Nap:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-szulnap" id="form-row-szulnap" type="number" min="1" max="31" placeholder="Nap">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy születési idejének napját!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szulev" class="col-md-12 col-form-label">Képzésbevétel napja:</label>
        </div>
        <div class="form-group row">
            <label for="form-row-szulev" class="col-md-4 col-form-label">Év:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-kepev" id="form-row-kepev" type="number" min="1900" max=""  placeholder="Év">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy képzésbevételi idejének évét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szulho" class="col-md-4 col-form-label">Hónap:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-kepho" id="form-row-kepho" type="number" min="1" max="12"  placeholder="Hónap">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy  képzésbevételi idejének havát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szulnap" class="col-md-4 col-form-label">Nap:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-kepnap" id="form-row-kepnap" type="number" min="1" max="31" placeholder="Nap">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy  képzésbevételi  idejének napját!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-lakir" class="col-md-12 col-form-label">Lakóhely:</label>

        </div>
        <div class="form-group row">
            <label for="form-row-lakir" class="col-md-4 col-form-label">Irányító szám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-lakir" id="form-row-lakir" type="number"  placeholder="Irányító szám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy lakhelyének irányítószámát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-lakcity" class="col-md-4 col-form-label">Város:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-lakcity" id="form-row-lakcity" type="text"  placeholder="Város">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy lakhelyének város nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-lakstreet" class="col-md-4 col-form-label">Utca:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-lakstreet" id="form-row-lakstreet" type="text"  placeholder="utca">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő lakhelyének utca nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-lakhs" class="col-md-4 col-form-label">Házszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-lakhs" id="form-row-lakhs" type="number"  placeholder="házszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy lakhelyének házszámt!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-laklp" class="col-md-4 col-form-label">Lépcsőház:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-laklp" id="form-row-laklp" type="text"  placeholder="lépcsőház">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy lakhelyének lépcsőházát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
         <div class="form-group row">
            <label for="form-row-lakcity" class="col-md-4 col-form-label">Végzettség:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-veg" id="form-row-veg" type="text"  placeholder="Végzetség">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy végzettségének nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
          <div class="form-group row">
            <label for="form-row-lakcity" class="col-md-4 col-form-label">Email:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-veg" id="form-row-email" type="email"  placeholder="Email">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy email címét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="option-button-wrapper form-group row">

            <?php
            if (isset($_POST['param']) && $_POST['muv'] == "edit") {
                ?>
                <div onclick="studentEdit(<?= $_POST['param'] ?>)" class="btn col-md-5 btn option-button">Felvitel</div>
                   <div onclick="deleteData(6,<?= $_POST['param'] ?>)"><input type="button" class="btn col-md-5 option-button" value="Törlés"></div>
    
                <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
                <div onclick="studentEdit(<?= $_POST['param'][1] ?>)" class="btn col-md-5 btn option-button">Felvitel</div>
                   <div onclick="deleteData(6,<?= $_POST['param'][1] ?>)"><input type="button" class="btn col-md-5 option-button" value="Törlés"></div>
    
                <?php
            } else {
                ?>
                <div onclick="studentSend()" class="btn col-md-5 btn option-button">Felvitel</div>
                <?php
            }
            ?>

            <div class="col-md-2"> </div>
            <div onclick="megsem();" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


        </div>
    </form>

</div>
<?php if(isset($_POST['param'])){ ?>
<div id="edit" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Résztvevő felhasználói adatai</h2>
    </div>
    <?php
    if (isset($_POST['param']) && $_POST['muv'] == "load") {
        echo $_POST['param'];
    } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
        echo $_POST['param'][0];
    }
    ?>
    <form  >
        <div class="form-group row">
            
            <div class="col-md-4">
                <input type="hidden" name="form-row-uid" id="form-row-uid">
            </div> 

          </div>
        <div class="form-group row">
            
            <label for="form-row-uname" class="col-md-4 col-form-label">Felhasználó név:</label>
            <div class="col-md-4">
                    <div class=" dropup">
                        <div class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                            <input autocomplete="new-password" onkeyup="getUsedName(1)" class="form-control-plaintext" name="form-row-uname" id="form-row-uname" type="text"  placeholder="Név">
                        </div>
                        <div class="dropdown-menu">
                          
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
            <?php        if (isset($_POST['param']) && $_POST['muv'] == "edit") {
                ?>
                <div onclick="sendPassword(<?= $_POST['param'] ?>,1)" class="btn col-md-5 btn option-button">Jelszó küldése</div>
                <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
                <div onclick="sendPassword(<?= $_POST['param'][1] ?>,1)" class="btn col-md-5 btn option-button">Jelszó küldése</div>
            <?php } ?>
                </div>    
            <div class="col-md-1 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy felhasználó nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="option-button-wrapper form-group row">

            <?php
            if (isset($_POST['param']) && $_POST['muv'] == "edit") {
                ?>
                <div onclick="userEdit(<?= $_POST['param'] ?>,1)" class="btn col-md-5 btn option-button">Felvitel</div>
                <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
                <div onclick="userEdit(<?= $_POST['param'][1] ?>,1)" class="btn col-md-5 btn option-button">Felvitel</div>
            <?php } ?>
            <div class="col-md-2"> </div>
            <div onclick="megsem();" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


        </div>
    </form>

</div>
<?php } ?>

<div class="row "><h2 class="col-md-12 h2-default">Új személy felvitele</h2>
</div>
<?php
if(isset($_POST['param'])&&$_POST['muv']=="load"){
    echo $_POST['param'];
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
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
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">
        <label for="form-row-anyja-neve" class="col-md-4 col-form-label">Anyja neve:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-anyja-neve" id="form-row-anyja-neve" type="text"  placeholder="Anyja neve">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-szul-hely" class="col-md-4 col-form-label">Születési hely:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-szul-hely" id="form-row-szul-hely" type="text"  placeholder="Születési hely">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
            <div class="form-group row">
        <label for="form-row-nem" class="col-md-4 col-form-label">Neme:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-nem" id="form-row-nem" type="text"  placeholder="Neme">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-szar" class="col-md-4 col-form-label">Állampolgárság:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-szar" id="form-row-szar" type="text"  placeholder="Állampolgárság">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
       <div class="form-group row">
        <label for="form-row-phone" class="col-md-4 col-form-label">Telefonszám:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-phone" id="form-row-phone" type="text"  placeholder="Telefonszám">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-taj" class="col-md-4 col-form-label">TAJ szám:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-taj" id="form-row-taj" type="text"  placeholder="TAJ szám">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">
        <label for="form-row-szulev" class="col-md-12 col-form-label">Születési idő:</label>
    </div>
        <div class="form-group row">
        <label for="form-row-szulev" class="col-md-4 col-form-label">Év:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-szulev" id="form-row-szulev" type="text"  placeholder="Év">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
        <div class="form-group row">
        <label for="form-row-szulho" class="col-md-4 col-form-label">Hónap:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-szulho" id="form-row-szulho" type="text"  placeholder="Hónap">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-szulnap" class="col-md-4 col-form-label">Nap:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-szulnap" id="form-row-szulnap" type="text"  placeholder="Nap">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">
         <label for="form-row-lakir" class="col-md-12 col-form-label">Lakóhely:</label>
       
        </div>
    <div class="form-group row">
        <label for="form-row-lakir" class="col-md-4 col-form-label">Irányító szám:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-lakir" id="form-row-lakir" type="text"  placeholder="Irányító szám">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-lakcity" class="col-md-4 col-form-label">Város:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-lakcity" id="form-row-lakcity" type="text"  placeholder="Város">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-lakstreet" class="col-md-4 col-form-label">Utca:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-lakstreet" id="form-row-lakstreet" type="text"  placeholder="utca">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-lakhs" class="col-md-4 col-form-label">Házszám:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-lakhs" id="form-row-lakhs" type="text"  placeholder="házszám">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-laklp" class="col-md-4 col-form-label">Lépcsőház:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-laklp" id="form-row-laklp" type="text"  placeholder="lépcsőház">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="option-button-wrapper form-group row">

<?php
if(isset($_POST['param'])&&$_POST['muv']=="edit"){
?>
     <div onclick="studentEdit(<?=$_POST['param']?>)" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
?>
     <div onclick="studentEdit(<?=$_POST['param'][1]?>)" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}else{
?>
     <div onclick="studentSend()" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}
?>

     <div class="col-md-2"> </div>
        <div onclick="megsem();studentList();" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
</form>


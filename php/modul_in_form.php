<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Modul alapadatai</button>
    
</div>
<div id="add" class="tabcontent">
<div class="row "><h2 class="col-md-12 h2-default">Modul alapadatai</h2></div>
<?php
if(isset($_POST['param'])&&$_POST['muv']=="load"){
    echo $_POST['param'];
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
    echo $_POST['param'][0];
}
?>
    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Modul neve:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be az új modul nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
       
        <div class="form-group row">
            <label for="form-row-number" class="col-md-4 col-form-label">Modul azonosítószáma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-number" type="text"  placeholder="Modul szám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a modul azonosító számát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
            <div class="col-md-4">
                <select class="form-control" id="form-row-kepzes">
                    
                    </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válassza ki, melyik képzéshez tartozik a modul!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">Modul elmélet óraszáma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-elm" type="text"  placeholder="elméleti óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Elmélet óraszáma"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-gyak" class="col-md-4 col-form-label">Modul gyakorlati óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-gyakorlati" id="form-row-gyak" type="text"  placeholder="gyakorlati óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Gyakorlat óraszáma"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-irasbeli" class="col-md-4 col-form-label">Írásbeli vizsga:</label>
             <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-irasbeli-ora" type="number" min="0" placeholder="szükséges óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írásbeli vizsga időtartama"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-szobeli" class="col-md-4 col-form-label">Szóbeli vizsga:</label>
            
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-szobeli-ora" type="number" min="0" placeholder="szükséges óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="SZóbeli vizsga időtartama"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-gyakorlati" class="col-md-4 col-form-label">Gyakorlati vizsga:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-gyak-ora" type="number" min="0"  placeholder="szükséges óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Gyakorlati vizsga időtartama"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
       
         <div class="form-group row">
       <?php
if(isset($_POST['param'])&&$_POST['muv']=="edit"){
?>
     <div onclick="modulEdit(<?=$_POST['param']?>)" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
?>
     <div onclick="modulEdit(<?=$_POST['param'][1]?>)" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}else{
?>
     <div onclick="modulSend();" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}
?>
     <div class="col-md-2"> </div>
     <div onclick="megsem();modulList()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>



        </div>
    </form>
</div>
                    
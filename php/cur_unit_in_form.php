<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="row "><h2 class="col-md-12 h2-default">Tananyagegység rögzítése</h2></div>
<?php
if(isset($_POST['param'])&&$_POST['muv']=="load"){
    echo $_POST['param'];
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
    echo $_POST['param'][0];
}
?>
    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Név:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység megnevezése"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-con" class="col-md-4 col-form-label">Tartalom/témakör:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-con" id="form-row-con" type="text"  placeholder="Tartalom/témakör">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység témaköre"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
         <div class="form-group row">
            <label for="form-row-mod" class="col-md-4 col-form-label">Modul:</label>
            <div class="col-md-4">
                <select onclick="modulRefesh(0,'form-row-mod')" class="form-control" id="form-row-kepzes">
            
                </select>
                <select class="form-control" id="form-row-mod">
                  
                </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Adja meg, melyik modulhozctartozik!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">Elméleti óraszáma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-elm" type="text"  placeholder="Elméleti óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység elméleti óraszáma"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
		
		<div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">E-learning óraszáma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-elearn" id="form-row-elearn" type="text"  placeholder="Elméleti óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység e-learning óraszáma (opcionális)"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-gyak" class="col-md-4 col-form-label">Gyakorlati óraszám:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-gyak" id="form-row-gyak" type="text"  placeholder="Gyakorlati óraszám">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Tananyagegység gyakorlati óraszáma"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
       
    
         <div class="form-group row">
       <?php
if(isset($_POST['param'])&&$_POST['muv']=="edit"){
?>
     <div onclick="curunitEdit(<?=$_POST['param']?>)" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
?>
     <div onclick="curunitEdit(<?=$_POST['param'][1]?>)" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}else{
?>
     <div onclick="curunitSend();" class="btn col-md-5 btn option-button">Felvitel</div>
  <?php     
}
?>
     <div class="col-md-2"> </div>
     <div onclick="megsem();"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>



        </div>
    </form>

                    
                    
                    
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Alkalmi tananyagegység alapadatai</button>
    <button class="tablinks" onclick="openCity(event, 'mod1')" >Alkalmi oktató hozzárendelése</button>
    <button class="tablinks" onclick="openCity(event, 'mod2')">Alkalmi oktató eltávolítás</button>

</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 >Alkalmi tananyagegység alapadatai</h2></div>
    <?php
    if (isset($_POST['param']) && $_POST['muv'] == "load") {
        echo $_POST['param'];
    } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
        echo $_POST['param'][0];
    }
    ?>
    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Név:</label>
            <div class="col-md-8">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
            </div> 

                                     
        </div>
        <div class="form-group row">
            <label for="form-row-con" class="col-md-4 col-form-label">Tartalom/témakör:</label>
            <div class="col-md-8">
                <input class="form-control-plaintext" name="form-row-con" id="form-row-con" type="text"  placeholder="Tartalom/témakör">
            </div> 

                                        
        </div>
  
        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">Óraszáma:</label>
            <div class="col-md-8">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-elm" type="text"  placeholder="Elméleti óraszám">
            </div> 

                                        
        </div>
		<div class="list-wrapper2 form-group row">
        <!--<div class="form-group row">-->
            <?php
            if (isset($_POST['param']) && $_POST['muv'] == "edit") {
                ?>
				<div class="col-md-1"> </div>
                <div onclick="bonusunitEdit(<?= $_POST['param'] ?>)" class="btn col-md-3 btn-md btn-info ">Mentés</div>
                         <div class="col-md-1"> </div>
						 <div onclick="deleteData(5,<?= $_POST['param'] ?>)"><input type="button" class="btn col-md-3 btn-md btn-info" value="Törlés"></div>
            
                    <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
				<div class="col-md-1"> </div>
                <div onclick="bonusunitEdit(<?= $_POST['param'][1] ?>)" class="btn col-md-3 btn-md btn-info ">Mentés</div>
                 
				 <div class="col-md-1"> </div>
				 <div onclick="deleteData(5,<?= $_POST['param'][1] ?>)"><input type="button" class="btn col-md-3 btn-md btn-info " value="Törlés"></div>
   
        <?php
            } else {
                ?>
				<div class="col-md-1"> </div>
                <div onclick="bonusunitSend();" class="btn col-md-3 btn-md btn-info ">Mentés</div>
                 <?php
            }
            ?>
            <div class="col-md-1"> </div>
            <div onclick="megsem();"><input type="button" class="btn col-md-3 btn-md btn-info " value="Mégsem"></div>
			<div class="col-md-1"> </div>


        </div>
    </form>
</div>

    
      
        <!-- Tab content -->
        <div id="mod1" class="tabcontent">
              <?php
        if (isset($_POST['param']) && $_POST['muv'] == "edit") {
               
            ?>
            <input type="hidden" class="form-control" id="form-row-anyag" value="<?= $_POST['param'] ?>">
        
                
                <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
            <input type="hidden" class="form-control" id="form-row-anyag" value="<?= $_POST['param'][1] ?>">
   
              <?php
            } else {
                ?>
             <input type="hidden" class="form-control" id="form-row-anyag" value="-1">
                <?php
            }
            ?> 
            <div class="row "><h2 >Alkalmi oktató hozzárendelése</h2></div>
            <div class="form-group row">
                <label for="form-row-name" class="col-md-4 col-form-label">Alkalmi oktatók:</label>
                <div class="col-md-8">
                    <table  id="form-row-without" >

                    </table>
                </div> 
                                            
            </div>

			<div class="list-wrapper2 form-group row">
            <!--<div class="option-button-wrapper form-group row">-->


                <div onclick="connectionSendCur()" class="btn col-md-3 btn-md btn-info ">Összekapcsolás</div>



            </div>
            <div class="form-group row">
                <div onclick="megsem()"><input type="button" class="btn col-md-3 btn-md btn-info " value="Mégsem"></div>


            </div>
			
        </div>
        <div id="mod2" class="tabcontent">
            
            <div class="row "><h2 >Alkalmi oktató leválasztása</h2></div>
            <div class="form-group row">
                <label for="form-row-name" class="col-md-4 col-form-label">Hozzárendelt tananyagegységek:</label>
                <div class="col-md-8">
                    <table  id="form-row-oktato">
                    </table>
                </div>
                                           
            </div>
            <div class="option-button-wrapper form-group row">


                <div onclick="deleteConnectCurUnitAndteacher()"  class="btn col-md-4 btn-md btn-info">Leválasztás</div>





            </div>
            <div class="option-button-wrapper form-group row">


                <div onclick="megsem()" class="btn col-md-4 btn-md btn-info">Mégsem</div>



            </div>
        </div>


   
</div>



<!-- The Modal -->



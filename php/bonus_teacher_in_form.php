<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Alkalmi Oktató alapadatai</button>
    <button class="tablinks" onclick="openCity(event, 'delete')">Alkalmi oktatóhoz rendelt bónusz tanegységek</button>
 </div>
<div id="add" class="tabcontent">

    <div class="row "><h2 class="col-md-12 h2-default"> Alkalmi oktató alapadatai</h2>
    </div>
    <?php
    if (isset($_POST['param']) && $_POST['muv'] == "load") {
        echo $_POST['param'];
    } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
        echo $_POST['param'][0];
    }
    ?>
    <div class="form-group row">
        <div class="col-md-4">
            <input type="hidden"  id="form-row-oktato">

        </div> 
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Név:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="option-button-wrapper form-group row">

        <?php
        if (isset($_POST['param']) && $_POST['muv'] == "edit") {
            ?>
            <div onclick="bonusteacherEdit(<?= $_POST['param'] ?>)" class="btn col-md-5 btn option-button">Felvitel</div>
              <div onclick="deleteData(8,<?= $_POST['param'] ?>)"><input type="button" class="btn col-md-5 option-button" value="Törlés"></div>
    
            <?php
        } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
            ?>
            <div onclick="bonusteacherEdit(<?= $_POST['param'][1] ?>)" class="btn col-md-5 btn option-button">Felvitel</div>
              <div onclick="deleteData(8,<?= $_POST['param'][1] ?>)"><input type="button" class="btn col-md-5 option-button" value="Törlés"></div>
    
            <?php
        } else {
            ?>
            <div onclick="bonusteacherSend()" class="btn col-md-5 btn option-button">Felvitel</div>
            <?php
        }
        ?>
        <div class="col-md-2"> </div>
        <div onclick="megsem();" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
</div>

<div id="delete" class="tabcontent">

    <div class="row "><h2 class="col-md-12 h2-default">Alkalmi oktatóhoz rendelt bónusz tanegységek</h2></div>
    <div class="form-group row">
        <label for="form-row-anyag" class="col-md-4 col-form-label">Hozzárendelt tananyagegységek:</label>
        <div class="col-md-4">
            <table  id="form-row-anyag">
            </table>
        </div>
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    
    <div class="option-button-wrapper form-group row">


        <div onclick="megsem();" ><input type="button" class="btn col-md-12 option-button" value="Mégsem"></div>



    </div>
</div>





<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Oktatóhoz rendelt tanegységek szerkesztése: </h2>
 <?php
    if (isset($_POST['param']) && $_POST['muv'] == "load") {
        echo $_POST['param'];
    } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
        echo $_POST['param'][0];
    }
    ?>

<form >
        
    <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Oktató:</label>
            <div class="col-md-2">
                <select onclick="teacher_cur_unit_List(-2);teacher_cur_unit_List(-3)" class="form-control" id="form-row-oktato">
                </select>
            </div> 
            <div class="col-md-2">
            <div onclick="link('teacher_in_form')"  class="option-button">Új Oktató</div>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
    <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Hozzárendelt tananyagegységek:</label>
            <div class="col-md-2">
                <select onclick="connectionGetWithTwoParameter(-1)" class="form-control" id="form-row-anyag">
                </select>
            </div> 
            <div class="col-md-2">
            <div onclick="deleteConnectteacherAndCurUnit()"  class="option-button">törlés</div>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

    <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">OKTATHATÓ Tananyagegységek:</label>
            <div class="col-md-2">
                <select class="form-control" id="form-row-without" >
                  
                </select>
            </div> 
            <div class="col-md-2">
            <div onclick="link('cur_unit_in_form')" class="option-button">Új Tananyagegység HOZZÁRENDELÉSE</div>
                
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="...!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
    <div class="form-group row">
            <label for="form-row-alk" class="col-md-4 col-form-label">Alkalmasságot igazoló dokumentum:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-alk-name" id="form-row-alk-name" type="text" readonly  value="fájlneve">
                <input type="button" id="fileBtn" value="Fájl feltöltése">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Alkalmasságot igazoló dokumentum betallózása a számítógépről."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

    <div class="option-button-wrapper form-group row">

     
                <div onclick="connectionSend()" class="btn col-md-3 btn option-button">Felvitel</div>
                <div class="col-md-1"> </div>
               
                <div onclick="connectionEdit()" class="btn col-md-3 btn option-button">Szerkesztés</div>
                  <div class="col-md-1"> </div>
            <div  onclick="megsem()"><input type="button" class="btn col-md-3 option-button" value="Mégsem"></div>



    </div>
    
</form>
<!-- The Modal -->
    <div id="fileModal" class="modal">

        <!-- Modal content -->
        <div   class="modal-content">

            <span class="close" id="fileclose">&times;</span>
            <form id="fileMForm" target="__blank" action="server.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="muv" value="upload_file" >
                <div class="form-group row">
                    <label for="form-row-alk" class="col-md-4 col-form-label">Alkalmasságot igazoló dokumentum:</label>
                    <div class="col-md-4">
                        <input class="form-control-plaintext" name="form-row-alk" id="form-row-alk" type="file"  >
                    </div> 

                    <div class="col-md-4 ">
                        <a href="#" data-toggle="tooltip" title="Alkalmasságot igazoló dokumentum betallózása a számítógépről."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
                    </div>                            
                </div>
                <input type="submit" id="filesub" value="Feltölt" name="submit">
            </form>
        </div>

    </div>

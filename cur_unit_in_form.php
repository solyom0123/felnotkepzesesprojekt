<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Tananyagegység alapadatai</button>
    <button class="tablinks" onclick="openCity(event, 'edit')">Tananyagegységhez csatolt dokumentumok</button>

</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 >Tananyagegység alapadatai</h2></div>
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
            <label for="form-row-mod" class="col-md-4 col-form-label">Képzés, modul:</label>
            <div class="col-md-8">
                <select onclick="modulRefesh(0, 'form-row-mod')" class="form-control" id="form-row-kepzes">

                </select>
                <select class="form-control" id="form-row-mod">

                </select>
            </div> 
                                       
        </div>

        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">Elméleti óraszáma:</label>
            <div class="col-md-8">
                <input class="form-control-plaintext" name="form-row-elm" id="form-row-elm" type="text"  placeholder="Elméleti óraszám">
            </div> 

                                        
        </div>

        <div class="form-group row">
            <label for="form-row-elm" class="col-md-4 col-form-label">E-learning óraszáma:</label>
            <div class="col-md-8">
                <input class="form-control-plaintext" name="form-row-elearn" id="form-row-elearn" type="text"  placeholder="Elméleti óraszám">
            </div> 

                                        
        </div>
        <div class="form-group row">
            <label for="form-row-gyak" class="col-md-4 col-form-label">Gyakorlati óraszám:</label>
            <div class="col-md-8">
                <input class="form-control-plaintext" name="form-row-gyak" id="form-row-gyak" type="text"  placeholder="Gyakorlati óraszám">
            </div> 

                                       
        </div>
        <div class="form-group row">
		<div class="col-md-2"> </div>
            <?php
            if (isset($_POST['param']) && $_POST['muv'] == "edit") {
                ?>
                <div onclick="curunitEdit(<?= $_POST['param'] ?>)" class="btn col-md-3 btn btn-md btn-info">Mentés</div>
                <div onclick="deleteData(4,<?= $_POST['param'] ?>)"><input type="button" class="btn col-md-3 btn btn-md btn-info" value="Törlés"></div>
    
                 <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
                <div onclick="curunitEdit(<?= $_POST['param'][1] ?>)" class="btn col-md-3 btn btn-md btn-info">Mentés</div>
                <div onclick="deleteData(4,<?= $_POST['param'][1] ?>)"><input type="button" class="btn col-md-3 btn btn-md btn-info" value="Törlés"></div>
   
                 <?php
            } else {
                ?>
                <div onclick="curunitSend();" class="btn col-md-3 btn btn-md btn-info">Mentés</div>
                <?php
            }
            ?>
            <div class="col-md-1"> </div>
            <div onclick="megsem();"><input type="button" class="btn col-md-3 btn btn-md btn-info" value="Mégsem"></div>



        </div>
    </form>
</div>
<div id="edit" class="tabcontent">
    <div class="row "><h2 >Tananyagegységhez rendelt fájlok</h2>
    </div>

    <div class="form-group row">
        <label for="form-row-file-list" class="col-md-4 col-form-label">Csatolt dokumentumok:</label>
        <div class="col-md-4">
            <table   id="form-row-file-list" name="form-row-file-list" >

            </table>
        </div> 
                                   
    </div>
    <div class="form-group row">
        <label for="form-row-file-upload" class="col-md-4 col-form-label">Csatolandó dokumentumok betöltése:</label>
        <div class="col-md-8">
            <input type="button" id="fileBtn" value="Fájl feltöltése" class="btn col-md-3 btn btn-md btn-info">
        </div> 

                                  
    </div>
    <div class="option-button-wrapper form-group row">

		<div class="col-md-8">
        <div onclick="megsem()" ><input type="button" class="btn col-md-4 btn btn-md btn-info" value="Mégsem"></div>



    </div>
</div>



<!-- The Modal -->

<div id="fileModal" class="modal">

    <!-- Modal content -->


    <div   class="modal-content">

        <span class="close" id="fileclose">&times;</span>
        <form id="fileMForm" target="__blank" action="server.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="form-row-file-id" >
            <input type="hidden" name="type" id="form-row-file-type" >
            <input type="hidden" name="muv" value="upload_file_new" >
            <div class="form-group row">
                <label for="form-row-main-name" class="col-md-4 col-form-label">A válaszott fájl neve:</label>
                <div class="col-md-4">
                    <input class="form-control-plaintext" name="form-row-main-name" id="form-row-main-name" type="text" readonly >
                </div> 

                                            
            </div>

            <div class="form-group row">
                <label for="form-row-file" class="col-md-4 col-form-label">Kapcsolódó dokumentum:</label>
                <div class="col-md-4">
                    <input class="form-control-plaintext" name="form-row-file" id="form-row-file" type="file"  >
                </div> 

                                          
            </div>
			<div class="form-group row">
			<div class="col-md-8"></div>
            <input type="submit" id="filesub" value="Feltölt" name="submit" class="btn col-md-4 btn btn-md btn-info">
			</div>
        </form>
    </div>

</div>



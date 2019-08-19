
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Akkreditált képzés alapadatai</button>
 
</div>
<div id="add" class="tabcontent">
<div class="row "><h2 class="col-md-12 h2-default">Akkreditált képzés alapadatai: </h2>
    <?php
    if (isset($_POST['param']) && $_POST['muv'] == "load") {
        echo $_POST['param'];
    } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
        echo $_POST['param'][0];
    }
    ?>


    <form >
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Képzés neve:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Képzés neve">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Képzés megnevezésének megadása"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-azon" class="col-md-4 col-form-label">OKJ azonosítója:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-azon" type="text"  placeholder="OKJ azonosítója">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="OKJ azonosító megadása"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-nyil" class="col-md-4 col-form-label">Nyilván tartási száma:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-nyil" id="form-row-nyil" type="text"  placeholder="Nyilván tartási száma">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Nyilvántartási szám megadása"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
      
        <div class="form-group row">
            <label for="form-row-alk" class="col-md-4 col-form-label">Alkalmassági vizsga helyszinei:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-alk-name" id="form-row-alk-name" type="text" readonly  value="fájlneve">
                <input type="button" id="fileBtn" value="Fájl feltöltése">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Alkalmassági vizsgahelyszin dokumentumának betallózása a számítógépről."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="form-group row">
            <label for="form-row-kep" class="col-md-4 col-form-label">Hozzárendelt kép:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-kep-name" id="form-row-kep-name" type="text" readonly  value="default.png">
                <input type="button" id="kepBtn" value="Kép feltöltése">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="A kép a képzéshez."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="option-button-wrapper form-group row">

            <?php
            if (isset($_POST['param']) && $_POST['muv'] == "edit") {
                ?>
                <div onclick="courseEdit(<?= $_POST['param'] ?>)" class="btn col-md-5 btn option-button">Felvitel</div>
                <?php
            } else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
                ?>
                <div onclick="courseEdit(<?= $_POST['param'][1] ?>)" class="btn col-md-5 btn option-button">Felvitel</div>
                <?php
            } else {
                ?>
                <div onclick="courseSend()" class="btn col-md-5 btn option-button">Felvitel</div>
                <?php
            }
            ?>            <div class="col-md-2"> </div>
            <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


        </div>

    </form>
</div>





    <!-- The Modal -->
    <div id="kepModal" class="modal">

        <!-- Modal content -->
        <div   class="modal-content">

            <span class="close" id="kepclose">&times;</span>
            <form id="kepMform" target="__blank" action="server.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="muv" value="upload_kep" >
                <div class="form-group row">
                    <label for="form-row-kep" class="col-md-4 col-form-label">Hozzárendelt kép:</label>
                    <div class="col-md-4">
                        <input class="form-control-plaintext" name="form-row-kep" id="form-row-kep" type="file"  >
                    </div> 

                    <div class="col-md-4 ">
                        <a href="#" data-toggle="tooltip" title="A kép a képzéshez."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
                    </div>                            
                </div>
                <input type="submit" id="kepsub" value="Feltölt" name="submit">
            </form>
        </div>

    </div>
<!-- The Modal -->
    <div id="fileModal" class="modal">

        <!-- Modal content -->
        <div   class="modal-content">

            <span class="close" id="fileclose">&times;</span>
            <form id="fileMForm" target="__blank" action="server.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="muv" value="upload_file" >
                <div class="form-group row">
                    <label for="form-row-alk" class="col-md-4 col-form-label">Alkalmassági vizsga helyszinei:</label>
                    <div class="col-md-4">
                        <input class="form-control-plaintext" name="form-row-alk" id="form-row-alk" type="file"  >
                    </div> 

                    <div class="col-md-4 ">
                        <a href="#" data-toggle="tooltip" title="Alkalmassági vizsgahelyszin dokumentumának betallózása a számítógépről."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
                    </div>                            
                </div>
                <input type="submit" id="filesub" value="Feltölt" name="submit">
            </form>
        </div>

    </div>


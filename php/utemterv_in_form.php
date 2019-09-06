<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--<div class="form-group row">
        <label for="form-row-name" class="col-md-2 col-form-label">Dátum:</label>
        <label for="form-row-name" class="col-md-1 col-form-label">Elmélet óraszáma:</label>
        <label for="form-row-name" class="col-md-1 col-form-label">E-learning óraszáma:</label>
                <label for="form-row-name" class="col-md-1 col-form-label">Gyakorlat óraszáma:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">Modul :</label>
        <label for="form-row-name" class="col-md-3 col-form-label">Tananyagegység:</label>
        <label for="form-row-name" class="col-md-2 col-form-label">Oktató:</label>

    </div>
-->
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Aktív képzés adatai</button>
    <button class="tablinks" onclick="startLoadSchedulePlan();openCity(event, 'delete')">Ütemterv</button>
    <button class="tablinks" onclick=" startLoadSchedulePlan();openCity(event, 'bonus')">Bónusz napok</button>
</div>
<div id="alert">
        
    </div>
<div id="add" class="tabcontent">
    
    <div class="row "><h2 class="col-md-12 h2-default">Aktív képzés adatai</h2></div>
    <id style="display: none"></id>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Belső azonosító:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Belső azonosító">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a kívánt belső azonosítót"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzés kiválasztása:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-kepzes" id="form-row-kepzes" type="text"  placeholder="Képzés" readonly>

        </div> 
        <input id="modul_length_of_course" type="hidden" >
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Itt megadhatja az akkreditációban szereplő képzés adatokat"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-start" class="col-md-4 col-form-label">Kezdés dátuma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-start" id="form-row-start"   type="date"  placeholder="ÉÉÉÉ.HH.NN." readonly>
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a képzés kezdő dátumát"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-sign-date" class="col-md-4 col-form-label">Vizsga jelentkezés hatarideje:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-sign-date" id="form-row-sign-date"   type="date"  placeholder="ÉÉÉÉ.HH.NN." readonly>
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Vizsgajelentkezés határideje"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <input class="form-control-plaintext" name="form-row-help-day" id="form-row-help-day" type="hidden" min="0" value="0">
    <div class="form-group row">
        <label for="form-row-exam-date" class="col-md-4 col-form-label">Vizsga időpontja:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-exam-date" id="form-row-exam-date"   type="date"  placeholder="ÉÉÉÉ.HH.NN." >
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a vizsga időpontját"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
            <input class="form-control-plaintext" name="form-row-help-day" id="form-row-help-day" type="hidden" min="0" >

    <div class="form-group row">
        <label  class="col-md-4 col-form-label">Képzési modulok sorrendje :</label>

        <div class="col-md-8 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki a modulok sorrendjét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div id="modul-order-place" >

    </div>
                <div class="form-group row">
        <label  class="col-md-4 col-form-label">Teljesített képzési modulok sorrendje:</label>
        
        <div class="col-md-8 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki a teljesített modulok sorrendjét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div id="finished-modul-order-place" >
        
    </div>
    <div class="form-group row">
        <div onclick="editActiveEducation()"><input type="button" name="log-form" class="btn col-md-12 btn option-button" value="Módosít"></div>
    </div>
      <div class="form-group row">
        <div onclick="backtotheMenu()"><input type="button" class="btn col-md-12 option-button"  value="Mégsem"></div>
    </div>
</div>
<div id="delete" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Ütemterv</h2></div>
<div class="col-md-12 "id="resultTable">
    </div>
    <div class="form-group row">
        <div class="option-button col-md-12" onclick="editschedule(0)" id="pass-btn">Elfogad!</div></a>
    </div>
    <div class="form-group row">
        <div onclick="backtotheMenu()"><input type="button" class="btn col-md-12 option-button"  value="Mégsem"></div>
    </div>
</div>
<div id="bonus" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Bónusznapok</h2></div>


    <div class="col-md-12 alert-info" id="replacementDays">
        <div class="col-md-12">Szabadon használható pótnapok</div>
        <div class="col-md-12" id="replacementDays_headrow">
            <div class="col-md-2">Nap dátuma</div>
            <div class="col-md-2">Naphoz tartozó óraszám</div>
            <div class="col-md-2">Felhasználható tanegységek</div>
            <div class="col-md-2">Felhasználható óraszám</div>
            <div class="col-md-2">Maradék tartaléknapok száma</div> 
            <div class="col-md-2">Hozzáadás</div>

        </div>
        <div class="col-md-12" id="replacementDays_datarow">
            <select  class="col-md-2" onchange="calcReplacementDayHours()"></select>
           <div class="col-md-2"><input type="number" min="0" class="col-md-12"></div>
            <select class="col-md-2" onchange="calcUseableHour()"></select>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"><button onclick="addReplacementDay()">Hozzáadás</button></div>

        </div>

    </div>
    <table class="col-md-12 "id="bonustable">
        <tr><th>dátum</th><th>Tanegység neve</th><th>Modul neve</th><th>Óraszám</th><th>Kezdő</th><th>Vég</th><th>Típus</th><th>Oktató</th></tr>
                    
    </table>
    <div class="form-group row col-md-12">
        <div class="option-button col-md-12" onclick="editschedule(0)" id="pass-btn-b">Elfogad!</div></a>
    </div>
    <div class="form-group row col-md-12">
        <div onclick="backtotheMenu()"><input type="button" class="btn col-md-12 option-button"  value="Mégsem"></div>
    </div>
</div>




<div id="loadModal" class="modal">

    <!-- Modal content -->
    <div   class="modal-content">
        <img src="/img/load.gif" width="200px" height="200px">
        <h3>Kérem várjon, míg az oldal dolgozik!<br>Ne lépjen ki, ne váltson ablakot!<br>Ez az üzenet automatikusan eltűnik a folyamat végén!</h3>
    </div>

</div>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'edit')" id="defaultOpen">Képzési Szerződés</button>
</div>



<div id="edit" class="tabcontent">
     <div class="row "><h2 class="col-md-12 h2-default">Képzési szerződés: </h2></div>
    <div id="alertdiv">
        
    </div>

    <div class="form-group row">
        <label for="form-row-aktiv-kepzes-list" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes-list" onchange="listOptionsWithTargetAndSource(1, 'form-row-student','form-row-aktiv-kepzes-list')">

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez !"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-student" class="col-md-4 col-form-label">Résztvevő:</label>
        <div class="col-md-4">
            <select  id="form-row-student" >
                
            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
  

     <div class="option-button-wrapper form-group row">

       <!-- <div onclick="missingsend()"  class="btn col-md-5 btn option-button">Elküld</div>-->
        <div onclick="startPrinting(13)" id="buttonSend" class="btn col-md-5 btn option-button">Nyomtatás</div>
       <!-- <div class="col-md-2"> </div>-->
        <div onclick="megsem()"><input type="button" class="btn col-md-12 option-button" value="Mégsem"></div>


    </div>
     <div id="help_div" style="display: none"></div>
</div>
<div id="loadModal" class="modal">

        <!-- Modal content -->
        <div   class="modal-content">
            <img src="/img/load.gif" width="200px" height="200px">
            <h3>Kérem várjon, míg az oldal dolgozik!<br>Ne lépjen ki, ne váltson ablakot!<br>Ez az üzenet automatikusan eltűnik a folyamat végén!</h3>
        </div>

    </div>

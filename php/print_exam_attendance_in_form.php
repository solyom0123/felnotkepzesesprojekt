
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Jelenléti ívek nyomtatása adott napra</button>
</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Jelenléti ívek nyomtatása adott napra: </h2></div>
    <div id="alertdiv">
        
    </div>
    
    <div class="form-group row">
        <label for="form-row-aktiv-kepzes" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes" onchange="listOptionsWithTargetAndSource(2, 'form-row-date','form-row-aktiv-kepzes')">

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez szeretne hiányzást felvinni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-date" class="col-md-4 col-form-label">Dátum:</label>
        <div class="col-md-4">
            <select  id="form-row-date" >

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik modulengedélyezné!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    
    <div class="option-button-wrapper form-group row">

        <div onclick="startPrinting(7)" id="buttonSend" class="btn col-md-5 btn option-button">Nyomtatás</div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
    <div id="help_div" style="display: none">
        
    </div>

</div>





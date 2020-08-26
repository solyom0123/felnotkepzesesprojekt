
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Ütemterv nyomtatás</button>
     <button class="tablinks" onclick="openCity(event, 'edit')" id="defaultOpen">Haladási napló nyomtatás</button>
    <button class="tablinks" onclick="openCity(event, 'delete')" id="defaultOpen">Jelenléti ív teljes képzésre vonatkozóan(minden résztvevőnek)</button>
</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Ütemterv nyomtatás: </h2></div>
    <div id="alertdiv">
        
    </div>
    
    <div class="form-group row">
        <label for="form-row-aktiv-kepzes" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes">

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez szeretne hiányzást felvinni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="hour" class="col-md-4 col-form-label">Napi kezdés ideje(óra):</label>
        <div class="col-md-4">
            <input type="number" min="0" max="24"  id="hour">
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a kezdés időpontját!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="option-button-wrapper form-group row">

        <div onclick="startPrinting(3)" id="buttonSend" class="btn col-md-3 btn option-button">Nyomtatás</div>
		<div class="col-md-1"> </div>
		
        <div class="col-md-1"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-3 option-button" value="Mégsem"></div>


    </div>
	<div class="col-md-12" id="div_nyomtatvany">
	
	</div>
    <div id="help_div" style="display: none">
        
    </div>

</div>
<div id="edit" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Haladási Napló nyomtatás: </h2></div>
    <div id="alertdiv">
        
    </div>
    
    <div class="form-group row">
        <label for="form-row-aktiv-kepzes" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes-h" >

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez szeretne hiányzást felvinni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    
    
    <div class="option-button-wrapper form-group row">

        <div onclick="startPrinting(4)" id="buttonSend" class="btn col-md-5 btn option-button">Nyomtatás</div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>

</div>
<div id="delete" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Jelenléti ív teljes képzés időtartamra (minden résztvevőnek)  : </h2></div>
    <div id="alertdiv">

    </div>

    <div class="form-group row">
        <label for="form-row-aktiv-kepzes-list" class="col-md-4 col-form-label">Választható képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes-es">

            </select>
        </div>
        
    </div>


    <div class="option-button-wrapper form-group row">

        <!-- <div onclick="missingsend()"  class="btn col-md-5 btn option-button">Elküld</div>-->
        <div onclick="startPrinting(12)" id="buttonSend" class="btn col-md-3  btn-info">Jelenléti ívek nyomtatása</div>
        <div class="col-md-2"> </div>
		<div onclick="startPrinting(14)" id="buttonSend" class="btn col-md-3 btn-info  ">Sablon jelenléti</div>
		<div class="col-md-1"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-3 btn-info" value="Vissza"></div>


    </div>
    <div id="help_div" style="display: none"></div>
</div>




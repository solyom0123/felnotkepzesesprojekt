
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Hiányzás felvitele</button>
    <button class="tablinks" onclick="openCity(event, 'edit')" id="defaultOpen">Hiányzás listázása</button>
</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Hiányzás felvitele: </h2></div>
    <div id="alertdiv">
        
    </div>

    <div class="form-group row">
        <label for="form-row-aktiv-kepzes" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes" onchange="listOptionsWithTargetAndSource(0, 'form-row-date','form-row-aktiv-kepzes')">

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez szeretne hiányzást felvinni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-date" class="col-md-4 col-form-label">Dátum:</label>
        <div class="col-md-4">
            <select onchange="getMissingTable(0,'mhour','form-row-aktiv-kepzes','form-row-date')" id="form-row-date" >

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik modulengedélyezné!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-ahour" class="col-md-4 col-form-label">Hiányzás táblázat:</label>
        <div class="col-md-4">
            <table id="mhour">
            </table>
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="A hiányzás táblázat az adott napra!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>


    <div class="option-button-wrapper form-group row">

        <div onclick="missingsend(1,1)" id="buttonSend" class="btn col-md-5 btn option-button">Elküld</div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>

</div>



<div id="edit" class="tabcontent">
     <div class="row "><h2 class="col-md-12 h2-default">Hiányzás listázása: </h2></div>
    <div id="alertdiv">
        
    </div>

    <div class="form-group row">
        <label for="form-row-aktiv-kepzes-list" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes-list" onchange="listOptionsWithTargetAndSource(1, 'form-row-student','form-row-aktiv-kepzes-list')">

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez szeretne hiányzást felvinni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-student" class="col-md-4 col-form-label">Diák:</label>
        <div class="col-md-4">
            <select onclick="getMissingTable(1,'mhour-student','form-row-aktiv-kepzes-list','form-row-student')" id="form-row-student" >
                
            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik modulengedélyezné!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-ahour-student" class="col-md-4 col-form-label">Hiányzás táblázat:</label>
        <div class="col-md-4">
            <table id="mhour-student">
            </table>
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="A hiányzás táblázat az adott napra!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>


     <div class="option-button-wrapper form-group row">

       <!-- <div onclick="missingsend()"  class="btn col-md-5 btn option-button">Elküld</div>-->
       <!-- <div class="col-md-2"> </div>-->
        <div onclick="megsem()"><input type="button" class="btn col-md-12 option-button" value="Mégsem"></div>


    </div>
</div>

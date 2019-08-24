<id style="display: none"></id>
<div class="tab">
   
    <button class="tablinks" onclick="startLoadSchedulePlan();openCity(event, 'delete')" id="defaultOpen">Ütemterv</button>
    <button class="tablinks" onclick="openCity(event, 'bonus')">Bónusz napok</button>
</div>

<div id="delete" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Ütemterv</h2></div>
<div class="col-md-12 "id="resultTable">
    </div>
    <div class="form-group row">
       <div class="option-button" onclick="passUpdateschedule(0)">Elfogad!</div>
    </div>
    <div class="form-group row">
         <div class="option-button" onclick="backLoadUpdateschedule()">Módosítás</div>
    </div>
</div>
<div id="bonus" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Bónusznapok</h2></div>


    <div class="col-md-12 alert-info" id="replacementDays">
        <div class="col-md-12">Szabadon használható pótnapok</div>
        <div class="col-md-12" id="replacementDays_headrow">
            <div class="col-md-2">Nap dátuma</div>
            <div class="col-md-2">Óraszám</div>
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
    <div class="col-md-12 "id="bonustable">
    </div>
    <div class="form-group row">
       <div class="option-button" onclick="passUpdateschedule(0)">Elfogad!</div>
   
    </div>
    <div class="form-group row">
          <div class="option-button" onclick="backLoadUpdateschedule()">Módosítás</div>
    </div>
</div>



<div id="loadModal" class="modal">

        <!-- Modal content -->
        <div   class="modal-content">
            <img src="/img/load.gif" width="200px" height="200px">
            <h3>Kérem várjon, míg az oldal dolgozik!<br>Ne lépjen ki, ne váltson ablakot!<br>Ez az üzenet automatikusan eltűnik a folyamat végén!</h3>
        </div>

    </div>

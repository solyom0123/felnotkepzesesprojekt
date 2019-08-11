
<h1 class="col-md-12">Generálás eredménye</h1>
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
    <div class="col-md-2"></div>
    <select class="col-md-2" onchange="calcUseableHour()"></select>
    <div class="col-md-2"></div>
    <div class="col-md-2"></div>
    <div class="col-md-2"><button onclick="addReplacementDay()">Hozzáadás</button></div>
    
    </div>
        
</div>
<div class="col-md-12 "id="resultTable">
</div>
  
 <div class="option-button-wrapper">
     <div class="option-button" onclick="passschedule(0)">Elfogad!</div></a>
 <div class="option-button" onclick="editschedule();deleteEditedSchedule()">Módosít</div></a>
    

    </div>
<div id="loadModal" class="modal">

        <!-- Modal content -->
        <div   class="modal-content">
            <img src="/img/load.gif" width="200px" height="200px">
            <h3>Kérem várjon, míg az oldal dolgozik!<br>Ne lépjen ki, ne váltson ablakot!<br>Ez az üzenet automatikusan eltűnik a folyamat végén!</h3>
        </div>

    </div>

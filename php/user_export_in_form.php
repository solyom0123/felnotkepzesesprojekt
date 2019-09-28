
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Felhasználói adatok kimentése</button>
  </div>
<div id="add" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Felhasználói adatok kimentése: </h2></div>
    <div id="alertdiv">
        
    </div>
    <form action="server.php" target="_blank" method="post">
    <div class="form-group row">
        <input type="hidden" value="exportUser" name="muv">
        <label for="form-row-aktiv-kepzes" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes" name="param">

            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki, melyik aktív képzéshez szeretne exportalast!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-aktiv-kepzes" class="col-md-4 col-form-label">Típusa:</label>
        <div class="col-md-4">
            <select id="form-row-aktiv-kepzes" name="type">
                <option value="0">Összes felhasználó(résztvevő, oktató)</option>
                <option value="1">Résztvevő</option>
                <option value="2">Oktató</option>
            </select>
        </div> 
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Milyen típusú adatot szeretne exportálni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    

    <div class="option-button-wrapper form-group row">

        <input type="submit" id="buttonSend" class="btn col-md-5 btn option-button" value="Felhasználói adatok kimentése">
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
    </form>
</div>




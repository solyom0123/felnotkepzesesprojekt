
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Modul engedélyezése</button>

</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 >Modul engedélyezése: </h2></div>
    <div id="alertdiv">
        
    </div>

    <div class="form-group row">
        <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
        <div class="col-md-8">
            <select id="form-row-kepzes" onclick="modulRefesh(0, 'modul-list')">

            </select>
        </div> 
                                    
    </div>
    <div class="form-group row">
        <label for="form-row-kepzes" class="col-md-4 col-form-label">Modulok:</label>
        <div class="col-md-8">
            <select onclick="getAccessForModul()" id="modul-list" >

            </select>
        </div> 
                                    
    </div>
    <div class="form-group row">
        <label for="form-row-state" class="col-md-4 col-form-label">Modul állapota:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-state" id="form-row-state" type="text" readonly>
        </div> 

                                   
    </div> <div class="form-group row">
        <label for="form-row-state-date" class="col-md-4 col-form-label">Modul állapotának dátuma:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-state" id="form-row-state-date" type="text" readonly>
        </div> 

                                   
    </div>
    <div class="form-group row">
        <label for="form-row-ahour" class="col-md-4 col-form-label">Óraszámok:</label>
        <div class="col-md-4">
            <div id="ahour">
            </div>
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="A modulhoz megadott óraszámok! Vizsgák nélkül!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-exams" class="col-md-4 col-form-label">Vizsgák:</label>
        <div class="col-md-8">
            <div id="exams">
            </div>
        </div> 

                                    
    </div>
    <div class="form-group row">
        <label for="form-row-diff" class="col-md-4 col-form-label">Tanegységekből összesített óraszáma:</label>
        <div class="col-md-8">
            <div id="dbdata">
            </div>
        </div> 

                                   
    </div>


    <div class="option-button-wrapper form-group row">

        <div onclick="modulAccessPass()" id="sendBtnCalc" style="display: none" class="btn col-md-5 btn-md btn-info">Engedélyezés</div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()"><input type="button" class="btn col-md-5 btn-md btn-info" value="Mégsem"></div>


    </div>

</div>





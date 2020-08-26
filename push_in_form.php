<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Modul alapadatai</button>

</div>
<div id="add" class="tabcontent">
    <div class="row "><h2 class="col-md-12 h2-default">Modul alapadatai</h2></div>


    <form >
        <div class="form-group row">

            <div class="form-group row">
                <label for="form-row-aktiv-kepzes-list" class="col-md-4 col-form-label">Aktív Képzések:</label>
                <div class="col-md-4">
                    <select class="form-control" id="form-row-aktiv-kepzes-list">
                    </select>
                </div> 
                <div class="col-md-4 ">
                    <a href="#" data-toggle="tooltip" title="Válassza ki, melyik képzéshez tartozik az üzenet!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
                </div>                            
            </div>
            <label for="form-row-name" class="col-md-4 col-form-label">Üzenet:</label>
            <div class="col-md-4">
                <textarea class=" col-md-4" name="form-row-name" id="form-row-m"   placeholder="Üzenet"></textarea>
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be az üzentet!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

        <div class="form-group row">
            <div onclick="pushSend();" class="btn col-md-5 btn option-button">Felvitel</div>
            <div class="col-md-2"> </div>
            <div onclick="megsem();"><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>



        </div>
    </form>
</div>

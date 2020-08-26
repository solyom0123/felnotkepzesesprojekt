<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Oktató adatok </h2></div>
    <div class="alert alert-warning"><h3> Válasszon oktatót a legördülő listából!</h3></div>


        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Oktató:</label>
            <div class="col-md-4">
                <select onclick="teacher_cur_unit_List(-2);teacher_cur_unit_List(-3)" class="form-control" id="form-row-oktato">
                </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Tananyagegységhez rendelése</button>
            <button class="tablinks" onclick="openCity(event, 'delete')">Tananyagegységtől eltávolítás</button>

        </div>
      
        <!-- Tab content -->
        <div id="add" class="tabcontent">
            <div class="row "><h2 class="col-md-12 h2-default">Tananyagegységhez rendelése</h2></div>
            <div class="form-group row">
                <label for="form-row-name" class="col-md-4 col-form-label">OKTATHATÓ Tananyagegységek:</label>
                <div class="col-md-4">
                    <table  id="form-row-without" >

                    </table>
                </div> 
                <div class="col-md-4 ">
                    <a href="#" data-toggle="tooltip" title="...!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
                </div>                            
            </div>

            <div class="option-button-wrapper form-group row">


                <div onclick="connectionSend()" class="btn col-md-12 btn option-button">HOZZÁRENDELÉS</div>



            </div>
            <div class="form-group row">
                <div onclick="megsem()"><input type="button" class="btn col-md-12 option-button" value="MÉGSEM"></div>


            </div>
        </div>
        <div id="delete" class="tabcontent">
            <div class="row "><h2 class="col-md-12 h2-default">Tananyagegységtől eltávolítás</h2></div>
            <div class="form-group row">
                <label for="form-row-name" class="col-md-4 col-form-label">Hozzárendelt tananyagegységek:</label>
                <div class="col-md-4">
                    <table  id="form-row-anyag">
                    </table>
                </div>
                <div class="col-md-4 ">
                    <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
                </div>                            
            </div>
            <div class="option-button-wrapper form-group row">


                <div onclick="deleteConnectteacherAndCurUnit()"  class="option-button col-md-12">Eltávolítás</div>





            </div>
            <div class="option-button-wrapper form-group row">


                <div onclick="megsem()" class="btn col-md-12 btn option-button">MÉGSEM</div>



            </div>
        </div>


    
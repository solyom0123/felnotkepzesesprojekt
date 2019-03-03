<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Új datum felvitele</h2>
</div>
<form >
    <div class="form-group row">
        <label for="form-row-start" class="col-md-4 col-form-label">Dátum:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-start" id="form-row-start" type="date"  placeholder="kezdete">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    
    <div class="form-group row">
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <input class="option-button col-md-6 " name="form-row-name" id="form-row-name" type="button" value="Tiltás\feloldás" placeholder="adat">
        </div> 
             
    </div>

    <div class="datumdiv">
        <div class="datummain">
    <table class="calendar">
        <caption class="calendar__banner--month">
            <h1> Március</h1>
        </caption>
        <thead>
            <tr>
        
              <th class="calendar__day__header">  Hétfő</th>  
       <th class="calendar__day__header">  Kedd</th>
        <th class="calendar__day__header">  Szerda</th>
         <th class="calendar__day__header">  Csütörtök</th>
          <th class="calendar__day__header">  Péntek</th>
           <th class="calendar__day__header">  Szombat</th>
            <th class="calendar__day__header">  Vasárnap</th>
            </tr>
    </thead>
    <tbody>
        <tr>
            <td class="calendar__day__cell">
            1
            </td>
            
            <td class="calendar__day__cell">
            2
            </td>
             <td class="calendar__day__cell">
            3
             </td>
             <td class="calendar__day__cell">
            4
             </td>
             <td class="calendar__day__cell">
           5
             </td> <td class="calendar__day__cell" data-moon-phase="nyakleves">
                  6
             </td>
             <td class="calendar__day__cell">
            7
             </td>
            
        </tr>
        <tr>
            <td class="calendar__day__cell">
            1
            </td>
            
            <td class="calendar__day__cell">
            2
            </td>
             <td class="calendar__day__cell">
            3
             </td>
             <td class="calendar__day__cell">
            4
             </td>
             <td class="calendar__day__cell">
           5
             </td> <td class="calendar__day__cell" >
                  6
             </td>
             <td class="calendar__day__cell">
            7
             </td>
            
        </tr>
        <tr>
            <td class="calendar__day__cell">
            1
            </td>
            
            <td class="calendar__day__cell">
            2
            </td>
             <td class="calendar__day__cell">
            3
             </td>
             <td class="calendar__day__cell">
            4
             </td>
             <td class="calendar__day__cell">
           5
             </td> <td class="calendar__day__cell" >
                  6
             </td>
             <td class="calendar__day__cell">
            7
             </td>
            
        </tr>
        <tr>
            <td class="calendar__day__cell">
            1
            </td>
            
            <td class="calendar__day__cell">
            2
            </td>
             <td class="calendar__day__cell">
            3
             </td>
             <td class="calendar__day__cell">
            4
             </td>
             <td class="calendar__day__cell">
           5
             </td> <td class="calendar__day__cell" >
                  6
             </td>
             <td class="calendar__day__cell">
            7
             </td>
            
        </tr>
        <tr>
            <td class="calendar__day__cell">
            1
            </td>
            
            <td class="calendar__day__cell">
            2
            </td>
             <td class="calendar__day__cell">
            3
             </td>
             <td class="calendar__day__cell">
            4
             </td>
             <td class="calendar__day__cell">
           5
             </td> <td class="calendar__day__cell" >
                  6
             </td>
             <td class="calendar__day__cell">
            7
             </td>
            
        </tr>

    </tbody>    
    </table>
        </div>
    </div>
    <div class="option-button-wrapper form-group row">


        <div onclick="link('basic_datas')" ><input type="button" name="log-form" class="btn col-md-5 btn option-button" value="Felvitel"></div>
        <div class="col-md-2"> </div>
        <div onclick="megsem()" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>


    </div>
</form>


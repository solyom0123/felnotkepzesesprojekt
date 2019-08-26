<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class="col-md-12 h2-default">Új dátum felvitele</h2>
</div>
<form >
    
    <div class="datumdiv">
        <div class="datummain">
             <input class="form-control-plaintext" name="form-row-akthonap" id="form-row-akthonap" type="hidden"  >
          <div onclick="monthBefore()" class="btn col-md-5 btn option-button">Elöző hónap</div>
          <div class="col-md-2"> </div>
          <div onclick="monthNext()" class="btn col-md-5 btn option-button">Következő hónap</div>
            <table class="calendar" id="calendar">
               <caption  class="calendar__banner--month"><h1 id="calendar_capation_h1">
                  
                   </h1><div id="calendar_capation_okay_button" style="float: right; display: inline-block"></div>
                  </caption><thead><tr><th class="calendar__day__header">  Hétfő</th>
                  <th class="calendar__day__header">  Kedd</th>
                  <th class="calendar__day__header">  Szerda</th>
                  <th class="calendar__day__header">  Csütörtök</th>
                  <th class="calendar__day__header">  Péntek</th>
                  <th class="calendar__day__header">  Szombat</th>
                  <th class="calendar__day__header">  Vasárnap</th>
                  </tr>
                  </thead>
                  <tbody id="calendar_body">
                      
                  </tbody>
    

  
    </table>
          <div class="form-group row">
        <div class="col-md-12">
            <div class="col-md-3"> </div>
        <div onclick="megsem()" ><input type="button" class="btn col-md-5 option-button" value="Mégsem"></div>

        </div> 
             
    </div>

        </div>
    </div>
   
</form>

<!--
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
    
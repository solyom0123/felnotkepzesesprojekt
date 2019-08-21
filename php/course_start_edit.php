
<?php
if(isset($_POST['param'])&&$_POST['muv']=="load"){
    echo $_POST['param'];
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
    echo $_POST['param'][0];
}
?>
<div class="row "><h2 class="col-md-12 h2-default">Képzés(tanfolyam) indítása</h2></div>
<id style="display: none"></id>
<form >
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Belső azonosító:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Belső azonosító">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a kívánt belső azonosítót"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzés kiválasztása:</label>
        <div class="col-md-4">
            <select onchange="modulSelectorsMake()" class="form-control" id="form-row-kepzes">
            
            </select>
        </div> 
        <input id="modul_length_of_course" type="hidden" >
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Itt megadhatja az akkreditációban szereplő képzs adatokat"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-start" class="col-md-4 col-form-label">Kezdés dátuma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-start" id="form-row-start"  onchange="checkEnoughDay()" type="date"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a képzés kezdő dátumát"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-sign-date" class="col-md-4 col-form-label">Vizsga jelentkezés hatarideje:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-sign-date" id="form-row-sign-date"  onchange="checkEnoughDay()" type="date"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Vizsgajelentkezés határideje"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
 
       <div class="form-group row">
        <label for="form-row-exam-date" class="col-md-4 col-form-label">Vizsga időpontja:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-exam-date" id="form-row-exam-date"  onchange="checkEnoughDay()" type="date"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a vizsga időpontját"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
 <!--<div class="form-group row">
        <label for="form-row-machine" class="col-md-4 col-form-label">Tervezett befejezés (gépi kalkuláció):</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-machine" id="form-row-machine" type="date"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title=""><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
  -->
    <div class="form-group row">
        <label for="form-row-help-day" class="col-md-4 col-form-label">Képzésbe bevonható tartalék napok száma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-help-day" id="form-row-help-day" type="number" min="0" >
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a képzéshez hozzárendelhető tartalék napok számát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
   <div class="form-group row">
        <label  class="col-md-4 col-form-label">Képzési modulok sorrendjének beállítása:</label>
        
        <div class="col-md-8 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki a modulok sorrendjét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div id="modul-order-place" >
        
    </div>

<div id="error_place">
    
</div>
    <div class="form-group row">
        <label  class="col-md-4 col-form-label">Elméleti órák beosztása:</label>
        <div class="co-md-5"></div>
        <div class="col-md-1 ">
            <a href="#" data-toggle="tooltip" title="Adja meg az elmélet és a gyakorlati oktatás óraszámait napokra bontva!"><img src="img/help.png" class="img-circle" alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

        <div class="form-group row">
            
            <table class="col-md-12  ">
                <tr class="row">
                    <th class="col-md-3">
                        Nap:
                    </th>
                    <th>
                        <label>Tervezett elmélet:</label>
                    </th>
					<th>
                        <label>Tervezett e-learning időtartam:</label>
                    </th>
                    <th>
                        <label>Gyakorlati oktatás órák:</label>
                    </th>
                </tr>

                <tr class="row">
                    <td class="col-md-3">
                        Hétfő
                    </td>
                    <td>
                        <input id="mon_plan_dec" onchange="checkEnoughDay()" class="" type="number" min="0">
                    </td>
					<td>
                        <input id="mon_el_dec" class="" onchange="checkEnoughDay()" type="number" min="0">
                    </td>
                    <td>
                        <input  id="mon_plan_exe" class="" onchange="checkEnoughDay()" type="number" min="0">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-3">
                        Kedd
                    </td>
                    <td>
                        <input id="tue_plan_dec" class="" onchange="checkEnoughDay()" type="number" min="0">
                    </td>
					<td>
                        <input id="tue_el_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                    </td>
                    <td>
                        <input id="tue_plan_exe"  class="" type="number" min="0" onchange="checkEnoughDay()">
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-md-3">
                        Szerda
                    </td>
                  <td>
                        <input id="wed_plan_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
					<td>
                        <input id="wed_el_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                    </td>
                    <td>
                        <input id="wed_plan_exe" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-md-3">
                        Csütörtök
                    </td>
                  <td>
                        <input id="thu_plan_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                    </td>
					<td>
                        <input id="thu_el_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
                    <td>
                        <input id="thu_plan_exe" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-3">
                        Péntek
                    </td>
                    <td>
                        <input id="fri_plan_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
					<td>
                        <input id="fri_el_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
                     <td>
                        <input id="fri_plan_exe" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-3">
                        Szombat
                    </td>
                    <td>
                        <input id="sat_plan_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
					<td>
                        <input id="sat_el_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
                        <td>
                        <input id="sat_plan_exe" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-3">
                        Vasárnap
                    </td>
                    <td>
                        <input id="sun_plan_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
					<td>
                        <input id="sun_el_dec" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>
                    <td>
                        <input id="sun_plan_exe" class="" type="number" min="0"  onchange="checkEnoughDay()">
                    </td>

                </tr>


            </table>
        </div> 
    <div class="form-group row">
        <div onclick="updateSchedule()" ><input type="button" name="log-form" class="btn col-md-4 btn option-button" value="Szerkesztés"></div>
         <div class="col-md-2"></div>
        <div onclick="gettingupdateStart();setElozo('course_start_edit')" ><input type="button" id="form-row-schedule-button"name="log-form" class="btn col-md-4 btn option-button" value="Szerkesztés és generálás"></div>



    </div>
   <div class="form-group row">
        <div onclick="backtotheMenu()"><input type="button" class="btn col-md-12 option-button"  value="Mégsem"></div>
    </div>


 
</form>

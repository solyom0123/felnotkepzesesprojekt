
<?php
if(isset($_POST['param'])&&$_POST['muv']=="load"){
    echo $_POST['param'];
}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
    echo $_POST['param'][0];
}
?>
<script>setElozo('course_start')</script>
<div class="row "><h2 class="col-md-12 h2-default">Képzés(tanfolyam) indítása</h2></div>

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
        <div class="col-md-2">
            <select class="form-control" id="form-row-kepzes">
            </select>
        </div> 
        <div class="col-md-2">
            <div onclick="link('course_in_form');setElozo('course_start')" class="option-button">Új képzés alapadatainak megadása</div>

        </div>
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Itt megadhatja az akkreditációban szereplő képzs adatokat"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-start" class="col-md-4 col-form-label">Kezdés dátuma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-start" id="form-row-start" type="datetime"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a képzés kezdő dátumát"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-sign-date" class="col-md-4 col-form-label">Vizsga jelentkezés hatarideje:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-sign-date" id="form-row-sign-date" type="datetime"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Vizsgajelentkezés határideje"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
 
       <div class="form-group row">
        <label for="form-row-exam-date" class="col-md-4 col-form-label">Vizsga időpontja:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-exam-date" id="form-row-exam-date" type="datetime"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a vizsga időpontját"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
 <div class="form-group row">
        <label for="form-row-machine" class="col-md-4 col-form-label">Tervezett befejezés (gépi kalkuláció):</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-machine" id="form-row-machine" type="datetime"  placeholder="ÉÉÉÉ.HH.NN.">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title=""><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label  class="col-md-4 col-form-label">Képzési modulok sorrendjének beállítása:</label>
        
        <div class="col-md-8 ">
            <a href="#" data-toggle="tooltip" title="Válassza ki a modulok sorrendjét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div id="modul-order-place">
        
    </div>
    <div class="form-group row">
        <label for="form-row-help-day" class="col-md-4 col-form-label">Képzésbe bevonható tartalék napok száma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-help-day" id="form-row-help-day" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Adja meg a képzéshez hozzárendelhető tartalék napok számát!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">
        <label  class="col-md-4 col-form-label">Elméleti órák beosztása:</label>
        <div class="col-md-5">
            <table class="col-md-12 ">
                <tr class="row">
                    <th class="col-md-6">
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
                    <td class="col-md-6">
                        Hétfő
                    </td>
                    <td>
                        <input id="mon_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="mon_el_dec" class="col-md-3" type="number">
                    </td>
                    <td>
                        <input  id="mon_plan_exe" class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Kedd
                    </td>
                    <td>
                        <input id="tue_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="tue_el_dec" class="col-md-3" type="number">
                    </td>
                    <td>
                        <input id=tue_plan_exe"  class="col-md-6" type="number">
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Szerda
                    </td>
                  <td>
                        <input id="wed_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="wed_el_dec" class="col-md-3" type="number">
                    </td>
                    <td>
                        <input id="wed_plan_exe" class="col-md-6" type="number">
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Csütörtök
                    </td>
                  <td>
                        <input id="thu_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="thu_el_dec" class="col-md-3" type="number">
                    </td>
                    <td>
                        <input id="thu_plan_exe" class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Péntek
                    </td>
                    <td>
                        <input id="fri_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="fri_el_dec" class="col-md-3" type="number">
                    </td>
                     <td>
                        <input id="fri_plan_exe" class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Szombat
                    </td>
                    <td>
                        <input id="sat_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="sat_el_dec" class="col-md-3" type="number">
                    </td>
                        <td>
                        <input id="sat_plan_exe" class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Vasárnap
                    </td>
                    <td>
                        <input id="sun_plan_dec" class="col-md-3" type="number">
                    </td>
					<td>
                        <input id="sun_el_dec" class="col-md-3" type="number">
                    </td>
                    <td>
                        <input id="sun_plan_exe" class="col-md-6" type="number">
                    </td>

                </tr>


            </table>
        </div> 

        <div class="col-md-1 ">
            <a href="#" data-toggle="tooltip" title="Adja meg az elmélet és a gyakorlati oktatás óraszámait napokra bontva!"><img src="img/help.png" class="img-circle" alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
  
    <div class="form-group row">

        <div class="col-md-2"></div>   
        <div onclick="startCourse();setElozo('course_start')" ><input type="button" name="log-form" class="btn col-md-8 btn option-button" value="Tanfolyam ütemezés előzetes tervezése"></div>



    </div>
</form>

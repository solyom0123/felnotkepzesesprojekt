<?php
if (isset($_POST['param']) && $_POST['muv'] == "load") {
    echo $_POST['param'];
} else if (isset($_POST['param']) && $_POST['muv'] == "editafter") {
    echo $_POST['param'][0];
}
?>
<div class="row "><h2 class="col-md-12 h2-default">Képzés(tanfolyam) indítása</h2></div>
<id style="display: none"></id>
<form>
    <div id="loadedSc">

    </div>

    <div class="form-group row">
        <label for="form-row-sema" class="col-md-4 col-form-label">Betölthető már mentett aktív képzések:</label>
        <div class="col-md-8">
            <select onchange="backloadActiveEduSchema()" class="form-control-plaintext" name="form-row-sema"
                    id="form-row-sema">

            </select>
        </div>

    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Belső azonosító:</label>
        <div class="col-md-8">
            <div class=" dropup col-md-12">
                <div class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                    <input autocomplete="new-password" onkeyup="getUsedName(2)" class="form-control-plaintext"
                           name="form-row-name" id="form-row-name" type="text" placeholder="Név">
                </div>
                <div class="dropdown-menu col-md-12">

                </div>
            </div>
        </div>


    </div>
    <div class="form-group row">
        <label for="form-row-kepzes" class="col-md-4 col-form-label">Képzés kiválasztása:</label>
        <div class="col-md-4">
            <select onchange="modulSelectorsMake()" class="form-control" id="form-row-kepzes">

            </select>
        </div>
        <input id="modul_length_of_course" type="hidden">

    </div>
    <div class="form-group row">
        <label for="form-row-start" class="col-md-4 col-form-label">Kezdés dátuma:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-start" id="form-row-start" onchange="checkEnoughDay()"
                   type="date" placeholder="ÉÉÉÉ.HH.NN.">
        </div>

    </div>
    <div class="form-group row">
        <label for="form-row-sign-date" class="col-md-4 col-form-label">Vizsga jelentkezés hatarideje:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-sign-date" id="form-row-sign-date"
                   onchange="checkEnoughDay()" type="date" placeholder="ÉÉÉÉ.HH.NN.">
        </div>


    </div>

    <div class="form-group row">
        <label for="form-row-exam-date" class="col-md-4 col-form-label">Vizsga időpontja:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-exam-date" id="form-row-exam-date"
                   onchange="checkEnoughDay()" type="date" placeholder="ÉÉÉÉ.HH.NN.">
        </div>


    </div>
    <div class="form-group row">
        <label for="form-row-exam-date" class="col-md-4 col-form-label">Gyakorlat tiltás kezdőnap:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-pract-ban-start-date" id="form-row-pract-ban-start-date"
                   onchange="checkEnoughDay()" type="date" placeholder="ÉÉÉÉ.HH.NN." value="1990-01-01">
        </div>


    </div>
    <div class="form-group row">
        <label for="form-row-exam-date" class="col-md-4 col-form-label">Gyakorlat tiltás vége:</label>
        <div class="col-md-8">
            <input class="form-control-plaintext" name="form-row-pract-ban-end-date" id="form-row-pract-ban-end-date"
                   onchange="checkEnoughDay()" type="date" placeholder="ÉÉÉÉ.HH.NN." value="1990-01-01">
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
    <input class="form-control-plaintext" name="form-row-help-day" id="form-row-help-day" type="hidden" min="0"
           value="0">
    <div class="form-group row">
        <label class="col-md-8 col-form-label">Képzési modulok sorrendjének beállítása:</label>


    </div>
    <div id="modul-order-place">

    </div>
    <div class="form-group row">
        <label class="col-md-8 col-form-label">Teljesített képzési modulok sorrendjének beállítása:</label>


    </div>
    <div id="finished-modul-order-place">

    </div>
    <div id="error_place">

    </div>
    <div class="form-group row">
        <label class="col-md-8 col-form-label">Oktatási órák beosztása:</label>
        <div class="co-md-5"></div>

    </div>

    <div class="form-group row">

        <table>
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
                    <input id="mon_plan_exe" class="" onchange="checkEnoughDay()" type="number" min="0">
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
                    <input id="tue_plan_exe" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
            </tr>
            <tr class="row">
                <td class="col-md-3">
                    Szerda
                </td>
                <td>
                    <input id="wed_plan_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="wed_el_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="wed_plan_exe" class="" type="number" min="0" onchange="checkEnoughDay()">
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
                    <input id="thu_el_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="thu_plan_exe" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>

            </tr>
            <tr class="row">
                <td class="col-md-3">
                    Péntek
                </td>
                <td>
                    <input id="fri_plan_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="fri_el_dec" class="" type="num" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="fri_plan_exe" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>

            </tr>
            <tr class="row">
                <td class="col-md-3">
                    Szombat
                </td>
                <td>
                    <input id="sat_plan_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="sat_el_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="sat_plan_exe" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>

            </tr>
            <tr class="row">
                <td class="col-md-3">
                    Vasárnap
                </td>
                <td>
                    <input id="sun_plan_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="sun_el_dec" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>
                <td>
                    <input id="sun_plan_exe" class="" type="number" min="0" onchange="checkEnoughDay()">
                </td>

            </tr>


        </table>
    </div>
    <!-- <div class="form-group row">
           <label  class="col-md-4 col-form-label">Órarend a tervezett napok szerint:</label>
           <div class="co-md-5"></div>
           <div class="col-md-1 ">
               <a href="#" data-toggle="tooltip" title="Adja meg az elmélet és a gyakorlati oktatás óraszámait napokra bontva!"><img src="img/help.png" class="img-circle" alt="Súgó" width="15" height="15"></a>
           </div>
       </div>
      <div class="form-group row">

               <table class="col-md-12  ">


                   <tbody id="timetable"></tbody>


               </table>
           </div>-->
    <div class="form-group row">
        <div onclick="saveSchedule()"><input type="button" name="log-form" class="btn col-md-4 btn btn-block btn-info"
                                             value="Mentés"></div>
        <div class="col-md-2"></div>
        <div onclick="gettingStart();setElozo('course_start')"><input type="button" style="display: none"
                                                                      id="form-row-schedule-button" name="log-form"
                                                                      class="btn col-md-4 btn option-button"
                                                                      value="Mentés és generálás"></div>


    </div>


</form>

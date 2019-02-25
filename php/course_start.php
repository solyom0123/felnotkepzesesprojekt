<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script>setElozo('course_start')</script>
<div class="row "><h2 class="col-md-12 h2-default">Tanfolyam indítása</h2></div>

<form >
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Belső azonosító:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Képzés:</label>
        <div class="col-md-2">
            <select class="form-control" id="sel1">
                <option>Képzés 1</option>
                <option>Képezés 2</option>
                <option>Képzés 3</option>
                <option>Képzés 4</option>
            </select>
        </div> 
        <div class="col-md-2">
            <div onclick="link('course_in_form');setElozo('course_start')" class="option-button">Új képzés</div>

        </div>
        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Kezdés:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Vizsga jelentkezes hatarido:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
 
       <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Vizsga idopontja:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
 <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Gépi kalkulált befejezés:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Modulok sorrendje:</label>
        
        <div class="col-md-8 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">1.</label>
            <div class="col-md-4">
                <select  class="form-control" id="sel1">
                    <option>Modul 1</option>
                    <option>Modul 2</option>
                    <option>Modul 3</option>
                    <option>Modul 4</option>
                </select>
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">2.</label>
            <div class="col-md-4">
                <select  class="form-control" id="sel1">
                    <option>Modul 1</option>
                    <option>Modul 2</option>
                    <option>Modul 3</option>
                    <option>Modul 4</option>
                </select>
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">3.</label>
            <div class="col-md-4">
                <select  class="form-control" id="sel1">
                    <option>Modul 1</option>
                    <option>Modul 2</option>
                    <option>Modul 3</option>
                    <option>Modul 4</option>
                </select>
            </div>
            
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        
        <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">4.</label>
            <div class="col-md-4">
                <select  class="form-control" id="sel1">
                    <option>Modul 1</option>
                    <option>Modul 2</option>
                    <option>Modul 3</option>
                    <option>Modul 4</option>
                </select>
            </div>
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>

    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Tartalék napok száma:</label>
        <div class="col-md-4">
            <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
        </div> 

        <div class="col-md-4 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Elmélet beosztás:</label>
        <div class="col-md-5">
            <table class="col-md-12 ">
                <tr class="row">
                    <th class="col-md-6">
                        Nap:
                    </th>
                    <th class="col-md-6">
                        Tervezett óraszám:
                    </th>

                </tr>

                <tr class="row">
                    <td class="col-md-6">
                        Hétfő
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Kedd
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Szerda
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Csütörtök
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Péntek
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Szombat
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Vasárnap
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>


            </table>
        </div> 

        <div class="col-md-1 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle" alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>
    <div class="form-group row">
        <label for="form-row-name" class="col-md-4 col-form-label">Gyakorlat beosztás:</label>
        <div class="col-md-5">
            <table class="col-md-12 ">
                <tr class="row">
                    <th class="col-md-6">
                        Nap:
                    </th>
                    <th class="col-md-6">
                        Tervezett óraszám:
                    </th>

                </tr>

                <tr class="row">
                    <td class="col-md-6">
                        Hétfő
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Kedd
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Szerda
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Csütörtök
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Péntek
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Szombat
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>
                <tr class="row">
                    <td class="col-md-6">
                        Vasárnap
                    </td>
                    <td>
                        <input class="col-md-6" type="number">
                    </td>

                </tr>


            </table>
        </div> 

        <div class="col-md-1 ">
            <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy nevét!"><img src="img/help.png" class="img-circle" alt="Súgó" width="15" height="15"></a>
        </div>                            
    </div>

    <div class="form-group row">

        <div class="col-md-2"></div>   
        <div onclick="link('utemterv_in_form');setElozo('course_start')" ><input type="button" name="log-form" class="btn col-md-8 btn option-button" value="Tanfolyam ütemezés előzetes tervezése"></div>



    </div>
</form>

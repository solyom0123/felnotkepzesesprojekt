<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

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
            <a href="index.php?page=course_in_form" class="option-button">Új képzés</a>
                
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
            <label for="form-row-name" class="col-md-4 col-form-label">Befejezés:</label>
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
            <label for="form-row-name" class="col-md-4 col-form-label">Moduljai:</label>
            <div class="col-md-2">
                <select multiple class="form-control" id="sel1">
                    <option>Modul 1- Oktató 1</option>
                    <option>Modul 2- oktató 2</option>
                    <option>Modul 3- oktató 3</option>
                    <option>Modul 4- oktató 4</option>
                </select>
            </div> 
            <div class="col-md-1">
            <a href="index.php?page=modul_con_form" class="option-button">Modul hozzárendelés</a>
                
            </div>
            <div class="col-md-1 ">
                <p class="option-button">Kijelölt modul törlése</p>
                
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
             <a href="index.php?page=result"><input type="submit" name="log-form" class="btn col-md-8 btn option-button" value="Tanfolyam ütemezés előzetes tervezése"></a>
      


        </div>
    </form>

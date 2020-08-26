
 <div class="col-md-12">
 <div class="col-md-9">
<form>

	<!--<button class="tablinks" style="display:none" onclick="openCity(event, 'add')" >Vizsga eredmények rögzítése</button>
    <button class="tablinks" style="display:none" onclick="openCity(event, 'edit')" >Vizsga eredmények listázása személyenként</button> onclick="openCity(event, 'delete')"-->
    
<div >
     <div class="row "><h2 >Modulzáró vizsgák - összesítő adatlapok: </h2></div>
    
	

        
    </div>

    <div class="form-group row">
        <label for="form-row-aktiv-kepzes-list" class="col-md-4 col-form-label">Aktív Képzések:</label>
        <div class="col-md-4">
           <!-- <select id="form-row-aktiv-kepzes-es" onchange="getMissingTable(7,'eshour','form-row-aktiv-kepzes-es','0')">-->
			<select id="form-row-aktiv-kepzes-es">
				
            </select>
        </div> 
                                    
    </div>
    <div id="div_nyomtatvany" class="form-group">
       

         
        
    </div>
     

	
	
    

</form>
</div>


     <div class="col-md-3 form-group row">
		<!--<div class="col-md-1"></div>-->
       <!-- <div onclick="missingsend()"  class="btn col-md-5 btn option-button">Elküld</div>-->
        <div onclick="nyomtat_sablon()" id="" class="btn col-md-3 btn-info btn-block">Képernyőre!</div>
       <!--<div class="col-md-1"> </div>-->
	   <div onclick="exportHTML()" id="" class="btn col-md-3 btn-info btn-block ">Word Dokumentum</div>
	   
       <!--<div class="col-md-1"> </div>-->
        <div onclick="megsem()"><input type="button" class="btn col-md-3 btn-block btn-info" value="Mégsem"></div>
		<!--<div class="col-md-1"></div>-->
		
		






    </div>
</div>





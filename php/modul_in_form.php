<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<!--<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen">Modul alapadatai</button>
    
</div>

<div id="add" class="tabcontent">-->
	<div ><h2 >Modul alapadatai</h2></div>
		<?php
		if(isset($_POST['param'])&&$_POST['muv']=="load"){
			echo $_POST['param'];
		}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
			echo $_POST['param'][0];
		}
		?>
	<form >
		<div class="col-md-9">
    
	
			<div class="form-group row">
				<label for="form-row-name" class="col-md-4 col-form-label">Modul neve:</label>
				<div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Név">
				</div> 

									 
			</div>
       
			<div class="form-group row">
				<label for="form-row-number" class="col-md-4 col-form-label">Modul azonosítószáma:</label>
				<div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-name" id="form-row-number" type="text"  placeholder="Modul szám">
				</div> 

			</div>
		
			<div class="form-group row">
				<label for="form-row-kepzes" class="col-md-4 col-form-label">Képzések:</label>
				<div class="col-md-4">
					<select class="form-control" id="form-row-kepzes">
						
						</select>
				</div> 
										 
			</div>
        
			<div class="form-group row">
				<label for="form-row-elm" class="col-md-4 col-form-label">Modul elméleti óraszáma:</label>
				<div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-elm" id="form-row-elm" type="text"  placeholder="elméleti óraszám">
				</div> 

									   
			</div>
			<div class="form-group row">
				<label for="form-row-gyak" class="col-md-4 col-form-label">Modul gyakorlati óraszám:</label>
				<div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-gyakorlati" id="form-row-gyak" type="text"  placeholder="gyakorlati óraszám">
				</div> 

										   
			</div>
			<div class="form-group row">
				<label for="form-row-irasbeli" class="col-md-4 col-form-label">Írásbeli vizsga óraszáma:</label>
				 <div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-elm" id="form-row-irasbeli-ora" type="number" min="0" placeholder="szükséges óraszám">
				</div> 

										 
			</div>
			<div class="form-group row">
				<label for="form-row-szobeli" class="col-md-4 col-form-label">Szóbeli vizsga óraszáma:</label>
				
				<div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-elm" id="form-row-szobeli-ora" type="number" min="0" placeholder="szükséges óraszám">
				</div> 

									   
			</div>
			<div class="form-group row">
				<label for="form-row-gyakorlati" class="col-md-4 col-form-label">Gyakorlati vizsga óraszáma:</label>
				<div class="col-md-4">
					<input class="form-control-plaintext" name="form-row-elm" id="form-row-gyak-ora" type="number" min="0"  placeholder="szükséges óraszám">
				</div> 

										  
			</div>
        
		</div>   
         
		<div class="col-md-3">
			   <?php
				if(isset($_POST['param'])&&$_POST['muv']=="edit"){
				?>
			<div class="col-md-12"></div>
			 <div onclick="modulEdit(<?=$_POST['param']?>)" class="btn col-md-4 btn btn-md btn-info btn-block">Mentés</div>
			 <div class="col-md-12"></div>
			 <div onclick="deleteData(3,<?= $_POST['param'] ?>)"><input type="button" class="btn col-md-4 btn-md btn-info btn-block" value="Törlés"></div>
				 <?php     
				}else if(isset($_POST['param'])&&$_POST['muv']=="editafter"){
				?>
				<div class="col-md-12"></div>
			 <div onclick="modulEdit(<?=$_POST['param'][1]?>)" class="btn col-md-4 btn btn-md btn-info btn-block">Mentés</div>
			 <div class="col-md-12"></div>
			 <div onclick="deleteData(3,<?= $_POST['param'][1] ?>)"><input type="button" class="btn col-md-4 btn-info btn-md btn-block " value="Törlés"></div>
				  <?php     
				}else{
				?>
				<div class="col-md-12"></div>
			 <div onclick="modulSend();" class="btn col-md-4 btn btn-md btn-info btn-block">Mentés</div>
				  <?php     
				}
				?>
			 <div class="row"></div>
			 <div class="col-md-12"></div>
			 <div onclick="megsem();modulList()"><input type="button" class="btn col-md-4 btn-md btn-info btn-block" value="Mégsem"></div>



		</div>
	</form>		
<!--</div>-->

                    
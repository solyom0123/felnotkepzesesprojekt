
<h2 class="h2">Képzésben résztvevők névsora</h2>
<form >
<div class="col-md-9">
    <div class="row col-md-12 list-wrapper">
        <ul id="list_items">
           <?php echo $_POST['param'];?>
        </ul>





        <div id="pagenerButtons"></div>
    </div>
 </div>   
<div class="col-md-3">

		<button type="button" class="btn btn-info btn-lg btn-block" onclick="megsem()">Vissza</button>
		<button type="button" class="btn btn-info btn-lg btn-block" onclick="studentGet();setElozo('student_r_list')">Megmutat!</button>
        <button type="button" class="btn btn-info btn-lg btn-block" onclick="link('user_in_form');setElozo('student_r_list')">Új résztvevő</button>
    <!--<div class="col-md-12 list-wrapper ">
        <div onclick="studentGet();setElozo('student_r_list')" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('user_in_form');setElozo('student_r_list')" ><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégsem</div></div>


    </div>-->
	</div>
</form>

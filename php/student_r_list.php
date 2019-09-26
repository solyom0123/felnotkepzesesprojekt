
<h2 class="h2-default">Résztvevők névsora</h2>
<form >
    <div class="row col-md-12 list-wrapper">
        <ul id="list_items">
           <?php echo $_POST['param'];?>
        </ul>






    </div>

    <div class="col-md-12 list-wrapper ">
        <div onclick="studentGet();setElozo('student_r_list')" ><div class="col-md-4 option-button">Kiválasztás</div></div>
        <div onclick="link('user_in_form');setElozo('student_r_list')" ><div class="col-md-4 option-button">Új hozzáadása</div></div>
        
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégsem</div></div>


    </div>
</form>

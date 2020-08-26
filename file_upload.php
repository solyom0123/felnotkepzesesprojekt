<?php

 
     
?>
<style>

</style>

<!-- Trigger/Open The Modal -->
<button id="kepBtn">Kép feltöltése</button>
  <div class="form-group row">
            <label for="form-row-name" class="col-md-4 col-form-label">Képzés neve:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  placeholder="Képzés neve">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Képzés megnevezésének megadása"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
<!-- The Modal -->
<div id="kepModal" class="modal">

  <!-- Modal content -->
  <div   class="modal-content">
    
    <span class="close">&times;</span>
    <form target="_blan" action="../server.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="muv" value="upload_kep" >
         <div class="form-group row">
            <label for="form-row-kep" class="col-md-4 col-form-label">Hozzárendelt kép:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-kep" id="form-row-kep" type="file"  >
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="A kép a képzéshez."><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <input type="submit" value="Feltölt" name="submit">
    </form>
  </div>

</div>
<script>
var modal = document.getElementById("kepModal");

// Get the button that opens the modal
var btn = document.getElementById("kepBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

</script>
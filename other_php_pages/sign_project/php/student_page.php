<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script>
var hungarian_titles=new Array(
    "Kérem válasszon résztvevőt!  Mégse gombbal léphet vissza az előző menübe!","Résztvevők:","Mégsem"
);

var english_titles=new Array(
    "Please choose a participant! You can go back to the previous menu with 'Back' button!","Participants:","Back"
);


function setText(){
    document.getElementById("command").innerHTML=act_l[0];
    document.getElementById("list_title").innerHTML=act_l[1];
    
    document.getElementById("back").innerHTML=act_l[2];
}
changeL(ACT_L_ID)
</script>
<div class="col-sm-12">
   <button class="button  bg-primary col-sm-12" onclick="megsem()" ><div id="back"></div></button>
    </div>
<div id="country" class="col-sm-12">
    <div class="col-sm-6" onclick="changeL(0)"><img src="./img/hun_flag.jpg" class="flag"></div>
    <div class="col-sm-6" onclick="changeL(1)"><img src="./img/eng_flag.jpg" class="flag"></div>
</div>
<div id="command" class="col-sm-12 alert alert-info"></div>
<div id="list_title" class="col-sm-12"></div>
<div id="list_items" class="container-fluid">
</div>
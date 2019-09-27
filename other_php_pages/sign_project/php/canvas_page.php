<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script>
var hungarian_titles=new Array(
    "Kérem írjon alá a fekete keretes területre! Utána nyomja meg a zöld gombot! Mégse gombbal léphet vissza az előző menübe!","Aláírás helye:","Mégsem","Rajz eltűntetése"
);

var english_titles=new Array(
    "Please sign your name in black bordered area! Then press green button! You can go back to the previous menu with 'Back' button!","Sign your name here:","Back","Clear drawing panel"
);

function setText(){
    document.getElementById("command").innerHTML=act_l[0];
    document.getElementById("list_title").innerHTML=act_l[1];
    
    document.getElementById("back").innerHTML=act_l[2];
    document.getElementById("clearCanvasSimple").innerHTML=act_l[3];
}
changeL(ACT_L_ID);
</script>
<div class="col-sm-12">
    <button class="button  bg-primary col-sm-6" onclick="megsem()" ><div id="back"></div></button>
    <div class="button col-sm-6" onclick="send()"id="sendBtnGreen" ><img src="./img/check_button_green.png" width="50px" height="50px"></div>
</div>
<div id="country" class="col-sm-12">
    <div class="col-sm-6" onclick="changeL(0)"><img src="./img/hun_flag.jpg" class="flag"></div>
    <div class="col-sm-6" onclick="changeL(1)"><img src="./img/eng_flag.jpg" class="flag"></div>
</div>
<form style="display: none" action="server.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="student" id="student">
    <input type="file" name="img" id="img">
    <input type="submit" id="sendSign" name="sendBtn">
</form>
<div id="command" class="col-sm-12 alert alert-info"></div>
<div id="list_title" class="col-sm-12"></div>
<button id="clearCanvasSimple" class="button bg-danger col-sm-12"></button>
<canvas id="canvaskem" style="border: #000 double 1px;height: 80%" >
    
</canvas>
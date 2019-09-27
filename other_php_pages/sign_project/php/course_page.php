<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script>
var hungarian_titles=new Array(
    "Kérem válasszon képzést!  Mégse gombbal léphet vissza az előző menübe!","Képzések:","Mégsem"
);

var english_titles=new Array(
    "Please choose a course! You can go back to the previous menu with 'Back' button!","Courses:","Back"
);
function setText(){
    document.getElementById("command").innerHTML=act_l[0];
    document.getElementById("list_title").innerHTML=act_l[1];
    
}
changeL(ACT_L_ID)
</script>
<div id="country" class="col-sm-12">
    <div class="col-sm-6" onclick="changeL(0)"><img src="./img/hun_flag.jpg" class="flag"></div>
    <div class="col-sm-6" onclick="changeL(1)"><img src="./img/eng_flag.jpg" class="flag"></div>
</div>
<div id="command" class="col-sm-12 alert alert-info"></div>
<div id="list_title" class="col-sm-12"></div>

<div id="list_items" class="container">
    
    <!--
   <div class="card_st" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
       <img class="card-img-top" src="./img/img_avatar1.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
    <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
   <div class="card" style="width:200px" onclick="getStudent(0);setElozo('course_page')">
        <img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Teszt kártya</h4>
      <p class="card-text">Xy képzés</p>
    </div>
  </div>
  -->
</div>
<?php
session_start();
//$_SESSION['page']= isset()$_GET["page"];
//$page= $_SESSION['page'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <title>Corvin KÖZ Oktatási központ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="schortcut" type="image/png" href="./img/logo_icon.PNG">
       <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript" src="./js/bootstrap.js"></script>
        <!--<script type="text/javascript" src="./js/other/navigation.js"></script>
        <script type="text/javascript" src="./js/controller/felvitel.js"></script>
        <script type="text/javascript" src="./js/other/course.js"></script>
        <script type="text/javascript" src="./js/other/cur_unit.js"></script>
        <script type="text/javascript" src="./js/other/modul.js"></script>
        <script type="text/javascript" src="./js/other/student.js"></script>
        <script type="text/javascript" src="./js/other/teacher.js"></script>
        <script type="text/javascript" src="./js/other/curseStart.js"></script>
        <script type="text/javascript" src="./js/other/schedule_global_vars.js"></script>
        <script type="text/javascript" src="./js/model/Aktiv_Kepzes_Model.js"></script>
        <script type="text/javascript" src="./js/model/Kepzes_Model.js"></script>
        <script type="text/javascript" src="./js/model/Modul_Model.js"></script>
        <script type="text/javascript" src="./js/model/Oktatok_Model.js"></script>
        <script type="text/javascript" src="./js/model/Tananyagegyseg_Model.js"></script>
        <script type="text/javascript" src="./js/model/Utemterv_bejegyzes_Model.js"></script>
        <script type="text/javascript" src="./js/model/Vizsga_Model.js"></script>
        <script type="text/javascript" src="./js/other/date.js"></script>
        <script type="text/javascript" src="./js/other/bonus_unit.js"></script>
        <script type="text/javascript" src="./js/other/bonus_teacher.js"></script>
        <script type="text/javascript" src="./js/other/active_courses.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_calcing.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_controller.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_converter.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_search.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_calc.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_controller.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_convert.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_search.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_calc.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_controller.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_convert.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_search.js"></script>
        <script type="text/javascript" src="./js/other/form_builder_for_printing.js"></script>
        <script type="text/javascript" src="./js/other/printing.js"></script>
        <script type="text/javascript" src="./js/other/tabs.js"></script>
        <script type="text/javascript" src="./js/other/push.js"></script>
        <script type="text/javascript" src="./js/other/passwordjs.js"></script>-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	<style>
	.card-main{
		
		width:600px;
		margin-left: auto;
		margin-right: auto;
	}
	</style>
</head>
<body>
<div class="card card-main" >
<article class="card-body">
	<h4 class="card-title text-center mb-4 mt-1">Belépés képzésben résztvevőknek</h4>
	<hr>
	<p class="text-success text-center">Corvin Köz Oktatási Központ</p>
	<form action="student/login_student.php" method="POST">
	<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
		<input name="username" class="form-control" placeholder="Felhasználónév" type="text" id="username">
	</div> <!-- input-group.// -->
	</div> <!-- form-group// -->
	<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		 </div>
	    <input name="passw" class="form-control" placeholder="******" type="password" id="passw">
	</div> <!-- input-group.// -->
	</div> <!-- form-group// -->
	<div class="form-group">
	<!--<button  onClick="window.location.href='student/student_index.php'" class="btn btn-primary btn-block"> Belépés  </button>-->
	<button  type="submit" class="btn btn-primary btn-block"> Belépés  </button>
	</div> <!-- form-group// -->
	<p class="text-center"><a href="#" class="btn">Elfelejtette a jelszavát?</a></p>
	</form>
</article>
</div> <!-- card.// -->

	</aside> <!-- col.// -->
</div> <!-- row.// -->

</div> 
<!--container end.//-->
<script>
function login(){
var u_name=document.getElementById("username").value;
var password=document.getElementById("passw").value;
$.ajax({
				url: "student/login_student.php",
				type: "POST",
				data: {
					u_name: u_name,
					password: password
				},
				cache: false,
				success: function(){
					console.log("kész");
					window.location="student/student_index.php";
				}
			});

}
</script>
  </body> 
</html>  
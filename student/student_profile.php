<?php 
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
		
        <title>Corvin Köz Oktatási központ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="schortcut" type="image/png" href="./img/logo_icon.PNG">
		<link rel="stylesheet" href="../css/student_main.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="student_main.js"></script>
<!------ Include the above in your HEAD tag ---------->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
		</head>
		
		
		<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                
                <div class="navi">
                    <ul>
                        <li ><a href="student_index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Áttekintő</span></a></li>
                        <li><a href="student_timetable.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Időbeosztás</span></a></li>
                        <li><a href="student_exam.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Vizsgák</span></a></li>
                        <li><a href="https://www.facebook.com/pg/corvinkozoktatasikozpont/posts/" target="blank"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Facebook</span></a></li>
                        <li><a href='http://elearning.narasoft.hu/login/index.php'target="blank"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">E-learning center</span></a></li>
                        <li class="active"><a href="student_profile.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Saját adataim</span></a></li>
						<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Kilépés</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Navigáció</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                                <input type="text" value="Corvin Köz Oktatási Központ">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                               
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    <h1>Személyes adataim</h1>
					
					
					<form  >
        <div class="form-group row">
		
            <label for="form-row-name" class="col-md-4 col-form-label">Név:</label>
            <div class="col-md-8">
                <!--<input class="form-control-plaintext" name="form-row-name" id="form-row-name" type="text"  
				value='-->
				<label>
				<?php  
				include ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `student_full_name` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$name=$row["student_full_name"];
							echo $name;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                        
        </div>
        <div class="form-group row">
            <label for="form-row-szul-nev" class="col-md-4 col-form-label">Születési név:</label>
            <div class="col-md-8">
                
            <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `birth_name` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$name=$row["birth_name"];
							echo $name;
						}
					}						
				?><!--'>-->
				</label>
			</div> 

                                        
        </div>

        <div class="form-group row">
            <label for="form-row-anyja-neve" class="col-md-4 col-form-label">Anyja neve:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `mothers_name` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$name=$row["mothers_name"];
							echo $name;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                      
        </div>
        <div class="form-group row">
            <label for="form-row-szul-hely" class="col-md-4 col-form-label">Születési hely:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `birth_place` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$name=$row["birth_place"];
							echo $name;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                       
        </div>

        <div class="form-group row">
            <label for="form-row-szar" class="col-md-4 col-form-label">Állampolgárság:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `nationality` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$nationality=$row["nationality"];
							echo $nationality;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                       
        </div>
        <div class="form-group row">
            <label for="form-row-phone" class="col-md-4 col-form-label">Telefonszám:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `phone_number` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$phone=$row["phone_number"];
							echo $phone;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                       
        </div>
        <div class="form-group row">
            <label for="form-row-taj" class="col-md-4 col-form-label">TAJ szám:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `taj` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$taj=$row["taj"];
							echo $taj;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                        
        </div>

        <div class="form-group row">
            <label for="form-row-szulev" class="col-md-4 col-form-label">Születési idő:</label>
        
        
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `birth_date` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$birth=$row["birth_date"];
							echo $birth;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                       
        </div>
        
        
        <div class="form-group row">
            <label for="form-row-szulev" class="col-md-4 col-form-label">Képzésbevétel napja:</label>
        
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `enrollment_to_course` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$course_start=$row["enrollment_to_course"];
							echo $course_start;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                      
        </div>
        
        
        <div class="form-group row">
            <label for="form-row-lakir" class="col-md-4 col-form-label">Lakcím:</label>

        
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `home_address` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$home=$row["home_address"];
							echo $home;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                        
        </div>
        
        
        
        
         <div class="form-group row">
            <label for="form-row-lakcity" class="col-md-4 col-form-label">Végzettség:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `educational_attainment` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$edu=$row["educational_attainment"];
							echo $edu;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                       
        </div>
          <div class="form-group row">
            <label for="form-row-lakcity" class="col-md-4 col-form-label">Email:</label>
            <div class="col-md-8">
                <label>
				<?php  
				require_once ("cfg.php");
				
				$student_id=$_SESSION["student_id"];
				//echo  $student_id;
				$sql="SELECT `email` FROM `students` WHERE `student_id`='$student_id'";
				$result = mysqli_query($db,$sql);
					if (!$result) {
					//printf("Error: %s\n", mysqli_error($db));
					echo mysqli_error($db);
					exit();
					}
				$count = mysqli_num_rows($result);
					if($count ==1) {
						while($row = mysqli_fetch_assoc($result)) {
							$email=$row["email"];
							echo $email;
						}
					}						
				?><!--'>-->
				</label>
            </div> 

                                        
        </div>
         
        
    </form>
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">

                            
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>



    

</body>
		 
		 
</html>
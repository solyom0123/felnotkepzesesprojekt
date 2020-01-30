<?php 
session_start();
?>

<!DOCTYPE html>

<!--
table schedule_plan
oszlopok: 
schedule_plan_data_id  aktuális kurzus ID-ja a schedule_plan_data tablaban, active_education az education_students tablaban
study_material_id

-->
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
                <!--<div class="logo">
                    <a hef="home.html"><img src="http://jskrishna.com/work/merkury/images/logo.png" alt="corvin_logo" class="hidden-xs hidden-sm">
                        <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="corvin_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>-->
                <div class="navi">
                    <ul>
                        <li ><a href="student_index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Áttekintő</span></a></li>
                        <li class="active"><a href="student_timetable.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Időbeosztás</span></a></li>
                        <li><a href="student_exam.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Vizsgák</span></a></li>
                        <li><a href="https://www.facebook.com/pg/corvinkozoktatasikozpont/posts/" target="blank"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Facebook</span></a></li>
                        <li><a href='http://elearning.narasoft.hu/login/index.php'target="blank"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">E-learning center</span></a></li>
                        <li><a href="student_profile.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Saját adataim</span></a></li>
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
                    <h1>Oktatás ütemterv</h1>
                    <div class="row">
					<?php
					$kiirni="<table class='table table-striped' id='myTable'>
							  <thead>
								<tr>
								  <th scope='col'>#</th>
								  <th scope='col'>Dátum</th>
								  <th scope='col'>Téma, tananyag</th>
								  <th scope='col'>Oktató</th>
								</tr>
							  </thead>
							  <tbody>";
					include('cfg.php');
					
					$userid=$_SESSION['userid'];
					$student_id=$_SESSION['student_id'];
					$course=$_SESSION['education_id'];
					$active_course=$_SESSION['active_course_id'];
					$tananyag_id;
					$tananyag;
					$sql="SELECT * FROM schedule_plan WHERE `schedule_plan_data_id`='$active_course'";	  
						$result = mysqli_query($db,$sql);
												if (!$result) {
														//printf("Error: %s\n", mysqli_error($db));
														echo mysqli_error($db);
														exit();
													}
												  //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
												$count = mysqli_num_rows($result);
												if($count >0) {
													while($row = mysqli_fetch_assoc($result)) {
														$date=$row['date'];
														//$tananyag_id=$row['used_studymaterials_id'];
														$_SESSION['tananyag_id']=$row['used_studymaterials_id'];
														$tananyag_id=$_SESSION['tananyag_id'];
														//echo $tananyag_id;
														
														$_SESSION['oktato_id']=$row['teacher_id'];
														
														$kiirni.="<tr><td width='25px'></td><td>".$row['date']."</td><td>";
														
														$sql_tananyag="SELECT * FROM `studymaterials` WHERE `studymaterials_id`='$tananyag_id'";
														$result2=mysqli_query($db, $sql_tananyag);
														//var_dump($result2);
														while($row2=mysqli_fetch_assoc($result2)){
															$oktato_id=$_SESSION['oktato_id'];
															$name=$row2['study_materials_name'];
															$kiirni.=$name."</td><td>";
															
															$sql_oktato="SELECT * FROM teachers WHERE `teacher_id`='$oktato_id'";
															$result3=mysqli_query($db, $sql_oktato);
															
															while($row3=mysqli_fetch_assoc($result3)){
																
																$kiirni.=$row3['teacher_full_name']."</td></tr>";
															}
															
															
															
														}
														
																											
														//$kiirni.="</td><td>".$row['message']."</td></tr>";
														
														
													}
													$kiirni.="</tbody></table>";
													
												}
												echo $kiirni;
						
					
					
					
					?>
                        <!--<table class="table table-striped" id="myTable">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Dátum</th>
								  <th scope="col">Téma, tananyag</th>
								  <th scope="col">Oktató</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <th scope="row">1</th>
								  <td>2019.09.10.</td>
								  <td>Szakmai ismeretek (férfi fr)</td>
								  <td>Nagy Zoltán</td>
								</tr>
								<tr>
								  <th scope="row">2</th>
								  <td>2019.09.11.</td>
								  <td>Szakmai ismeretek (férfi fr)</td>
								  <td>Nagy Zoltán</td>
								</tr>
								<tr>
								  <th scope="row">3</th>
								  <td>2019.09.16.</td>
								  <td>Szakmai ismeretek (férfi fr)</td>
								  <td>Nagy Zoltán</td>
								</tr>
								<tr>
								  <th scope="row">4</th>
								  <td>2019.09.17.</td>
								  <td>Szakmai ismeretek (férfi fr)</td>
								  <td>Nagy Zoltán</td>
								</tr>
								<tr>
								  <th scope="row">5</th>
								  <td>2019.09.18.</td>
								  <td>Művészeti ismeretek </td>
								  <td>Vincze Zoltánné</td>
								</tr>
								<tr>
								  <th scope="row">6</th>
								  <td>2019.09.23.</td>
								  <td>Szakmai ismeretek (férfi fr)</td>
								  <td>Nagy Zoltán</td>
								</tr>
							  </tbody>
							</table>-->
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



   

</body>
		 
		 
</html>
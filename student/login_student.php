<?php 	session_start();
		
		
			
			   include("cfg.php");
			  	echo "script indul";		   			   
			  // if($_SERVER["REQUEST_METHOD"] == "POST") {
				  // username and password sent from form 
				  echo "postban van adat";
				  $myusername = mysqli_real_escape_string($db,$_POST['username']);
				  echo $myusername;
				  $mypassword = mysqli_real_escape_string($db,$_POST['passw']); 
				  $mypass5= password_hash($mypassword, PASSWORD_DEFAULT);
				  echo $mypass5;
				  $userid;
				  
				 // $sql =  "SELECT * FROM `user` WHERE user_name='$myusername' and password='$mypass5'";
				 $sql =  "SELECT * FROM `user` WHERE user_name='$myusername'";
				  $result = mysqli_query($db,$sql);
				  if (!$result) {
						//printf("Error: %s\n", mysqli_error($db));
						echo mysqli_error($db);
						exit();
					}
				  //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				  
				  
				  $count = mysqli_num_rows($result);
				  //echo $count."sor van ";
				  // If result matched $myusername and $mypassword, table row must be 1 row
					
				  if($count == 1) {
					  //echo "ha 1 sor van";
					 while($row = mysqli_fetch_assoc($result)){
						 $hash=$row['password'];
						 //echo $hash;
						 if(password_verify($mypassword, $hash)){
							 
							 $userid=$row['user_id'];
							$_SESSION['userid']= $userid;
							$_SESSION['loggedin'] = true;
					  $_SESSION[]=$myusername;
					 $_SESSION['user'] = $myusername;
					 echo "Sikeres bejelentkezés";
					 header("location: student_index.php");
						 }
							
							
							
						}
					 
					
				  }else {
					 $error = "Hibás felhasználónév vagy jelszó!";
					 echo $error;
					header("location: ../student.php");
				  }
			  // }
			   mysqli_close($db);
			?>

	
	
              
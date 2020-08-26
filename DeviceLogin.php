<?php

$contentType = explode(';', $_SERVER['CONTENT_TYPE']);
$rawBody = file_get_contents("php://input");
$data = array();

if (in_array('application/json', $contentType)) {
    $data = json_decode($rawBody, true);
}

$userName = $data['userName'];
//$userName="birtag";
$password1 = base64_decode($data['password']);
//$password1='ABCD1234';
$password=password_hash($password1, PASSWORD_DEFAULT);
//echo $password;
//echo " ";

$servername = "mysql.nethely.hu";
$username = "oktat";
$dbPassword = 'corvin2019';
$dbname = 'oktat';

$conn = new mysqli($servername, $username, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT user_id, user_name, password, GROUP_CONCAT(active_education) as course
//FROM `user` JOIN students ON students.userid = user.user_id JOIN education_students ON students.student_id = education_students.student_id 
//WHERE user_name='" . $userName . "' AND password='" . $password . "' ";
$userid="";
$course="";



$sql = "SELECT user_id, user_name, password, GROUP_CONCAT(active_education) as course
FROM `user` JOIN students ON students.userid = user.user_id JOIN education_students ON students.student_id = education_students.student_id 
WHERE user_name='$userName'";




 //$sql =  "SELECT * FROM `user` WHERE user_name='$userName'";
				  $result = mysqli_query($conn,$sql);
				  if (!$result) {
						//printf("Error: %s\n", mysqli_error($db));
						echo mysqli_error($conn);
						exit();
					}
				  				  
				  
				  $count = mysqli_num_rows($result);
				  					
				  if($count == 1) {
					  
					 while($row = mysqli_fetch_assoc($result)){
						 $hash=$row['password'];
						// echo $hash;
						 
						 if(password_verify($password1, $hash)){
							 
							 $userid=$row['user_id'];
							 $course=$row['course'];
							 echo json_encode(array(
							'userId' => $row['user_id'],
							'course'=> $row['course']
							));
							//echo "Sikeres bejelentkezés";
					 
						 }

						 else {
							header('Content-Type: application/json; charset=UTF-8');
							echo json_encode(array(
								'error' => "ERROR"
							));
						}
}
				  }
$conn->close();

?>
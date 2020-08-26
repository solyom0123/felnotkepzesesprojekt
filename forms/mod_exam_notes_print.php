<?php
//session_start();
include_once '../../server.php';



$kepzes= isset($_REQUEST["kepzes_id"]) ? $_REQUEST['kepzes_id'] : null;


//echo $kepzes;



/*kepzes nevenek lekerdezese*/

$sql_text="SELECT * FROM `schedule_plan_data` WHERE id='".$kepzes."'";
$chset=mysqli_query($conn1,"SET CHARACTER SET 'utf8'");
$chset2=mysqli_query($conn1,"SET SESSION collation_connection ='utf8_general_ci'");

$result = mysqli_query($conn1, $sql_text);
//var_dump($result);
$json = array();
$json2 = array();

$json3 = array();
$json4=array();
while($row = mysqli_fetch_array($result)) {
        $json[] = $row;
    }


$htmlArray_head = "<h4>Résztvevők adatai és modulzáró vizsgájának eredményei<br>
				Csoport száma: ";
foreach ($json as $row){
	$name= $row['name'];
	
	$htmlArray_head.= $name;
	$htmlArray_head.= "</h4>";
	
}
//mysqli_close($conn1);


//$sql_text2="SELECT  * FROM `modul_eredemeny` WHERE `active_education`='".$kepzes."'";
//$sql_text2="SELECT DISTINCT student_full_name, birth_place, birth_date, mothers_name FROM students t1 INNER JOIN education_students t2 WHERE t2.active_education='".$kepzes."'";
$sql_text2="SELECT  student_full_name, birth_place, birth_date, mothers_name FROM  modul_eredmeny WHERE active_education='".$kepzes."'";
//$sql_text3="SELECT DISTINCT modul_name, modul_number, practical_test, verbal_test, writting_test FROM modul t1 INNER JOIN education t2 INNER JOIN schedule_plan t3 WHERE t3.schedule_plan_data_id='".$kepzes."' AND t3.course_id=t2.education_id AND t2.education_id=t1.education_id";

$edu_id;
$sql_text4="SELECT `id`, `course_id` FROM schedule_plan_data WHERE `id`='".$kepzes."'";
$chset3=mysqli_query($conn1,"SET CHARACTER SET 'utf8'");
$chset4=mysqli_query($conn1,"SET SESSION collation_connection ='utf8_general_ci'");

$result2 = mysqli_query($conn1, $sql_text2);
$result4= mysqli_query($conn1, $sql_text4);

//var_dump($result4);
//var_dump($result3);

while($row = mysqli_fetch_array($result4)) {
        $json4[] = $row;
		$edu_id=$row["course_id"];
		//echo $edu_id;
    }
while($row = mysqli_fetch_array($result2)) {
        $json2[] = $row;
    }
$sql_text3="SELECT `modul_name`, `modul_number`, `modul_id` FROM modul WHERE `education_id`='".$edu_id."'";	
$result3= mysqli_query($conn1, $sql_text3);
while($row=mysqli_fetch_array($result3)){
	
	$json3[]=$row;
}
//var_dump ($result3);
$htmlContent;
$htmlArray;
$htmlArray2;
foreach($json3 as $row){
	$htmlArray2.="<tr>
				<td width='35px'>".$row['modul_number']."</td>
				<td width='30px' >".$row['modul_name']."</td>
				<td width='30px' >Í/Sz/GY</td>
				<td width='30px'>________%:</td>
				<td width='60px' ></td>
				<td width='30px'>megfelelt/nem felelt meg</td>
				</tr>";
				}
foreach ($json2 as $row){
	
	$neve=$row["student_full_name"];
	$szul_ido=$row["birth_date"];
	$szul_hely=$row["birth_place"];
	$anyja_neve=$row["mothers_name"];
	$htmlArray="<div class='nopagebreak'><table style='margin:3px' >";
	$htmlArray.="<tr ><th colspan='3' >Név:</th><th colspan='3' >".$neve."</th></tr>
				<tr ><th width='30px'>Szül. hely:</th><td >".$szul_hely."</td>
				<th width='30px'>Szül. ideje:</th><td >".$szul_ido."</td>
				<th width='30px'>Anyja neve:</th><td >".$anyja_neve."</td></tr>"; 
	$htmlArray.="<tr>
				<th width='35px'>Modul száma:</th>
				<th width='30px'>Modul megnev.:</th>
				<th width='30px' >Vizsga tip.:</th>
				<th width='30px'>Modul   %:</th>
				<th width='60px' >Modulzáró vizsga ideje:</th>
				<th width='30px'>Modulzáró vizsga eredmény</th>
				</tr>";
				
	$htmlContent.= $htmlArray;
	$htmlContent.=$htmlArray2;		
	$htmlContent.="</table><br></div>";			
}


 $htmlKiirni=$htmlArray_head.$htmlContent;
//$htmlContent=$htmlArray_head.$htmlContent;
//echo $htmlArray2;
// $htmlArray=$htmlArray.$htmlArray2;
   
   

echo $htmlKiirni;
//return;







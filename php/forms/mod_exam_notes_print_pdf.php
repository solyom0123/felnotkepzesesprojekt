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

$kiir_adat=array();
$kiir_szemely=array();
$fejlec=array();

$htmlArray = "<h3>Résztvevők adatai és modulzáró vizsgájának eredményei</h3><br>
				<p><h2>Csoport száma: ";
$fejlec[0]="Résztvevők adatai és modulzáró vizsgájának eredményei";
				//<p><h2> ";
$fejlec[1]="Csoport száma: ";
foreach ($json as $row){
	$name= $row['name'];
	$fejlec[2]=$name;
	$htmlArray.= $name;
	$htmlArray.= "</h2></p>";
	
}
//mysqli_close($conn1);


//$sql_text2="SELECT  * FROM `modul_eredemeny` WHERE `active_education`='".$kepzes."'";
$sql_text2="SELECT DISTINCT student_full_name, birth_place, birth_date, mothers_name FROM students t1 INNER JOIN education_students t2 WHERE t2.active_education='".$kepzes."'";
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
$index=0;

foreach($json3 as $row){
	
	$htmlArray2.="<tr>
				<td style='border:solid 1px'>".$row['modul_number']."</td>
				<td style='border:solid 1px'>".$row['modul_name']."</td>
				<td width='30px' style='border:solid 1px'>Í/Sz/GY</td>
				<td style='border:solid 1px'>________%:</td>
				<td width='60px' style='border:solid 1px'></td>
				<td style='border:solid 1px'>megfelelt/nem felelt meg</td>
				</tr>";
				$kiir_adat[$index][0]=$row['modul_number'];
				$kiir_adat[$index][1]=$row['modul_name'];
				$kiir_adat[$index][2]="Í/Sz/GY";
				$kiir_adat[$index][3]="________%";
				$kiir_adat[$index][4]= "____________";
				$kiir_adat[$index][5]="megfelelt/nem felelt meg";
				$index++;
				}
				
$index2=0;
foreach ($json2 as $row){
	
	$neve=$row["student_full_name"];
	$szul_ido=$row["birth_date"];
	$szul_hely=$row["birth_place"];
	$anyja_neve=$row["mothers_name"];
	$htmlArray="<table class='col-md-12' style='border:solid 1px'>";
	$htmlArray.="<tr><th colspan='3' style='border:solid 1px'>Név:</th><td colspan='6' style='border:solid 1px'>".$neve."</td></tr>
				<tr><th style='border:solid 1px'>Szül. hely:</th><td style='border:solid 1px'>".$szul_hely."</td>
				<th style='border:solid 1px'>Szül. ideje:</th><td style='border:solid 1px'>".$szul_ido."</td></tr>
				<th style='border:solid 1px'>Anyja neve:</th><td style='border:solid 1px'>".$anyja_neve."</td></tr>"; 
	$htmlArray.="<tr>
				<td style='border:solid 1px'>Modul száma:</td>
				<td style='border:solid 1px'>Modul megnev.:</td>
				<td width='30px' style='border:solid 1px'>Vizsga tip.:</td>
				<td style='border:solid 1px'>Modul   %:</td>
				<td width='60px' style='border:solid 1px'>Modulzáró vizsga ideje:</td>
				<td style='border:solid 1px'>Modulzáró vizsga eredmény</td>
				</tr><tr ></tr>";
				
	$kiir_szemely[$index2][0]=	"Név:"	;
	$kiir_szemely[$index2][1]=	$neve	;
	$kiir_szemely[$index2][2]= "Szül. hely:"		;
	$kiir_szemely[$index2][3]=	$szul_hely	;
	$kiir_szemely[$index2][4]=	"Szül. ideje"	;
	$kiir_szemely[$index2][5]=	$szul_ido	;
	$kiir_szemely[$index2][6]=	"Anyja neve"	;
	$kiir_szemely[$index2][7]=	$anyja_neve	;
	$kiir_szemely[$index2][8]=	"Modul száma:"	;
	$kiir_szemely[$index2][9]=	"Modul megnev.:"	;
	$kiir_szemely[$index2][10]=	"Vizsga tip."	;
	$kiir_szemely[$index2][11]=	"Modul   %:"	;
	$kiir_szemely[$index2][12]=	"Modulzáró vizsga ideje:"	;
	$kiir_szemely[$index2][13]=	"Modulzáró vizsga eredmény"	;
	
	
	$htmlContent.= $htmlArray.$htmlArray2;		
				
}

$htmlContent.="</table>";
//echo $htmlArray2;
// $htmlArray=$htmlArray.$htmlArray2;
 
//echo $htmlContent;
//return;
//require_once('/tcpdf/config/lang/eng.php');
require_once('../tfpdf.php');

class PDF extends tFPDF {

// Page header
    function Header() {
        // Logo
        // Arial bold 15
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->SetFont('DejaVu', '', 14);
        // Move to the right
        //$this->Cell(80);
        // Title
       // $this->Cell(30, 10, 'Ütemterv ', 0, 0);
        // Line break
       // $this->Ln(20);
    }

// Page footer


    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, $this->PageNo() . '/{nb}' . ' oldal ', 0, 0);
    }

}

$pdf = new PDF();
//$pdf->AliasNbPages();

//$pdf = new PDF();
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// set auto page breaks
//$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
// set font
//$pdf->SetFont('dejavusans', '', 11);
// add a page
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 8);
$pdf->AddFont('DejaVuB', '', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->MultiCell(100, 8, $fejlec[0]);
$pdf->MultiCell(50, 10, $fejlec[1]);
$pdf->MultiCell(50, 10, $fejlec[2]);
$pdf->Ln(5);
for ($index=0;$index<count($kiir_szemely);$index++){
	
	
	$pdf->Cell(50, 10, $kiir_szemely[$index][0]);
	$pdf->Cell(70, 10, $kiir_szemely[$index][1]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][2]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][3]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][4]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][5]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][6]);
	$pdf->Cell(60, 10, $kiir_szemely[$index][7]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][8]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][9]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][10]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][11]);
	$pdf->Cell(40, 10, $kiir_szemely[$index][12]);
	$pdf->Cell(60, 10, $kiir_szemely[$index][13]);
	
	for($index2=0;$index2<count($kiir_adat);$index2++){
		
		$pdf->Cell(30, 10, $kiir_adat[$index2][0]);
		$pdf->Cell(30, 10, $kiir_szemely[$index2][1]);
		$pdf->Cell(30, 10, $kiir_szemely[$index2][2]);
		$pdf->Cell(50, 10, $kiir_szemely[$index2][3]);
		$pdf->Cell(50, 10, $kiir_szemely[$index2][4]);
		$pdf->Cell(50, 10, $kiir_szemely[$index2][5]);
		
		}
	$pdf->Ln(5);
	
	if(($index+1)%3==0){
		$pdf->AddPage();
		
	}
	
	
	
	
}



// output the HTML content
//$pdf->WriteHTML($htmlContent, true, false, true, false, '');
//$pdf->lastPage();
$pdf->Output('../../pdfs/name.pdf', 'F');
//echo true;


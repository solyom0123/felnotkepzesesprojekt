<?php
function makeSchedulePlan() {
    global $value;
    lekapcsolodas(insertSchedule(kapcsolodas()));
    lekapcsolodas(collectNeededCourseData(kapcsolodas()));
    for ($index = 0; $index < count($value[7]); $index++) {
        lekapcsolodas(collectNeededModulsData(kapcsolodas(),$value[7][$index]));
    }
    echo" //";
    for ($index = 0; $index < count($value[7]); $index++) {
        lekapcsolodas(collectNeededCurUnitDatasData(kapcsolodas(),$value[7][$index]));
    }
    echo ' //';
    lekapcsolodas(collectNeededDatesData(kapcsolodas()));
    echo ' //';
    collectNeededDatesBetweenStartAndEnd();
}

function collectNeededCourseData($conn) {
    global $value;
    $sql = "select education_id as id,education_name as name,education_inhouse_id as inId"
            . " from education where education_id=" . $value[1] . "  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . " ;" . $row["id"] . ";" . $row['inId'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}
function collectNeededDatesBetweenStartAndEnd() {
    global $value;
     $begin = new DateTime($value[2]);
    $end = new DateTime($value[3]);

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    
    foreach ($period as $dt) {
            echo $dt->format("Y-m-d")."/;/";

     
    }
    echo ' //';
}
function collectNeededModulsData($conn,$modulid) {
    global $value;
    $sql = "select modul_id as id,modul_name as name,modul_number as inId, doctrine as d,exercise as e,verbal_test as vt,writting_test as wt,practical_test as pt"
            . " from modul where modul_id=" . $modulid . "  ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . " ;" . $row["id"] . ";" . $row['inId'] . ";" . $row['d'] . ";" . $row['e'] . ";" . $row['vt'] . ";" . $row['wt'] . ";" . $row['pt'] . "/;/";
        }
    } else {
        echo "none;/;/";
    }
    return $conn;
}
function collectNeededCurUnitDatasData($conn,$modulid) {
    global $value;
    $sql = "select studymaterials_id as id,study_materials_name as name, doctrine as d,exercise as e, modul_id as m"
            . " from studymaterials where modul_id=" . $modulid . "   ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . "; " . $row["id"] . ";" . $row['d'] . ";" . $row['e'] . ";" . $row['m'] . "/;/";
        }
    } else {
        echo "none;/;/";
    }
    return $conn;
}
function collectNeededDatesData($conn){
    global $value;
    $sql = "select date,DAYOFWEEK(date) as napno from unable_dates where `date` between '" . $value[2] . "' and '" . $value[3] . "'    ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            echo $row['date'].";" . numberofday($row["napno"])."/;/";
        }
    } else {
        echo $conn->error;
    }
    return $conn;
}

function insertSchedule($conn) {
    global $value;
    $week_plan_doctrine = arraytoString($value[5]);
    $week_plan_exercise =arraytoString($value[6]);
    $week_plan_elearn ="";
    $used_moduls =arraytoString($value[7]);
    $used_module_place =arraytoString($value[8]);
    
    $sql = "INSERT INTO schedule_plan_data (`name`,course_id,start_day,sign_day,exam_date,doctrine_week_plan,exercise_week_plan,used_modul_id,used_modul_place)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $week_plan_doctrine . "','" . $week_plan_exercise . "','" . $used_moduls . "','" . $used_module_place . "');";
   if ($conn->query($sql) === TRUE) {
       // echo 'ok';
    } else {
       // echo 'error';
    }
    $sql = "SELECT id as lst from schedule_plan_data where course_id=".$value[1]." order by id Desc limit 1 ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["lst"] . "//";
        }
    } else {
        echo "none//";
    }

    return $conn;
}
function arraytoString($inputarray){
    $returnString ="";
    for ($index = 0; $index < count($inputarray); $index++) {
        $returnString .= $inputarray[$index].";"; 
    }
    return $returnString;
}
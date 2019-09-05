<?php

function getActiveEducationSchemas() {

    $conn = kapcsolodas();
    $sql = "select `name`  as n , id as i  from schedule_plan_data ;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["i"] . ";" . $row["n"] . "/;/";
        }
    } else {
        echo "none;";
    }
    lekapcsolodas($conn);
}

function makeSchedulePlan() {
    global $value;
    lekapcsolodas(insertSchedule(kapcsolodas()));
    lekapcsolodas(collectNeededCourseData(kapcsolodas()));
    for ($index = 0; $index < count($value[7]); $index++) {
        lekapcsolodas(collectNeededModulsData(kapcsolodas(), $value[7][$index]));
    }
    echo" //";
    for ($index = 0; $index < count($value[7]); $index++) {
        lekapcsolodas(collectNeededCurUnitDatasData(kapcsolodas(), $value[7][$index]));
    }
    echo ' //';
    lekapcsolodas(collectNeededDatesData(kapcsolodas()));
    echo ' //';
    collectNeededDatesBetweenStartAndEnd();

    for ($index = 0; $index < count($value[11]); $index++) {
        lekapcsolodas(collectNeededModulsData(kapcsolodas(), $value[11][$index]));
    }
    
}

function makeUpdateSchedulePlan() {
    global $value;
    lekapcsolodas(updateSchedule(kapcsolodas()));
    lekapcsolodas(collectNeededCourseData(kapcsolodas()));
    for ($index = 0; $index < count($value[7]); $index++) {
        lekapcsolodas(collectNeededModulsData(kapcsolodas(), $value[7][$index]));
    }
    echo" //";
    for ($index = 0; $index < count($value[7]); $index++) {
        lekapcsolodas(collectNeededCurUnitDatasData(kapcsolodas(), $value[7][$index]));
    }
    echo ' //';
    lekapcsolodas(collectNeededDatesData(kapcsolodas()));
    echo ' //';
    collectNeededDatesBetweenStartAndEnd();
  
    for ($index = 0; $index < count($value[11]); $index++) {
        lekapcsolodas(collectNeededModulsData(kapcsolodas(), $value[11][$index]));
    }
    
}

function searchTeacher($conn) {
    global $value;
    $sql = "select t.teacher_id as id, t.teacher_full_name as name"
            . " from teachers t,studymaterials_teacher st where t.teacher_id = st.teacher and st.studymaterials=" . $value."  group by t.teacher_id";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . " ;,;,;" . $row["name"] . "/;/";
        }
    } else {
        echo "-2;,;,;Nincs oktató a tanegységhez rendelve!/;/";
    }
    return $conn;
}
function searchTeacherExam($conn) {
    global $value;
    $sql = "select t.teacher_id as id, t.teacher_full_name as name"
            . " from teachers t,studymaterials_teacher  st, studymaterials s where t.teacher_id = st.teacher and  st.studymaterials = s.studymaterials_id and s.modul_id=" . $value."  group by t.teacher_id";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . " ;,;,;" . $row["name"] . "/;/";
        }
    } else {
        echo "-2;,;,;Nincs oktató a modulhoz rendelve!/;/";
    }
    return $conn;
}

function curUnitsWithoutThisCourse($conn) {
    global $value;
    $sql = "select s.studymaterials_id as id, s.study_materials_name as name , s.doctrine as d, s.elearn as el, s.exercise as ex"
            . " from studymaterials s, modul m where s.modul_id = m.modul_id and m.modul_id not in (select modul_id from modul where education_id=" . $value . ")";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . " ;,;,;" . $row["name"] . " ;,;,;" . $row["d"] . " ;,;,;" . $row["el"] . " ;,;,;" . $row["ex"] . "/;/";
        }
    } else {
        echo "-2;,;,;Nincs tanegység!;,;,;0;,;,;0;,;,;0/;/";
    }
    return $conn;
}

function curUnitsWithbonus($conn) {
    global $value;
    $sql = "select s.studymaterials_id as id, s.study_materials_name as name , s.doctrine as d, s.elearn as el, s.exercise as ex"
            . " from studymaterials s where s.bonus='true' ;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . " ;,;,;" . $row["name"] . " ;,;,;" . $row["d"] . " ;,;,;" . $row["el"] . " ;,;,;" . $row["ex"] . "/;/";
        }
    } else {
        echo "-2;,;,;Nincs tanegység!;,;,;0;,;,;0;,;,;0/;/";
    }
    return $conn;
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
        echo $dt->format("Y-m-d") . "/;/";
    }
    echo ' //';
}

function collectNeededModulsData($conn, $modulid) {
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

function collectNeededCurUnitDatasData($conn, $modulid) {
    global $value;
    $sql = "select studymaterials_id as id,study_materials_name as name, doctrine as d,exercise as e,elearn as el, modul_id as m"
            . " from studymaterials where modul_id=" . $modulid . "   ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . "; " . $row["id"] . ";" . $row['d'] . ";" . $row['e'] . ";" . $row['el'] . ";" . $row['m'] . "/;/";
        }
    } else {
        echo "none;/;/";
    }
    return $conn;
}

function collectNeededDatesData($conn) {
    global $value;
    $sql = "select date,DAYOFWEEK(date) as napno from unable_dates where `date` between '" . $value[2] . "' and '" . $value[3] . "'    ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            echo $row['date'] . ";" . numberofday($row["napno"]) . "/;/";
        }
    } else {
        echo $conn->error;
    }
    return $conn;
}

function insertSchedule($conn) {
    global $value;
    $week_plan_doctrine = arraytoString($value[5]);
    $week_plan_exercise = arraytoString($value[6]);
    $week_plan_elearn = arraytoString($value[10]);
    $used_moduls = arraytoString($value[7]);
    $used_module_place = arraytoString($value[8]);
    $used_finished_module = arraytoString($value[11]);
    $used_finished_module_place = arraytoString($value[12]);
    $replace = $value[9];
    $sql = "INSERT INTO schedule_plan_data (`name`,course_id,start_day,sign_day,exam_date,doctrine_week_plan,elearn_week_plan,exercise_week_plan,used_modul_id,used_modul_place,replace_days,used_finished_modul,used_finished_modul_place)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $week_plan_doctrine . "','" . $week_plan_elearn . "','" . $week_plan_exercise . "','" . $used_moduls . "','" . $used_module_place . "'," . $replace . ",'" . $used_finished_module . "','" . $used_finished_module_place . "');";
    if ($conn->query($sql) === TRUE) {
        // echo 'ok';
    } else {
        // echo 'error';
    }
    $sql = "SELECT id as lst from schedule_plan_data where course_id=" . $value[1] . " order by id Desc limit 1 ;";
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

function updateSchedule($conn) {
    global $value;
    $week_plan_doctrine = arraytoString($value[5]);
    $week_plan_exercise = arraytoString($value[6]);
    $week_plan_elearn = arraytoString($value[10]);
    $used_moduls = arraytoString($value[7]);
    $used_module_place = arraytoString($value[8]);
     $used_finished_module = arraytoString($value[11]);
    $used_finished_module_place = arraytoString($value[12]);
    $replace = $value[9];
    $sql = "UPDATE schedule_plan_data set name ='" . $value[0] . "',course_id='" . $value[1] . "',start_day='" . $value[2] . "',sign_day='" . $value[3] . "',exam_date='" . $value[4] . "',doctrine_week_plan='" . $week_plan_doctrine . "',elearn_week_plan='" . $week_plan_elearn . "',exercise_week_plan='" . $week_plan_exercise . "',used_modul_id='" . $used_moduls . "',used_modul_place='" . $used_module_place . "',replace_days=" . $replace . ",,used_finished_modul='" . $used_finished_module . "',used_finished_modul_place='" . $used_finished_module_place . "'  where id = " . $value[11] . " ;";
    if ($conn->query($sql) === TRUE) {
        //  echo 'ok';
    } else {
        //  echo 'error';
        //  echo $conn->error;
    }

    echo $value[13] . "//";
    return $conn;
}

function arraytoString($inputarray) {
    $returnString = "";
    for ($index = 0; $index < count($inputarray); $index++) {
        $returnString .= $inputarray[$index] . ";";
    }
    return $returnString;
}

function deleteedited($conn) {
    global $value;

    $sql = "delete from schedule_plan_data WHERE id=" . $value;
    if ($conn->query($sql) === TRUE) {
        // echo 'ok';
    } else {
        echo $conn->error;
    }

    return $conn;
}

function passschedule($conn) {
    global $value;
    var_dump($value);
    $sql = "INSERT INTO schedule_plan (`schedule_plan_data_id`,`date`,used_hours,used_hours_type,used_modul_id,used_studymaterials_id,modul_start_hour,modul_end_hour,teacher_id,exam,replace_day)
VALUES ('" . $value[10] . "','" . $value[0] . "','" . $value[2] . "','" . $value[6] . "','" . $value[8] . "','" . $value[1] . "','" . $value[3] . "','" . $value[4] . "','" . $value[7] . "','" . $value[5] . "','" . $value[9] . "');";
    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function select_all_dataforAnActiveEducation($conn) {
    global $value;
    $moduls = '';
    $start = "";
    $end = "";
    $fmodul ='';
    $sql = "select sc.`name` as n,e.education_name as e,e.okj_number as o,sc.start_day as s,sc.sign_day as si, sc.used_modul_id as mi, sc.used_modul_place as mp, sc.replace_days as r,sc.exam_date as ex , sc.course_id as cid, sc.doctrine_week_plan as dp, sc.elearn_week_plan as elp, sc.exercise_week_plan as exp, used_finished_modul as ufm, used_finished_modul_place as ufmp  from schedule_plan_data sc, education e where e.education_id= sc.course_id and sc.id =" . $value;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["n"] . ";,;" . $row["e"] . ";,;" . $row["o"] . ";,;" . $row["s"] . ";,;" . $row["si"] . ";,;" . $row["mi"] . ";,;" . $row["mp"] . ";,;" . $row["r"] . ";,;" . $row["ex"] . ";,;" . $row["cid"] . ";,;" . $row["dp"] . ";,;" . $row["elp"] . ";,;" . $row["exp"] . "//";
            //0                 //1                 //2                 //3                 //4                 //5                     //6                 //7                 //8                 //9             //10                //11                //12
            $moduls = $row['mi'];
            $start = $row["s"];
            $end = $row["si"];
            $fmodul = $row['ufm'];
        }
    } else {
        echo "none//";
        echo $conn->error;
    }
    echo '/;/';
    $spmoduls = explode(";", $moduls);

    for ($index = 0; $index < count($spmoduls); $index++) {
        if ($spmoduls[$index] != '' && $spmoduls[$index] != ';') {
            $sql = "select m.modul_name as n, m.modul_number as nu from modul m where m.modul_id=" . $spmoduls[$index];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo $spmoduls[$index] . ";" . $row["n"] . ";" . $row["nu"] . "//";
                }
            } else {
                echo "none//";
                echo $conn->error;
            }
        }
    }
    echo '/;/';
    $sql = "select `date` as d, used_hours_type as t, used_hours as uh, modul_start_hour as sh, modul_end_hour as eh, used_modul_id as mi, (select modul_name from modul where modul_id=used_modul_id) as mn, used_studymaterials_id as si,(select study_materials_name from studymaterials where studymaterials_id = used_studymaterials_id) as sn, exam as e, replace_day as r, sc.teacher_id as ti, (select teacher_full_name from teachers where teacher_id= sc.teacher_id) as tn from schedule_plan sc where sc.schedule_plan_data_id=" . $value;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["d"] . ";,;" . $row["r"] . ";,;" . $row["si"] . ";,;" . $row["uh"] . ";,;" . $row["t"] . ";,;" . $row["e"] . ";,;" . $row["sh"] . ";,;" . $row["eh"] . ";,;" . $row["mi"] . ";,;" . $row["mn"] . ";,;" . $row["sn"] . ";,;" . $row["ti"] . ";,;" . $row["tn"] . "//";
            //     0                    1                   2                       3                      4                5                   6                       7               8                   9                       10                  11                  12                  
            
        }
    } else {
        echo "none//";
        echo $conn->error;
    }
    echo '/;/';
    $sql = "select date,DAYOFWEEK(date) as napno from unable_dates where `date` between (select start_day from schedule_plan_data where id= " . $value . " ) and (select sign_day from schedule_plan_data where id= " . $value . " )    ";
    //echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            echo $row['date'] . ";" . numberofday($row["napno"]) . "//";
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    $begin = new DateTime($start);
    $end_1 = new DateTime($end);
    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end_1);

    foreach ($period as $dt) {
        echo $dt->format("Y-m-d") . "//";
    }
     echo '/;/';
    $spmoduls = explode(";", $fmodul);

    for ($index = 0; $index < count($spmoduls); $index++) {
        if ($spmoduls[$index] != '' && $spmoduls[$index] != ';') {
            $sql = "select m.modul_name as n, m.modul_number as nu from modul m where m.modul_id=" . $spmoduls[$index];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo $spmoduls[$index] . ";" . $row["n"] . ";" . $row["nu"] . "//";
                }
            } else {
                echo "none//";
                echo $conn->error;
            }
        }
    }
    return $conn;
}

function edit_dataforAnActiveEducation($conn) {
    global $value;
    $sql = "UPDATE schedule_plan_data
SET `name` = '" . $value[1] . "', replace_days = " . $value[2] . ", exam_date='" . $value[3] . "'" .
            "WHERE id=" . $value[0];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function editschedule($conn) {
    global $value;
    
    $sql = "select schedule_plan_data_id as id from schedule_plan  where schedule_plan_data_id =" . $value[10] . " and `date`='" . $value[0] . "'  and exam='" . $value[5] . "' and used_modul_id=" . $value[8] . " and used_hours_type=" . $value[6] . " and replace_day='" . $value[9] . "' and used_studymaterials_id=" . $value[1] . " and used_hours=" . $value[2] . " and modul_end_hour=" . $value[4] . " and modul_start_hour=" . $value[3] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql = "UPDATE schedule_plan set teacher_id='" . $value[7] . "' where schedule_plan_data_id ='" . $value[10] . "' and `date`='" . $value[0] . "'  and exam='" . $value[5] . "' and used_modul_id='" . $value[8] . "' and used_hours_type='" . $value[6] . "' and replace_day='" . $value[9] . "' and used_studymaterials_id='" . $value[1] . "' and used_hours='" . $value[2] . "' and modul_end_hour='" . $value[4] . "' and modul_start_hour='" . $value[3] . "';";
            if ($conn->query($sql) === TRUE) {
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    } else {
        $sql = "INSERT INTO schedule_plan (`schedule_plan_data_id`,`date`,used_hours,used_hours_type,used_modul_id,used_studymaterials_id,modul_start_hour,modul_end_hour,teacher_id,exam,replace_day)
VALUES ('" . $value[10] . "','" . $value[0] . "','" . $value[2] . "','" . $value[6] . "','" . $value[8] . "','" . $value[1] . "','" . $value[3] . "','" . $value[4] . "','" . $value[7] . "','" . $value[5] . "','" . $value[9] . "');";
        if ($conn->query($sql) === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
   
    return $conn;
}

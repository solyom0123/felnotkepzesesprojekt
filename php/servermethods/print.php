<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printForm() {
    global $value, $coursedata, $date, $maintable;

    switch ($value[0]) {
        case 1:
            collectDataForMissingForm($value[1]);
            echo '/;/';
            echo 'attendance_sheet_print.php';
            break;
        case 2:
            collectDataForMissingFormTeacher($value[1]);
            echo '/;/';
            echo 'attendance_sheet_teacher_print.php';
            break;
        case 3:

            echo 'attendance_sc_print.php';
            break;
        case 4:

            echo 'attendance_dd_print.php';
            break;
        case 5:

            echo 'missing_notes_print.php';
            break;

        case 6:

            echo 'exam_notes_print.php';
            break;
        case 7:
            collectDataForMissingFormExam($value[1]);
            echo '/;/';
            echo 'attendance_exam_sheet_print.php';
            break;
        case 8:
            collectDataForMissingFormFinalExam($value[1]);
            echo '/;/';
            echo 'attendance_final_exam_sheet_print.php';
            break;
        case 9:
            collectDataForMissingFormListName($value[1]);
            echo '/;/';
            echo 'list_name_print.php';
            break;
        case 10:
            echo 'exam_sum_print.php';
            break;
        case 11:
            echo 'personal_notes_print.php';
            break;
        case 12:
            collectDataForScMissingForm($value[1]);
            echo 'attendance_missing_sc_print.php';
            break;
        case 13:
            echo 'edu_cont_print.php';
            break;
        default:

            break;
    }
}
function collectDataForScMissingForm($dataArray) {
    $conn = kapcsolodas();
    
        $sql = "select "
                . "s.student_full_name as fn,"
                . "birth_date as br,"
                . " es.student_id as id, "
                . "s.home_address as ad,"
                . "'false' as r "
                . "from "
                . "education_students es, "
                . "students s "
                . "where "
                . "es.student_id=s.student_id "
                . "and "
                . "es.active_education=" . $dataArray[0].' group by es.student_id';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['id'].";".$row['fn']."//";
        }
    } else {
        echo $conn->error;
    }

    echo '/;/';
    
    lekapcsolodas($conn);
}

function collectDataForMissingForm($dataArray) {
    $conn = kapcsolodas();
    $date = '';
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,`name` as n from schedule_plan_data where id=" . $dataArray[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["c"] . ';';
            echo $row["e"] . ';';
            echo 'cim' . ';';
            echo $row["s"] . "-" . $row["n"] . ';';
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    $sql = "select "
            . "("
            . "case "
            . "when replace_day='false' "
            . "then "
            . "(select modul_name "
            . "from modul "
            . "where modul_id=used_modul_id) "
            . "else '' END) as m,"
            . " used_hours as uh,  "
            . "(case "
            . "when used_hours_type=1 "
            . "then 'elméleti' "
            . "else "
            . "(case "
            . "when used_hours_type=2"
            . " then 'gyakorlati'  "
            . "else ("
            . "case "
            . "when used_hours_type=3 "
            . "then 'elearn' "
            . "else '' END "
            . ") END"
            . "             ) END"
            . " ) as t, "
            . "`date` as d,"
            . " (case"
            . " when exam ='false' "
            . "then "
            . "(select study_materials_name "
            . "from studymaterials "
            . "where studymaterials_id= used_studymaterials_id)"
            . " else "
            . "(select realname "
            . "from helper_exam_data "
            . "where `type`= used_studymaterials_id) END) as c "
            . "from schedule_plan "
            . "where "
            . "schedule_plan_data_id=" . $dataArray[0] . " "
            . "and `date`='" . $dataArray[1] . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['m'] . ' - ' . $row['c'] . ' - ' . $row['t'] . ';';
            echo $row['uh'] . ';//';
            $date = $row['d'];
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $dataArray[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['fn'] . ';' . explode(" ", $row['br'])[0] . ';//';
        }
    } else {
        echo $conn->error;
    }

    echo '/;/';
    echo $date;
    lekapcsolodas($conn);
}

function collectDataForMissingFormExam($dataArray) {
    $conn = kapcsolodas();
    $date = '';
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,`name` as n from schedule_plan_data where id=" . $dataArray[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["c"] . ';';
            echo $row["e"] . ';';
            echo 'cim' . ';';
            echo $row["s"] . "-" . $row["n"] . ';';
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    $sql = "select "
            . "("
            . "case "
            . "when replace_day='false' "
            . "then "
            . "(select modul_name "
            . "from modul "
            . "where modul_id=used_modul_id) "
            . "else '' END) as m,"
            . " used_hours as uh,  "
            . "(case "
            . "when used_hours_type=1 "
            . "then 'elméleti' "
            . "else "
            . "(case "
            . "when used_hours_type=2"
            . " then 'gyakorlati'  "
            . "else ("
            . "case "
            . "when used_hours_type=3 "
            . "then 'elearn' "
            . "else '' END "
            . ") END"
            . "             ) END"
            . " ) as t, "
            . "`date` as d,"
            . " (case"
            . " when exam ='false' "
            . "then "
            . "(select study_materials_name "
            . "from studymaterials "
            . "where studymaterials_id= used_studymaterials_id)"
            . " else "
            . "(select realname "
            . "from helper_exam_data "
            . "where `type`= used_studymaterials_id) END) as c "
            . "from schedule_plan "
            . "where "
            . "schedule_plan_data_id=" . $dataArray[0] . " "
            . "and `date`='" . $dataArray[1] . "' and exam='true';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['m'] . ' - ' . $row['c'] . ' - ' . $row['t'] . ';';
            echo $row['uh'] . ';//';
            $date = $row['d'];
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $dataArray[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['fn'] . ';' . explode(" ", $row['br'])[0] . ';//';
        }
    } else {
        echo $conn->error;
    }

    echo '/;/';
    echo $date;
    lekapcsolodas($conn);
}

function collectDataForMissingFormFinalExam($dataArray) {
    $conn = kapcsolodas();
    $date = '';
    $kepzes = '';
    $sql = "select  exam_date as ed,(select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,`name` as n from schedule_plan_data where id=" . $dataArray[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["c"] . ';';
            echo $row["e"] . ';';
            echo 'cim' . ';';
            echo $row["s"] . "-" . $row["n"] . ';';
            $date = $row['ed'];
            $kepzes = $row["c"] . ' - ' . $row[n];
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';

    echo 'Záróvizsga' . ' - ' . $kepzes . ';';
    echo $dataArray[1] . ';//';

    echo '/;/';
    $sql = "select "
            . "s.student_full_name as fn,"
            . "birth_date as br,"
            . " es.student_id as id "
            . "from "
            . "education_students es, "
            . "students s "
            . "where "
            . "es.student_id=s.student_id "
            . "and "
            . "es.active_education=" . $dataArray[0];


    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql1 = "select"
                    . " sc.id as id,"
                    . " sc.`date`,"
                    . " (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi'  end)  as mn,"
                    . " (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_studymaterials_id) end) as et,"
                    . " (select (case when (EXISTS(select mc.grade =1  from exam_table mc where mc.schedule_plan_data_id=" . $dataArray[0] . " and mc.student_id=" . $row["id"] . " and mc.schedule_plan_row_id =sc.id))=1 then 'megbukott'  else 'még nem vizsgázott'  end))  as grade  "
                    . "from schedule_plan sc "
                    . "where sc.schedule_plan_data_id=" . $dataArray[0] . ""
                    . " and sc.exam='true' "
                    . "and sc.id not in "
                    . "(select mc.schedule_plan_row_id "
                    . "from exam_table mc"
                    . " where mc.schedule_plan_data_id=" . $dataArray[0] . " "
                    . "and mc.student_id=" . $row["id"] . " and mc.grade >1);";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                
            } else {
                echo $conn->error;
                echo $row['fn'] . ';' . explode(" ", $row['br'])[0] . ';//';
            }
        }
    } else {
        echo $conn->error;
    }

    echo '/;/';
    echo $date;
    lekapcsolodas($conn);
}

function collectDataForMissingFormListName($dataArray) {
    $conn = kapcsolodas();
    $date = '';
    $kepzes = '';

    $sql = "select  exam_date as ed,(select CONCAT(education_name, '( ',okj_number , ')') from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,`name` as n from schedule_plan_data where id=" . $dataArray[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["c"] . ';';
            echo $row["e"] . ';';
            echo 'cim' . ';';
            echo $row["s"] . "-" . $row["n"] . ';';
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';

    echo ';';
    echo ';//';

    echo '/;/';
    if ($dataArray[1] == 2) {
        $sql = "select "
                . "s.student_full_name as fn,"
                . "s.birth_name as bn,"
                . "s.mothers_name as mn,"
                . "s.birth_place as bp,"
                . "s.birth_date as br,"
                . "s.gender as g,"
                . "s.nationality as n,"
                . "s.home_address as ad,"
                . "s.phone_number as pn,"
                . "s.educational_attainment as ea,"
                . "s.enrollment_to_course as ec,"
                . "s.taj,"
                . " es.student_id as id, "
                . "'false' as r "
                . "from "
                . "education_students es, "
                . "students s "
                . "where "
                . "es.student_id=s.student_id "
                . "and "
                . "es.active_education=" . $dataArray[0].' group by es.student_id';
    } else {
        $sql = "select "
                . "s.teacher_full_name as fn,"
                . "s.birth_name as bn,"
                . "s.mothers_name as mn,"
                . "s.birth_place as bp,"
                . "s.birth_date as br,"
                . "s.gender as g,"
                . "s.nationality as n,"
                . "s.home_address as ad,"
                . "s.phone_number as pn,"
                . "'nincs' as ea,"
                . "'nincs' as ec,"
                . "s.taj,"
               . " s.teacher_id as id,"
                
                . "es.replace_day as r"
                . ""
                . " from "
                . "schedule_plan es, "
                . "teachers s "
                . "where "
                . "es.teacher_id=s.teacher_id "
                . "and "
                . "es.schedule_plan_data_id=" . $dataArray[0].' group by es.teacher_id';
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["r"] != "false") {
                echo $row['fn'] . '(külsős) ;' .$row['bn'] . ' ;'.$row['mn'] . ' ;'.$row['bp'] . ' ;'. explode(" ", $row['br'])[0] . ';'.$row['g'] . ' ;'.$row['n'] . ' ;'.$row['ad'] . ' ;'.$row['pn'] . ' ;'.$row['ea'] . ' ;'.$row['ec'] . ' ;'.$row['taj'] . '//';
       
              } else {
                echo $row['fn'] . ' ;' .$row['bn'] . ' ;'.$row['mn'] . ' ;'.$row['bp'] . ' ;'. explode(" ", $row['br'])[0] . ';'.$row['g'] . ' ;'.$row['n'] . ' ;'.$row['ad'] . ' ;'.$row['pn'] . ' ;'.$row['ea'] . ' ;'.$row['ec'] . ' ;'.$row['taj'] . '//';
            }
        }
    } else {
        echo $conn->error;
    }

    echo '/;/';
    if ($dataArray[1] == 1) {
        echo "Oktatói";
    } else {
        echo "Résztvevői";
    }

    lekapcsolodas($conn);
}

function collectDataForMissingFormTeacher($dataArray) {
    $conn = kapcsolodas();
    $date = '';
    $sql = "select  (select CONCAT(education_name, '( ',okj_number , ')')  from education where education_id =course_id) as c,(select education_inhouse_id from education where education_id =course_id) as e, start_day as s,`name` as n from schedule_plan_data where id=" . $dataArray[0] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //$loc_array = array(, $row['s'], $row['n'],$row['n']);
            echo $row["c"] . ';';
            echo $row["e"] . ';';
            echo 'cim' . ';';
            echo $row["s"] . "-" . $row["n"] . ';';
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    $sql = "select "
            . "("
            . "case "
            . "when sp.replace_day='false' "
            . "then "
            . "(select modul_name "
            . "from modul "
            . "where modul_id=sp.used_modul_id) "
            . "else '' END) as m,"
            . " sp.used_hours as uh,  "
            . "(case "
            . "when sp.used_hours_type=1 "
            . "then 'elméleti' "
            . "else "
            . "(case "
            . "when sp.used_hours_type=2"
            . " then 'gyakorlati'  "
            . "else ("
            . "case "
            . "when sp.used_hours_type=3 "
            . "then 'elearn' "
            . "else '' END "
            . ") END"
            . "             ) END"
            . " ) as t, "
            . "sp.date as d,"
            . " (case"
            . " when exam ='false' "
            . "then "
            . "(select study_materials_name "
            . "from studymaterials "
            . "where studymaterials_id= sp.used_studymaterials_id)"
            . " else "
            . "(select realname "
            . "from helper_exam_data "
            . "where `type`= sp.used_studymaterials_id) END) as c, "
            . "(case when sp.teacher_id=0 then 'Nincs oktató kiválasztva' else (select  t.teacher_full_name  from teachers t where t.teacher_id =sp.teacher_id) END) as tn "
            . "from schedule_plan sp "
            . "where "
            . "sp.schedule_plan_data_id=" . $dataArray[0] . " "
            . "and sp.date='" . $dataArray[1] . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['m'] . ' - ' . $row['c'] . ' - ' . $row['t'] . ';';
            echo $row['tn'] . ';';
            echo $row['uh'] . ';//';
            $date = $row['d'];
        }
    } else {
        echo $conn->error;
    }
    echo '/;/';
    echo $date;
    lekapcsolodas($conn);
}

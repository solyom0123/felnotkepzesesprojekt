<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function send_active_course($conn) {
    global $value;
    $spids = explode("_", $value[1]);
    for ($index = 0; $index < count($spids); $index++) {
        if ($spids[$index] != "") {

            $sql = "INSERT INTO education_students (active_education,student_id) " .
                    "VALUES ('" . $value[0] . "','" . $spids[$index] . "') ";

            if ($conn->query($sql) === TRUE) {
                $sql = "Update students set enrollment_to_course = NOW() where  student_id= " . $spids[$index] . " ";

                 if ($conn->query($sql) === TRUE) {
                    echo 'ok';
                } else {
                    echo 'error';
                }
            } else {
                echo 'error';
            }
        }
    }
    return $conn;
}

function insertorUpdateMissing($conn) {
    global $value;
    $sql = "select  id  from missing_table where sc_plan_row_id=" . $value[2] . "  and active_education_id =  " . $value[3] . "  and student_id=" . $value[4] . " ;";
    echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql = "Update missing_table set missing_hour_ammount=" . $value[1] . " where id=" . $row["id"] . "; ";

            if ($conn->query($sql) === TRUE) {
                echo 'update';
            } else {
                echo 'error';
            }
        }
    } else {
        echo $conn->error;
        $sql = "INSERT INTO missing_table (missing_hour_ammount,sc_plan_row_id,active_education_id,student_id) " .
                "VALUES ('" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "')";

        if ($conn->query($sql) === TRUE) {
            echo 'insert';
        } else {
            echo 'error';
        }
    }
    return $conn;
}

function getMissing($conn) {
    global $value;
    $sql = "select missing_hour_ammount as mh  from missing_table where  sc_plan_row_id=" . $value[2] . " and active_education_id = " . $value[3] . "  and student_id=" . $value[4] . " ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["mh"];
        }
    } else {
        echo '0';
    }


    return $conn;
}

function insertorUpdateExam($conn) {
    global $value;
    $sql = "select  id  from exam_table where schedule_plan_row_id=" . $value[2] . "  and schedule_plan_data_id =  " . $value[3] . "  and student_id=" . $value[4] . " ;";
    echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql = "Update exam_table set grade=" . $value[1] . " where id=" . $row["id"] . "; ";

            if ($conn->query($sql) === TRUE) {
                echo 'update';
            } else {
                echo 'error';
            }
        }
    } else {
        echo $conn->error;
        $sql = "INSERT INTO exam_table (grade,schedule_plan_row_id,schedule_plan_data_id,student_id) " .
                "VALUES ('" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "')";

        if ($conn->query($sql) === TRUE) {
            echo 'insert';
        } else {
            echo 'error';
        }
    }
    return $conn;
}

function getFinalExam($conn) {
    global $value;
    $sql = "select certificate_no as no,certificate_date as cdate,grade as mh  from finalexam_table where date='" . $value[0] . "' and schedule_plan_data_id = " . $value[1] . "  and student_id=" . $value[2] . " ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["mh"] . "_;_" . $row["no"] . "_;_" . $row["cdate"];
        }
    } else {
        echo '0_;_nincs_;_';
    }


    return $conn;
}

function insertorUpdateFinalExam($conn) {
    global $value;
    $sql = "select  id  from finalexam_table where `date`='" . $value[0] . "'  and schedule_plan_data_id =  " . $value[1] . "  and student_id=" . $value[2] . " ;";
    echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql = "Update finalexam_table set grade=" . $value[3] . ",certificate_no ='" . $value[4] . "', certificate_date='" . $value[5] . "' where id=" . $row["id"] . "; ";

            if ($conn->query($sql) === TRUE) {
                echo 'update';
            } else {
                echo 'error';
            }
        }
    } else {
        echo $conn->error;
        $sql = "INSERT INTO finalexam_table (date,schedule_plan_data_id,student_id,grade,certificate_no,certificate_date) " .
                "VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "')";

        if ($conn->query($sql) === TRUE) {
            echo 'insert';
        } else {
            echo 'error';
        }
    }
    return $conn;
}

function getExam($conn) {
    global $value;
    $sql = "select grade as mh  from exam_table where  schedule_plan_row_id=" . $value[2] . " and schedule_plan_data_id = " . $value[3] . "  and student_id=" . $value[4] . " ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["mh"];
        }
    } else {
        echo '0';
    }


    return $conn;
}

function delete_active_course($conn) {
    global $value;
    $spids = explode("_", $value[1]);
    for ($index = 0; $index < count($spids); $index++) {
        if ($spids[$index] != "") {


            $sql = "DELETE FROM education_students where student_id=" . $spids[$index] . " and active_education=" . $value[0];

            if ($conn->query($sql) === TRUE) {
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }

    return $conn;
}

function get_active_course($conn) {
    global $value;
    //echo $value;
    $spOrder = explode("_", $value);
    $id = $spOrder[0];
    $order = solveOrderStudent($spOrder[1]);
    $ordertype = solveOrderTypeStudent($spOrder[2]);
    $orderold = solveOrderStudent($spOrder[3]);
    $ordertypeold = solveOrderTypeStudent($spOrder[4]);

    $sql = "select sc.`name`, e.education_name as ename  from schedule_plan_data sc, education e where e.education_id= sc.course_id and sc.id = " . $id . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['ename'] . ";" . $id . "/;/ ";
        }
    } else {
        echo "none/;/";
    }
    echo"/:/:/";
    $sql = "select s.student_id as id, s.student_full_name as name,s.birth_date as b from education_students es, students s where es.student_id= s.student_id and es.active_education = " . $id . " order by " . $orderold . " " . $ordertypeold . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['b'] . "/;/ ";
        }
    } else {
        echo "none/;/";
    }
    echo"/:/:/";
    $sql = "select s.student_id as id, s.student_full_name as name,s.birth_date as b from  students s where s.student_id not in (select student_id from education_students where active_education = " . $id . ") and s.student_id not in (select student_id from education_students ) order by " . $order . " " . $ordertype . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['b'] . "/;/ ";
        }
    } else {
        echo "none/;/";
        echo $conn->error;
    }
    echo"/:/:/";
    return $conn;
}

function list_active_course($conn) {
    global $value;
    $spOrder = explode("_", $value);
    $order = solveOrderActiveEducation($spOrder[0]);
    $ordertype = solveOrderTypeActiveEducation($spOrder[1]);
    $sql = "select sc.id, sc.name,e.education_name as ename,sc.start_day as s, sc.sign_day as si from schedule_plan_data sc,education e where sc.active=1 and e.education_id= sc.course_id order by " . $order . "  " . $ordertype;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['name'] . ";" . $row['ename'] . ";" . $row['s'] . ";" . $row['si'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}


function list_students_for_active($conn) {
    global $value;

    $sql = "select s.student_full_name as fn, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $value;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ";" . $row['fn'] . "//";
        }
    } else {
        echo "-1;Nincs résztvevő hozzá//";
    }
    return $conn;
}

function list_dates_for_active($conn, $type) {
    global $value;
    if ($type == 0) {
        $sql = "select `date` from schedule_plan where schedule_plan_data_id=" . $value . " group by date";
    } else if ($type == 1) {
        $sql = "select `date` from schedule_plan where exam ='true'  and schedule_plan_data_id=" . $value . " group by date";
    } else {
        $sql = "select exam_date as date from schedule_plan_data where id=" . $value . " ";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["date"] . ";" . $row['date'] . "//";
        }
    } else {
        echo "-1;Nincs ütemtervhozzá//";
    }
    return $conn;
}

function table_for_date($conn) {
    global $value;
    $student_data = array();
    $course_date = array();

    $sql = "select used_hours as uh, used_modul_id as m, used_studymaterials_id as s, replace_day as r, exam as e,used_hours_type as uht, id as id from schedule_plan where schedule_plan_data_id=" . $value[0] . " and `date`='" . $value[1] . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["m"], $row['s'], $row['uh'], $row['r'], $row['e'], $row['uht'], $row['id']);
            array_push($course_date, $loc_array);
        }
    }
    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $value[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["id"], $row['fn'], $row['br']);
            array_push($student_data, $loc_array);
        }
    }
    if (count($course_date) > 0) {
        echo $value[1] . ";" . solveBackCurUnitNameModulName($course_date) . "//";
    }
    for ($actstudent = 0; $actstudent < count($student_data); $actstudent++) {
        echo $student_data[$actstudent][1] . "-" . $student_data[$actstudent][2] . ";";
        for ($actcourse = 0; $actcourse < count($course_date); $actcourse++) {
            echo $student_data[$actstudent][0] . "_,_" . $course_date[$actcourse][6] . "_,_" . $course_date[$actcourse][2] . "_,_" . $value[0] . "_,_" . $value[1] . ";";
            //              0-id                             1-mod                               2-cur                                   3_uh                              4-rep                                           5-exam                           6-type                       7-aid                 8-date
        }
        echo '//';
    }
    return $conn;
}

function table_for_student($conn) {
    global $value;

    $sql = "select "
            . "mc.id as id,"
            . "(select sc.`date`  from schedule_plan sc where sc.id=mc.sc_plan_row_id) as date "
            . ",mc.missing_hour_ammount as hour,"
            . " (select (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi_'  end)  from schedule_plan sc where sc.id=mc.sc_plan_row_id)  as mn,"
            . " (select (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_hours_type) end)  from schedule_plan sc where sc.id=mc.sc_plan_row_id) as sn"
            . "  from missing_table mc"
            . " where"
            . " mc.active_education_id=" . $value[0] . " "
            . "and"
            . " mc.student_id=" . $value[1] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['id'] . ";" . $row['date'] . ";" . $row['hour'] . ";" . $row['mn'] . ";" . $row['sn'] . "//";
        }
    } else {

        echo "-1;Nincs;Nincs;Nincs;Nincs;";
        echo $conn->error;
    }

    return $conn;
}

function table_for_date_exam($conn) {
    global $value;
    $student_data = array();
    $course_date = array();

    $sql = "select used_hours as uh, used_modul_id as m, used_studymaterials_id as s, replace_day as r, exam as e,used_hours_type as uht, id as id from schedule_plan where schedule_plan_data_id=" . $value[0] . " and `date`='" . $value[1] . "' and  exam ='true';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["m"], $row['s'], $row['uh'], $row['r'], $row['e'], $row['uht'], $row['id']);
            array_push($course_date, $loc_array);
        }
    }

    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $value[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["id"], $row['fn'], $row['br']);
            array_push($student_data, $loc_array);
        }
    }
    if (count($course_date) > 0) {
        echo $value[1] . ";" . solveBackCurUnitNameModulName($course_date) . "//";
    }
    for ($actstudent = 0; $actstudent < count($student_data); $actstudent++) {
        echo $student_data[$actstudent][1] . "-" . $student_data[$actstudent][2] . ";";
        for ($actcourse = 0; $actcourse < count($course_date); $actcourse++) {
            echo $student_data[$actstudent][0] . "_,_" . $course_date[$actcourse][6] . "_,_" . $course_date[$actcourse][2] . "_,_" . $value[0] . "_,_" . $value[1] . ";";
            //              0-id                                                         5-exam                           6-type                       7-aid                 8-date
        }
        echo '//';
    }
    return $conn;
}

function table_for_date_exam_sum($conn) {
    global $value;
    $student_data = array();
    $course_date = array();

    $sql = "select used_hours as uh, used_modul_id as m, used_studymaterials_id as s, replace_day as r, exam as e,used_hours_type as uht, id as id from schedule_plan where schedule_plan_data_id=" . $value[0] . "  and  exam ='true';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["m"], $row['s'], $row['uh'], $row['r'], $row['e'], $row['uht'], $row['id']);
            array_push($course_date, $loc_array);
        }
    }

    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $value[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $loc_array = array($row["id"], $row['fn'], $row['br']);
            array_push($student_data, $loc_array);
        }
    }
    if (count($course_date) > 0) {
        echo   "Vizsgák/Résztvevők;" . solveBackCurUnitNameModulName($course_date) . "Záróvizsgára alkalmas/eredmény//";
    }
    for ($actstudent = 0; $actstudent < count($student_data); $actstudent++) {
        echo $student_data[$actstudent][1] . "-" . $student_data[$actstudent][2] . ";";
        for ($actcourse = 0; $actcourse < count($course_date); $actcourse++) {
            $sql = "select grade from exam_table where schedule_plan_data_id=" . $value[0] . " and student_id=" . $student_data[$actstudent][0] . " and schedule_plan_row_id=" . $course_date[$actcourse][6] . ";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {

                    echo $row['grade'] . "_,_";
                }
            } else {
                //echo $conn->error;
                
                echo 'Nem' . "_,_";
            }
        }
        $sql1 = "select"
                . " sc.id as id,"
                . " sc.`date`,"
                . " (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi'  end)  as mn,"
                . " (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_studymaterials_id) end) as et,"
                . " (select (case when (EXISTS(select mc.grade =0  from exam_table mc where mc.schedule_plan_data_id=" . $value[0] . " and mc.student_id=" . $student_data[$actstudent][0] . " and mc.schedule_plan_row_id =sc.id))=0 then 'megbukott'  else 'megbukott'  end))  as grade  "
                . "from schedule_plan sc "
                . "where sc.schedule_plan_data_id=" . $value[0] . ""
                . " and sc.exam='true' "
                . "and sc.id not in "
                . "(select mc.schedule_plan_row_id "
                . "from exam_table mc"
                . " where mc.schedule_plan_data_id=" . $value[0] . " "
                . "and mc.student_id=" . $student_data[$actstudent][0] . " and mc.grade =1);";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            echo "Nem" . ';';
        } else {
            //echo $conn->error;
               $sql2 = "select"
                    . " mc.grade as g"
                    . " from finalexam_table mc"
                    . " where mc.schedule_plan_data_id=" . $value[0] . " "
                    . "and mc.student_id=" . $student_data[$actstudent][0] . ";";
             //echo $sql2;
               $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                 while ($row = $result2->fetch_assoc()) {

                echo $row["g"] . ';';
                
                 }
                
            } else {
               
               // echo $conn->error;
                echo "Igen" . ';';
            }
           
        }
        echo '//';
    }
    return $conn;
}

function table_for_date_final_exam($conn) {
    global $value;
    $student_data = array();
    $course_date = array();


    $loc_array = array("Záróvizsga", "", "", "", "", "", "");
    array_push($course_date, $loc_array);

    $sql = "select s.student_full_name as fn,birth_date as br, es.student_id as id from education_students es, students s where es.student_id=s.student_id and es.active_education=" . $value[0];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sql1 = "select"
                    . " sc.id as id,"
                    . " sc.`date`,"
                    . " (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi'  end)  as mn,"
                    . " (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_studymaterials_id) end) as et,"
                    . " (select (case when (EXISTS(select mc.grade =0  from exam_table mc where mc.schedule_plan_data_id=" . $value[0] . " and mc.student_id=" . $row["id"] . " and mc.schedule_plan_row_id =sc.id))=0 then 'megbukott'  else 'megbukott'  end))  as grade  "
                    . "from schedule_plan sc "
                    . "where sc.schedule_plan_data_id=" . $value[0] . ""
                    . " and sc.exam='true' "
                    . "and sc.id not in "
                    . "(select mc.schedule_plan_row_id "
                    . "from exam_table mc"
                    . " where mc.schedule_plan_data_id=" . $value[0] . " "
                    . "and mc.student_id=" . $row["id"] . " and mc.grade =1);";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                
            } else {
                //    echo $conn->error;
                $loc_array = array($row["id"], $row['fn'], explode(" ", $row['br'])[0]);
                array_push($student_data, $loc_array);
            }
        }
    }
    if (count($course_date) > 0) {
        echo $value[1] . ";" . "Záróvizsga" . "//";
    }
    for ($actstudent = 0; $actstudent < count($student_data); $actstudent++) {
        echo $student_data[$actstudent][1] . "-" . $student_data[$actstudent][2] . ";";
        for ($actcourse = 0; $actcourse < count($course_date); $actcourse++) {
            echo $student_data[$actstudent][0] . "_,_" . $value[0] . "_,_" . $value[1] . ";";
            //              0-id                                                         5-exam                           6-type                       7-aid                 8-date
        }
        echo '//';
    }
    return $conn;
}

function table_for_student_exam($conn) {
    global $value;

    $sql = "select "
            . "mc.id as id,"
            . "(select sc.`date`  from schedule_plan sc where sc.id=mc.schedule_plan_row_id) as date "
            . ",mc.grade as hour,"
            . " (select (case when sc.replace_day='false' then (select modul_name from modul where modul_id=sc.used_modul_id)  else 'Alkalmi_'  end)  from schedule_plan sc where sc.id=mc.schedule_plan_row_id)  as mn,"
            . " (select (case  when sc.exam='false' then (select study_materials_name  from studymaterials where studymaterials_id=sc.used_studymaterials_id) else (select realname from helper_exam_data where `type`=sc.used_hours_type) end)  from schedule_plan sc where sc.id=mc.schedule_plan_row_id) as sn"
            . "  from exam_table mc"
            . " where"
            . " mc.schedule_plan_data_id=" . $value[0] . " "
            . "and"
            . " mc.student_id=" . $value[1] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['id'] . ";" . $row['date'] . ";" . $row['hour'] . ";" . $row['mn'] . ";" . $row['sn'] . "//";
        }
    } else {

        echo "-1;Nincs;Nincs;Nincs;Nincs;";
        echo $conn->error;
    }

    return $conn;
}

function table_for_student_final_exam($conn) {
    global $value;

    $sql = "select "
            . "mc.id as id,"
            . "mc.`date` as date"
            . ",mc.grade as hour,"
            . " mc.certificate_no as mn,"
            . " mc.certificate_date  as sn"
            . "  from finalexam_table mc"
            . " where"
            . " mc.schedule_plan_data_id=" . $value[0] . " "
            . "and"
            . " mc.student_id=" . $value[1] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['id'] . ";" . $row['date'] . ";" . $row['hour'] . ";" . $row['mn'] . ";" . $row['sn'] . "//";
        }
    } else {

        echo "-1;Nincs;Nincs;Nincs;Nincs;";
        echo $conn->error;
    }

    return $conn;
}

function solveBackCurUnitNameModulName($course_date) {
    $returnText = "";
    for ($index = 0; $index < count($course_date); $index++) {
        $conn = kapcsolodas();
        $returnText .= $course_date[$index][2] . " óra : ";
        if ($course_date[$index][3] != "true") {
            $sql = "select modul_name as mn, modul_number as m from modul where modul_id=" . $course_date[$index][0];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $returnText .= $row["mn"] . " - " . $row['m'];
                }
            }
        } else {
            $returnText .= " Alkalmi:";
        }
        if ($course_date[$index][4] != "true") {
            $sql = "select study_materials_name as sn  from studymaterials where studymaterials_id=" . $course_date[$index][1];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $returnText .= " __ " . $row["sn"];
                    switch ($course_date[$index][5]) {
                        case "1":
                            $returnText .= " __ elmélet;";
                            break;
                        case "2":
                            $returnText .= "__ gyakorlat;";
                            break;
                        case "3":
                            $returnText .= "__ elarn;";
                            break;

                        default:
                            $returnText .= "__ alkalmi;";

                            break;
                    }
                }
            }
        } else {
            switch ($course_date[$index][1]) {
                case "1":
                    $returnText .= " __ szóbeli vizsga;";
                    break;
                case "2":
                    $returnText .= "__ írásbeli vizsga;";
                    break;
                case "3":
                    $returnText .= "__ gyakorlati vizsga;";
                    break;

                default:

                    break;
            }
        }
        lekapcsolodas($conn);
    }
    return $returnText;
}

function solveOrderActiveEducation($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "sc.name";

            break;
        case "2":
            $returnValue = "e.education_name";

            break;
        case "3":
            $returnValue = "sc.start_day";

            break;
        case "4":
            $returnValue = "sc.sign_day";

            break;

        default:
            $returnValue = "sc.name";

            break;
    }
    return $returnValue;
}

function solveOrderTypeActiveEducation($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "ASC";

            break;
        case "2":
            $returnValue = "DESC";

            break;
    }
    return $returnValue;
}

function solveOrderStudent($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "s.student_full_name";

            break;
        case "2":
            $returnValue = "s.birth_date";

            break;

        default:
            $returnValue = "s.student_full_name";

            break;
    }
    return $returnValue;
}

function solveOrderTypeStudent($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "ASC";

            break;
        case "2":
            $returnValue = "DESC";

            break;
    }
    return $returnValue;
}

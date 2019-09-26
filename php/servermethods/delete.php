<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function deletecontroller($conn) {
    global $value;
    switch ($value[0]) {
        case 0: {
                deleteActiveCourseForDelete($conn);
                //echo $conn->error;
                break;
            }
        case 1: {
                deleteSchedulePlanForDelete($conn);
                //echo $conn->error;
                break;
            }
        case 2: {
                deleteCourseForDelete($conn);
                //echo $conn->error;
                break;
            }

        case 3: {
                deleteModulForDelete($conn);
                //echo $conn->error;
                break;
            }

        case 4: {
                deleteCurUnitForDelete($conn);
                //echo $conn->error;
                break;
            }

        case 5: {
                deleteBonusUnitForDelete($conn);
                //echo $conn->error;
                break;
            }
        case 6: {
                deleteStudentForDelete($conn);
                //echo $conn->error;
                break;
            }
            case 7: {
                 deleteTeacherForDelete($conn);
                echo $conn->error;
                break;
            }
            case 8: {
                 deleteTeacherForDelete($conn);
                echo $conn->error;
                break;
            }
    }
    return $conn;
}

function deleteActiveCourseForDelete($conn) {
    global $value;
    deleteSchedulePlanForDelete($conn);

    $sql = "DELETE from push_notice where schedule_plan_data_id =   " . $value[1];
    $conn->query($sql);

    $sql = "DELETE from education_students where active_education =   " . $value[1];
    $conn->query($sql);


    $sql = "DELETE from schedule_plan_data where id =   " . $value[1];
    $conn->query($sql);
    return $conn;
}

function deleteCourseForDelete($conn) {
    global $value;
    if (!courseIsUsed($value[1], $conn)) {
        $sql = "DELETE from education where education_id =   " . $value[1];
        $conn->query($sql);
    }

    return $conn;
}

function deleteModulForDelete($conn) {
    global $value;
    $volt = checkModulinUsedForDelete($value[1], $conn);
    if (!$volt) {
        $sql = "DELETE from modul where modul_id =   " . $value[1];
        $conn->query($sql);
        $sql = "UPDATE `studymaterials` SET modul_id='-1' where modul_id=" . $value[1];
        $conn->query($sql);
    }
    return $conn;
}

function deleteCurUnitForDelete($conn) {
    global $value;
    $volt = curUnitIsUsed($value[1], $conn);

    if (!$volt) {
        $sql = "DELETE from studymaterials where studymaterials_id =   " . $value[1];
        $conn->query($sql);
        $sql = "DELETE from studymaterials_teacher where studymaterials =   " . $value[1];
        $conn->query($sql);
        $sql = "DELETE from studymaterials_files where studymaterials_studymaterials_id =   " . $value[1];
        $conn->query($sql);
    }
    return $conn;
}

function deleteBonusUnitForDelete($conn) {
    global $value;
    $volt = curUnitIsUsed($value[1], $conn);

    if (!$volt) {
        $sql = "DELETE from studymaterials where studymaterials_id =   " . $value[1];
        $conn->query($sql);
        $sql = "DELETE from studymaterials_teacher where studymaterials =   " . $value[1];
        $conn->query($sql);
        $sql = "DELETE from studymaterials_files where studymaterials_studymaterials_id =   " . $value[1];
        $conn->query($sql);
    }
    return $conn;
}

function deleteSchedulePlanForDelete($conn) {
    global $value;
    $sql = "DELETE from schedule_plan where schedule_plan_data_id =   " . $value[1];
    $conn->query($sql);

    $sql = "DELETE from missing_table where active_education_id =   " . $value[1];
    $conn->query($sql);


    $sql = "DELETE from finalexam_table where schedule_plan_data_id =   " . $value[1];
    $conn->query($sql);

    $sql = "DELETE from exam_table where schedule_plan_data_id =   " . $value[1];
    $conn->query($sql);

    return $conn;
}

function deleteStudentForDelete($conn) {
    global $value;
    $sql = "select active_education from education_students where student_id = " . $value[1];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
    } else {
        $sql = "DELETE from students where student_id =   " . $value[1];
        $conn->query($sql);
    }



    return $conn;
}

function deleteTeacherForDelete($conn) {
    global $value;
    if (!teacherIsUsed($value[1], $conn)) {
        $sql = "DELETE from teachers where teacher_id =   " . $value[1];
        
        $conn->query($sql);
        $sql = "DELETE from teacher_files where teacher_id =   " . $value[1];
        
        $conn->query($sql);
    
    }


    return $conn;
}

function teacherIsUsed($id, $conn) {
    $used = false;
    $sql = "select id from schedule_plan where teacher_id = " . $id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $used = true;
    } else {
        echo $conn->error;   
    }
    return $used;
}

function checkModulinUsedForDelete($param, $conn) {
    $volt = false;
    $sql = "select id,used_finished_modul as ufm,used_modul_id as umi from schedule_plan_data  ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $spModul = explode(";", $row["umi"]);
            $spModulFin = explode(";", $row["ufm"]);
            if (in_array("" . $param, $spModul) || in_array("" . $param, $spModulFin)) {
                $volt = true;
            }
        }
    } else {
        
    }
    return $volt;
}

function courseIsUsed($id, $conn) {
    $used = false;
    $sql = "select id from schedule_plan_data where course_id=" . $id . "  ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $used = true;
    } else {
        
    }
    return $used;
}

function curUnitIsUsed($id, $conn) {
    $used = false;
    $sql = "select modul_id as id, bonus  from studymaterials where studymaterials_id= " . $id . " ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["bonus"] != "true") {

                if ($row["id"] != "-1") {
                    $used = checkModulinUsedForDelete($row["id"], $conn);
                }
            } else {
                $sql = "select id from schedule_plan where used_studymaterials_id= " . $id . " ;";
                $result1 = $conn->query($sql);
                if ($result1->num_rows > 0) {
                    // output data of each row
                    $used = true;
                } else {
                    
                }
            }
        }
    }
    return $used;
}

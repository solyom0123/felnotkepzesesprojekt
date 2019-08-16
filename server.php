<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once './php/servermethods/course.php';
include_once './php/servermethods/cur_unit.php';
include_once './php/servermethods/student.php';
include_once './php/servermethods/modul.php';
include_once './php/servermethods/teacher.php';
include_once './php/servermethods/date.php';
include_once './php/servermethods/active_courses.php';
include_once './php/servermethods/schedule.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$value = isset($_POST['param']) ? $_POST['param'] : null;
$muv = isset($_POST['muv']) ? $_POST['muv'] : null;
if ($muv == "new_modul") {
    lekapcsolodas(felvitelmodul(kapcsolodas()));
} else if ($muv == "login") {
    lekapcsolodas(login(kapcsolodas()));
} else if ($muv == "logged") {
    $_SESSION["uid"] = $value[0];
} else if ($muv == "session") {
    lookUpSession();
} else if ($muv == "user_name") {
    lekapcsolodas(user_name(kapcsolodas()));
} else if ($muv == "list_student") {
    lekapcsolodas(list_student(kapcsolodas()));
} else if ($muv == "studentSend") {
    lekapcsolodas(insertStudent(kapcsolodas()));
} else if ($muv == "studentget") {
    lekapcsolodas(getStudent(kapcsolodas()));
} else if ($muv == "studentEdit") {
    lekapcsolodas(editStudent(kapcsolodas()));
} else if ($muv == "courseSend") {
    lekapcsolodas(insertCourse(kapcsolodas()));
} else if ($muv == "courseget") {
    lekapcsolodas(getCourse(kapcsolodas()));
} else if ($muv == "courseEdit") {
    lekapcsolodas(editCourse(kapcsolodas()));
} else if ($muv == "list_course") {
    lekapcsolodas(list_course(kapcsolodas()));
} else if ($muv == "modulSend") {
    lekapcsolodas(insertModul(kapcsolodas()));
} else if ($muv == "list_modul") {
    lekapcsolodas(list_modul(kapcsolodas()));
} else if ($muv == "modulEdit") {
    lekapcsolodas(editModul(kapcsolodas()));
}else if ($muv == "modulget") {
    lekapcsolodas(getModul(kapcsolodas()));
} else if ($muv == "upload_kep") {
    uploadImage();
    echo "<script>window.close();</script>";
} else if ($muv == "upload_file") {
    uploadFile();
    echo "<script>window.close();</script>";
}else if ($muv == "list_modul_filter") {
    lekapcsolodas(list_modul_filter(kapcsolodas()));
} else if ($muv == "curunitSend") {
    lekapcsolodas(insertCurUnit(kapcsolodas()));
} else if ($muv == "curunitEdit") {
    lekapcsolodas(editCurUnit(kapcsolodas()));
} else if ($muv == "curunitget") {
    lekapcsolodas(getCurUnit(kapcsolodas()));
} else if ($muv == "list_cur_unit_filter") {
    lekapcsolodas(list_cur_unit_filter(kapcsolodas()));
} else if ($muv == "list_teacher") {
    lekapcsolodas(list_teacher(kapcsolodas()));
} else if ($muv == "teacherSend") {
    lekapcsolodas(insertTeacher(kapcsolodas()));
} else if ($muv == "teacherget") {
    lekapcsolodas(getTeacher(kapcsolodas()));
} else if ($muv == "teacherEdit") {
    lekapcsolodas(editTeacher(kapcsolodas()));
} else if($muv=="list_cur_unit_teacher"){
    lekapcsolodas(list_teacher_cur_unit(kapcsolodas()));
} else if($muv=="list_cur_unit_without_teacher"){
    lekapcsolodas(list_teacher_cur_without_unit(kapcsolodas()));
}else if ($muv == "connectionSend") {
    lekapcsolodas(insertConnection(kapcsolodas()));
} else if ($muv == "connectionget") {
    lekapcsolodas(getConnection(kapcsolodas()));
} else if ($muv == "connectionEdit") {
    lekapcsolodas(editConnection(kapcsolodas()));
}else if ($muv == "delete_cur_unit_teacher") {
    lekapcsolodas(deleteConnection(kapcsolodas()));
}else if ($muv == "monthGet") {
    lekapcsolodas(getDates(kapcsolodas()));
}else if ($muv == "dateEdit") {
    lekapcsolodas(dateEdit(kapcsolodas()));
}else if ($muv == "list_modul_selector_piece") {
    lekapcsolodas(list_modul_for_course_with_piece(kapcsolodas()));
}else if ($muv == "enough_day") {
    lekapcsolodas(enough_day(kapcsolodas()));
}else if ($muv == "list_modul_filter_with_education_ordeless") {
    lekapcsolodas(list_modul_filter_with_non_ordered(kapcsolodas()));
}else if ($muv == "course_start") {
    makeSchedulePlan();
}else if ($muv == "delete_edited_sc") {
    lekapcsolodas(deleteedited(kapcsolodas()));
}else if ($muv == "pass_schedule") {
    lekapcsolodas(passschedule(kapcsolodas()));
}else if ($muv == "searchTeacher") {
    lekapcsolodas(searchTeacher(kapcsolodas()));
} else if($muv =="cur_units_without_this_course"){
    lekapcsolodas(curUnitsWithoutThisCourse(kapcsolodas()));
}else if($muv =="list_active_course"){
    lekapcsolodas(list_active_course(kapcsolodas()));
}else if($muv =="active_course_get"){
    lekapcsolodas(get_active_course(kapcsolodas()));
}else if($muv =="activeCourseDelete"){
    lekapcsolodas(delete_active_course(kapcsolodas()));
}else if($muv =="activeCourseSend"){
    lekapcsolodas(send_active_course(kapcsolodas()));
}else if($muv =="load_an_active_schedule"){
    lekapcsolodas(select_all_dataforAnActiveEducation(kapcsolodas()));
}else if($muv =="edit_an_active_schedule_data"){
    lekapcsolodas(edit_dataforAnActiveEducation(kapcsolodas()));
}else if ($muv == "edit_schedule") {
    lekapcsolodas(editschedule(kapcsolodas()));
}


function kapcsolodas() {
    $szerverneve = "mysql.nethely.hu";
    $felhasznalonev = "oktat";
    $password = 'corvin2019';
    $dbname = 'oktat';
    $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);

    mysqli_query($conn, "SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function lekapcsolodas($conn) {
    $conn->close();
}

function lookUpSession() {
    if (isset($_SESSION['uid'])) {
        echo 'true';
    } else {
        echo 'false';
    }
}

function login($conn) {
    global $value;
    $sql = "select user_id as id, password as pw  from `user` where user_name='" . $value[0] . "'  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if (password_verify($value[1], $row["pw"])) {
                echo 'true;' . $row["id"];
            } else {
                echo 'false;';
            }
        }
    } else {
        echo "false;";
    }
    return $conn;
}


function user_name($conn) {
    global $value;
    $sql = "select user_name as name  from `user` where user_id='" . $value . "'  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"];
        }
    } else {
        echo "none;";
    }
    return $conn;
}


<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

function list_student($conn) {
    $sql = "select student_id as id, student_full_name as name  from students ;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}

function insertStudent($conn) {
    global $value;
    $sql = "INSERT INTO students (student_full_name, birth_name, mothers_name,birth_place,gender,nationality,phone_number,taj,birth_date,home_address)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "','" . $value[6] . "','" . $value[7] . "','" . $value[8] . "." . $value[9] . "." . $value[10] . "','" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function getStudent($conn) {
    global $value;

    $sql = "select student_full_name as nev,birth_name as bnev,mothers_name as anev,birth_date as bd,birth_place as bp,gender as g,home_address as ha,nationality as n,phone_number as pn,taj  from students where student_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['bnev'] . "/;/" . $row['anev'] . "/;/" . $row['bd'] . "/;/" . $row['bp'] . "/;/" . $row['g'] . "/;/" . $row['ha'] . "/;/" . $row['n'] . "/;/" . $row['pn'] . "/;/" . $row['taj'] . "/;/";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}
function editStudent($conn) {
    global $value;
    $sql = "UPDATE students SET student_full_name='" . $value[0] . "', birth_name='" . $value[1] . "', mothers_name ='" . $value[2] . "',birth_place='" . $value[3] . "',gender='" . $value[4] . "',nationality='" . $value[5] . "',phone_number='" . $value[6] . "',taj='" . $value[7] . "',birth_date='" . $value[8] . "." . $value[9] . "." . $value[10] . "',home_address='" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "' where student_id=".$value[16];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

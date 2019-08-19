<?php

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
          $id = getStudentId();
        echo ','.$id;
    } else {
        echo 'error';
    }

    return $conn;
}
function getStudentId() {
    $id = 0;
    $conn = kapcsolodas();
   
        $sql = "select max(student_id) as id  from students ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
        }
    } else {
        $id = 0;
        echo $conn->error;
    }
    lekapcsolodas($conn);
    return $id;
}
function getStudent($conn) {
    global $value;

    $sql = "select student_full_name as nev,birth_name as bnev,mothers_name as anev,birth_date as bd,birth_place as bp,gender as g,home_address as ha,nationality as n,phone_number as pn,taj,userid  from students where student_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['bnev'] . "/;/" . $row['anev'] . "/;/" . $row['bd'] . "/;/" . $row['bp'] . "/;/" . $row['g'] . "/;/" . $row['ha'] . "/;/" . $row['n'] . "/;/" . $row['pn'] . "/;/" . $row['taj'] . "/;/" . $row['userid'] . "/;/";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}

function editStudent($conn) {
    global $value;
    $sql = "UPDATE students SET student_full_name='" . $value[0] . "', birth_name='" . $value[1] . "', mothers_name ='" . $value[2] . "',birth_place='" . $value[3] . "',gender='" . $value[4] . "',nationality='" . $value[5] . "',phone_number='" . $value[6] . "',taj='" . $value[7] . "',birth_date='" . $value[8] . "." . $value[9] . "." . $value[10] . "',home_address='" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "' where student_id=" . $value[16];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function userEdit($conn) {
    global $value;
    if ($value[1] == 1) {
        $sql = "select userid as u from students where student_id=" . $value[0] . ";  ";
    } else {
        $sql = "select userid as u from teachers where teacher_id=" . $value[0] . ";  ";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["u"] != ""&&$row["u"]!="0") {

                $sql = "UPDATE `user` SET user_name='" . $value[3] . "', password='" .  password_hash($value[4], PASSWORD_DEFAULT) . "' where user_id=" . $row["u"] . ";";

                if ($conn->query($sql) === TRUE) {
                    echo 'ok';
                } else {
                    echo 'error';
                }
            } else {
                if ($value[1] == 1) {
                    $sql = "INSERT INTO `user` (user_name, password, permission_id) VALUES ('" . $value[3] . "','" . password_hash($value[4], PASSWORD_DEFAULT) . "',4)";
                } else {
                    $sql = "INSERT INTO `user` (user_name, password, permission_id) VALUES ('" . $value[3] . "','" . password_hash($value[4], PASSWORD_DEFAULT). "',3)";
                }

                if ($conn->query($sql) === TRUE) {
                    $id = getNewUserid();
                    //echo $id;
                    if ($value[1] == 1) {
                        $sql = "UPDATE students SET userid=" . $id . " where student_id=" . $value[0];
                    } else {
                        $sql = "UPDATE teachers SET userid=" . $id . " where teacher_id=" . $value[0];
                    }
                    if ($conn->query($sql) === TRUE) {
                        echo 'ok';
                    } else {
                        echo 'error';
                         echo $conn->error;
                    }
                   
                } else {
                    echo 'error';
                     echo $conn->error;
                }
            }
        }
    } else {
        echo "error";
        echo $conn->error;
    }
  return $conn;
}

function getNewUserid() {
    $id = 0;
    $conn = kapcsolodas();

    $sql = "select max(user_id) as id  from `user` ;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
        }
    } else {
        $id = 0;
        echo $conn->error;
    }
    lekapcsolodas($conn);
    return $id;
}

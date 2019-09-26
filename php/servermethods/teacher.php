<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function list_teacher($conn, $bonus) {
    if ($bonus) {
        $bonus = "true";
    } else {
        $bonus = "false";
    }
    $sql = "select teacher_id as id, teacher_full_name as name  from teachers where bonus = '" . $bonus . "' ;  ";
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

function insertTeacher($conn, $bonus) {
    if ($bonus) {
        $bonus = "true";
    } else {
        $bonus = "false";
    }
    global $value;
    $sql = "INSERT INTO teachers (teacher_full_name, birth_name, mothers_name,birth_place,gender,nationality,phone_number,taj,birth_date,home_address,bonus,email)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "','" . $value[6] . "','" . $value[7] . "','" . $value[8] . "." . $value[9] . "." . $value[10] . "','" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "','" . $bonus . "','" . $value[16] . "')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
        $id = getTeacherId();
        echo ',' . $id;
    } else {
        echo 'error';
    }

    return $conn;
}

function getTeacher($conn) {
    global $value;

    $sql = "select teacher_full_name as nev,birth_name as bnev,mothers_name as anev,birth_date as bd,birth_place as bp,gender as g,home_address as ha,nationality as n,phone_number as pn,taj,userid,email  from teachers where teacher_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['bnev'] . "/;/" . $row['anev'] . "/;/" . $row['bd'] . "/;/" . $row['bp'] . "/;/" . $row['g'] . "/;/" . $row['ha'] . "/;/" . $row['n'] . "/;/" . $row['pn'] . "/;/" . $row['taj'] . "/;/" . $row["userid"] . "/;/" . $row["email"] . "/;/";
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}

function editTeacher($conn) {
    global $value;
    $sql = "UPDATE teachers SET teacher_full_name='" . $value[0] . "', birth_name='" . $value[1] . "', mothers_name ='" . $value[2] . "',birth_place='" . $value[3] . "',gender='" . $value[4] . "',nationality='" . $value[5] . "',phone_number='" . $value[6] . "',taj='" . $value[7] . "',birth_date='" . $value[8] . "." . $value[9] . "." . $value[10] . "',home_address='" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "', email='" . $value[17] . "' where teacher_id=" . $value[16];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
        echo $conn->error;
    }

    return $conn;
}

function getLoginData($conn) {
    global $value;
    $sql = "select user_name from user where user_id =" . $value . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["user_name"];
        }
    } else {
        echo "none//";
    }
    return $conn;
}

function list_teacher_cur_unit($conn, $reverse, $bonus) {
    global $value;
    if (!$reverse) {
        if ($bonus) {
            $bonus = "true";
        } else {
            $bonus = "false";
        }
        $id = $value[0];
        $spOrder = explode("_", $value[1]);
        $order = solveOrderCurunit($spOrder[0]);
        $ordertype = solveOrderTypeCurunit($spOrder[1]);
        $sql = "select s.studymaterials_id as id, s.study_materials_name as name ,(select modul_name from modul where modul_id = s.modul_id) as mname from studymaterials s where s.studymaterials_id in (select studymaterials from studymaterials_teacher where teacher=" . $id . ")  and s.bonus='" . $bonus . "' order by " . $order . " " . $ordertype . ";  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row["name"] . ";" . $row['id'] . ";" . $row["mname"] . "//";
            }
        } else {
            echo $conn->error;
            echo "none;//";
        }
    } else {
        $id = $value[0];
        $spOrder = explode("_", $value[1]);
        $order = solveOrderCurunit($spOrder[0]);
        $ordertype = solveOrderTypeCurunit($spOrder[1]);
        $sql = "select s.teacher_id as id, s.teacher_full_name as name,'Alkalmi oktató' as mname from teachers s where s.teacher_id in (select teacher from studymaterials_teacher where studymaterials=" . $id . ") and s.bonus='true' order by " . $order . " " . $ordertype . " ;  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row["name"] . ";" . $row['id'] . ";" . $row["mname"] . "//";
            }
        } else {
            echo "none;//";
        }
    }
    return $conn;
}

function list_teacher_cur_without_unit($conn, $reverse) {
    global $value;
    if (!$reverse) {
        $id = $value[0];
        $spOrder = explode("_", $value[1]);
        $order = solveOrderCurunit($spOrder[0]);
        $ordertype = solveOrderTypeCurunit($spOrder[1]);
        $sql = "select s.studymaterials_id as id, s.study_materials_name as name,(select modul_name from modul where modul_id = s.modul_id) as mname from studymaterials s where s.studymaterials_id not in (select studymaterials from studymaterials_teacher where teacher=" . $id . ") and s.bonus='false' order by " . $order . " " . $ordertype . " ;  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row["name"] . ";" . $row['id'] . ";" . $row["mname"] . "//";
            }
        } else {

            echo "none;//";
        }
    } else {
        $id = $value[0];
        $spOrder = explode("_", $value[1]);
        $order = solveOrderCurunit($spOrder[0]);
        $ordertype = solveOrderTypeCurunit($spOrder[1]);
        $sql = "select s.teacher_id as id, s.teacher_full_name as name,'Alkalmi oktató' as mname from teachers s where s.teacher_id not in (select teacher from studymaterials_teacher where studymaterials=" . $id . ") and s.bonus='true' order by " . $order . " " . $ordertype . " ;  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row["name"] . ";" . $row['id'] . ";" . $row["mname"] . "//";
            }
        } else {
            echo "none;//";
        }
    }
    return $conn;
}

function insertConnection($conn, $reverse) {
    global $value;
    if (!$reverse) {
        $spids = explode("_", $value[1]);
        for ($index = 0; $index < count($spids); $index++) {
            if ($spids[$index] != "") {


                $sql = "INSERT INTO studymaterials_teacher(teacher, studymaterials)
VALUES ('" . $value[0] . "','" . $spids[$index] . "')";

                if ($conn->query($sql) === TRUE) {
                    echo 'ok';
                } else {
                    echo 'error' . $conn->error;
                }
            }
        }
    } else {
        $spids = explode("_", $value[0]);
        for ($index = 0; $index < count($spids); $index++) {
            if ($spids[$index] != "") {


                $sql = "INSERT INTO studymaterials_teacher(teacher, studymaterials)
VALUES ('" . $spids[$index] . "','" . $value[1] . "')";

                if ($conn->query($sql) === TRUE) {
                    echo 'ok';
                } else {
                    echo 'error' . $conn->error;
                }
            }
        }
    }
    return $conn;
}

function deleteConnection($conn, $reverse) {
    global $value;
    if (!$reverse) {

        $spids = explode("_", $value[1]);
        for ($index = 0; $index < count($spids); $index++) {
            if ($spids[$index] != "") {
                if (!teacherIsUsedAtCurUnit($value[0], $spids[$index], $conn)) {

                    $sql = "DELETE from studymaterials_teacher where teacher= " . $value[0] . "  and studymaterials =   " . $spids[$index];

                    if ($conn->query($sql) === TRUE) {
                        echo 'ok';
                    } else {
                        echo 'error' . $conn->error;
                    }
                } else {
                    //echo  $value[0];
                    //var_dump($spids);
                    echo 'error';
                }
            }
        }
    } else {
        $spids = explode("_", $value[0]);
        for ($index = 0; $index < count($spids); $index++) {
            if ($spids[$index] != "") {
                if (!teacherIsUsedAtCurUnit($spids[$index],$value[1], $conn)) {

                    $sql = "DELETE from studymaterials_teacher where teacher= " . $spids[$index] . "  and studymaterials =   " . $value[1];

                    if ($conn->query($sql) === TRUE) {
                        echo 'ok';
                    } else {
                        echo 'error' . $conn->error;
                    }
                } else {
                    echo error;
                }
            }
        }
    }
    return $conn;
}

function solveOrderCurunit($order) {
    $returnValue = '';
    switch ($order) {
        case "1":
            $returnValue = "name";

            break;
        case "2":
            $returnValue = "mname";

            break;

        default:
            $returnValue = "name";

            break;
    }
    return $returnValue;
}

function solveOrderTypeCurunit($order) {
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

function getTeacherId() {
    $id = 0;
    $conn = kapcsolodas();

    $sql = "select max(teacher_id) as id  from teachers ;";
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

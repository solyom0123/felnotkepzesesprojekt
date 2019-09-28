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
    $sql = "INSERT INTO students (student_full_name, birth_name, mothers_name,birth_place,gender,nationality,phone_number,taj,birth_date,home_address,enrollment_to_course,educational_attainment,email)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "','" . $value[4] . "','" . $value[5] . "','" . $value[6] . "','" . $value[7] . "','" . $value[8] . "." . $value[9] . "." . $value[10] . "','" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "','" . $value[16] . "." . $value[17] . "." . $value[18] . "','" . $value[19] . "','" . $value[20] . "','" . $value[21] . "')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
        $id = getStudentId();
        echo ',' . $id;
    } else {
        echo 'error';
        echo $conn->error;
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

    $sql = "select paymode as py,student_full_name as nev,birth_name as bnev,mothers_name as anev,birth_date as bd,birth_place as bp,gender as g,home_address as ha,nationality as n,phone_number as pn,taj,userid,enrollment_to_course as ec, educational_attainment as ea, email  from students where student_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['bnev'] . "/;/" . $row['anev'] . "/;/" . $row['bd'] . "/;/" . $row['bp'] . "/;/" . $row['g'] . "/;/" . $row['ha'] . "/;/" . $row['n'] . "/;/" . $row['pn'] . "/;/" . $row['taj'] . "/;/" . $row['userid'] . "/;/" . $row['ec'] . "/;/" . $row['ea'] . "/;/" . $row['email'] . "/;/" . $row['py'];
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}

function editStudent($conn) {
    global $value;
    $sql = "UPDATE students SET email='" . $value[21] . "',student_full_name='" . $value[0] . "', birth_name='" . $value[1] . "', mothers_name ='" . $value[2] . "',birth_place='" . $value[3] . "',gender='" . $value[4] . "',nationality='" . $value[5] . "',phone_number='" . $value[6] . "',taj='" . $value[7] . "',birth_date='" . $value[8] . "." . $value[9] . "." . $value[10] . "',home_address='" . $value[11] . "," . $value[12] . "," . $value[13] . "," . $value[14] . "," . $value[15] . "',enrollment_to_course='" . $value[17] . "." . $value[18] . "." . $value[19] . "',educational_attainment='" . $value[20] . "',paymode='" . $value[22] . "' where student_id=" . $value[16];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
        echo $conn->error;
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
            if ($row["u"] != "" && $row["u"] != "0") {

                $sql = "UPDATE `user` SET user_name='" . $value[3] . "' where user_id=" . $row["u"] . ";";

                if ($conn->query($sql) === TRUE) {
                    echo 'ok';
                } else {
                    echo 'error';
                }
            } else {
                if ($value[1] == 1) {
                    $sql = "INSERT INTO `user` (user_name, permission_id) VALUES ('" . $value[3] . "',4)";
                } else {
                    $sql = "INSERT INTO `user` (user_name, permission_id) VALUES ('" . $value[3] . "',3)";
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

function getUsedNames() {
    global $value;


    if ($value[0] == 1) {
        $conn = kapcsolodas2();
        $sql = "select user_name as n  from `user` where user_name like '" . $value[1] . "%';";
    } else {
        $conn = kapcsolodas();
        $sql = "select `name`  as n  from schedule_plan_data where `name` like '" . $value[1] . "%';";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["n"] . ";";
        }
    } else {
        echo "none;";
    }
    lekapcsolodas($conn);
}

function exportUser($conn) {
    global $value;
    $type = $_POST["type"];
    $dontUsed = array();

    if ($type == 0 || $type == 1) {
        $user_data = array();
        $sql = "select si.student_full_name as sf,birth_date as ni ,us.user_name as n,us.password as p  from  `user` as us,schedule_plan_data sc ,education_students s, students si where sc.id='" . $value . "' and sc.id=s.active_education and si.student_id=s.student_id and si.userid = us.user_id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if (strlen($row["p"]) > 0) {
                    $strch = "<tr><td>" . $row["sf"] . "</td><td>" . explode(" ", $row["ni"])[0] . "</td><td>(Résztvevő)</td></tr>";

                    array_push($user_data, array($row["n"], $row["p"], $strch));
                    //          echo ;
                }
            }
        } else {
            
        }
        $sql = "select si.student_full_name as sf ,si.birth_date as n  from  schedule_plan_data sc ,education_students s, students si where sc.id='" . $value . "' and sc.id=s.active_education and si.student_id=s.student_id ;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $strch = "<tr><td>" . $row["sf"] . "</td><td>" . explode(" ", $row["n"])[0] . "</td><td>(Résztvevő)</td></tr>";

                if (!in_array_own($strch, $user_data)) {
                    array_push($dontUsed, $strch);
                }
                //      echo ;
            }
        } else {
            
        }
    }
    if ($type == 0 || $type == 2) {

        $moduls = array();
        $sql = "select sc.used_modul_id as m,sc.used_finished_modul_place as fm  from schedule_plan_data sc where sc.id='" . $value . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $modul = explode(";", $row["m"]);
                foreach ($modul as $valuese) {
                    array_push($moduls, $valuese);
                }

                $modul = explode(";", $row["fm"]);
                foreach ($modul as $valuese) {
                    array_push($moduls, $valuese);
                }
            }
        } else {
            
        }
        foreach ($moduls as $valuesee) {
            $sql = "select si.teacher_full_name as sf,si.birth_date as ni ,us.user_name as n,us.password as p  from  `user` as us,modul m,studymaterials sa, studymaterials_teacher s, teachers si where m.modul_id='" . $valuesee . "' and m.modul_id=sa.modul_id and sa.studymaterials_id=s.studymaterials and s.teacher=si.teacher_id and si.userid = us.user_id group by si.teacher_id;";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if (strlen($row["p"]) > 0) {
                        $strch = "<tr><td>" . $row["sf"] . "</td><td>" . explode(" ", $row["ni"])[0] . "</td><td>(Oktató)</td></tr>";

                        array_push($user_data, array($row["n"], $row["p"], $strch));
                        //          echo ;
                    }
                }
            } else {
                
            }
        }



        foreach ($moduls as $valuesee) {

            $sql = "select si.teacher_full_name as sf,si.birth_date as n from  modul m,studymaterials sa, studymaterials_teacher s, teachers si where m.modul_id='" . $valuesee . "' and m.modul_id=sa.modul_id and sa.studymaterials_id=s.studymaterials and s.teacher=si.teacher_id group by si.teacher_id;";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $strch = "<tr><td>" . $row["sf"] . "</td><td>" . explode(" ", $row["n"])[0] . "</td><td>(Oktató)</td></tr>";
                    if (!in_array($strch, $dontUsed)) {
                        if (!in_array_own($strch, $user_data)) {
                            array_push($dontUsed, $strch);
                        }
                    }
                    //      echo ;
                }
            } else {
                
            }
        }
    }
    if (!(count($dontUsed) > 0)) {
        //echo $conn->error;
        //var_dump($user_data);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="user_export_' . $value . '_' . date("Y-m-d") . '.csv";');

        for ($index = 0; $index < count($user_data); $index++) {

            echo $user_data[$index][0] . ";" . $user_data[$index][1];
        }
    } else {
        echo 'Ezek az embereknek nincs felhasználó fiókjuk vagy jelszavuk nincs beállítva:' . "<br><table>";
        foreach ($dontUsed as $values) {
            echo $values;
        }
        echo '</table>';
    }
    return $conn;
}

function in_array_own($value, $array) {
    $returnValue = false;
    for ($index = 0; $index < count($array); $index++) {
        if ($array[$index][2] == $value) {
            $returnValue = true;
        }
    }
    return $returnValue;
}

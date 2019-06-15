<?php

function insertCourse($conn) {
    global $value;
    $sql = "INSERT INTO education (education_name,okj_number,education_inhouse_id,image,education_center)
VALUES ('" . $value[0] . "','" . $value[1] . "','" . $value[2] ."','" . $value[3] ."','" . $value[4] ."')";

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function getCourse($conn) {
    global $value;

    $sql = "select education_name as nev,okj_number as okj,education_inhouse_id as id,education_center as center,image from education where education_id=" . $value . ";  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["nev"] . "/;/" . $row['okj'] . "/;/" . $row['id'] . "/;/ " . $row['center'] . "/;/". $row['image'] . "/;/" ;
        }
    } else {
        echo "none/;/";
    }

    return $conn;
}
function editCourse($conn) {
    global $value;
    $sql = "UPDATE education SET education_name='" . $value[0] . "', okj_number='" . $value[1] . "', education_inhouse_id ='" . $value[2] . "' , education_center ='" . $value[4] . "',  image ='" . $value[5] . "' where education_id=".$value[3];

    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo 'error';
    }

    return $conn;
}

function list_course($conn) {
    $sql = "select education_id as id, education_name as name,image as image  from education ;  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ";" . $row['image'] . ";" . $row['id'] . "//";
        }
    } else {
        echo "none;//";
    }
    return $conn;
}
function uploadImage(){
    $target_dir = "img/";
$target_file = $target_dir . basename($_FILES["form-row-kep"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["form-row-kep"])) {
    $check = getimagesize($_FILES["form-row-kep"]["tmp_name"]);
    if($check !== false) {
       $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
if ($uploadOk == 0) {
  //  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["form-row-kep"]["tmp_name"], $target_file)) {
   //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
    //    echo "Sorry, there was an error uploading your file.";
    }
}

}
function uploadFile(){
    $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["form-row-alk"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["form-row-alk"])) {
    $check = getimagesize($_FILES["form-row-alk"]["tmp_name"]);
    if($check !== false) {
       $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
if ($uploadOk == 0) {
  //  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["form-row-alk"]["tmp_name"], $target_file)) {
   //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
    //    echo "Sorry, there was an error uploading your file.";
    }
}

}

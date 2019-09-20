<?php

$hir = "";
$name = "";
$user_name = "";
$email = "";
$token = "";
$uid = "";
$id = "";
$type = "";
$hiba = false;
$hiba_send = false;
$param = isset($_POST['param']) ? $_POST['param'] : 0;
if ($param != 0) {
    $uid = $param[2];
    $id = $param[0];
    $type = $param[1];
    lekapcsolodas3(getUserData(kapcsolodas3()));
    if ($type == 1) {
        lekapcsolodas3(getStudentData(kapcsolodas3()));
    } else {

        lekapcsolodas3(getTeacherData(kapcsolodas3()));
    }
    
        if($email==""){
            $hiba=true;
        }
    if (!$hiba) {
        lekapcsolodas3(makeToken(kapcsolodas3()));
        hirkeszites();
        if ($hiba_send) {
            echo 'error:send';
        } else {
            echo 'ok';
        }
    } else {
        echo 'error:data';
    }
}

function kapcsolodas3() {
     $szerverneve = "mysql.nethely.hu";//"localhost"; //";;
    $felhasznalonev = "oktat";//'root'; //
    $password = 'corvin2019';//""; //
    $dbname = 'oktat';
   $conn = new mysqli($szerverneve, $felhasznalonev, $password, $dbname);

    mysqli_query($conn, "SET NAMES 'UTF8'");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function lekapcsolodas3($conn) {
    $conn->close();
}

function getUserData($conn) {
    global $param, $user_name, $hiba;
    $sql = "SELECT user_name as ua FROM `user` where user_id=" . $param[2] . " ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_name = $row["ua"];
        }
    } else {
        $hiba = true;
    }
    return $conn;
}

function getTeacherData($conn) {
    global $email, $name, $id, $hiba;
    $sql = "SELECT teacher_full_name as tn,email as e FROM teachers where teacher_id=" . $id . ";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["tn"];
            $email = $row["e"];
        }
    } else {
        $hiba = true;
    }
    return $conn;
}

function getStudentData($conn) {
    global $email, $name, $id, $hiba;
    $sql = "SELECT student_full_name as tn,email as e FROM students where student_id=" . $id . ";";
   
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["tn"];
            $email = $row["e"];
        }
    } else {
        $hiba = true;
    }
    return $conn;
}

function makeToken($conn) {
    global $token, $id, $uid;
    $ok = false;
    $sql = "SELECT id FROM token where uid='" . $uid . "';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql = " DELETE FROM `token`  where id='" . $row['id'] . "';";
            if ($conn->query($sql) === TRUE) {
                //echo 'ok';
            } else {
                //echo 'error';
                //echo $conn->error;
            }
        }
    } else {
        
    }

    while (!$ok) {

        $token = bin2hex(random_bytes(64));
        //var_dump($token);
        $sql = "SELECT id FROM token where token='" . $token . "';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ok = false;
            }
        } else {
            $ok = true;
            $sql = "INSERT INTO token (token,uid,aid) 
VALUES ('" . $token . "','" . $uid . "','" . $id . "')";

            if ($conn->query($sql) === TRUE) {
                //echo 'ok';
            } else {
                //echo 'error';
                //echo $conn->error;
            }
        }
    }
    return $conn;
}

function hirkeszites() {
    global $name, $user_name, $token, $hir;
    $hir = '<html>
    <head>
        <style>
                .stilus{   
                margin: auto;
               text-align: center;
		width:750px;
		color: #ffffff;
                height: auto;
                background-color: burlywood;
}
        .kep{
    width: 150px;
    height: auto;
}
            .hirelem{
               
				width:750px;
				height:auto;
				 
				color:#ffffff;

}
.style11 {     
                                margin:0 auto;
				width: 750px;
				height: auto;
				background-color: rgba(0,0,0,0.1);
				border-radius: 10px;
				box-shadow: inset 0 50px rgba(255,255,255,0.2), inset 0 -15px 30px rgba(0,0,0,0.4), 0 5px 10px rgba(0,0,0,0.5);
				font-family: Amarante, Arial, Helvetica, sans-serif;
				font-size: 20px;
				color: #ffffff;
				text-align: center;
                                 display: block;
}
.ido {          float:right;
                width:80px;
                height:40px;
                background-color: rgba(0,0,0,0.1);
                box-shadow: inset 0 50px rgba(255,255,255,0.2), inset 0 -15px 30px rgba(0,0,0,0.4), 0 5px 10px rgba(0,0,0,0.5);
                font-family: Amarante, Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #ffffff;
                z-index: 1;
}
            
     h1 {     color: #ffffff;
     }
     
     h2 {     color: #ffffff;
     }';

    $hir = $hir . '
        </style>
        <title>Email értesítő a jelszó beállításhoz!</title>
        <meta charset="UTF-8">
    </head>
    <body class="stilus"><h1>Email értesítő a jelszó beállításhoz!</h1>
        <p>Tiszlelt  ' . $name . '!</p> 
    <p style="text-align: center;">Ezt az email-t, a Corvin Képzőközpont küldi önnek!<br> Az email tartalmaza a linket, melyen egyszer beállíthatja/módosíthatja a jelszavát </p>
        <p>A link megnyitásához kérjük kattintson a képre!</p>
        <p>A felhasználó név:' . $user_name . '</p>
        
        <a href="http://oktat.narasoft.hu/other_php_pages/password_set.php?token=' . $token . '"><img src="http://oktat.narasoft.hu/img/jelszo.png" ></a>
        <p style="text-align: center">Email értesítő jelszó váltáshoz</p>
        <p> </p>
    </body>
</html>';

    //echo $hir;
    kuldes();
}

function kuldes() {
    global $hir, $email, $hiba_send;
    require("PHPMailer-master/class.phpmailer.php");
    require("PHPMailer-master/class.smtp.php");

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'saten.noreply@gmail.com';
        $mail->Password = 'satenvagyok01';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('saten.noreply@gmail.com', 'Corvin');
        $mail->addReplyTo('saten.noreply@gmail.com', 'Corvin');
        $mail->isHTML(true);
        $mail->Subject = 'Email ertesito a jelszo beallitashoz!';
        $mail->Body = $hir;

        $mail->addAddress($email);

        if ($mail->send()) {

            $mail->ClearAllRecipients();
        } else {
            $hiba_send = true;
        }

        $mail->ClearAllRecipients();
    } catch (phpmailerException $e) {
        $hiba_send = true;
        
    }
}

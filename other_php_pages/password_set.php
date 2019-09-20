<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

  ,

 */
$user_name = "";
$token = "";
$uid = "";
$id = "";
$type = "";
$ps = "";
$ps_ag ="";
$hiba = false;
$hiba_send = false;
$error_massage="";
$param = isset($_GET['token']) ? $_GET['token'] : 0;
//$send = isset($_POST['sendBtn']) ? $_POST['sendBtn'] : 0;
if (isset($_POST["sendBtn"])) {
    $ps= trim($_POST["ps"]);
    $token= trim($_POST["token"]);
    $uid = trim($_POST["uid"]);
    $ps_ag= trim($_POST["ps-ag"]);
    if($ps==$ps_ag&$ps!=""&$ps_ag!=""){
    lekapcsolodas3(updatePassword(kapcsolodas3()));
    lekapcsolodas3(deleteToken(kapcsolodas3()));
      if($hiba_send){
        $error_massage =" Sikertelen módosítás! Kérem lépjen kapcsolatba az ügyintézőjével!";
      }else{
         $error_massage =" Sikeres módosítás!";
         
      }
    
    }else{
        $hiba=false;
        $error_massage ="A két jelszó nem egyezik.";

        $param=$token;
    }
}
if (isset($_GET['token']) ) {
    $token = $param;
    lekapcsolodas3(getToken(kapcsolodas3()));
    if (!$hiba) {
    lekapcsolodas3(getUserData(kapcsolodas3()));
    } else {
     $error_massage =" Törölt user vagy érvénytelen token!";
   
    }
}else{
      $error_massage ="Tiltott behatolási kísérlet!";
   
    $hiba=true;
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
function updatePassword($conn){
    global $ps,$uid,$hiba_send;
$sql = " Update `user`  set  `password`='" .  password_hash($ps, PASSWORD_DEFAULT) . "'  where user_id='" .$uid . "';";
            if ($conn->query($sql) === TRUE) {
                //echo 'ok';
            } else {
                $hiba_send=true;
                //echo 'error';
                echo $conn->error;
            }
    return $conn;
}
function getUserData($conn) {
    global $param, $user_name, $hiba, $uid;
    $sql = "SELECT user_name as ua FROM `user` where user_id=" . $uid . " ;";
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
function deleteToken($conn){
    global $token,$hiba_send;
$sql = " DELETE FROM `token`  where token='" .$token . "';";
            if ($conn->query($sql) === TRUE) {
                //echo 'ok';
            } else {
                $hiba_send=true;
                //echo 'error';
                //echo $conn->error;
            }
            
    return $conn;
}
function getToken($conn) {
    global $token, $uid, $hiba;
    $sql = "SELECT uid FROM token where token='" . $token . "';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $uid = $row["uid"];
        }
    } else {
        $hiba = true;
    }
    return $conn;
}

?>
<h2><?php echo $error_massage ?></h2>

    <?php if (!$hiba) { ?>
    <h1>Csak egyszer használható ez a token!</h1>
    <form method="POST">
        <label for="uname" class="col-md-4 col-form-label">Felhasználó név:</label>
        <input  class="form-control-plaintext" name="token" id="form-row-uname" type="hidden"  placeholder="Név" value="<?= $token ?>">
        <input  class="form-control-plaintext" name="uid" id="form-row-uname" type="hidden"  placeholder="Név" value="<?= $uid ?>">

        <div class="col-md-4">
            <input  class="form-control-plaintext" name="uname" id="form-row-uname" type="text"  placeholder="Név" value="<?= $user_name ?>" disabled>
        </div>

        <div class="form-group row">
            <label for="ps" class="col-md-4 col-form-label">Jelszó:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="ps" id="ps" type="password"  placeholder="Jelszó">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy jelszavát!"><img src="http://oktat.narasoft.hu/img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="ps-ag" class="col-md-4 col-form-label">Jelszó:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="ps-ag" id="ps-ag" type="password"  placeholder="Jelszó újra">
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Írja be a felvintendő személy jelszavát még egyszer!"><img src="http://oktat.narasoft.hu/img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="option-button-wrapper form-group row">

            <input type="submit" value="Jelszó módosítás" id="send" name="sendBtn">

        </div>
    </form>
<?php } ?>

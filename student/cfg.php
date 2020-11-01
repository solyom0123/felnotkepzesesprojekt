<?php

$szerverneve = "mysql.nethely.hu";//"localhost"; //";;
    $felhasznalonev = "oktat";//'root'; //
    $password = 'corvin2019';//""; //
    $dbname = 'oktat';
    $db = mysqli_connect($szerverneve, $felhasznalonev, $password, $dbname);
	$chset=mysqli_query($conn,"SET CHARACTER SET 'utf8'");
    $chset2=mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
	?>
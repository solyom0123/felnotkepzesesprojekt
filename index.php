<?php
session_start();
//$_SESSION['page']= isset()$_GET["page"];
//$page= $_SESSION['page'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <title>Központi Képzés Adminisztráció</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/szin.css">

        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/buttons.css">
        <link rel="stylesheet" href="./css/usefull.css">
        <link rel="stylesheet" href="./css/wrappers.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./js/controller/felvitel.js"></script>


        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
            //navigation functions
            /**
             * 
             * @returns {undefined}
             */
            function megsem() {

                $.post("./php/elozmeny.php", {
                    ker: 1
                }, function (data, status) {
                  //  console.log(data);
                    link(data);

                });
            }
            /**
             * 
             * @param {type} elozo
             * @returns {undefined}
             */
            function setElozo(elozo) {
                //console.log(elozo);
                $.post("./php/elozmeny.php", {
                    preva: elozo
                }, function (data, status) {
                    //  console.log(data);
                });
            }
            /**
             * 
             * @param {type} link
             * @returns {undefined}
             */
            function link(link) {
                var slink = './php/' + link + '.php';

                $.get(slink, function (data, status) {

                    document.getElementsByClassName('tartalom-wrapper')[0].innerHTML = data;
                });
            }
            /**
             * 
             * @param {type} linkfr
             * @param {type} value
             * @param {type} muv
             * @param {type} target
             * @returns {undefined}
             */
            function serverdata(linkfr, value, muv, target) {
                //console.log(value);
                //console.log(target);
                $.post("server.php", {
                    muv: muv,
                    param: value

                }, function (data, status) {
                    console.log(data);
                    if (target != "") {
                        document.getElementsByClassName(target)[0].innerHTML = data;
                    }
                });
            }
            /**
             * 
             * @param {type} linkfr
             * @param {type} value
             * @param {type} muv
             * @param {type} target
             * @returns {undefined}
             */
            function linkWithData(linkfr, value, muv, target) {
                //console.log(value);
                //console.log(target);
                $.post("./php/" + linkfr + ".php", {
                    muv: muv,
                    param: value

                }, function (data, status) {
                    console.log(data);
                    if (target != "") {
                        document.getElementsByClassName(target)[0].innerHTML = data;
                    }
                    if(linkfr=="modul_in_form"){
                        modulEducation();
                    }
                    
                });
            }
            /**
             * 
             * @param {type} link
             * @returns {undefined}
             */
            function linkside(link) {
                // console.log(value);
                var slink = './php/' + link + '.php';
                if (!link == "") {
                    $.get(slink, function (data, status) {

                        document.getElementsByClassName('menu-wrapper')[1].innerHTML = data;
                    });
                } else {
                    document.getElementsByClassName('menu-wrapper')[1].innerHTML = "";
                }
            }
            /**
             * 
             * @returns {undefined}
             */
            function linkhead() {
                // console.log(value);
                var slink = './php/header.php';

                $.get(slink, function (data, status) {
                    console.log(data);
                    document.getElementsByClassName('header-wrapper')[0].innerHTML = data;
                });
            }
            //accountmanage functions
            /**
             * 
             * @param {type} muv
             * @returns {undefined}
             */
            function login(muv) {

                var name = document.getElementById("name").value;
                var pass = document.getElementById("pass").value;
                var value = new Array(name, pass);
                //console.log(muv + "," + name + "," + pass);
                var slink = 'server.php';
                $.post(slink, {
                    muv: muv,
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var splited = data.split(";");
                    if (splited[0] == "true") {

                        serverdata("server", splited[1], "logged", "");
                        link("main_admin");
                        linkside("menu");
                        sessionTeszt();
                        linkhead();
                        serverdata("server", splited[1], "user_name", "user_name");
                    } else {
                        link("login");
                    }


                });
            }
            /**
             * 
             * @returns {undefined}
             */
            function loggedIn() {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "session",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                    if (data == "true") {

                        link("main_admin");
                        linkhead();
                        linkside("menu");
                    } else {
                        linkhead();
                        linkside("");
                        link("login");
                    }


                });
            }
            //student manage functions
            /**
             * 
             * @returns {undefined}
             */
            function studentList() {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "list_student",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                    if (data != "none;//") {
                        var value = "";
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");

                                value += '<li ><div class="row"><input id="student" name="student" type="radio"  checked class="col-md-6" value="' + spStudent[1] + '"><p class="col-md-6">' + spStudent[0] + '</p></div></li>';
                            }
                        }
                        linkWithData("student_r_list", value, "load", 'tartalom-wrapper');

                    } else {
                        var value = '<li ><div class="row"><input id="student" name="student" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még diák felvive a rendszerbe!</p></div></li>';
                        linkWithData("student_r_list", value, "load", 'tartalom-wrapper');

                    }


                });
            }

            function studentSend() {
                var name = document.getElementById("form-row-name").value;
                var szulnev = document.getElementById("form-row-szul-nev").value;
                var mothername = document.getElementById("form-row-anyja-neve").value;
                var bcity = document.getElementById("form-row-szul-hely").value;
                var nem = document.getElementById("form-row-nem").value;
                var szar = document.getElementById("form-row-szar").value;
                var telszam = document.getElementById("form-row-phone").value;
                var taj = document.getElementById("form-row-taj").value;
                var szulev = document.getElementById("form-row-szulev").value;
                var szulho = document.getElementById("form-row-szulho").value;
                var szulnap = document.getElementById("form-row-szulnap").value;
                var irszam = document.getElementById("form-row-lakir").value;
                var city = document.getElementById("form-row-lakcity").value;
                var utca = document.getElementById("form-row-lakstreet").value;
                var hz = document.getElementById("form-row-lakhs").value;
                var lepcsohz = document.getElementById("form-row-laklp").value;
                var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz);
                var slink = 'server.php';
                $.post(slink, {
                    muv: "studentSend",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var value;
                    if (data != "error") {
                        value = '<div class="alert alert-success">Sikeres felvitel!</div>';


                    } else {
                        value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

                    }
                    linkWithData("user_in_form", value, "load", 'tartalom-wrapper');


                });
            }
            function studentGet() {
                var value = $("input[name=student]:checked").val();
                var slink = 'server.php';
                linkWithData("user_in_form", value, "edit", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "studentget",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                        document.getElementById("form-row-name").value = spData[0];
                        document.getElementById("form-row-szul-nev").value = spData[1];
                        document.getElementById("form-row-anyja-neve").value = spData[2];
                        document.getElementById("form-row-szul-hely").value = spData[4];
                        document.getElementById("form-row-nem").value = spData[5];
                        document.getElementById("form-row-szar").value = spData[7];
                        document.getElementById("form-row-phone").value = spData[8];
                        document.getElementById("form-row-taj").value = spData[9];
                        var spDate = spData[3].split('-');
                        document.getElementById("form-row-szulev").value = spDate[0];
                        document.getElementById("form-row-szulho").value = spDate[1];
                        document.getElementById("form-row-szulnap").value = spDate[2].split(' ')[0];
                        var spDataa = spData[6].split(',');

                        document.getElementById("form-row-lakir").value = spDataa[0];
                        document.getElementById("form-row-lakcity").value = spDataa[1];
                        document.getElementById("form-row-lakstreet").value = spDataa[2];
                        document.getElementById("form-row-lakhs").value = spDataa[3];
                        document.getElementById("form-row-laklp").value = spDataa[4];


                    } else {
                        link("user_in_form");
                    }


                });
            }
            function studentGetWithParam(value) {
                var slink = 'server.php';
                linkWithData("user_in_form", value, "editafter", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "studentget",
                    param: value[1]

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                        document.getElementById("form-row-name").value = spData[0];
                        document.getElementById("form-row-szul-nev").value = spData[1];
                        document.getElementById("form-row-anyja-neve").value = spData[2];
                        document.getElementById("form-row-szul-hely").value = spData[4];
                        document.getElementById("form-row-nem").value = spData[5];
                        document.getElementById("form-row-szar").value = spData[7];
                        document.getElementById("form-row-phone").value = spData[8];
                        document.getElementById("form-row-taj").value = spData[9];
                        var spDate = spData[3].split('-');
                        document.getElementById("form-row-szulev").value = spDate[0];
                        document.getElementById("form-row-szulho").value = spDate[1];
                        document.getElementById("form-row-szulnap").value = spDate[2].split(' ')[0];
                        var spDataa = spData[6].split(',');

                        document.getElementById("form-row-lakir").value = spDataa[0];
                        document.getElementById("form-row-lakcity").value = spDataa[1];
                        document.getElementById("form-row-lakstreet").value = spDataa[2];
                        document.getElementById("form-row-lakhs").value = spDataa[3];
                        document.getElementById("form-row-laklp").value = spDataa[4];


                    } else {
                        link("user_in_form");
                    }


                });
            }
            function studentEdit(id) {
                var name = document.getElementById("form-row-name").value;
                var szulnev = document.getElementById("form-row-szul-nev").value;
                var mothername = document.getElementById("form-row-anyja-neve").value;
                var bcity = document.getElementById("form-row-szul-hely").value;
                var nem = document.getElementById("form-row-nem").value;
                var szar = document.getElementById("form-row-szar").value;
                var telszam = document.getElementById("form-row-phone").value;
                var taj = document.getElementById("form-row-taj").value;
                var szulev = document.getElementById("form-row-szulev").value;
                var szulho = document.getElementById("form-row-szulho").value;
                var szulnap = document.getElementById("form-row-szulnap").value;
                var irszam = document.getElementById("form-row-lakir").value;
                var city = document.getElementById("form-row-lakcity").value;
                var utca = document.getElementById("form-row-lakstreet").value;
                var hz = document.getElementById("form-row-lakhs").value;
                var lepcsohz = document.getElementById("form-row-laklp").value;
                var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz,id);
                var slink = 'server.php';
                $.post(slink, {
                    muv: "studentEdit",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var text;
                    if (data != "error") {
                        text = '<div class="alert alert-success">Sikeres módosítás!</div>';


                    } else {
                        text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

                    }
                    var value = new Array(text,id);
                    studentGetWithParam(value);

                });
            }
             function courseSend() {
                var name = document.getElementById("form-row-name").value;
                var azon = document.getElementById("form-row-azon").value;
                var nyil = document.getElementById("form-row-nyil").value;
               // var alk = document.getElementById("form-row-alk").value;
               // var kep = document.getElementById("form-row-kep").value;
                var value = new Array(name, azon, nyil,); //alk, kep);
                var slink = 'server.php';
                $.post(slink, {
                    muv: "courseSend",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var value;
                    if (data != "error") {
                        
                        value = '<div class="alert alert-success">Sikeres felvitel!</div>';


                    } else {
                        value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

                    }
                    linkWithData("course_in_form", value, "load", 'tartalom-wrapper');


                });
            }
            function courseGet(value) {
                var slink = 'server.php';
                linkWithData("course_in_form", value, "edit", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "courseget",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                        document.getElementById("form-row-name").value = spData[0];
                        document.getElementById("form-row-azon").value = spData[1];
                        document.getElementById("form-row-nyil").value = spData[2];
                        

                    } else {
                        link("course_in_form");
                    }


                });
            }
            function courseGetWithParam(value) {
                var slink = 'server.php';
                linkWithData("course_in_form", value, "editafter", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "courseget",
                    param: value[1]

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                        document.getElementById("form-row-name").value = spData[0];
                        document.getElementById("form-row-azon").value = spData[1];
                        document.getElementById("form-row-nyil").value = spData[2];
                       

                    } else {
                        link("course_in_form");
                    }


                });
            }
            function courseEdit(id) {
                var name = document.getElementById("form-row-name").value;
                var azon = document.getElementById("form-row-azon").value;
                var nyil = document.getElementById("form-row-nyil").value;
                //var alk = document.getElementById("form-row-alk").value;
                //var kep = document.getElementById("form-row-kep").value;
                var value = new Array(name, azon, nyil,id);// alk, kep);
                var slink = 'server.php';
               $.post(slink, {
                    muv: "courseEdit",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var text;
                    if (data != "error") {
                        text = '<div class="alert alert-success">Sikeres módosítás!</div>';


                    } else {
                        text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

                    }
                    var value = new Array(text,id);
                    courseGetWithParam(value);

                });
                
            }
            function courseList() {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "list_course",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                    if (data != "none;//") {
                        var value = "";
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");
                                var image="default";
                                if (spStudent[1]!='default') {
                                    image=spStudent[1];
                                }
                                value += '<td><div class="span-half-corner-wrapper"><div onclick="courseGet('+spStudent[2]+');'+"setElozo('course_basic_datas')"+'"><img src="img/'+image+'.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100"></div></div><span>'+spStudent[0]+'</span></td>';
                            }
                        }
                        linkWithData("course_basic_datas", value, "load", 'tartalom-wrapper');

                    } else {
                        var value = '<li ><div class="row"><input id="student" name="student" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még kurzus felvive a rendszerbe!</p></div></li>';
                        linkWithData("course_basic_datas", value, "load", 'tartalom-wrapper');

                    }


                });
            }
            function modulSend() {
                var name = document.getElementById("form-row-name").value;
                var azon = document.getElementById("form-row-number").value;
                var kepzes = document.getElementById("form-row-kepzes").value;
                var elm = document.getElementById("form-row-elm").value;
               var gyak = document.getElementById("form-row-gyak").value;
               var irasbeli_ora = document.getElementById("form-row-irasbeli-ora").value;
               var szobeli_ora = document.getElementById("form-row-szobeli-ora").value;
               var gyakorlati_ora = document.getElementById("form-row-gyak-ora").value;
                
                if(!document.getElementById('form-row-szobeli').checked){
                    szobeli_ora=-1;  
                }
                if(!document.getElementById('form-row-gyakorlati').checked){
                    gyakorlati_ora=-1;  
                }
                if(!document.getElementById('form-row-irasbeli').checked){
                    irasbeli_ora=-1;  
                }
                var value = new Array(name, azon, kepzes, elm,gyak, irasbeli_ora,szobeli_ora,gyakorlati_ora);
                var slink = 'server.php';
                $.post(slink, {
                    muv: "modulSend",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var value;
                    if (data != "error") {
                        
                        value = '<div class="alert alert-success">Sikeres felvitel!</div>';


                    } else {
                        value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

                    }
                    linkWithData("modul_in_form", value, "load", 'tartalom-wrapper');


                });
            }
            function modulGet() {
                 var value = $("input[name=modul]:checked").val();
                var slink = 'server.php';
                linkWithData("modul_in_form", value, "edit", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "modulget",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                       document.getElementById("form-row-name").value= spData[0];;
                             document.getElementById("form-row-number").value= spData[1];;
                            document.getElementById("form-row-kepzes").value= spData[2];;
                             document.getElementById("form-row-elm").value= spData[3];;
                             document.getElementById("form-row-gyak").value= spData[4];;
                             document.getElementById("form-row-irasbeli-ora").value= spData[5];;
                             document.getElementById("form-row-szobeli-ora").value= spData[6];;
                             document.getElementById("form-row-gyak-ora").value= spData[7];;
            
                        

                    } else {
                        link("modul_in_form");
                    }


                });
            }
            function modulGetWithParam(value) {
                var slink = 'server.php';
                linkWithData("modul_in_form", value, "editafter", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "modulget",
                    param: value[1]

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                             document.getElementById("form-row-name").value= spData[0];;
                             document.getElementById("form-row-number").value= spData[1];;
                            document.getElementById("form-row-kepzes").value= spData[2];;
                             document.getElementById("form-row-elm").value= spData[3];;
                             document.getElementById("form-row-gyak").value= spData[4];;
                             document.getElementById("form-row-irasbeli-ora").value= spData[5];;
                             document.getElementById("form-row-szobeli-ora").value= spData[6];;
                             document.getElementById("form-row-gyak-ora").value= spData[7];;
            
                       

                    } else {
                        link("modul_in_form");
                    }


                });
            }
            function modulEdit(id) {
                 var name = document.getElementById("form-row-name").value;
                var azon = document.getElementById("form-row-number").value;
                var kepzes = document.getElementById("form-row-kepzes").value;
                var elm = document.getElementById("form-row-elm").value;
               var gyak = document.getElementById("form-row-gyak").value;
               var irasbeli_ora = document.getElementById("form-row-irasbeli-ora").value;
               var szobeli_ora = document.getElementById("form-row-szobeli-ora").value;
               var gyakorlati_ora = document.getElementById("form-row-gyak-ora").value;
                
                if(!document.getElementById('form-row-szobeli').checked){
                    szobeli_ora=-1;  
                }
                if(!document.getElementById('form-row-gyakorlati').checked){
                    gyakorlati_ora=-1;  
                }
                if(!document.getElementById('form-row-irasbeli').checked){
                    irasbeli_ora=-1;  
                }
                var value = new Array(name, azon, kepzes, elm,gyak, irasbeli_ora,szobeli_ora,gyakorlati_ora);
               var slink = 'server.php';
               $.post(slink, {
                    muv: "modulEdit",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var text;
                    if (data != "error") {
                        text = '<div class="alert alert-success">Sikeres módosítás!</div>';


                    } else {
                        text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

                    }
                    var value = new Array(text,id);
                    modulGetWithParam(value);

                });
                
            }
             function modulList() {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "list_modul",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                    if (data != "none;//") {
                        var value = "";
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");

                                value += '<li ><div class="row"><input id="modul" name="modul" type="radio"  checked class="col-md-6" value="' + spStudent[2] + '"><p class="col-md-6">' + spStudent[0] + '|| '+spStudent[1]+'</p></div></li>';
                            }
                        }
                        linkWithData("modul_r_list", value, "load", 'tartalom-wrapper');

                    } else {
                        var value = '<li ><div class="row"><input id="student" name="student" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még diák felvive a rendszerbe!</p></div></li>';
                        linkWithData("modul_r_list", value, "load", 'tartalom-wrapper');

                    }


                });
            }
            function modulEducation() {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "list_course",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                     var value = '<option value="-1">Nincs képzéshez rendelve</option>';
                    if (data != "none;//") {
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");

                                value += '<option value="'+spStudent[1]+'">'+spStudent[0]+'</option>';
                            }
                        }
                        
                    } 

                      document.getElementById('form-row-kepzes').innerHTML=value;
                });
            }

        </script>
    </head>
    <body class=" body-set ">
	<div class="col-md-12">
        <nav class=" row navbar navbar-inverse col-12 header-wrapper " style="height: 100px">

        </nav>
        <main class=" row col-md-12 mt-1">
            <div class="menu-wrapper ">
                <div class="menu-wrapper  col-md-2">
                </div>   
            </div>

            <div class="col-md-10 ">
                <div class="tartalom-wrapper">

                </div>

            </div>
        </main>
        <script>loggedIn()</script>
        <footer class=" row col-md-12 mt-1">
            Copyright infó jön ide.<br>2018
        </footer>
		</div>
    </body>
</html>

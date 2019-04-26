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

        <title>DEMO ISKOLAKEZELŐ RENDSZER</title>
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
                    console.log(data);
                    link(data);

                });
            }
            /**
             * 
             * @param {type} elozo
             * @returns {undefined}
             */
            function setElozo(elozo) {
                console.log(elozo);
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
                console.log(value);
                console.log(target);
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
                console.log(value);
                console.log(target);
                $.post("./php/" + linkfr + ".php", {
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
                console.log(muv + "," + name + "," + pass);
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
            
        </script>
    </head>
    <body class=" body-set col-md-12">
        <nav class=" row navbar navbar-inverse col-md-12 header-wrapper " style="height: 70px">

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
        <footer class=" row col-md-12">
            Made by Készítő neve.<br>2018
        </footer>
    </body>
</html>

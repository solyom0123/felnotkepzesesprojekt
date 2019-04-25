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
            function megsem() {

                $.post("./php/elozmeny.php", {
                    ker: 1
                }, function (data, status) {
                    console.log(data);
                    link(data);

                });
            }
            function setElozo(elozo) {
                console.log(elozo);
                $.post("./php/elozmeny.php", {
                    preva: elozo
                }, function (data, status) {
                    //  console.log(data);
                });
            }
            function link(link) {
                var slink = './php/' + link + '.php';

                $.get(slink, function (data, status) {

                    document.getElementsByClassName('tartalom-wrapper')[0].innerHTML = data;
                });
            }
            function pagecall(link) {
                var slink = './php/' + link + '.php';
                $.get(slink, function (data, status) {
                    document.write(data);
                });
            }
            function linka(linkfr, value, muv, target) {
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

                        linka("server", splited[1], "logged","");
                        link("main_admin");
                        linkside("menu");
                        sessionTeszt();
                        linkhead();
                        linka("server",splited[1],"user_name","user_name");
                    } else {
                        link("login");
                    }


                });
            }
            function sessionTeszt(){
                linka("server","session teszt" , "session","");
            }
            function linkside(link) {
                // console.log(value);
                var slink = './php/' + link + '.php';
                if(!link==""){
                $.get(slink, function (data, status) {
                    
                    document.getElementsByClassName('menu-wrapper')[1].innerHTML = data;
                });
                }else{
                    document.getElementsByClassName('menu-wrapper')[1].innerHTML = "";
                }   
            }

            function linkhead() {
                // console.log(value);
                var slink = './php/header.php';

                $.get(slink, function (data, status) {
                    console.log(data);
                    document.getElementsByClassName('header-wrapper')[0].innerHTML = data;
                });
            }
            function linkv(link, value, muv) {
                console.log(value);
                var slink = './php/' + link + '.php';
                $.post(slink, {
                    muv: muv,
                    param: value

                }, function (data, status) {
                    //  console.log(data);
                    document.getElementsByClassName('tartalom-wrapper')[0].innerHTML = data;
                });
            }
        </script>
    </head>
    <body class=" body-set col-md-12">
        <nav class=" row navbar navbar-inverse col-md-12 header-wrapper " style="height: 70px">
            <script>linkhead()</script>
        </nav>
        <main class=" row col-md-12 mt-1">
            <div class="menu-wrapper ">
                <div class="menu-wrapper  col-md-2">
                    <?php
//                    if (isset($_SESSION['uid'])) {
//                        include './php/menu.php';
//                    }
                    ?>
                </div>   
            </div>

            <div class="col-md-10 ">
                <div class="tartalom-wrapper">

                    <!--             <?php
//                    if (isset($_SESSION['uid'])) {
//                        
                    ?><script>link("main_admin")</script>
                                     //<?php
//                        // include './php/'. $page.".php";
//                    } else {
//                    include './php/login.php';    
//                    }
//                    
                    ?>
                    -->                  <script>link('login');</script>
                </div>

            </div>
        </main>
        <footer class=" row col-md-12">
            Made by Készítő neve.<br>2018
        </footer>
    </body>
</html>

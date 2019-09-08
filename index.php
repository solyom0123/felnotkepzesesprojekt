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
        <script type="text/javascript" src="./js/other/navigation.js"></script>
        <script type="text/javascript" src="./js/controller/felvitel.js"></script>
        <script type="text/javascript" src="./js/other/course.js"></script>
        <script type="text/javascript" src="./js/other/cur_unit.js"></script>
        <script type="text/javascript" src="./js/other/modul.js"></script>
        <script type="text/javascript" src="./js/other/student.js"></script>
        <script type="text/javascript" src="./js/other/teacher.js"></script>
        <script type="text/javascript" src="./js/other/curseStart.js"></script>
        <script type="text/javascript" src="./js/other/schedule_global_vars.js"></script>
        <script type="text/javascript" src="./js/model/Aktiv_Kepzes_Model.js"></script>
        <script type="text/javascript" src="./js/model/Kepzes_Model.js"></script>
        <script type="text/javascript" src="./js/model/Modul_Model.js"></script>
        <script type="text/javascript" src="./js/model/Oktatok_Model.js"></script>
        <script type="text/javascript" src="./js/model/Tananyagegyseg_Model.js"></script>
        <script type="text/javascript" src="./js/model/Utemterv_bejegyzes_Model.js"></script>
        <script type="text/javascript" src="./js/model/Vizsga_Model.js"></script>
        <script type="text/javascript" src="./js/other/date.js"></script>
        <script type="text/javascript" src="./js/other/bonus_unit.js"></script>
        <script type="text/javascript" src="./js/other/bonus_teacher.js"></script>
        <script type="text/javascript" src="./js/other/active_courses.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_calcing.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_controller.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_converter.js"></script>
        <script type="text/javascript" src="./js/other/schedule_make_search.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_calc.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_controller.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_convert.js"></script>
        <script type="text/javascript" src="./js/other/schedule_after_edit_search.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_calc.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_controller.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_convert.js"></script>
        <script type="text/javascript" src="./js/other/schedule_edit_search.js"></script>
        <script type="text/javascript" src="./js/other/form_builder_for_printing.js"></script>
        <script type="text/javascript" src="./js/other/printing.js"></script>
        <script type="text/javascript" src="./js/other/tabs.js"></script>
        <script type="text/javascript" src="./js/other/push.js"></script>
        <script>
           $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();

            });
        </script>
    </head>
    <body class=" body-set ">
        <div class="col-md-12">
            <!--        <nav class=" row navbar navbar-inverse col-12 header-wrapper " style="height: 100px">
            
                    </nav>-->
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

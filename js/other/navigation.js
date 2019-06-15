/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
                    console.log("visszalépésadat: "+data);
                    link(data);
                    loadingModuls(data);
                });
            }
            function loadingModuls(linkfr){
                if (linkfr == "modul_in_form"||linkfr == "cur_unit_in_form"||linkfr=="modul_r_list"||linkfr=="cur_unit_list") {
                        modulEducation();
                    }
                    if (linkfr == "course_in_form") {
                        coursekepmodal();
                        coursefilemodal();
                        
                    }
                    if(linkfr == "course_basic_datas"){
                        courseList();
                    }
                    
                    if(linkfr == "teacher_connect_in_form"){
                       teacherListOption();
                       coursefilemodal();
                    }
                    
            }
            /**
             * 
             * @param {type} elozo
             * @returns {undefined}
             */
            function setElozo(elozo) {
                console.log("elozo: "+elozo);
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
                document.getElementsByClassName('tartalom-wrapper')[0].innerHTML ="";
                $(".tartalom-wrapper").append( data );

                    loadingModuls(link);

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
                    loadingModuls(linkfr);
                    

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
                        //sessionTeszt();
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
                        //linkhead();
                        linkside("menu");
                    } else {
                        //linkhead();
                        linkside("");
                        link("login");
                    }


                });
            }
            
          
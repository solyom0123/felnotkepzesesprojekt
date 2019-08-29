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

    
     return new Promise((resolve, reject) => {
        $.ajax({
            url: "./php/elozmeny.php",
            type: 'POST',
            data: {
                ker: 1
            },

            success: function (data) {
                link(data);
                loadingModuls(data);
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
function loadingModuls(linkfr) {
    if (linkfr == "modul_in_form" || linkfr == "cur_unit_in_form" || linkfr == "modul_r_list" || linkfr == "cur_unit_list") {
        modulEducation(true);
    }
    if(linkfr == "bonus_unit_list"){
        bonusunitList('bonus_unit_list');
    }
    if (linkfr == "course_start"||linkfr == "course_start_edit") {
        modulEducation(false);
        getActiveEduScheme();
         lockAllFieldsCourseStartForm(false);
        lockAllModulSelector(false);
        //clearUsedSelectChooseArrays();
    }
    if (linkfr == "course_in_form") {
        coursekepmodal();
        coursefilemodal();

    }
  
    if (linkfr == "missing_in_form") {
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes");
        activeCourseListOptions(0,"form-row-aktiv-kepzes-list");
    }
     if (linkfr == "print_attendance_in_form"||linkfr=="print_sc_in_form"||linkfr == "print_attendance_in_form_teacher") {
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes");
     
    }
    if (linkfr == "actually_course") {
        activeCourseList(1,1);
    }
    if (linkfr == "course_basic_datas") {
        courseList();
    }
    
    if (linkfr == "teacher_connect_in_form") {
        teacherListOption();
        openDefultTab();
       // coursefilemodal();
    }
    if (linkfr == "utemterv_in_form") {
        
        openDefultTab();
        VOLT=false;
       // coursefilemodal();
    }
      if (linkfr == "modul_access_in_form") {
        
        openDefultTab();
         hiba = false;
         modulEducation(true);
       // coursefilemodal();
    }
    if(linkfr == "bonus_teacher_in_form"||linkfr == "teacher_in_form"||linkfr == "cur_unit_in_form"||linkfr == "bonus_unit_in_form"||linkfr == "course_in_form"||linkfr == "modul_in_form"||linkfr == "user_in_form"||linkfr == "user_con_form"){
         
        openDefultTab();
    }
    if (linkfr == "date_in_form") {
        var date = new Date();
        var stringDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-01";
        ////console.log(stringDate);
        monthGet(stringDate);


    }


}
function checkEmptyString(string){
    if(string==""||string==" "){
        return true;
    }
    else{
        return false;
    }
}
/**
 * 
 * @param {type} elozo
 * @returns {undefined}
 */
function setElozo(elozo) {
    ////console.log("elozo: " + elozo);
    $.post("./php/elozmeny.php", {
        preva: elozo
    }, function (data, status) {
        //  ////console.log(data);
    });
}
/**
 * 
 * @param {type} link
 * @returns {undefined}
 */
function link(link) {
    var slink = './php/' + link + '.php';
    return new Promise((resolve, reject) => {
        $.ajax({
            url: slink,
            type: 'GET',

            success: function (data) {
                document.getElementsByClassName('tartalom-wrapper')[0].innerHTML = "";
                $(".tartalom-wrapper").append(data);

                loadingModuls(link);
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
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
    //////console.log(value);
    //////console.log(target);
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: value,
                muv: muv
            },

            success: function (data) {
                if (!checkEmptyString(target)) {
                    document.getElementsByClassName(target)[0].innerHTML = data;
                }
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
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
    //////console.log(value);
    //////console.log(target);
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "./php/" + linkfr + ".php",
            type: 'POST',
            data: {
                param: value,
                muv: muv
            },

            success: function (data) {
                if (!checkEmptyString(target)) {
                    document.getElementsByClassName(target)[0].innerHTML = data;
                }
                loadingModuls(linkfr);
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });

}
/**
 * 
 * @param {type} link
 * @returns {undefined}
 */
function linkside(link) {
    // ////console.log(value);
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
    // ////console.log(value);
    var slink = './php/header.php';

    $.get(slink, function (data, status) {
        ////console.log(data);
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
    //////console.log(muv + "," + name + "," + pass);
    var slink = 'server.php';
    $.post(slink, {
        muv: muv,
        param: value

    }, function (data, status) {
        ////console.log(data);
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
        ////console.log(data);
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

          
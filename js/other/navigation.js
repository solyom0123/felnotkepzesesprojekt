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
   console.log(linkfr);
    if (linkfr == "modul_in_form" || linkfr == "cur_unit_in_form" || linkfr == "modul_r_list" || linkfr == "cur_unit_list") {
        modulEducation(true);
    }
    if(linkfr == "bonus_unit_list"){
        bonusunitList('form-row-cur-unit');
    }
    if (linkfr == "course_start") {
        modulEducation(false);
        getActiveEduScheme();
         lockAllFieldsCourseStartForm(false);
        lockAllModulSelector(false);
        //clearUsedSelectChooseArrays();
    }
    if (linkfr == "course_start_edit") {
        modulEducation(false);
        lockAllFieldsCourseStartForm(false);
        lockAllModulSelector(false);
     }
    if (linkfr == "course_in_form") {
        coursekepmodal();
        coursefilemodal();

    }
  
    if (linkfr == "final_exam_in_form") {
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes");
        activeCourseListOptions(0,"form-row-aktiv-kepzes-list");
    }
	if (linkfr == "exam_in_form_mod") {
       // openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes-es");
        //activeCourseListOptions(0,"form-row-aktiv-kepzes-list");
    }
    if(linkfr == "missing_in_form"||linkfr == "exam_in_form"){
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes");
        activeCourseListOptions(0,"form-row-aktiv-kepzes-list");

    }
    if(linkfr == "print_edu_cont_in_form"||linkfr == "print_personal_in_form"||linkfr == "push_in_form"){
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes-list");
        
    }
    
     if (linkfr == "user_export_in_form"||linkfr == "list_names_in_form"|linkfr == "print_attendance_in_form"||linkfr == "print_final_exam_attendance_in_form"||linkfr=="print_exam_attendance_in_form"|linkfr == "print_attendance_in_form_teacher") {
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes");
     
    }
    if (linkfr=="print_sc_in_form") {
        openDefultTab();
        activeCourseListOptions(0,"form-row-aktiv-kepzes-es");
        activeCourseListOptions(0,"form-row-aktiv-kepzes");
        activeCourseListOptions(0,"form-row-aktiv-kepzes-h");
     
    }
    if (linkfr == "actually_course") {
        activeCourseList(1,1);
    }
    if (linkfr == "student_r_list") {
        studentList();
    }
    
    if (linkfr == "teacher_list") {
        teacherList();
    }
    
    if (linkfr == "bonus_teacher_list") {
        bonusteacherList();
    }
    if (linkfr == "push_notice") {
        pushNoticeList(1,1);
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
    if(linkfr == "bonus_teacher_in_form"||linkfr == "teacher_in_form"||linkfr == "cur_unit_in_form"||linkfr == "bonus_unit_in_form"||linkfr == "course_in_form"||linkfr == "resultpageedit"||linkfr == "resultpage"||linkfr == "modul_in_form"||linkfr == "user_in_form"||linkfr == "user_con_form"){
         
        openDefultTab();
    }
    if (linkfr == "date_in_form") {
        var date = new Date();
        var stringDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-01";
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
    //////console.log("elozo: " + elozo);
    $.post("./php/elozmeny.php", {
        preva: elozo
    }, function (data, status) {
        //  //////console.log(data);
    });
}
/**
 * 
 * @param {type} link
 * @returns {undefined}
 */
function link(link) {
    var slink = './php/' + link + '.php';
    //console.log(link);
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
    ////////console.log(value);
    ////////console.log(target);
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
    ////////console.log(value);
    ////////console.log(target);
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
    // //////console.log(value);
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
    // //////console.log(value);
    var slink = './php/header.php';

    $.get(slink, function (data, status) {
        //////console.log(data);
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
    ////////console.log(muv + "," + name + "," + pass);
    var slink = 'server.php';
    $.post(slink, {
        muv: muv,
        param: value

    }, function (data, status) {
        //////console.log(data);
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
        //console.log(data);
        if (data == "true") {

            link("main_admin");
            //linkhead();
            linkside("menu");
        } else {
            //linkhead();
            linkside("");
            link("login").then(data => {
               })
            .catch(error => {
                //console.log(error)
            });;
        }


    });
}

function nyomtat_sablon(){
	
	var kepzes_id=document.getElementById("form-row-aktiv-kepzes-es").value;
	//console.log(kepzes_id);
	var hr = new XMLHttpRequest();
	
	var p_link="../php/forms/mod_exam_notes_print.php";
	hr.open("POST", p_link+"?kepzes_id="+kepzes_id, true);
	
	
	hr.onreadystatechange = function() {
    if(hr.readyState == 4 && hr.status == 200) {
        var return_data = hr.responseText;
		//console.log(return_data);
        document.getElementById("div_nyomtatvany").innerHTML = return_data;
		}
	}
	hr.send();
	
	
	
}

function nyomtat_sablon_pdf(){
	
	var kepzes_id=document.getElementById("form-row-aktiv-kepzes-es").value;
	//console.log(kepzes_id);
	var hr = new XMLHttpRequest();
	
	var p_link="../php/forms/mod_exam_notes_print_pdf.php";
	hr.open("POST", p_link+"?kepzes_id="+kepzes_id, true);
	
	
	hr.onreadystatechange = function() {
    if(hr.readyState == 4 && hr.status == 200) {
        var return_data = hr.responseText;
		////console.log(return_data);
        document.getElementById("div_nyomtatvany").innerHTML = return_data;
		}
	}
	hr.send();
	
	
	 
	
	
}


    function exportHTML(){
		/*-----*/
		var p_link="../php/forms/mod_exam_notes_print_pdf.php";
		
		
		
		
		
		
		/*------*/
		var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title><style> tr { page-break-inside:avoid; page-break-after:auto } .nopagebreak{page-break-inside: avoid;} table, td, th {padding:2px; border: 1px solid black; border-collapse: collapse; font-size:10px; page-break-inside:auto;}</style></head><body>";
       var footer = "</body></html>";
	   /*startPrinting(14);*/
       var sourceHTML = header+document.getElementById("div_nyomtatvany").innerHTML+footer;
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'modul_osszesito.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
       
		
    }


          
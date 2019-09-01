/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function startPrinting(type) {
    switch (type) {
        case 1:
            attendforStudent(type);
            break;
            case 2:
            attendforteacher(type);
            break;
            case 3:
            scprint(type);
            break;
            case 4:
            scprint(type);
            break;
            case 5:
            missingPrint(type);
            break;
            case 6:
            missingPrint(type);
            break;
             case 7:
            attendforStudent(type);
            break;
             case 8:
            attendforStudent(type);
            break;
             case 9:
            listnamePrint(type);
            break;
        default:
            
            break;
    }
    

}
function attendforStudent(type){
    var date =0;
    if(type!=8){
     date = document.getElementById("form-row-date").value;
    }else{
     date = document.getElementById("form-row-hour").value;   
    }
    var course = document.getElementById("form-row-aktiv-kepzes").value;
    if (course != -1 && date != -1) {
         var slink ='server.php';
         var value = new Array(type, new Array(course, date))
        
        $.post(slink, {
            muv: "print",
            param: value

        }, function (data, status) {
            console.log(data);
            var mainhead_array = new Array();
            var date = '';
            var courses_datas = new Array();
            var maintable_array = new Array();
            var spData = data.split("/;/");
            mainhead_array = spData[0].split(";");
            mainhead_array[mainhead_array.length] = "";
            courses_datas = spData[1].split("//");
            var spStudents = spData[2].split("//");
            for (var i = 0, max = spStudents.length; i < max; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var loac_array = spStudents[i].split(";");
                    maintable_array[maintable_array.length] = loac_array;
                }
            }
            date = spData[3];
            var link = spData[4];
            var i=0;
            var timer = setInterval (function(){
            if(i<courses_datas.length){
                if (!checkEmptyString(courses_datas[i])) {
                    var spCourses = courses_datas[i].split(";");
                    mainhead_array[4] = spCourses[0];
                    mainhead_array[5] = spCourses[1];

                    makeformForsendattendstudent(date, mainhead_array, maintable_array, link);
                }
                i++;
            }else{
                clearInterval(timer);
            }
            
            },300
            )
        });
    }
}
function listnamePrint(type){
    var types = document.getElementById("form-row-type").value;
   
    var course = document.getElementById("form-row-aktiv-kepzes").value;
    if (course != -1 && types != -1) {
         var slink ='server.php';
         var value = new Array(type, new Array(course, types))
        
        $.post(slink, {
            muv: "print",
            param: value

        }, function (data, status) {
            console.log(data);
            var mainhead_array = new Array();
            var date = '';
            var courses_datas = new Array();
            var maintable_array = new Array();
            var spData = data.split("/;/");
            mainhead_array = spData[0].split(";");
            mainhead_array[mainhead_array.length] = "";
            courses_datas = spData[1].split("//");
            var spStudents = spData[2].split("//");
            for (var i = 0, max = spStudents.length; i < max; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var loac_array = spStudents[i].split(";");
                    maintable_array[maintable_array.length] = loac_array;
                }
            }
            date = spData[3];
            var link = spData[4];
            var i=0;
            var timer = setInterval (function(){
            if(i<courses_datas.length){
                if (!checkEmptyString(courses_datas[i])) {
                    var spCourses = courses_datas[i].split(";");
                    mainhead_array[4] = spCourses[0];
                    mainhead_array[5] = spCourses[1];

                    makeformForsendattendstudent(date, mainhead_array, maintable_array, link);
                }
                i++;
            }else{
                clearInterval(timer);
            }
            
            },300
            )
        });
    }
}
function scprint(type){
   var course = 0;
   if(type==3){
          course = document.getElementById("form-row-aktiv-kepzes").value;
       }else{
           course = document.getElementById("form-row-aktiv-kepzes-h").value;
       }
    if (course != -1 ) {
        var value = new Array(type, new Array(course))
        var slink = 'server.php';
        $.post(slink, {
            muv: "print",
            param: value

        }, function (data, status) {
            console.log(data);
            var link = data;
               makeformForscprint(course,link); 
            
            
        });
    }
}
function missingPrint(type){
   var course = document.getElementById("form-row-aktiv-kepzes-list").value;
        var student= document.getElementById("form-row-student").value;    
    if (course != -1&&student!=-1) {
        var value = new Array()
        value[value.length] = type;
        var slink = 'server.php';
        $.post(slink, {
            muv: "print",
            param: value

        }, function (data, status) {
            console.log(data);
            var link = data;
               makeformFormissingprint(new Array(course,student),link); 
            
            
        });
    }
}
function  makeformForscprint(value, link) {
    var button_id="passToPrint";
    var form = form_head("./php/forms/"+link,true,"POST");
    form += one_variable_input("param",value);
    form+=submit_button(button_id);
    form+=form_end();
    document.getElementById("help_div").innerHTML = form;
    document.getElementById(button_id).click();
}
function  makeformFormissingprint(value, link) {
    var button_id="passToPrint";
    var form = form_head("./php/forms/"+link,true,"POST");
    form += one_dimension_input("param",value);
    form+=submit_button(button_id);
    form+=form_end();
    document.getElementById("help_div").innerHTML = form;
    document.getElementById(button_id).click();
}
function  makeformForsendattendstudent(date, mainhead_array, maintable_array, link) {
    var button_id="passToPrint";
    var form = form_head("./php/forms/"+link,true,"POST");
    form += one_variable_input("date",date);
    form += one_dimension_input("head",mainhead_array);
    form += two_dimension_input("main",maintable_array);
    form+=submit_button(button_id);
    form+=form_end();
    document.getElementById("help_div").innerHTML = form;
    document.getElementById(button_id).click();
}
function attendforteacher(type){
    var date = document.getElementById("form-row-date").value;
    var course = document.getElementById("form-row-aktiv-kepzes").value;
    if (course != -1 && date != -1) {
        var value = new Array(type, new Array(course, date))
        var slink = 'server.php';
        $.post(slink, {
            muv: "print",
            param: value

        }, function (data, status) {
            console.log(data);
            var mainhead_array = new Array();
            var date = '';
            var courses_datas = new Array();
            var maintable_array = new Array();
            var spData = data.split("/;/");
            mainhead_array = spData[0].split(";");
            mainhead_array[mainhead_array.length] = "";
            courses_datas = spData[1].split("//");
            for (var i = 0, max = courses_datas.length; i < max; i++) {
                if (!checkEmptyString(courses_datas[i])) {
                    var loac_array = courses_datas[i].split(";");
                    maintable_array[maintable_array.length] = loac_array;
                }
            }
            date = spData[2];
            var link = spData[3];
            makeformForsendattendstudent(date, mainhead_array, maintable_array, link);
            
        
    });
}
}

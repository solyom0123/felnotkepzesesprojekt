/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
        ////console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            console.log(createPage('student', spStudents, "list_items"));
            var buttons = createPage('student', spStudents, "list_items");
            var spData = buttons.split(";/;/;");
            document.getElementById("pagenerButtons").innerHTML = spData[0];
            loadPagebyButton("list_items", 1, spData[1]);
        } else {
            var value = '<li ><div class="row"><input id="student" name="student" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még résztvevő felvive a rendszerbe!</p></div></li>';
            document.getElementById("list_items").innerHTML = value;
        }


    });
}
function studentTestPage() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "testStudentPage",
        param: "value"

    }, function (data, status) {
        console.log(data);
        

    });
}
//buttonData+= '<li ><div class="row"><input id="student" name="'+name+'" type="radio"  checked class="col-md-6" value="' + spStudent[1] + '"><p class="col-md-6">' + spStudent[0] + '</p></div></li>';

function createPage(name, listArray, target) {
    var returnPages = "";
    var buttonData = "";
    var buttonsArrays = new Array();
    for (var i = 0; i < listArray.length; i++) {
        if (!checkEmptyString(listArray[i])) {
            var spStudent = listArray[i].split(";");
            console.log("alma");
            buttonData += name + ';' + spStudent[1] + ';' + spStudent[0] + '//';

        }
        if ((i + 1) % 10 == 0) {
            buttonsArrays.push(buttonData);
            buttonData = "";

        }


    }
            if (!checkEmptyString(buttonData)) {
            buttonsArrays.push(buttonData);
        }

    console.log(buttonsArrays);
    returnPages = createPageButtons(buttonsArrays, target) + ";/;/;" + buttonsArrays[0];
    return returnPages;
}
function createPageButtons(dataArray, target) {
    var buttons = "";
    for (var i = 0, max = dataArray.length; i < max; i++) {
        buttons += '<div class="col-md-1 option-button" onclick="loadPagebyButton(\'' + target + '\',' + (i + 1) + ',\'' + dataArray[i] + '\')">' + (i + 1) + '</div>'

    }
    return buttons;
}
function loadPagebyButton(target, index, dataArray) {
    var spdata = dataArray.split("//");
    console.log(spdata);
    var valueOfUl = document.getElementById(target).value;

    var pagecontent = "";
    for (var i = 0, max = spdata.length; i < max; i++) {

        if (!checkEmptyString(spdata[i])) {
            var student = spdata[i].split(";");
            console.log(student);
                pagecontent += '<li ><div class="row"><input id="' + student[0] + '" name="' + student[0] + '" type="radio"  checked class="col-md-6" value="' + student[1] + '"><p class="col-md-6">' + student[2] + '</p></div></li>';
           
        }
    }
    document.getElementById(target).innerHTML = pagecontent;
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

    var kepev = document.getElementById("form-row-kepev").value;
    var kepho = document.getElementById("form-row-kepho").value;
    var kepnap = document.getElementById("form-row-kepnap").value;
    var irszam = document.getElementById("form-row-lakir").value;
    var city = document.getElementById("form-row-lakcity").value;
    var utca = document.getElementById("form-row-lakstreet").value;
    var hz = document.getElementById("form-row-lakhs").value;
    var lepcsohz = document.getElementById("form-row-laklp").value;
    var veg = document.getElementById("form-row-veg").value;
    var email = document.getElementById("form-row-email").value;
    var paymode = document.getElementById("form-row-paymode").value;
    var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz, kepev, kepho, kepnap, veg, email, paymode);
    var slink = 'server.php';
    $.post(slink, {
        muv: "studentSend",
        param: value

    }, function (data, status) {
        ////console.log(data);
        var value;
        if (data != "error") {
            value = '<div class="alert alert-success">Sikeres felvitel!</div>';
            var id = data.split(",")[1];
            var arrayToPush = new Array(value, id);
            studentGetWithParam(arrayToPush);

        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';
            linkWithData("user_in_form", value, "load", 'tartalom-wrapper');
        }



    });
}
function exportUser() {
    var value = document.getElementById("form-row-aktiv-kepzes-list");
    var slink = 'server.php';

    $.post(slink, {
        muv: "exportUser",
        param: value

    }, function (data, status) {
        //console.log(data);
        /* if (data.contains("alert")) {
         
         document.getElementById("alert").innerHTML='<div class="alert alert-warning">'+data+"</div>";
         
         } else {
         document.getElementById("alert").innerHTML='<div class="alert alert-success">Minden sikerült!</div>';
         
         }
         */

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
        ////console.log(data);
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
            document.getElementById("form-row-uid").value = spData[10];
            document.getElementById("form-row-veg").value = spData[12];
            document.getElementById("form-row-email").value = spData[13];
            document.getElementById("form-row-paymode").value = spData[14];
            spDate = spData[11].split('-');

            document.getElementById("form-row-kepev").value = spDate[0];
            document.getElementById("form-row-kepho").value = spDate[1];
            document.getElementById("form-row-kepnap").value = spDate[2].split(' ')[0];


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
        ////console.log(data);
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
            document.getElementById("form-row-uid").value = spData[10];
            document.getElementById("form-row-veg").value = spData[12];
            document.getElementById("form-row-email").value = spData[13];
            document.getElementById("form-row-paymode").value = spData[14];
            spDate = spData[11].split('-');
            document.getElementById("form-row-kepev").value = spDate[0];
            document.getElementById("form-row-kepho").value = spDate[1];
            document.getElementById("form-row-kepnap").value = spDate[2].split(' ')[0];



        } else {
            link("user_in_form");
        }


    });
}
function getUsedName(type) {
    if (type == 1) {
        var name = document.getElementById("form-row-uname").value;
    } else {
        var name = document.getElementById("form-row-name").value;

    }

    var value = new Array(type, name);
    var slink = 'server.php';
    $.post(slink, {
        muv: "getUsedName",
        param: value

    }, function (data, status) {
        console.log(data);
        if (data != "none;") {
            var spData = data.split(";");
            var text = '';
            for (var i = 0; i < spData.length; i++) {
                if (!checkEmptyString(spData[i])) {
                    text += '  <div class="dropdown-item col-md-12" >' + spData[i] + '</div>';
                }
            }
            document.getElementsByClassName("dropdown-menu")[0].innerHTML = text;
            if ($('.dropdown').find('.dropdown-menu').is(":hidden")) {
                $('.dropdown-toggle').dropdown('toggle');
            }
        } else {
            if (!$('.dropdown').find('.dropdown-menu').is(":hidden")) {
                $('.dropdown-toggle').dropdown('toggle');
            }
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
    var kepev = document.getElementById("form-row-kepev").value;
    var kepho = document.getElementById("form-row-kepho").value;
    var kepnap = document.getElementById("form-row-kepnap").value;
    var irszam = document.getElementById("form-row-lakir").value;
    var city = document.getElementById("form-row-lakcity").value;
    var utca = document.getElementById("form-row-lakstreet").value;
    var hz = document.getElementById("form-row-lakhs").value;
    var lepcsohz = document.getElementById("form-row-laklp").value;
    var veg = document.getElementById("form-row-veg").value;
    var email = document.getElementById("form-row-email").value;
    var paymode = document.getElementById("form-row-paymode").value;

    var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz, id, kepev, kepho, kepnap, veg, email, paymode);
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
        var value = new Array(text, id);
        studentGetWithParam(value);

    });
}
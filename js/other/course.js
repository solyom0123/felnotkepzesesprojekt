/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function courseSend() {
    var name = document.getElementById("form-row-name").value;
    var azon = document.getElementById("form-row-azon").value;
    var nyil = document.getElementById("form-row-nyil").value;
    var alk = document.getElementById("form-row-alk-name").value;
    var kep = document.getElementById("form-row-kep-name").value;
    var value = new Array(name, azon, nyil, kep,alk);
    var slink = 'server.php';
    $.post(slink, {
        muv: "courseSend",
        param: value

    }, function (data, status) {
        //console.log(data);
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
        //console.log(data);
        if (data != "none/;/") {
            var spData = data.split("/;/");
            document.getElementById("form-row-name").value = spData[0];
            document.getElementById("form-row-azon").value = spData[1];
            document.getElementById("form-row-nyil").value = spData[2];
            document.getElementById("form-row-alk-name").value = spData[3];
            document.getElementById("form-row-kep-name").value = spData[4];


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
        //console.log(data);
        if (data != "none/;/") {
            var spData = data.split("/;/");
            document.getElementById("form-row-name").value = spData[0];
            document.getElementById("form-row-azon").value = spData[1];
            document.getElementById("form-row-nyil").value = spData[2];
            document.getElementById("form-row-alk-name").value = spData[3];
            document.getElementById("form-row-kep-name").value = spData[4];


        } else {
            link("course_in_form");
        }


    });
}
function courseEdit(id) {
    var name = document.getElementById("form-row-name").value;
    var azon = document.getElementById("form-row-azon").value;
    var nyil = document.getElementById("form-row-nyil").value;
    var alk = document.getElementById("form-row-alk-name").value;
    var kep = document.getElementById("form-row-kep-name").value;
    var value = new Array(name, azon, nyil, id, kep,alk);
    var slink = 'server.php';
    $.post(slink, {
        muv: "courseEdit",
        param: value

    }, function (data, status) {
        //console.log(data);
        var text;
        if (data != "error") {
            text = '<div class="alert alert-success">Sikeres módosítás!</div>';


        } else {
            text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

        }
        var value = new Array(text, id);
        courseGetWithParam(value);

    });

}
function courseList() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_course",
        param: "value"

    }, function (data, status) {
        //console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var spStudent = spStudents[i].split(";");
                    var image = "default";
                    if (spStudent[1] != 'default') {
                        image = spStudent[1];
                    }
                    value += '<td><div class="span-half-corner-wrapper"><div onclick="courseGet(' + spStudent[2] + ');' + "setElozo('course_basic_datas')" + '"><img src="img/' + image + '" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100"></div></div><span>' + spStudent[0] + '</span></td>';
                }
            }

        } else {
            var value = '<li ><div class="row"><input id="student" name="student" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még kurzus felvive a rendszerbe!</p></div></li>';
        }
        document.getElementById('courselist').innerHTML = value;



    });
}
function coursefilemodal() {
    var filemodal = document.getElementById("fileModal");

    var sendbtn = document.getElementById("filesub");

    var btn = document.getElementById("fileBtn");

    var span = document.getElementById("fileclose");

    btn.onclick = function () {
        filemodal.style.display = "block";
    }
    span.onclick = function () {
        filemodal.style.display = "none";
    }
    sendbtn.onclick = function () {
        var sEleresiUt = document.getElementById("form-row-alk").value.split("\\")
        document.getElementById("form-row-alk-name").value = sEleresiUt[sEleresiUt.length - 1];
        filemodal.style.display = "none";

    }

}
function coursekepmodal() {
    var kepmodal = document.getElementById("kepModal");


    var sendbtn = document.getElementById("kepsub");

    var btn = document.getElementById("kepBtn");

    var span = document.getElementById("kepclose");

    btn.onclick = function () {
        kepmodal.style.display = "block";
    }
    span.onclick = function () {
        kepmodal.style.display = "none";
    }

    sendbtn.onclick = function () {
        var sEleresiUt = document.getElementById("form-row-kep").value.split("\\")
        document.getElementById("form-row-kep-name").value = sEleresiUt[sEleresiUt.length - 1];
        kepmodal.style.display = "none";

    }

}
         
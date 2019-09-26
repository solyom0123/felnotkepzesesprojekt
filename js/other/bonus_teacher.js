/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//teacher manage functions
/**
 * 
 * @returns {undefined}
 */
function bonusteacherList() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_bonus_teacher",
        param: "value"

    }, function (data, status) {
        ////console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var spStudent = spStudents[i].split(";");

                    value += '<li ><div class="row"><input id="teacher" name="teacher" type="radio"  checked class="col-md-6" value="' + spStudent[1] + '"><p class="col-md-6">' + spStudent[0] + '</p></div></li>';
                }
            }
            document.getElementById("list_items").innerHTML=value;

        } else {
            var value = '<li ><div class="row"><input id="teacher" name="teacher" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még oktató felvive a rendszerbe!</p></div></li>';
            document.getElementById("list_items").innerHTML=value;
        }


    });
}

function bonusteacherSend() {
    var name = document.getElementById("form-row-name").value;
    var value = new Array(name, "szulnev"," mothername", "bcity", "nem", "szar", "telszam", "taj", "szulev", "szulho", "szulnap", "irszam", "city", "utca", "hz", "lepcsohz");
    var slink = 'server.php';
    $.post(slink, {
        muv: "bonusteacherSend",
        param: value

    }, function (data, status) {
        console.log(data);
        var value;
        if (data != "error") {
            value = '<div class="alert alert-success">Sikeres felvitel!</div>';
            var id= data.split(",")[1];
            var arrayToPush = new Array(value,id);
            bonusteacherGetWithParam(arrayToPush);
        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';
             linkWithData("bonus_teacher_in_form", value, "load", 'tartalom-wrapper');

        }
       


    });
}
function bonusteacherGet() {
    var value = $("input[name=teacher]:checked").val();

    if (value != "0") {
        setElozo('bonus_teacher_list');
        var slink = 'server.php';
        linkWithData("bonus_teacher_in_form", value, "edit", 'tartalom-wrapper');

        $.post(slink, {
            muv: "teacherget",
            param: value

        }, function (data, status) {
            ////console.log(data);
            if (data != "none/;/") {
                var spData = data.split("/;/");
                document.getElementById("form-row-name").value = spData[0];
                document.getElementById("form-row-oktato").value = value;
                teacher_cur_unit_List(-2, 1, 1,true);

            } else {
                link("bonus_teacher_in_form");
            }


        });
    }
}
function bonusteacherGetWithParam(value) {
    var slink = 'server.php';
    linkWithData("bonus_teacher_in_form", value, "editafter", 'tartalom-wrapper');

    $.post(slink, {
        muv: "teacherget",
        param: value[1]

    }, function (data, status) {
        ////console.log(data);
        if (data != "none/;/") {
            var spData = data.split("/;/");
            document.getElementById("form-row-name").value = spData[0];
            document.getElementById("form-row-oktato").value = value[1];
                
            teacher_cur_unit_List(-2, 1, 1, true);
        } else {
            link("bonus_teacher_in_form");
        }


    });
}
function bonusteacherEdit(id) {
    var name = document.getElementById("form-row-name").value;
    var value = new Array(name, "szulnev", "mothername", "bcity", "nem", "szar", "telszam", "taj", "szulev", "szulho", "szulnap", "irszam", "city", "utca", "hz", "lepcsohz", id);
    var slink = 'server.php';
    $.post(slink, {
        muv: "teacherEdit",
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
        bonusteacherGetWithParam(value);

    });
}





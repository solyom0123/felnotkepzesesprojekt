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
function teacherList() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_teacher",
        param: "value"

    }, function (data, status) {
        console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (spStudents[i] != "") {
                    var spStudent = spStudents[i].split(";");

                    value += '<li ><div class="row"><input id="teacher" name="teacher" type="radio"  checked class="col-md-6" value="' + spStudent[1] + '"><p class="col-md-6">' + spStudent[0] + '</p></div></li>';
                }
            }
            linkWithData("teacher_list", value, "load", 'tartalom-wrapper');

        } else {
            var value = '<li ><div class="row"><input id="teacher" name="teacher" type="radio" checked class="col-md-6" value="0"><p class="col-md-6">Nincs még oktató felvive a rendszerbe!</p></div></li>';
            linkWithData("teacher_list", value, "load", 'tartalom-wrapper');

        }


    });
}

function teacherSend() {
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
        muv: "teacherSend",
        param: value

    }, function (data, status) {
        console.log(data);
        var value;
        if (data != "error") {
            value = '<div class="alert alert-success">Sikeres felvitel!</div>';


        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

        }
        linkWithData("teacher_in_form", value, "load", 'tartalom-wrapper');


    });
}
function teacherGet() {
    var value = $("input[name=teacher]:checked").val();

    if (value != "0") {
        setElozo('teacher_list');
        var slink = 'server.php';
        linkWithData("teacher_in_form", value, "edit", 'tartalom-wrapper');

        $.post(slink, {
            muv: "teacherget",
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
                teacher_cur_unit_List(value);

            } else {
                link("teacher_in_form");
            }


        });
    }
}
function teacherGetWithParam(value) {
    var slink = 'server.php';
    linkWithData("teacher_in_form", value, "editafter", 'tartalom-wrapper');

    $.post(slink, {
        muv: "teacherget",
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

            teacher_cur_unit_List(value[1]);
        } else {
            link("teacher_in_form");
        }


    });
}
function teacherEdit(id) {
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
    var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz, id);
    var slink = 'server.php';
    $.post(slink, {
        muv: "teacherEdit",
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
        teacherGetWithParam(value);

    });
}
function teacher_cur_unit_List(value) {
    var muv = "list_cur_unit_teacher";
    var target = "form-row-anyag";
    if (value == -2) {
        value = document.getElementById("form-row-oktato").value;

    }
    if (value == -3) {
        value = document.getElementById("form-row-oktato").value;
        muv = "list_cur_unit_without_teacher";
        target = "form-row-without";
    }

    var slink = 'server.php';
    $.post(slink, {
        muv: muv,
        param: value

    }, function (data, status) {
        console.log(data);
        if (value != -1) {
            var value = '';
            if (data != "none;//") {
                var spStudents = data.split("//");
                for (var i = 0; i < spStudents.length; i++) {
                    if (spStudents[i] != "") {
                        var spStudent = spStudents[i].split(";");

                        value += '<option value="' + spStudent[1] + '">' + spStudent[0] + '</option>';
                    }
                }





            } else {
                var value = '<option value="-1">Nincs tanegységhez rendelve</option>';

            }
            document.getElementById(target).innerHTML = value;

        } else {
            var value = '<option value="-1">Nincs tanegységhez rendelve</option>';
            document.getElementById(target).innerHTML = value;
        }


    });
}
function teacherListOption() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_teacher",
        param: "value"

    }, function (data, status) {
        console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (spStudents[i] != "") {
                    var spStudent = spStudents[i].split(";");

                    value += '<option name="teacher" value="' + spStudent[1] + '">' + spStudent[0] + '</option>';
                }
            }

        } else {
            var value = '<option name="teacher" value="-1">Nincs felvive oktató!</option>';

        }

        document.getElementById("form-row-oktato").innerHTML = value;
    });
}
function deleteConnectteacherAndCurUnit() {
    var muv = "delete_cur_unit_teacher";
    var id = document.getElementById("form-row-oktato").value;
    var cur_unit = document.getElementById("form-row-anyag").value;
    var value = new Array(id, cur_unit);
    var slink = 'server.php';
    var text="";
    $.post(slink, {
        
        muv: muv,
        param: value

    }, function (data, status) {
        console.log(data);

        if (data != "error") {
            text= '<div class="alert alert-success">Sikeres törlés!</div>';


        } else {
            text = '<div class="alert alert-danger">Sikertelen törlés!</div>';

        }
         value = new Array(text, id, cur_unit, "fájl neve");
        connectionGetWithTwoParameter(value);

    });
}
function connectionSend() {
    var oktato = document.getElementById("form-row-oktato").value;
    var cur_unit = document.getElementById("form-row-without").value;
    var file_name = document.getElementById("form-row-alk-name").value;
    var value = new Array(oktato, cur_unit, file_name);
    var slink = 'server.php';
    $.post(slink, {
        muv: "connectionSend",
        param: value

    }, function (data, status) {
        console.log(data);
        var text;
        if (data != "error") {
            text = '<div class="alert alert-success">Sikeres felvitel!</div>';


        } else {
            text = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

        }
        value = new Array(text, oktato, cur_unit, file_name);
        connectionGetWithTwoParameter(value);


    });
}
function connectionEdit() {
    var name = document.getElementById("form-row-oktato").value;
    var szulnev = document.getElementById("form-row-anyag").value;
    var mothername = document.getElementById("form-row-alk-name").value;

    var value = new Array(name, szulnev, mothername);
    var slink = 'server.php';
    $.post(slink, {
        muv: "connectionEdit",
        param: value

    }, function (data, status) {
        console.log(data);
        var text;
        if (data != "error") {
            text = '<div class="alert alert-success">Sikeres módosítás!</div>';


        } else {
            text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

        }
        var value = new Array(text, name, szulnev, mothername);
        connectionGetWithTwoParameter(value);
    });
}
function connectionGetWithTwoParameter(value) {
    var loadFileName= false
    if (!Array.isArray(value)) {
        console.log("alma");
        var oktato = document.getElementById("form-row-oktato").value;
        var anyag = document.getElementById("form-row-anyag").value;

        value = new Array("", oktato, anyag);
        loadFileName=true;
    }
    if(anyag!=-1){
    
    if(!loadFileName){
    linkWithData("teacher_connect_in_form", value, "editafter", 'tartalom-wrapper');
    teacher_cur_unit_List(-2);
    teacher_cur_unit_List(-3);
    }
    console.log(value);
    console.log("________________");
    var slink = 'server.php';
    
    value = new Array(value[1], value[2]);
    console.log(value);
        $.post(slink, {
        muv: "connectionget",
        param: value

    }, function (data, status) {
        console.log(data);
        var spData = data.split("/;/");
        document.getElementById("form-row-oktato").value = spData[0];
        document.getElementById("form-row-anyag").value = spData[1];
        document.getElementById("form-row-alk-name").value = spData[2];




    });
    }

}
function connectionGetWithOneParameter(value) {
    link("teacher_connect_in_form");
    document.getElementById("form-row-oktato").value = value;
    teacher_cur_unit_List(-2);
    teacher_cur_unit_List(-3);




}
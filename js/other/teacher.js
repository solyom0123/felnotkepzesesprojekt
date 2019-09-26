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
     var email = document.getElementById("form-row-email").value;
    var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz,email);
    var slink = 'server.php';
    $.post(slink, {
        muv: "teacherSend",
        param: value

    }, function (data, status) {
        console.log(data);
        var value;
        if (data != "error") {
            value = '<div class="alert alert-success">Sikeres felvitel!</div>';
            var id= data.split(",")[1];
            var arrayToPush = new Array(value,id);
            teacherGetWithParam(arrayToPush);
        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';
             linkWithData("teacher_in_form", value, "load", 'tartalom-wrapper');

        }
       


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
                listUploadedFile(0, value, 1, 1);
                otherfilemodal(0, value, spData[0]);
                document.getElementById("form-row-oktato").value = value;
                 document.getElementById("form-row-uid").value = spData[10];
                 document.getElementById("form-row-email").value= spData[11];
                teacher_cur_unit_List(-2, 1, 1, false);

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
            listUploadedFile(0, value[1], 1, 1);
            otherfilemodal(0, value[1], spData[0]);
            document.getElementById("form-row-oktato").value = value[1];
            document.getElementById("form-row-uid").value = spData[10];
            document.getElementById("form-row-email").value= spData[11];
            teacher_cur_unit_List(-2, 1, 1, false);
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
    var email = document.getElementById("form-row-email").value;
    var value = new Array(name, szulnev, mothername, bcity, nem, szar, telszam, taj, szulev, szulho, szulnap, irszam, city, utca, hz, lepcsohz, id,email);
    var slink = 'server.php';
    $.post(slink, {
        muv: "teacherEdit",
        param: value

    }, function (data, status) {
        ////console.log(data);
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



//        ||||||||  ||      ||  |||||||     ||      ||  ||||      ||    ||  ||||||||||      
//       ||         ||      ||  ||      ||  ||      ||  ||  ||    ||    ||      ||
//       ||         ||      ||  ||      ||  ||      ||  ||    ||  ||    ||      ||
//       ||         ||      ||  ||      ||  ||      ||  ||     || ||    ||      ||
//       ||         ||      ||  ||||||||    ||      ||  ||      ||||    ||      ||
//        ||||||||    ||||||    ||      ||    ||||||    ||      ||||    ||      ||
//
function deleteConnectteacherAndCurUnit() {
    var muv = "delete_cur_unit_teacher";
    var id = document.getElementById("form-row-oktato").value;
    if (id != -1) {
        var data = collectCbData("teacherCurUnitOld");
        if (!checkEmptyString(data)) {
            var value = new Array(id, data);
            var slink = 'server.php';

            $.post(slink, {

                muv: muv,
                param: value

            }, function (data, status) {
                console.log(data);

                teacher_cur_unit_get(1, 1, 1, 1);
            });
        }
    }
}

function connectionSend() {
    var oktato = document.getElementById("form-row-oktato").value;
    if (oktato != -1) {
        var data = collectCbData("teacherCurUnitNew");
        if (!checkEmptyString(data)) {
            var value = new Array(oktato, data);
            var slink = 'server.php';
            $.post(slink, {
                muv: "connectionSend",
                param: value

            }, function (data, status) {
                ////console.log(data);
                teacher_cur_unit_get(1, 1, 1, 1);

            });
        }
    }
}


function  makeRowsFromDataTeacher(spCurunits, cbName, type) {
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var buttonparambefore = "";
    var buttonparamafter = "";
    if (type != 1) {
        buttonparamafter = ",1,1"
    } else {

        buttonparambefore = "1,1,"
    }
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="teacher_cur_unit_get(' + buttonparambefore;
    var down_arrow_end = ',1' + buttonparamafter + ')"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="teacher_cur_unit_get(' + buttonparambefore;
    var up_arrow_end = ',2' + buttonparamafter + ')"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';
    var checkbox_start = '<input type="checkbox" class="' + cbName + '" value="';
    var checkbox_end = '">';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Tanegység név " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "Modul " +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            tr_end;

    if (spCurunits[0] != "none;//") {
        for (var i = 0; i < spCurunits.length; i++) {

            if (!checkEmptyString(spCurunits[i])) {

                var spStudent = spCurunits[i].split(";");

                tr = '<tr style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        checkbox_start + spStudent[1] + checkbox_end +
                        spStudent[0] +
                        td_end +
                        td +
                        spStudent[2] +
                        td_end +
                        tr_end;

            }
        }

    } else {
        value += tr +
                td +
                'Nincs' +
                td_end +
                td +
                'Nincs' +
                td_end +
                tr_end;

    }

    //console.log(value);
    return value;
}
function teacher_cur_unit_get(order_new, ordertype_new, order_old, ordertype_old) {
    teacher_cur_unit_List(-2, order_new, ordertype_new,false);
    teacher_cur_unit_List(-3, order_old, ordertype_old,false);
}
function teacher_cur_unit_List(value, order, ordertype,bonus) {
    var muv = "list_cur_unit_teacher";
    var target = "form-row-anyag";
    var id = 0;
    if (value == -2) {
        id = document.getElementById("form-row-oktato").value;
        if(bonus){
             muv = "list_cur_unit_teacher_bonus";
        }
    }
    if (value == -3) {
        id = document.getElementById("form-row-oktato").value;
        muv = "list_cur_unit_without_teacher";
        target = "form-row-without";
    }
   
    if (id != -1) {
        var sendValue = new Array(id, order + "_" + ordertype);
        var slink = 'server.php';
        $.post(slink, {
            muv: muv,
            param: sendValue

        }, function (data, status) {
           console.log(data);
            var table = "";
            var spStudents = null;
            if (data != "none;//") {
                spStudents = data.split("//");




            } else {
                var spStudents = new Array(data);

            }
            if (value == -2) {
                table = makeRowsFromDataTeacher(spStudents, "teacherCurUnitOld", 2);
            } else {
                table = makeRowsFromDataTeacher(spStudents, "teacherCurUnitNew", 1);

            }
            document.getElementById(target).innerHTML = table;




        });
    } else {
        if (value == -2) {
            table = makeRowsFromDataTeacher("", "teacherCurUnitOld", 2);
        } else {
            table = makeRowsFromDataTeacher("", "teacherCurUnitNew", 1);

        }
        document.getElementById(target).innerHTML = table;

    }
}

function teacherListOption() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_teacher",
        param: "value"

    }, function (data, status) {
        ////console.log(data);
        if (data != "none;//") {
            var value = "";
            value += '<option name="teacher" value="-1">Kérem válasszon oktatót!</option>'
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
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

function userEdit(aid, type) {
    var uid = document.getElementById("form-row-uid").value;
    var uname = document.getElementById("form-row-uname").value;
    //var ps = document.getElementById("form-row-ps").value;
   // var ps2 = document.getElementById("form-row-ps-ag").value;
    var slink = 'server.php';
    /*if (ps != ps2) {
        var value = '<div class="alert alert-warning">A két jelszó nem egyezik!</div>';
        var data = new Array(value, aid);
         if (type == 2) {
                teacherGetWithParam(data);
            } else {
                studentGetWithParam(data);
            }
    } else {*/
        if(checkEmptyString(uid)){
           uid=0; 
        }
        var data = new Array(aid, type,uid,uname);
 
        $.post(slink, {
            muv: "userEdit",
            param: data

        }, function (dataa, status) {
            //console.log(dataa);

            var value = '<div class="alert alert-success">Sikeres felvitel</div>';
            var data = new Array(value, aid);
            if (type == 2) {
                teacherGetWithParam(data);
            } else {
                studentGetWithParam(data);
            }

        });
    //}
}
function getLoginData() {
    var uid = document.getElementById("form-row-uid").value;
    var slink = 'server.php';
        if(uid!=0){
 
        $.post(slink, {
            muv: "getUser",
            param: uid

        }, function (dataa, status) {
            //console.log(dataa);

           if(dataa!="none//"){
              document.getElementById("form-row-uname").value = dataa;
     
           }
        });
    }
}
//       ||||||||||    |||||||||     
//           ||        ||
//           ||        ||
//           ||        ||||||||
//           ||        ||
//           ||        |||||||||
//
function deleteConnectCurUnitAndteacher() {
    var muv = "delete_teacher_cur_unit";
    var id = document.getElementById("form-row-anyag").value;
    if (id != -1) {
        var data = collectCbData("CurUnitteacherOld");
        if (!checkEmptyString(data)) {
            var value = new Array(data, id);
            var slink = 'server.php';

            $.post(slink, {

                muv: muv,
                param: value

            }, function (data, status) {
                ////console.log(data);

                cur_unit_teacher_get(1, 1, 1, 1);
            });
        }
    }
}

function connectionSendCur() {
    var oktato = document.getElementById("form-row-anyag").value;
    if (oktato != -1) {
        var data = collectCbData("CurUnitteacherNew");
        if (!checkEmptyString(data)) {
            var value = new Array(data, oktato);
            var slink = 'server.php';
            $.post(slink, {
                muv: "connectionSendCur",
                param: value

            }, function (data, status) {
                ////console.log(data);
                cur_unit_teacher_get(1, 1, 1, 1);

            });
        }
    }
}


function  makeRowsFromDataTeacherCur(spCurunits, cbName, type) {
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var buttonparambefore = "";
    var buttonparamafter = "";
    if (type != 1) {
        buttonparamafter = ",1,1"
    } else {

        buttonparambefore = "1,1,"
    }
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="cur_unit_teacher_get(' + buttonparambefore;
    var down_arrow_end = ',1' + buttonparamafter + ')"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="cur_unit_teacher_get(' + buttonparambefore;
    var up_arrow_end = ',2' + buttonparamafter + ')"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';
    var checkbox_start = '<input type="checkbox" class="' + cbName + '" value="';
    var checkbox_end = '">';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Oktató neve " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "Típusa " +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            tr_end;

    if (spCurunits[0] != "none;//") {
        for (var i = 0; i < spCurunits.length; i++) {

            if (!checkEmptyString(spCurunits[i])) {

                var spStudent = spCurunits[i].split(";");

                tr = '<tr style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        checkbox_start + spStudent[1] + checkbox_end +
                        spStudent[0] +
                        td_end +
                        td +
                        spStudent[2] +
                        td_end +
                        tr_end;

            }
        }

    } else {
        value += tr +
                td +
                'Nincs' +
                td_end +
                td +
                'Nincs' +
                td_end +
                tr_end;

    }

    //console.log(value);
    return value;
}
function cur_unit_teacher_get(order_new, ordertype_new, order_old, ordertype_old) {
    cur_unit_teacher_List(-2, order_new, ordertype_new);
    cur_unit_teacher_List(-3, order_old, ordertype_old);
}
function cur_unit_teacher_List(value, order, ordertype) {
    var muv = "list_teacher_cur_unit";
    var target = "form-row-oktato";
    var id = 0;
    if (value == -2) {
        id = document.getElementById("form-row-anyag").value;

    }
    if (value == -3) {
        id = document.getElementById("form-row-anyag").value;
        muv = "list_teacher_without_cur_unit";
        target = "form-row-without";
    }
    if (id != -1) {
        var sendValue = new Array(id, order + "_" + ordertype);
        var slink = 'server.php';
        $.post(slink, {
            muv: muv,
            param: sendValue

        }, function (data, status) {
            console.log(data);
            var table = "";
            var spStudents = null;
            if (data != "none;//") {
                spStudents = data.split("//");




            } else {
                var spStudents = new Array(data);

            }
            if (value == -2) {
                table = makeRowsFromDataTeacherCur(spStudents, "CurUnitteacherOld", 2);
            } else {
                table = makeRowsFromDataTeacherCur(spStudents, "CurUnitteacherNew", 1);

            }
            document.getElementById(target).innerHTML = table;




        });
    } else {
        if (value == -2) {
            table = makeRowsFromDataTeacherCur("", "CurUnitteacherOld", 2);
        } else {
            table = makeRowsFromDataTeacherCur("", "CurUnitteacherNew", 1);

        }
        document.getElementById(target).innerHTML = table;

    }
}




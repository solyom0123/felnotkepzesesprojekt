/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function isUsedDayInSc(sc, date) {
    var returnBoolean = false;
    for (var i = 0, max = sc.getUtemterv().length; i < max; i++) {
        if (sc.getUtemtervNap(i).getdatum() == date  && sc.getUtemtervNap(i).isTartalekNap() == false) {
            return true;
        }
    }
    return returnBoolean;
}

function searchIndexSelectedOption(svalue, select) {
    var index = 0;
    var options = select.getElementsByTagName("option");
    for (var i = 0, max = options.length; i < max; i++) {
        var optionvalue = options[i].value.trim();
        if (optionvalue == svalue) {
            index = i;
        }
    }
    return index;
}

function searchTeacherExam(modul) {
    return new Promise((resolve, reject) => {

        $.ajax({

            url: "server.php",
            type: 'POST',
            data: {
                param: modul,
                muv: "searchTeacherExam"
            },

            success: function (data) {
                // ////console.log(data);
                resolve(data);
            },
            error: function (err) {
                reject(err);
            }
        });
    });
}
function searchTeacher(curUnitId) {
    return new Promise((resolve, reject) => {

        $.ajax({

            url: "server.php",
            type: 'POST',
            data: {
                param: curUnitId,
                muv: "searchTeacher"
            },

            success: function (data) {
                // ////console.log(data);
                resolve(data);
            },
            error: function (err) {
                reject(err);
            }
        });
    });
}
function searchForCurUnits(param) {

    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: param,
                muv: "cur_units_with_bonus"
            },

            success: function (data) {
                ////console.log(data);
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
function whichcurunit(selected_cur_unit) {
    for (var i = 0, max = objects.length; i < max; i++) {
        if (objects[i]["id"] == selected_cur_unit) {
            return i;
        }
    }
}

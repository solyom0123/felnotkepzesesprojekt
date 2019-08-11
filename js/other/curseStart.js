/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*  <div class="form-group row">
 <label for="form-row-name" class="col-md-4 col-form-label">xy.</label>
 <div class="col-md-4">
 <select  class="form-control" id="form-row-modul-1" onclick="modulChange(1)">
 
 </select>
 </div>
 <div class="col-md-4 ">
 <a href="#" data-toggle="tooltip" title="Válassza ki a xy. modult modult!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
 </div>                            
 </div>
 */
var tiltotta = new Array();
var hasznalt = new Array();
var hiba= false;
function modulSelectorsMake() {
    var slink = 'server.php';
    var id = document.getElementById("form-row-kepzes").value;
    if (id != -1) {
        $.post(slink, {
            muv: "list_modul_selector_piece",
            param: id

        }, function (data, status) {
            ////console.log(data);
            var value = "";
            var spStudents = data.split("//");
            var emptyModulList = false;
            document.getElementById("modul_length_of_course").value = spStudents[0];
            lockAllFieldsCourseStartForm(false);
            for (var i = 1; i < spStudents.length; i++) {
                if (spStudents[i] != "") {
                    value += '<div class="form-group row"><label for="form-row-name" class="col-md-4 col-form-label">' + i + '.</label>' +
                            '<div class="col-md-4"><select  class="form-control" id="form-row-modul-' + i + '" onchange="modulChange()">' +
                            '</select></div><div class="col-md-4 "><a href="#" data-toggle="tooltip" title="Válassza ki a ' + i + '. modult modult!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a> ' +
                            ' </div></div>';
                }
            }
            document.getElementById("modul-order-place").innerHTML = value;
            var modullist = "";
            modulRefeshwithParametersAJAXCALL(id, true)
                    .then(moduls => {

                        modullist = moduls;
                        for (var i = 1; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                //console.log(i);
                                let atadandotiltott = Object.assign(new Array(), tiltotta);
                                let atadandohely = Object.assign(new Array(), hasznalt);
                                let index = "form-row-modul-" + i;
                                modulRefeshwithParametersSELECTION(modullist, id, index, atadandotiltott, atadandohely)
                                //tiltotta[tiltotta.length] = spStudents[i];
                            }
                        }
                        if (spStudents[0] == 0) {
                            emptyModulList = true;
                        }
                        var message = "";
                        if (emptyModulList) {

                            message = '<div class="alert alert-danger">Ehhez a képzéshez nincs modul rendelve. Kérem válasszon másikat!</div>';
                            lockAllFieldsCourseStartForm(true);
                        }
                        document.getElementById("error_place").innerHTML = message;
                    })
                    .catch(error => {
                        //console.log(error)
                    });


        });

    } else {
        lockAllFieldsCourseStartForm(true);

        document.getElementById("modul-order-place").innerHTML = "";
    }



}
function lockAllFieldsCourseStartForm(lock) {
    lockAllWeekDaysInput("_plan_dec", lock);//;
    lockAllWeekDaysInput("_plan_exe", lock);
    lockAllWeekDaysInput("_el_dec", lock);
}
function modulChange() {
    clearUsedSelectChooseArrays();
    collectModulSelectorsData();
    modulSelectorsMake();

}
function checkEnoughDay() {
    var plan_dec_number = calc("_plan_dec");//;
    var plan_exe_number = calc("_plan_exe");
    var el_dec_number = calc("_el_dec");
    var startday = document.getElementById("form-row-start").value;
    var signDay = document.getElementById("form-row-sign-date").value;
    var id = document.getElementById("form-row-kepzes").value;

    var param = new Array();
    param[0] = plan_dec_number;
    param[1] = plan_exe_number;
    param[2] = el_dec_number;
    param[3] = startday;
    if (startday != "") {
        param[4] = getMonthStartWeekDaysNo(startday);
    } else {
        param[4] = "";
    }
    param[5] = signDay;
    if (signDay != "") {
        param[6] = getMonthStartWeekDaysNo(signDay);
    } else {
        param[6] = "";
    }
    param[7] = id;
    param[8] = tiltotta;
    var slink = 'server.php';
    $.post(slink, {
        muv: "enough_day",
        param: param

    }, function (data, status) {
        console.log(data);

        var spStudents = data.split("//");
        var message = "";
        var need_doc = 0;
        var need_exec = 0;
        var need_el = 0;
        var needMoreExec = false;
        var needLessExec = false;
        var needMoreEl = false;
        var unuseableExam = false;
        var unuseableExamType = new Array();
        var unuseableExamhour = new Array();
        var needLessEL = false;
        var needMore = false;
        var needLess = false;

        if (spStudents[0] < 0) {
            needMore = true;
            need_doc = spStudents[0] * (-1);
        }
        if (spStudents[1] < 0) {
            needMoreExec = true;
            need_exec = spStudents[1] * (-1);
        }
        if (spStudents[2] < 0) {
            needMoreEl = true;
            need_el = spStudents[2] * (-1);
        }
        if (spStudents[0] > 0) {
            needLess = true;
            need_doc = spStudents[0];
        }
        if (spStudents[1] > 0) {
            needLessExec = true;
            need_exec = spStudents[1];
        }
        if (spStudents[2] > 0) {
            needLessEL = true;
            need_el = spStudents[2];
        }
        if (spStudents[3] != "") {
            unuseableExam = true;
            var spdata = spStudents[3].split(",");
            if (spdata[0] == "doc") {
                unuseableExamType.push("doc");
                unuseableExamhour.push(spdata[1]);
                if (spStudents.length >= 5) {
                    var spdata = spStudents[4].split(",");
                    unuseableExamType.push("exe");
                    unuseableExamhour.push(spdata[1]);

                }
            } else {
                unuseableExamType.push("exe");
                unuseableExamhour.push(spdata[1]);
            }
        }
        if (needMore || needMoreEl || needMoreExec || unuseableExam) {
            hiba=true;
            message = '<div class="alert alert-danger">Hiba az oktatás idővallumjával vagy a tervezett óraszámmal!';

        } else {
            hiba=false;
            message = '<div class="alert alert-success">Rövidebb idővallumú ütemterv készülhet, mint a vizsga jelentkezés időpontja!';

        }

        if (needLess) {

            message += '<br>Az üresen maradó elméleti órák száma: ' + need_doc + '.';

        }
        if (needMore) {

            message += '<br>Hiányzó elméleti órák száma: ' + need_doc + '.';

        }
        if (needLessEL) {

            message += '<br>Az üresen maradó elearning órák száma: ' + need_el + '.';

        }
        if (needMoreEl) {

            message += '<br>Hiányzó elearning órák száma: ' + need_el + '.';

        }
        if (needLessExec) {

            message += '<br>Az üresen maradó gyakorlati órák száma: ' + need_exec + '.';

        }
        if (needMoreExec) {

            message += '<br>Hiányzó gyakorlati órák száma: ' + need_exec + '.';

        }
        if (unuseableExam) {
            for (var i = 0, max = unuseableExamType.length; i < max; i++) {
                if (unuseableExamType[i]=="doc") {
                message += '<br>Az elméleti órák nem fedik le egyik napon sem a leghosszabb vizsgát: ' + unuseableExamhour[i]+ '.';

                }else{
                message += '<br>A gyakorlati órák nem fedik le egyik napon sem a leghosszabb vizsgát: ' + unuseableExamhour[i]+ '.';

                }
            }
            
        }
        document.getElementById("error_place").innerHTML = message;
    });

}



function calc(type) {
    var sum = new Array();
    var week_days = ["mon", "tue", "wed", "thu", "fri", "sat", "sun"];
    for (var i = 0, max = week_days.length; i < max; i++) {
        sum[sum.length] = document.getElementById(week_days[i] + type).value * 1;
    }
    collectModulSelectorsData();
    return sum;
}
function lockAllWeekDaysInput(type, lock) {
    var week_days = ["mon", "tue", "wed", "thu", "fri", "sat", "sun"];
    for (var i = 0, max = week_days.length; i < max; i++) {
        document.getElementById(week_days[i] + type).readOnly = lock;
    }
    document.getElementById("form-row-start").readOnly = lock;
    document.getElementById("form-row-sign-date").readOnly = lock;
    document.getElementById("form-row-exam-date").readOnly = lock;


}
function lockAllModulSelector(lock) {
    var osszesdb = (document.getElementById("modul_length_of_course").value * 1) + 1;
    for (var i = 1, max = osszesdb; i < max; i++) {
        document.getElementById("form-row-modul-" + i).disabled = lock;
    }
    document.getElementById("form-row-schedule-button").disabled = lock;
    document.getElementById("form-row-kepzes").disabled = lock;
    document.getElementById("form-row-name").disabled = lock;

}
function clearUsedSelectChooseArrays() {
    tiltotta = new Array();
    hasznalt = new Array();
}
function collectModulSelectorsData() {
    var osszesdb = (document.getElementById("modul_length_of_course").value * 1) + 1;
    tiltotta = new Array();
    hasznalt = new Array();
    for (var i = 1, max = osszesdb; i < max; i++) {
        var ertek = document.getElementById("form-row-modul-" + i).value;
        if (ertek != -1) {
            hasznalt[hasznalt.length] = i;
            tiltotta[tiltotta.length] = ertek;
        }
    }
}
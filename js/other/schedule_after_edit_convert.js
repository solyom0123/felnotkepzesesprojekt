/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addReplacementDayafterEdit(day) {
    var selected_cur_unit = day[2];
    var curunit = whichcurunit(selected_cur_unit);
    var sum = (objects[curunit]["el"] * 1) + (objects[curunit]["ex"] * 1) + (objects[curunit]["d"] * 1)
    var remain_replacementdays_ammount = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML;
    var selected_day = day[0];
    for (var i = 0, max = replacementdays.length; i < max; i++) {

        if (replacementdays[i].getdatum() == selected_day) {
            if (day[3] >= replacementdays[i].getOra()) {
                removeDay(selected_day);
            } else if (day[3] < replacementdays[i].getOra()) {
                replacementdays[i].setOra(replacementdays[i].getOra() - day[3]);
                refeshlist(selected_day,replacementdays[i].getOra());
            }

        }

    }

    objects[curunit]["used"] = (objects[curunit]["used"] * 1) + (day[3] * 1);
    var newday = new Utemterv_bejegyzes_Model(0, day[0], solveBooleanFromString(day[1]), day[2], day[3], day[4], solveBooleanFromString(day[5]), day[6], day[7], day[8], day[9]);
    insertInTable(newday);
    var remain_curunit = sum - (objects[curunit]["used"] * 1);
    if ((remain_curunit * 1) < 1) {
        removeCuruint(selected_cur_unit);
    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = ((remain_replacementdays_ammount * 1) - 1)

}
function loadSchedule(spSchedule) {
    var lastDays = new Array();
    if (spSchedule != "none//") {
        var scRows = spSchedule.split("//");

        for (var i = 0, max = scRows.length; i < max; i++) {
            var actrow = scRows[i].split(";,;");
            if (!checkEmptyString(scRows[i])) {
                var day = new Utemterv_bejegyzes_Model(0, actrow[0], solveBooleanFromString(actrow[1]), actrow[2], actrow[3], actrow[4], solveBooleanFromString(actrow[5]), actrow[6], actrow[7], actrow[8]);
                                                    //0         1           2                               3              4        5           6                               7           8           9   
                day.setOktato(actrow[11] * 1);
                sc.addUtemtervhez(day);
                if (actrow[1] == "true") {
                    lastDays[lastDays.length] = actrow;
                }
                if (actrow[5] == "true") {
                     var dayno = getMonthStartWeekDaysNo(actrow[0]);
                    var data = new Array(actrow[0]+"||"+solveDayForShow(dayno), solveUtemTerv_ModelExamTypeForHuman(actrow[2]), actrow[9], actrow[3], actrow[6], actrow[7], solveUtemTerv_ModelTypeForHuman(actrow[4]),actrow[0], actrow[8]+"_"+actrow[2]);
                    makeTableForShow(3, data);
                }
                if (actrow[5] == "false" && actrow[1] == "false") {
                    var dayno = getMonthStartWeekDaysNo(actrow[0]);
                    var data = new Array(actrow[0]+"||"+solveDayForShow(dayno), actrow[10], actrow[9], actrow[3], actrow[6], actrow[7], solveUtemTerv_ModelTypeForHuman(actrow[4]), actrow[0], actrow[2]);
                    makeTableForShow(2, data);
                }
            }
        }


    } else {
        hiba = true;

    }
    return lastDays;
}
function loadNameAndDatesInputs(spNameAndDates, id) {

    var NameAndDates = spNameAndDates.split("//")[0].split(";,;");
    var kepzes = new Kepzes_Model(NameAndDates[9], NameAndDates[1], NameAndDates[2]);

    sc = new Aktiv_Kepzes_Model(id, NameAndDates[0], kepzes, NameAndDates[3], NameAndDates[8], NameAndDates[4], NameAndDates[7],NameAndDates[13],NameAndDates[14]);
    var doctrina_days = makeArrayFomString(NameAndDates[10]);
    var elearn_days = makeArrayFomString(NameAndDates[11]);
    var exercise_days = makeArrayFomString(NameAndDates[12]);
    ////console.log(doctrina_days);
    ////console.log(elearn_days);
    ////console.log(exercise_days);
    makeWeekUtemterv_bejegyzes_ModelfromArray(doctrina_days, sc, 1);
    makeWeekUtemterv_bejegyzes_ModelfromArray(exercise_days, sc, 2);
    makeWeekUtemterv_bejegyzes_ModelfromArray(elearn_days, sc, 3);

    ////console.log(spNameAndDates);
    makeTableForShow(1, null);
    document.getElementById("form-row-name").value = NameAndDates[0];
    document.getElementById("form-row-help-day").value = NameAndDates[7];

    document.getElementById("form-row-start").value = NameAndDates[3];
    document.getElementById("form-row-sign-date").value = NameAndDates[4];
    document.getElementById("form-row-kepzes").value = NameAndDates[1] + "-" + NameAndDates[2];
    if (NameAndDates[8] != "0000-00-00") {
        document.getElementById("form-row-exam-date").value = NameAndDates[8];
    }
    if (NameAndDates[13] != "0000-00-00") {
        document.getElementById("form-row-pract-ban-start-date").value = NameAndDates[13];
    }
    if (NameAndDates[14] != "0000-00-00") {
        document.getElementById("form-row-pract-ban-end-date").value = NameAndDates[14];
    }
}
function loadModulNames(spModulNames,target) {
    var inputs = '';
    var span_head = '<span class="col-md-4">';
    var span_end = '</span>';
    var inputs_head = ' <input class="form-control-plaintext col-md-8 " name="form-row-help-day" id="form-row-help-day" type="text"  value="';
    var inputs_end = '" readonly >';
    var NameAndDates = spModulNames.split("//");
    for (var i = 0, max = NameAndDates.length; i < max; i++) {
        if (!checkEmptyString(NameAndDates[i])) {
            var spModul = NameAndDates[i].split(";");
            inputs += span_head + (i + 1) + ": " + span_end + inputs_head + spModul[1] + " - " + spModul[2] + inputs_end;

        }
    }
    document.getElementById(target).innerHTML = inputs;
}
function loadUsedReplacementDays(usedReplacementDays) {
    for (var i = 0, max = usedReplacementDays.length; i < max; i++) {
        addReplacementDayafterEdit(usedReplacementDays[i]);
    }
}
function setBackSelectedTeachersAtReplacementDay(usedReplacementDays) {
    for (var i = 0, max = usedReplacementDays.length; i < max; i++) {

        var myTable = document.getElementById("bonustable");
        var rows = myTable.getElementsByTagName("tr");

        var select = rows[i+1].getElementsByTagName("td")[7].getElementsByTagName("select")[0];
        select.selectedIndex = searchIndexSelectedOption(usedReplacementDays[i][11].trim(), select);

    }
}
function makeArrayFomString(string) {
    var returnArrray = new Array();
    var spString = string.split(";");
    for (var i = 0, max = spString.length; i < max; i++) {
        if (!checkEmptyString(spString[i]))
        {
            returnArrray[returnArrray.length] = (spString[i] * 1);
        }

    }
    return returnArrray;
}
function makeCorrectModulStringInArray(string) {
    var returnArrray = new Array();
    var spString = string.split("//");
    for (var i = 0, max = spString.length; i < max; i++) {
        if (!checkEmptyString(spString[i]))
        {
            var spModul = spString[i].split(";");

            returnArrray[returnArrray.length] = spModul[1] + ";" + spModul[0] + ";" + spModul[2] + ";-1;-1;-1;-1;-1";
        }

    }
    return returnArrray;
}
function writeErrorMessageAndTowardToGenerate() {
    var massege = '<tr><td colspan="8"><div style="cursor: pointer;" onclick="backLoadeditschedule()" class="alert alert-danger"><h1>Ehhez az aktív képzéshez nem készült ütemterv!<br> Kérem kattintson erre az üzenetre a generáláshoz</h1></div></td></tr>';
    document.getElementById("resultTable").innerHTML = massege;
    document.getElementById("pass-btn").style.display = "none";
     document.getElementById("pass-btn-delete").style.display = "none";
    document.getElementById("bonus").innerHTML = massege;
}
function makeScFromDataNAMES(spNameAndDates, id) {

    var NameAndDates = spNameAndDates.split("//")[0].split(";,;");
    var kepzes = new Kepzes_Model(NameAndDates[9], NameAndDates[1], NameAndDates[2]);

    sc = new Aktiv_Kepzes_Model(id, NameAndDates[0], kepzes, NameAndDates[3], NameAndDates[8], NameAndDates[4], NameAndDates[7],NameAndDates[13],NameAndDates[14]);
    var doctrina_days = makeArrayFomString(NameAndDates[10]);
    var elearn_days = makeArrayFomString(NameAndDates[11]);
    var exercise_days = makeArrayFomString(NameAndDates[12]);
    ////console.log(doctrina_days);
    ////console.log(elearn_days);
    ////console.log(exercise_days);
    makeWeekUtemterv_bejegyzes_ModelfromArray(doctrina_days, sc, 1);
    makeWeekUtemterv_bejegyzes_ModelfromArray(exercise_days, sc, 2);
    makeWeekUtemterv_bejegyzes_ModelfromArray(elearn_days, sc, 3);

    ////console.log(spNameAndDates);

}
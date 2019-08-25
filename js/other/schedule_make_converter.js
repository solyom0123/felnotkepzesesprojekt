/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function makeSchedule(dataArrayFromInput, dataArrayFromServer, course) {
    return new Aktiv_Kepzes_Model(
            dataArrayFromServer[0],
            dataArrayFromInput[0],
            course,
            dataArrayFromInput[2],
            dataArrayFromInput[4],
            dataArrayFromInput[3],
            dataArrayFromInput[9],
            );
}
function makeTanegyseg_ModelFromData(dataArray, targetArray) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (!checkEmptyString(dataArray[i])) {
            var spCurUnitData = dataArray[i].split(";");
            var curUnit = new Tananyagegyseg_Model(spCurUnitData[1], spCurUnitData[0], spCurUnitData[2], spCurUnitData[3], spCurUnitData[4], spCurUnitData[5]);
            targetArray[targetArray.length] = curUnit;
        }
    }
}
function makeModul_ModelsfromData(dataArray, schedule) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (!checkEmptyString(dataArray[i])) {
            var spModulData = dataArray[i].split(";");
            let modul = new Modul_Model(spModulData[1], spModulData[0], spModulData[2], spModulData[3], spModulData[4]);

            makeExamForModul_Models(modul, 1, spModulData[5]);
            makeExamForModul_Models(modul, 2, spModulData[6]);
            makeExamForModul_Models(modul, 3, spModulData[7]);

            schedule.getKepzes().addModul(modul);
        }
    }
}
function makeUnusableUtemterv_bejegyzes_ModelfromData(dataArray, schedule) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (!checkEmptyString(dataArray[i])) {
            var spDateData = dataArray[i].split(";");
            let unusableDate = new Utemterv_bejegyzes_Model(spDateData[1], spDateData[0], 0, 0, 0, 0, 0, 0, 0);

            schedule.addKizartnap(unusableDate);
        }
    }
}
function makeWeekUtemterv_bejegyzes_ModelfromArray(dataArray, schedule, type) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (dataArray[i] > 0) {
            let weekDate = new Utemterv_bejegyzes_Model(i + 1, "", 0, 0, dataArray[i], type, 0, 0, 0);

            schedule.addWeekDay(weekDate);
        }
    }
}
function makeDayUtemterv_bejegyzes_ModelfromData(dataArray, schedule) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (!checkEmptyString(dataArray[i])) {
            let DayDate = new Utemterv_bejegyzes_Model(0, dataArray[i], 0, 0, 0, 0, 0, 0, 0);

            schedule.addNapNaptarhoz(DayDate);
        }
    }
}
function makeTableForShow(type, data) {
    var table = '<table id="scTable" onload="loadTeacherselects(0)">';
    var table_end = '</table>';
    var td = "<td>";
    var select_head = '<select onchange="loadTeacher(\''
    var select_middle = '\',';
    var select_middle_1 = ',';
    var select_end = ')" ><option value="-1">Kérem válasszon oktatót!</option></select>';
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var buttonparambefore = "";
    var buttonparamafter = "";
    /*var down_arrow_start = '<span style="cursor: pointer;"  onclick="teacher_cur_unit_get('+buttonparambefore;
     var down_arrow_end = ',1'+buttonparamafter+')"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
     var up_arrow_start = '<span   style="cursor: pointer;" onclick="teacher_cur_unit_get('+buttonparambefore;
     var up_arrow_end = ',2'+buttonparamafter+')"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';
     var checkbox_start = '<input type="checkbox" class="'+cbName+'" value="';
     var checkbox_end = '">';*/
    var th_end = '</th>';

    switch (type) {
        case 1:
            kiiras += table +
                    tr +
                    th_head +
                    'dátum' +
                    th_end +
                    th_head +
                    'Tanegység neve' +
                    th_end +
                    th_head +
                    'Modul neve' +
                    th_end +
                    th_head +
                    'Óraszám' +
                    th_end +
                    th_head +
                    'Kezdő' +
                    th_end +
                    th_head +
                    'Vég' +
                    th_end +
                    th_head +
                    'Típus' +
                    th_end +
                    th_head +
                    'Oktató' +
                    th_end +
                    tr_end;

            break;
        case 2:
            kiiras += tr +
                    td +
                    data[0] +
                    td_end +
                    td +
                    data[1] +
                    td_end +
                    td +
                    data[2] +
                    td_end +
                    td +
                    data[3] +
                    td_end +
                    td +
                    data[4] +
                    td_end +
                    td +
                    data[5] +
                    td_end +
                    td +
                    data[6] +
                    td_end +
                    td +
                    select_head +
                    data[7] +
                    select_middle +
                    data[8] +
                    select_middle_1 +
                    false +
                    select_middle_1 +
                    0 +
                    select_end +
                    td_end +
                    tr_end;

            break;
        case 3:
            kiiras += tr +
                    td +
                    data[0] +
                    td_end +
                    td +
                    data[1] +
                    td_end +
                    td +
                    data[2] +
                    td_end +
                    td +
                    data[3] +
                    td_end +
                    td +
                    data[4] +
                    td_end +
                    td +
                    data[5] +
                    td_end +
                    td +
                    data[6] +
                    td_end +
                    td +
                    'Vizsgához nem lehet oktatót választani!' +
                    td_end +
                    tr_end;

            break;
        case 4:
            kiiras += table_end;

            break;

        default:

            break;
    }
}
function collectDatainArray(targetArray) {
    targetArray[0] = document.getElementById("form-row-name").value;
    targetArray[1] = document.getElementById("form-row-kepzes").value;
    targetArray[2] = document.getElementById("form-row-start").value;
    targetArray[3] = document.getElementById("form-row-sign-date").value;
    targetArray[4] = document.getElementById("form-row-exam-date").value;
    targetArray[5] = calc("_plan_dec");
    targetArray[6] = calc("_plan_exe");
    targetArray[7] = tiltotta;
    targetArray[8] = hasznalt;
    targetArray[9] = document.getElementById("form-row-help-day").value;
    targetArray[10] = calc("_el_dec");



}
function connectCurUnitsForModuls(schedule, cur_unitArray) {

    for (var i = 0, max = schedule.getKepzes().getModulok().length; i < max; i++) {
        var modul = schedule.getKepzes().getModul(i);
        addCurUnitForModul(modul, cur_unitArray);

    }
}
function addCurUnitForModul(modul, array) {
    for (var i = 0, max = array.length; i < max; i++) {
        if (modul.getId() == array[i].getModulid()) {
            modul.addTananyagegyseg(array[i]);
        }
    }
}
function makeExamForModul_Models(modul, exam_type, exam_hour) {
    if (exam_hour != "0" && exam_hour != 0) {
        modul.addVizsga(new Vizsga_Model(exam_type, exam_hour));
    }
}
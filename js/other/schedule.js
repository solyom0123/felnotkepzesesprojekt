/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var kiiras = "";
var sc = null;
var objects = null;
var replacementdays = null;
var USEDREPLACEMENTDAYS = null;
var VOLT = false;
var SPSCHEDULEDATA = "";
//var utemterv = new Aktiv_Kepzes_Model();
//-----------------------------------------------------------------------------
//---------------------------SCHEDULING FUNCTIONS------------------------------
//------------------------------------------------------------------------------
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

function getActiveEduScheme() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "getActiveEduSchemee",
        param: "value"

    }, function (data, status) {
        console.log(data);
        if (data != "none;") {

            var spData = data.split("/;/");
            var text = '<option value="-1">Kérem válasszon sémát!</option>';
            for (var i = 0; i < spData.length; i++) {
                if (!checkEmptyString(spData[i])) {
                    var sprow = spData[i].split(";");
                    text += '<option value="' + sprow[0] + '">' + sprow[1] + '</option>'
                }
            }


        } else {
            var text = '<option value="-1">Nincs elmentet séma!</option>';
        }
        document.getElementById("form-row-sema").innerHTML = text;
    });
}
function backloadActiveEduSchema() {
    var value = document.getElementById("form-row-sema").value;
    if(value!=-1){
    document.getElementsByTagName("id")[0].innerHTML = value;
        makeScFromSchema();
        backLoadschedule(false,true);
       // document.getElementById("form-row-name").value="";
    }
}
function saveSchedule() {
    var formDataArray = new Array();
    //lockAllFieldsCourseStartForm(true);
    //lockAllModulSelector(true);
    collectDatainArray(formDataArray);

    // //console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "save_schedule",
        param: formDataArray

    }, function (data, status) {
        link("course_start");
    });
}
function updateSchedule() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    var formDataArray = new Array();
    //lockAllFieldsCourseStartForm(true);
    //lockAllModulSelector(true);
    collectDatainArray(formDataArray);
    formDataArray[formDataArray.length] = id;
    //console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "update_schedule",
        param: formDataArray

    }, function (data, status) {
        //console.log(data);
        backtotheMenu();
    });
}
function gettingupdateStart() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    var formDataArray = new Array();
    //lockAllFieldsCourseStartForm(true);
    //lockAllModulSelector(true);
    collectDatainArray(formDataArray);
    formDataArray[formDataArray.length] = id;

    // //console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "course_start_update",
        param: formDataArray

    }, function (data, status) {
        // //console.log(data);
        kiiras = "";
        sc = null;
        objects = null;
        var spReplyData = data.split("//");
        var spModuls = spReplyData[2].split("/;/");
        var spCurUnits = spReplyData[3].split("/;/");
        var spDateInfos = spReplyData[4].split("/;/");
        var spCaleInfos = spReplyData[5].split("/;/");
        var spCourse = spReplyData[1].split(";");
        var course = new Kepzes_Model(spCourse[1], spCourse[0], spCourse[2]);
        var cur_unitArray = new Array();
        ////console.log(schedule);
        var schedule = makeSchedule(formDataArray, spReplyData, course);
        makeTanegyseg_ModelFromData(spCurUnits, cur_unitArray);
        makeModul_ModelsfromData(spModuls, schedule);
        makeUnusableUtemterv_bejegyzes_ModelfromData(spDateInfos, schedule);
        connectCurUnitsForModuls(schedule, cur_unitArray);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[5], schedule, 1);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[6], schedule, 2);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[10], schedule, 3);
        makeTableForShow(1, null);
        makeDayUtemterv_bejegyzes_ModelfromData(spCaleInfos, schedule);
        ////console.log(schedule);
        scanDates(schedule);
        makeTableForShow(4, null);
        //console.log(schedule);
        showResultUpdate(schedule);
    });
}
function gettingStart() {
    var formDataArray = new Array();
    //lockAllFieldsCourseStartForm(true);
    //lockAllModulSelector(true);
    collectDatainArray(formDataArray);

    // //console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "course_start",
        param: formDataArray

    }, function (data, status) {
        // //console.log(data);
        kiiras = "";
        sc = null;
        objects = null;
        var spReplyData = data.split("//");
        var spModuls = spReplyData[2].split("/;/");
        var spCurUnits = spReplyData[3].split("/;/");
        var spDateInfos = spReplyData[4].split("/;/");
        var spCaleInfos = spReplyData[5].split("/;/");
        var spCourse = spReplyData[1].split(";");
        var course = new Kepzes_Model(spCourse[1], spCourse[0], spCourse[2]);
        var cur_unitArray = new Array();
        ////console.log(schedule);
        var schedule = makeSchedule(formDataArray, spReplyData, course);
        makeTanegyseg_ModelFromData(spCurUnits, cur_unitArray);
        makeModul_ModelsfromData(spModuls, schedule);
        makeUnusableUtemterv_bejegyzes_ModelfromData(spDateInfos, schedule);
        connectCurUnitsForModuls(schedule, cur_unitArray);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[5], schedule, 1);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[6], schedule, 2);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[10], schedule, 3);
        makeTableForShow(1, null);
        makeDayUtemterv_bejegyzes_ModelfromData(spCaleInfos, schedule);
        ////console.log(schedule);
        scanDates(schedule);
        makeTableForShow(4, null);
        //console.log(schedule);
        showResult(schedule);
    });
}
function makeTableForShow(type, data) {
    var table = '<table id="scTable" onload="loadTeacherselects(0)">';
    var table_end = '</table>';
    var td = "<td>";
    var select_head = '<select onchange="loadTeacher(\''
    var select_middle = '\',';
    var select_end = ',false)" ><option value="-1">Kérem válasszon oktatót!</option></select>';
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
function scanDates(schedule) {
    for (var i = 0, max = schedule.getNaptar(); i < max; i++) {
        var actdate = schedule.getNapNaptarhoz(i).getdatum();
        if (!tiltottnap(schedule, actdate)) {
            var dayno = getMonthStartWeekDaysNo(actdate);
            var hourscanuse = checkEnableHoursAtDate(schedule, dayno);
            if (hourscanuse.length > 0) {
                var moduls = searchModul(schedule, hourscanuse);

                if (moduls.length > 0) {
                    ////console.log(actdate);
                    ////console.log(moduls);
                    ////console.log(hourscanuse);

                    useFoundModulsAndHours(moduls, schedule, hourscanuse, actdate, dayno);
                } else {
                    schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno, actdate, true, 0, sumHoursCanUse(hourscanuse), 0, false, 0, 0, 0));

                }
            }
        }
        ////console.log("_____nextday___");
    }
}
function useFoundModulsAndHours(moduls, schedule, hourscanuse, actdate, dayno) {
    var actModulNoInArray = 0;
    var actHoursCanUseNoInArray = 0;
    var usedHoursAmmount = 0;
    //var end = false;
    while (actHoursCanUseNoInArray < hourscanuse.length) {
        var actHour = hourscanuse[actHoursCanUseNoInArray];
        var actModul = moduls[actModulNoInArray];
        var foundCurUnit = searchCurUnit(actModul, actHour);
        // //console.log(foundCurUnit);
        //var helyiarray = new Array();
        var foundExam = null;
        if (foundCurUnit != null) {
            ////console.log(actHour.getOra()-usedHoursAmmount);
            var hourAmmmountByHoursType = calchourAmmmountByHoursType(foundCurUnit, actHour, (actHour.getOra() - usedHoursAmmount));
            var modulstarthourAmmmountByHoursType = calcmodulstarthourAmmmountByHoursType(actModul, actHour);
            //  //console.log(hourAmmmountByHoursType);
            // //console.log(modulstarthourAmmmountByHoursType);
            var data = new Array(actdate, foundCurUnit.getTanegyseg_neve(), actModul.getModul_neve() + " " + actModul.getModul_azon(), hourAmmmountByHoursType, modulstarthourAmmmountByHoursType, (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType), solveUtemTerv_ModelTypeForHuman(actHour.getTipus()), actdate, foundCurUnit.getId());
            makeTableForShow(2, data);
            schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno, actdate, false, foundCurUnit.getId(), hourAmmmountByHoursType, actHour.getTipus(), false, (modulstarthourAmmmountByHoursType), (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType), actModul.getId()))
            usedHoursAmmount += hourAmmmountByHoursType;
            calcAndSetFoundCurUnitUsedHourAmmountByHourType(actHour, foundCurUnit, hourAmmmountByHoursType);
            calcAndSetActModulUsedHourAmmountByHourType(actHour, actModul, hourAmmmountByHoursType);

        } else {
            foundExam = searchExam(actModul, actHour, (actHour.getOra() - usedHoursAmmount));
            if (foundExam != null) {
                var hourAmmmountByHoursType = (foundExam.getOraszam() * 1);
                var modulstarthourAmmmountByHoursType = calcmodulstarthourAmmmountByHoursType(actModul, actHour);
                var data = new Array(actdate, solveUtemTerv_ModelExamTypeForHuman(foundExam.getTipus()), actModul.getModul_neve() + " " + actModul.getModul_azon(), hourAmmmountByHoursType, modulstarthourAmmmountByHoursType, (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType), solveUtemTerv_ModelTypeForHuman(actHour.getTipus()));
                makeTableForShow(3, data);
                schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno, actdate, false, foundExam.getTipus(), hourAmmmountByHoursType, actHour.getTipus(), true, (modulstarthourAmmmountByHoursType), (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType), actModul.getId()));
                usedHoursAmmount += hourAmmmountByHoursType;
                calcAndSetActModulUsedHourAmmountByHourType(actHour, actModul, hourAmmmountByHoursType);
                foundExam.setUsed(true);
            }

        }
        if ((actModulNoInArray + 1) < moduls.length && (actHour.getOra() - usedHoursAmmount) > 0) {
            actModulNoInArray++;
        } else if ((actHour.getOra() - usedHoursAmmount) > 0 && schedule.getTartaleknapok() > 0) {
            schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno, actdate, true, 0, (actHour.getOra() - usedHoursAmmount), 0, false, 0, 0, 0));
            actModulNoInArray = 0;
            usedHoursAmmount = 0;
            actHoursCanUseNoInArray++;

        } else {
            actModulNoInArray = 0;
            usedHoursAmmount = 0;
            actHoursCanUseNoInArray++;
        }

    }
}
function showResult(schedule) {
    link("resultpage")
            .then(data => {
                document.getElementById("resultTable").innerHTML = kiiras;
                sc = schedule;
                loadTeacherselects(0, 0, false);
                replacementdays = collectSCReplacmentDays(sc);
                var options = makeOptionsFromReplacemetnDays(replacementdays);
                document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = options;
                document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = sc.getTartaleknapok();
                searchForCurUnits(sc.getKepzes().getId())
                        .then(data => {
                            objects = makeObjectFromReturnValue(data);
                            options = makeOptionsFromObjects(objects);
                            document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].innerHTML = options;

                        })
                        .catch(error => {
                            ////console.log(error)
                        });

            })
            .catch(error => {
                ////console.log(error)
            });

    //document.getElementById("resultTable").innerHTML= kiiras;
}
function showResultUpdate(schedule) {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    link("resultpageedit")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
                document.getElementById("resultTable").innerHTML = kiiras;
                sc = schedule;
                loadTeacherselects(0, 0, false);
                replacementdays = collectSCReplacmentDays(sc);
                var options = makeOptionsFromReplacemetnDays(replacementdays);
                document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = options;
                document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = sc.getTartaleknapok();
                searchForCurUnits(sc.getKepzes().getId())
                        .then(data => {
                            objects = makeObjectFromReturnValue(data);
                            options = makeOptionsFromObjects(objects);
                            document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].innerHTML = options;

                        })
                        .catch(error => {
                            ////console.log(error)
                        });

            })
            .catch(error => {
                ////console.log(error)
            });

    //document.getElementById("resultTable").innerHTML= kiiras;
}
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,calculation funtions,,,,,,,,,,,,,,,,,,,,,,,,,,
function  sumHoursCanUse(hourscanuse) {
    var hour = 0;
    for (var i = 0, max = hourscanuse.length; i < max; i++) {
        hour += hourscanuse[i].getOra();
    }
    return hour;
}
function  calcAndSetFoundCurUnitUsedHourAmmountByHourType(actHour, foundCurUnit, hourAmmmountByHoursType) {
    if (actHour.getTipus() == 1) {
        foundCurUnit.setFelhasznalt_elmelet(foundCurUnit.getFelhasznalt_elmelet() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 2) {
        foundCurUnit.setFelhasznalt_gyakorlat(foundCurUnit.getFelhasznalt_gyakorlat() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 3) {
        foundCurUnit.setFelhasznalt_elearn(foundCurUnit.getFelhasznalt_elearn() + hourAmmmountByHoursType);
    }

}
function calcAndSetActModulUsedHourAmmountByHourType(actHour, actModul, hourAmmmountByHoursType) {
    if (actHour.getTipus() == 1 || actHour.getTipus() == 3) {
        actModul.setFelhasznaltElmeletiOraszam(actModul.getFelhasznaltElmeletiOraszam() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 2) {
        actModul.setFelhasznaltGyakorlatiOraszam(actModul.getFelhasznaltGyakorlatiOraszam() + hourAmmmountByHoursType);
    }

}
function calcmodulstarthourAmmmountByHoursType(actModul, actHour) {
    var returnValue = 0;
    if (actHour.getTipus() == 1 || actHour.getTipus() == 3) {
        returnValue = actModul.getFelhasznaltElmeletiOraszam();
    } else if (actHour.getTipus() == 2) {
        returnValue = actModul.getFelhasznaltGyakorlatiOraszam();
    }
    return returnValue;

}
function calchourAmmmountByHoursType(foundCurUnit, actHour, hourAmmount) {
    var returnValue = 0;
    if (actHour.getTipus() == 1) {
        var elmHour = foundCurUnit.getElmeleti_oraszam() - foundCurUnit.getFelhasznalt_elmelet();
        if ((elmHour) <= hourAmmount) {
            returnValue = elmHour;
        } else {
            returnValue = hourAmmount;
        }

    } else if (actHour.getTipus() == 2) {
        var gyakHour = foundCurUnit.getGyakorlati_oraszam() - foundCurUnit.getFelhasznalt_gyakorlat();
        if ((gyakHour) <= hourAmmount) {
            returnValue = gyakHour;
        } else {
            returnValue = hourAmmount;
        }
    } else if (actHour.getTipus() == 3) {
        var elHour = foundCurUnit.getElearn_oraszam() - foundCurUnit.getFelhasznalt_elearn();
        if ((elHour) <= hourAmmount) {
            returnValue = elHour;
        } else {
            returnValue = hourAmmount;
        }
    }
    return returnValue;
}
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,converter functions,,,,,,,,,,,,,,,,,,,,,,,,,,
function tiltottnap(schedule, actdate) {
    for (var i = 0, max = schedule.getKizartnapok(); i < max; i++) {

        if (schedule.getKizartnap(i) == actdate) {
            return true;
        }

    }
    return false;
}
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
    if (exam_hour != -1) {
        modul.addVizsga(new Vizsga_Model(exam_type, exam_hour));
    }
}
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,search functions,,,,,,,,,,,,,,,,,,,,,,,,,,,,
function searchCurUnit(modul, hour) {
    var returnCurUnit = null;
    // //console.log(modul);
    for (var i = 0, max = modul.getTananyagegysegek().length; i < max; i++) {
        var actCurUnit = modul.getTanegyseg(i);
        if (hour.getTipus() == 1) {
            if ((actCurUnit.getElmeleti_oraszam() - actCurUnit.getFelhasznalt_elmelet()) > 0) {
                return actCurUnit;
            }

        } else if (hour.getTipus() == 2) {
            if ((actCurUnit.getGyakorlati_oraszam() - actCurUnit.getFelhasznalt_gyakorlat()) > 0) {
                return actCurUnit;
            }
        } else if (hour.getTipus() == 3) {
            if ((actCurUnit.getElearn_oraszam() - actCurUnit.getFelhasznalt_elearn()) > 0) {
                return actCurUnit;
            }
        }
    }
    return returnCurUnit;
}
function searchExam(modul, hour, hourammount) {
    var returnExam = null;
    for (var i = 0, max = modul.getVizsgak().length; i < max; i++) {
        var actExam = modul.getVizsga(i);
        if (hour.getTipus() == 1) {
            if (modul.getVizsga(i).getTipus() == 1 || modul.getVizsga(i).getTipus() == 2) {
                if (hourammount >= (modul.getVizsga(i).getOraszam() * 1) && !modul.getVizsga(i).getUsed()) {
                    return actExam;
                }
            }
        } else if (hour.getTipus() == 2) {
            if (modul.getVizsga(i).getTipus() == 3) {
                if (hourammount >= (modul.getVizsga(i).getOraszam() * 1) && !modul.getVizsga(i).getUsed()) {
                    return actExam;
                }
            }
        }
    }
    return returnExam;
}
function searchModul(schedule, hourscanuse) {
    var returnArray = new Array();
    for (var i = 0, max = schedule.getKepzes().getModulok().length; i < max; i++) {
        if (canUseModul(schedule.getKepzes().getModul(i), hourscanuse)) {
            returnArray[returnArray.length] = schedule.getKepzes().getModul(i);
        }
    }
    return returnArray;
}
function canUseModul(modul, hourscanuse) {
    for (var i = 0, max = hourscanuse.length; i < max; i++) {
        if (hourscanuse[i].getTipus() == 1 || hourscanuse[i].getTipus() == 3) {
            if ((modul.getElmeleti_oraszam() - modul.getFelhasznaltElmeletiOraszam()) > 0 || haveUnusedExamWithEnoughHour(modul, hourscanuse[i])) {
                return true;
            }

        } else if (hourscanuse[i].getTipus() == 2) {
            if ((modul.getGyakorlati_oraszam() - modul.getFelhasznaltGyakorlatiOraszam()) > 0 || haveUnusedExamWithEnoughHour(modul, hourscanuse[i])) {
                return true;
            }
        }
    }

    return false;
}
function haveUnusedExamWithEnoughHour(modul, day) {
    for (var i = 0, max = modul.getVizsgak().length; i < max; i++) {
        if (day.getTipus() == 1) {
            if (modul.getVizsga(i).getTipus() == 1 || modul.getVizsga(i).getTipus() == 2) {
                if (day.getOra() >= modul.getVizsga(i).getOraszam() && !modul.getVizsga(i).getUsed()) {
                    return true;
                }
            }
        } else if (day.getTipus() == 2) {
            if (modul.getVizsga(i).getTipus() == 3) {
                if (day.getOra() >= modul.getVizsga(i).getOraszam() && !modul.getVizsga(i).getUsed()) {
                    return true;
                }
            }
        }

    }
    return false;
}
function checkEnableHoursAtDate(schedule, dayno) {
    var returnArray = new Array();
    for (var i = 0, max = schedule.getHet(); i < max; i++) {
        if (schedule.getWeekDay(i).getNap() == dayno) {
            returnArray[returnArray.length] = schedule.getWeekDay(i);
        }
    }
    return returnArray;
}
//-------------------------------------------------------------------------------
//----------------------------EDIT, PASS, REPLACEMENTDAYS FUNCTIONS--------------
//-------------------------------------------------------------------------------
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,,edit,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
function collectSCReplacmentDays(sc) {
    var replacmentDays = new Array();
    for (var i = 0; i < sc.getUtemterv().length; i++) {
        if (sc.getUtemtervNap(i).isTartalekNap() && sc.getUtemtervNap(i).getTanegysegVizsgaid() == 0) {
            replacmentDays.push(sc.getUtemtervNap(i));
        }
    }
    return replacmentDays;
}
function deleteEditedSchedule() {
    var slink = 'server.php';
    $.post(slink, {
        muv: "delete_edited_sc",
        param: sc.getId()

    }, function (data, status) {
        //console.log(data);
    });
}
function addReplacementDay() {
    var selected_day = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].value;
    var selected_cur_unit = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].value;
    var remain_replacementdays_ammount = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML;
    var remain_curunit = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML;

    if (selected_cur_unit != -1 && selected_day != -1 && (remain_replacementdays_ammount * 1) > 0) {
        for (var i = 0, max = replacementdays.length; i < max; i++) {

            if (replacementdays[i].getdatum() == selected_day) {
                var curunit = whichcurunit(selected_cur_unit);
                var sum = (objects[curunit]["el"] * 1) + (objects[curunit]["ex"] * 1) + (objects[curunit]["d"] * 1)
                replacementdays[i].setModul(0);
                if ((remain_curunit * 1) > replacementdays[i].getOra()) {
                    replacementdays[i].setOra(replacementdays[i].getOra());
                } else {
                    replacementdays[i].setOra(remain_curunit);
                }
                if (sum == (remain_curunit * 1)) {
                    replacementdays[i].setKezd(0);
                } else {
                    replacementdays[i].setKezd(sum - (remain_curunit * 1));
                }
                //console.log(sum - (remain_curunit * 1));

                objects[curunit]["used"] = (objects[curunit]["used"] * 1) + (replacementdays[i].getOra() * 1);
                calcUseableHour();
                remain_curunit = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML;
                replacementdays[i].setVeg((replacementdays[i].getKezd() * 1) + (replacementdays[i].getOra() * 1));
                replacementdays[i].setTanegyseg(selected_cur_unit);
                insertInTable(replacementdays[i]);
                removeDay(selected_day);
                if ((remain_curunit * 1) < 1) {
                    removeCuruint(selected_cur_unit);
                }
                document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = ((remain_replacementdays_ammount * 1) - 1)
            }
        }
    }
}
function addReplacementDayafterEdit(day) {
    var selected_cur_unit = day[2];
    var curunit = whichcurunit(selected_cur_unit);
    var sum = (objects[curunit]["el"] * 1) + (objects[curunit]["ex"] * 1) + (objects[curunit]["d"] * 1)
    var remain_replacementdays_ammount = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML;


    objects[curunit]["used"] = (objects[curunit]["used"] * 1) + (day[3] * 1);
    var newday = new Utemterv_bejegyzes_Model(0, day[0], solveBooleanFromString(day[1]), day[2], day[3], day[4], solveBooleanFromString(day[5]), day[6], day[7], day[8], day[9]);
    insertInTable(newday);
    var remain_curunit = sum - (objects[curunit]["used"] * 1);
    if ((remain_curunit * 1) < 1) {
        removeCuruint(selected_cur_unit);
    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = ((remain_replacementdays_ammount * 1) - 1)

}
function searchReplacementDayInTable(sdate, sorszama) {
    for (var i = sorszama - 1, max = 0; i > max; i--) {
        var date = document.getElementById("scTable").getElementsByTagName("tr")[i].getElementsByTagName("td")[0].innerHTML;
        if (sdate == date) {
            return i;
        }
    }
}
function insertInTable(utemterv) {
    var sorokszama = document.getElementById("scTable").getElementsByTagName("tr");
    var data = new Array(utemterv.getdatum(), objects[whichcurunit(utemterv.getTanegysegVizsgaid())]["name"], utemterv.getOra(), utemterv.getKezd(), utemterv.getVeg(), solveUtemTerv_ModelTypeForHuman(utemterv.getTipus()), utemterv.getdatum(), utemterv.getTanegysegVizsgaid());
    makeTableForShow(2, data);
    document.getElementById("scTable")
    var tr = document.createElement("tr");
    var td_0 = document.createElement("td");
    var td_0_textnode = document.createTextNode(data[0]);
    td_0.appendChild(td_0_textnode);
    tr.appendChild(td_0);
    var td_1 = document.createElement("td");
    var td_1_textnode = document.createTextNode(data[1]);
    td_1.appendChild(td_1_textnode);
    tr.appendChild(td_1);
    var td_2 = document.createElement("td");
    var td_2_textnode = document.createTextNode("");
    td_2.appendChild(td_2_textnode);
    tr.appendChild(td_2);
    var td_3 = document.createElement("td");
    var td_3_textnode = document.createTextNode(data[2]);
    td_3.appendChild(td_3_textnode);
    tr.appendChild(td_3);
    var td_4 = document.createElement("td");
    var td_4_textnode = document.createTextNode(data[3]);
    td_4.appendChild(td_4_textnode);
    tr.appendChild(td_4);
    var td_5 = document.createElement("td");
    var td_5_textnode = document.createTextNode(data[4]);
    td_5.appendChild(td_5_textnode);
    tr.appendChild(td_5);
    var td_6 = document.createElement("td");
    var td_6_textnode = document.createTextNode(data[5]);
    td_6.appendChild(td_6_textnode);
    tr.appendChild(td_6);
    var td_7 = document.createElement("td");
    var td_7_select = document.createElement("select");
    var td_7_select_option = document.createElement("option");
    td_7_select.setAttribute("onClick", 'loadTeacher(\'' + data[6] + '\',' + data[7] + ',true)');
    td_7_select_option.setAttribute("value", "-1");

    var td_7_select_optiontextnode = document.createTextNode("Kérem válasszon oktatót!");
    td_7_select_option.appendChild(td_7_select_optiontextnode);
    td_7_select.appendChild(td_7_select_option);
    td_7.appendChild(td_7_select);
    tr.appendChild(td_7);
    document.getElementById("scTable").appendChild(tr);

    searchTeacher(utemterv.getTanegysegVizsgaid())
            .then(data => {
                setTimeout(function () {

                    var options = makeOptionsForteacherselect(data);
                    loadOptions(searchReplacementDayInTable(utemterv.getdatum(), sorokszama.length), options);


                }, 300);
            })
            .catch(error => {


            });


}
function removeDay(date) {
    var newselect = "";
    var select = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].getElementsByTagName("option");
    for (var i = 0; i < select.length; i++) {

        if (select[i].value != date) {
            newselect += '<option value="' + select[i].value + '">' + select[i].innerHTML + '</option>';

        }

    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = newselect;

}
function removeCuruint(cur_unit) {
    var newselect = "";
    var select = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].getElementsByTagName("option");
    for (var i = 0; i < select.length; i++) {

        if (select[i].value != cur_unit) {
            newselect += '<option value="' + select[i].value + '">' + select[i].innerHTML + '</option>';

        }

    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].innerHTML = newselect;

}
function backLoadschedule(needName,again) {
    link("course_start")
            .then(data => {
                if(needName){
                document.getElementById("form-row-name").value = sc.getBelsoAzonosito();
                }
                document.getElementById("form-row-start").value = sc.getKezdes();
                document.getElementById("form-row-sign-date").value = sc.getVizsgaJelentkezes();
                document.getElementById("form-row-exam-date").value = sc.getVizsgaKezdes();
                document.getElementById("form-row-help-day").value = sc.getTartaleknapok();

                solveDaysAndWriteBack(sc);
                setTimeout(
                        function () {
                            document.getElementById("form-row-kepzes").value = sc.getKepzes().getId();
                            modulSelectorsMake();
                            setTimeout(
                                    function () {
                                        solveModulsAndOrderBack(sc);
                                        checkEnoughDay();
                                        if(again){
                                            setTimeout(function(){
                                            backLoadschedule(needName,false);
                                        },2000);
                                       }
                                    }
                            , 1000);

                        }
                , 1000);


            })
            .catch(error => {
                ////console.log(error)
            });

}
function backLoadUpdateschedule() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    link("course_start_edit")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
                document.getElementById("form-row-name").value = sc.getBelsoAzonosito();
                document.getElementById("form-row-start").value = sc.getKezdes();
                document.getElementById("form-row-sign-date").value = sc.getVizsgaJelentkezes();
                document.getElementById("form-row-exam-date").value = sc.getVizsgaKezdes();
                document.getElementById("form-row-help-day").value = sc.getTartaleknapok();

                solveDaysAndWriteBack(sc);
                setTimeout(
                        function () {
                            document.getElementById("form-row-kepzes").value = sc.getKepzes().getId();
                            modulSelectorsMake();
                            setTimeout(
                                    function () {
                                        solveModulsAndOrderBack(sc);
                                        checkEnoughDay();
                                    }
                            , 1000);

                        }
                , 1000);


            })
            .catch(error => {
                ////console.log(error)
            });

}
function solveDaysAndWriteBack(sc) {
    for (var i = 0, max = sc.getHet(); i < max; i++) {
        var actWeekday = sc.getWeekDay(i);
        var dayname = "";
        var typename = "";
        switch (actWeekday.getNap()) {
            case 1:
                dayname = "mon";
                break;
            case 2:
                dayname = "tue";
                break;
            case 3:
                dayname = "wed";
                break;
            case 4:
                dayname = "thu";
                break;
            case 5:
                dayname = "fri";
                break;
            case 6:
                dayname = "sat";
                break;
            case 7:
                dayname = "sun";
                break;
        }
        switch (actWeekday.getTipus()) {
            case 1:
                typename = "plan_dec";
                break;
            case 2:
                typename = "plan_exe";
                break;
            case 3:
                typename = "el_dec";
                break;
        }
        document.getElementById(dayname + "_" + typename).value = actWeekday.getOra();
    }
}
function solveModulsAndOrderBack(sc) {
    for (var i = 0, max = sc.getKepzes().getModulok().length; i < max; i++) {
        var actmodul = sc.getKepzes().getModul(i);
        document.getElementById("form-row-modul-" + (i + 1)).value = actmodul.getId();
    }
}
function solveUtemTerv_ModelTypeForHuman(type) {
    var returnValue = '';
    var numbertype = type * 1;
    switch (numbertype) {
        case 1:
            returnValue = "elméleti";
            break;
        case 2:
            returnValue = "gyakorlati";
            break;
        case 3:
            returnValue = "elearn";
            break;
        case 0:
            returnValue = "pótnap";
            break;
        default:

            break;
    }
    return returnValue;
}
function solveUtemTerv_ModelExamTypeForHuman(type) {
    var returnValue = '';
    var numbertype = type * 1;
    switch (numbertype) {
        case 1:
            returnValue = "szóbeli";
            break;
        case 2:
            returnValue = "írásbeli";
            break;
        case 3:
            returnValue = "gyakorlati";
            break;

        default:

            break;
    }
    return returnValue;
}
function loadTeacherselects(start, kulonbseg, load) {
    var modal = document.getElementById("loadModal");
    //console.log(start);
    if (start < sc.getUtemterv().length) {
        var actday = sc.getUtemtervNap(start);
        //console.log(sc.getUtemtervNap(start));
        //console.log(document.getElementById("scTable").getElementsByTagName("tr")[start + 1 - kulonbseg]);

        modal.style.display = "block";

        searchTeacher(actday.getTanegysegVizsgaid())
                .then(data => {
                    setTimeout(function () {
                        if (!actday.isVizsga() && !actday.isTartalekNap()) {

                            var options = makeOptionsForteacherselect(data);
                            loadOptions(start + 1 - kulonbseg, options);


                            loadTeacherselects(start + 1, kulonbseg, load);

                        } else {
                            if (!actday.isTartalekNap()) {
                                loadTeacherselects(start + 1, kulonbseg, load);
                            } else {
                                loadTeacherselects(start + 1, kulonbseg + 1, load);
                            }

                        }
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });


    } else {

        modal.style.display = "none";
        if (load) {
            loadBackSecondHalf();
        }
    }

}
function setTeacherOptionsValue(index, kulonbsegteacher) {
    var modal = document.getElementById("loadModal");

    if (index < sc.getUtemterv().length) {
        var actday = sc.getUtemtervNap(index);
        //console.log(sc.getUtemtervNap(index));
        //console.log(document.getElementById("scTable").getElementsByTagName("tr")[index + 1 - kulonbsegteacher]);

        modal.style.display = "block";


        if (!actday.isVizsga() && !actday.isTartalekNap()) {
            if (actday.getOktato() * 1 > 0) {
                var myTable = document.getElementById("scTable");
                var rows = myTable.getElementsByTagName("tr");
                var select = rows[index + 1 - kulonbsegteacher].getElementsByTagName("td")[7].getElementsByTagName("select")[0];
                select.selectedIndex = searchIndexSelectedOption(actday.getOktato(), select);


            }

            setTeacherOptionsValue(index + 1, kulonbsegteacher);

        } else {
            if (!actday.isTartalekNap()) {
                setTeacherOptionsValue(index + 1, kulonbsegteacher);
            } else {
                setTeacherOptionsValue(index + 1, kulonbsegteacher + 1);
            }

        }


    } else {
        modal.style.display = "none";

    }

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
function loadOptions(rowno, options) {
    var myTable = document.getElementById("scTable");
    var rows = myTable.getElementsByTagName("tr");
    var select = rows[rowno].getElementsByTagName("td")[7].getElementsByTagName("select")[0];
    select.innerHTML = select.innerHTML + options;
}
function loadTeacher(actdate, curUnitId, isReplacement) {
    var kulonbseg = 0;
    for (var i = 0, max = sc.getUtemterv().length; i < max; i++) {
        var actday = sc.getUtemtervNap(i);
        if (actday.isTartalekNap()) {
            kulonbseg++;

        }

        if (actday.getdatum() == actdate && actday.getTanegysegVizsgaid() == curUnitId && !actday.isVizsga()) {
            var oktatoid = 0;
            if (!isReplacement) {
                oktatoid = solveTeacherselectValue(i + 1 - kulonbseg);
            } else {
                oktatoid = solveTeacherselectValueReplacementDay(actdate);
            }
            actday.setOktato(oktatoid);
        }
    }
}
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,,converter,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
function makeOptionsFromObjects(objects) {
    var returnValue = '<option value="-1">Kérem válasszon egy tanegységet!</option>';
    for (var i = 0, max = objects.length; i < max; i++) {

        returnValue += '<option value="' + objects[i]['id'] + '">' + objects[i]['name'] + '</option>'

    }
    return  returnValue;
}
function makeObjectFromReturnValue(data) {
    var spData = data.split("/;/");
    var returnArray = new Array();
    for (var i = 0, max = spData.length; i < max; i++) {
        if (!checkEmptyString(spData[i])) {
            var spDataPiece = spData[i].split(";,;,;");
            var helyiArray = new Array();
            helyiArray["id"] = spDataPiece[0].trim();
            helyiArray["name"] = spDataPiece[1];
            helyiArray["d"] = spDataPiece[2];
            helyiArray["el"] = spDataPiece[3];
            helyiArray["ex"] = spDataPiece[4];
            helyiArray["used"] = 0;
            returnArray[returnArray.length] = helyiArray;
        }
    }
    return returnArray;
}
function makeOptionsFromReplacemetnDays(replacementdays) {
    var returnValue = "";
    if (replacementdays.length > 0) {
        returnValue += '<option value="-1">Kérem válasszon egy dátumot!</option>';

        for (var i = 0, max = replacementdays.length; i < max; i++) {
            returnValue += '<option value="' + replacementdays[i].getdatum() + '">' + replacementdays[i].getdatum() + '</option>';

        }
    } else {
        returnValue += '<option value="-1">Nincs hozzáadható tartaléknap!</option>';
    }
    return returnValue;
}
function makeOptionsForteacherselect(data) {
    var returnValue = "";
    var spData = data.split("/;/");
    for (var i = 0, max = spData.length; i < max; i++) {
        var spActrow = spData[i].split(";,;,;");
        if (!checkEmptyString(spData[i])) {
            returnValue += "<option value=\"" + spActrow[0] + "\">" + spActrow[1] + "</options>";
        }
    }
    return returnValue;
}
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,,search,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
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
                // //console.log(data);
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
                muv: "cur_units_without_this_course"
            },

            success: function (data) {
                //console.log(data);
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
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,,calc,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
function calcReplacementDayHours() {
    var selected = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].value;
    if (selected != -1) {
        for (var i = 0, max = replacementdays.length; i < max; i++) {
            if (replacementdays[i].getdatum() == selected) {
                document.getElementById("replacementDays_datarow").getElementsByTagName("div")[0].innerHTML = replacementdays[i].getOra();
            }
        }
    }

}
function calcUseableHour() {
    var selected = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].value;
    if (selected != -1) {
        var curunit = whichcurunit(selected);
        var sum = (objects[curunit]["el"] * 1) + (objects[curunit]["ex"] * 1) + (objects[curunit]["d"] * 1) - objects[curunit]["used"];
        document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML = sum;

    }

}
function solveTeacherselectValueReplacementDay(actDate) {
    var table = document.getElementById("scTable").getElementsByTagName("tr");
    for (var i = table.length - 1, max = 0; i > max; i--) {
        var date = table[i].getElementsByTagName("td")[0].innerHTML;
        if (date == actDate) {
            return  table[i].getElementsByTagName("td")[7].getElementsByTagName("select")[0].value;
        }
    }
}
function solveTeacherselectValue(rowno) {
    return  document.getElementById("scTable").getElementsByTagName("tr")[rowno].getElementsByTagName("td")[7].getElementsByTagName("select")[0].value;
}
//,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,pass,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,

function passschedule(start) {
    var param = new Array();
    var modal = document.getElementById("loadModal")
    if (start < sc.getUtemterv().length) {
        var localparam = new Array();
        var actday = sc.getUtemtervNap(start);
        localparam[localparam.length] = actday.getdatum();
        localparam[localparam.length] = actday.getTanegysegVizsgaid();
        localparam[localparam.length] = actday.getOra();//hour
        localparam[localparam.length] = actday.getKezd();//start
        localparam[localparam.length] = actday.getVeg(), //end
                localparam[localparam.length] = actday.isVizsga();//vizsga
        localparam[localparam.length] = actday.getTipus();//tipus
        localparam[localparam.length] = actday.getOktato();//oktato
        localparam[localparam.length] = actday.getModul();//modul
        localparam[localparam.length] = actday.isTartalekNap();//tartalek
        localparam[localparam.length] = sc.getId();//sc
        modal.style.display = "block";

        passscheduleAJAXPROMISE(localparam)
                .then(data => {
                    setTimeout(function () {
                        passschedule(start + 1);
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });
    } else {
        modal.style.display = "none";
        sc = null;
        objects = null;
        replacementdays = null;
        clearUsedSelectChooseArrays();
        link("course_start");

    }
}
function passUpdateschedule(start) {
    var param = new Array();
    var modal = document.getElementById("loadModal")
    if (start < sc.getUtemterv().length) {
        var localparam = new Array();
        var actday = sc.getUtemtervNap(start);
        localparam[localparam.length] = actday.getdatum();
        localparam[localparam.length] = actday.getTanegysegVizsgaid();
        localparam[localparam.length] = actday.getOra();//hour
        localparam[localparam.length] = actday.getKezd();//start
        localparam[localparam.length] = actday.getVeg(), //end
                localparam[localparam.length] = actday.isVizsga();//vizsga
        localparam[localparam.length] = actday.getTipus();//tipus
        localparam[localparam.length] = actday.getOktato();//oktato
        localparam[localparam.length] = actday.getModul();//modul
        localparam[localparam.length] = actday.isTartalekNap();//tartalek
        localparam[localparam.length] = sc.getId();//sc
        modal.style.display = "block";

        passscheduleAJAXPROMISE(localparam)
                .then(data => {
                    setTimeout(function () {
                        passschedule(start + 1);
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });
    } else {
        modal.style.display = "none";
        sc = null;
        objects = null;
        replacementdays = null;
        clearUsedSelectChooseArrays();
        backtotheMenu();

    }
}
function passscheduleAJAXPROMISE(param) {

    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: param,
                muv: "pass_schedule"
            },

            success: function (data) {
                //console.log(data);

                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
//-------------------------------------------------------------------------------------
//--------------------------------- AFTER EDIT! ---------------------------------------
//-------------------------------------------------------------------------------------
//_____________________________________________________________________________________

function loadAnActiveSchedule() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    kiiras = "";
    link("utemterv_in_form")
            .then(data => {
                $.ajax({
                    url: "server.php",
                    type: 'POST',
                    data: {
                        param: id,
                        muv: "load_an_active_schedule"
                    },

                    success: function (data) {
                        //console.log(data);
                        loadActiveScheduleFrom(data, id);

                    },
                    error: function (err) {

                    }
                });

            })
            .catch(error => {
                ////console.log(error)
            });


}

function loadActiveScheduleFrom(data, id) {
    SPSCHEDULEDATA = null;
    document.getElementsByTagName("id")[0].innerHTML = id;
    var spNameAndDates = data.split("/;/")[0];
    var spModulNames = data.split("/;/")[1];
    var spSchedule = data.split("/;/")[2];
    loadNameAndDatesInputs(spNameAndDates, id);
    loadModulNames(spModulNames);
    var modulsArray = makeCorrectModulStringInArray(spModulNames);
    makeModul_ModelsfromData(modulsArray, sc);
    SPSCHEDULEDATA = spSchedule;




}

function startLoadSchedulePlan() {
    if (!VOLT) {
        VOLT = true;
        USEDREPLACEMENTDAYS = loadSchedule(SPSCHEDULEDATA);
        makeTableForShow(4, null);
        //console.log(sc);
        ////console.log(kiiras);
        if (!hiba) {
            document.getElementById("resultTable").innerHTML = kiiras;
            loadTeacherselects(0, 0, true);
        } else {
            hiba = false;
            writeErrorMessageAndTowardToGenerate();
        }
    }
}
function loadBackSecondHalf() {
    setTeacherOptionsValue(0, 0);
    replacementdays = collectSCReplacmentDays(sc);
    var options = makeOptionsFromReplacemetnDays(replacementdays);
    document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = options;
    document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = sc.getTartaleknapok();
    searchForCurUnits(sc.getKepzes().getId())
            .then(data => {
                objects = makeObjectFromReturnValue(data);
                options = makeOptionsFromObjects(objects);
                document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].innerHTML = options;
                loadUsedReplacementDays(USEDREPLACEMENTDAYS);
                setTimeout(function () {
                    setBackSelectedTeachersAtReplacementDay(USEDREPLACEMENTDAYS);
                }, 3000);

            })
            .catch(error => {
                ////console.log(error)
            });

}
function loadSchedule(spSchedule) {
    var lastDays = new Array();
    if (spSchedule != "none//") {
        var scRows = spSchedule.split("//");

        for (var i = 0, max = scRows.length; i < max; i++) {
            var actrow = scRows[i].split(";,;");
            if (!checkEmptyString(scRows[i])) {
                var day = new Utemterv_bejegyzes_Model(0, actrow[0], solveBooleanFromString(actrow[1]), actrow[2], actrow[3], actrow[4], solveBooleanFromString(actrow[5]), actrow[6], actrow[7], actrow[8], actrow[9]);
                day.setOktato(actrow[11] * 1);
                sc.addUtemtervhez(day);
                if (actrow[1] == "true" && actrow[2] != 0) {
                    lastDays[lastDays.length] = actrow;
                }
                if (actrow[5] == "true") {
                    var data = new Array(actrow[0], solveUtemTerv_ModelExamTypeForHuman(actrow[2]), actrow[9], actrow[3], actrow[6], actrow[7], solveUtemTerv_ModelTypeForHuman(actrow[4]));
                    makeTableForShow(3, data);
                }
                if (actrow[5] == "false" && actrow[1] == "false") {
                    var data = new Array(actrow[0], actrow[10], actrow[9], actrow[3], actrow[6], actrow[7], solveUtemTerv_ModelTypeForHuman(actrow[4]), actrow[0], actrow[2]);
                    makeTableForShow(2, data);
                }
            }
        }


    } else {
        hiba = true;

    }
    return lastDays;
}
function solveBooleanFromString(string) {
    var returnValue = false;
    if (string == "true") {
        returnValue = true;
    }
    return  returnValue;
}
function loadNameAndDatesInputs(spNameAndDates, id) {

    var NameAndDates = spNameAndDates.split("//")[0].split(";,;");
    var kepzes = new Kepzes_Model(NameAndDates[9], NameAndDates[1], NameAndDates[2]);

    sc = new Aktiv_Kepzes_Model(id, NameAndDates[0], kepzes, NameAndDates[3], NameAndDates[8], NameAndDates[4], NameAndDates[7]);
    var doctrina_days = makeArrayFomString(NameAndDates[10]);
    var elearn_days = makeArrayFomString(NameAndDates[11]);
    var exercise_days = makeArrayFomString(NameAndDates[12]);
    //console.log(doctrina_days);
    //console.log(elearn_days);
    //console.log(exercise_days);
    makeWeekUtemterv_bejegyzes_ModelfromArray(doctrina_days, sc, 1);
    makeWeekUtemterv_bejegyzes_ModelfromArray(exercise_days, sc, 2);
    makeWeekUtemterv_bejegyzes_ModelfromArray(elearn_days, sc, 3);

    //console.log(spNameAndDates);
    makeTableForShow(1, null);
    document.getElementById("form-row-name").value = NameAndDates[0];
    document.getElementById("form-row-help-day").value = NameAndDates[7];

    document.getElementById("form-row-start").value = NameAndDates[3];
    document.getElementById("form-row-sign-date").value = NameAndDates[4];
    document.getElementById("form-row-kepzes").value = NameAndDates[1] + "-" + NameAndDates[2];
    if (NameAndDates[8] != "0000-00-00") {
        document.getElementById("form-row-exam-date").value = NameAndDates[8];
    }
}

function loadModulNames(spModulNames) {
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
    document.getElementById("modul-order-place").innerHTML = inputs;
}
function editActiveEducation() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    var data = new Array(id);
    data[data.length] = document.getElementById("form-row-name").value;
    data[data.length] = document.getElementById("form-row-help-day").value;
    data[data.length] = document.getElementById("form-row-exam-date").value;
    $.ajax({
        url: "server.php",
        type: 'POST',
        data: {
            param: data,
            muv: "edit_an_active_schedule_data"
        },

        success: function (data) {
            //console.log(data);
            loadAnActiveSchedule();
        },
        error: function (err) {

        }
    });
}
function loadUsedReplacementDays(usedReplacementDays) {
    for (var i = 0, max = usedReplacementDays.length; i < max; i++) {
        addReplacementDayafterEdit(usedReplacementDays[i]);
    }
}
function setBackSelectedTeachersAtReplacementDay(usedReplacementDays) {
    for (var i = 0, max = usedReplacementDays.length; i < max; i++) {

        var myTable = document.getElementById("scTable");
        var rows = myTable.getElementsByTagName("tr");

        var select = rows[searchReplacementDayInTable(usedReplacementDays[i][0], rows.length)].getElementsByTagName("td")[7].getElementsByTagName("select")[0];
        select.selectedIndex = searchIndexSelectedOption(usedReplacementDays[i][11].trim(), select);

    }
}
function editschedule(start) {
    var modal = document.getElementById("loadModal")
    if (start < sc.getUtemterv().length) {
        var localparam = new Array();
        var actday = sc.getUtemtervNap(start);
        localparam[localparam.length] = actday.getdatum();              //0
        localparam[localparam.length] = actday.getTanegysegVizsgaid();  //1
        localparam[localparam.length] = actday.getOra();//hour          //2
        localparam[localparam.length] = actday.getKezd();//start        //3
        localparam[localparam.length] = actday.getVeg(), //end          //4
                localparam[localparam.length] = actday.isVizsga();//vizsga//5
        localparam[localparam.length] = actday.getTipus();//tipus           //6
        localparam[localparam.length] = actday.getOktato();//oktato         //7
        localparam[localparam.length] = actday.getModul();//modul           //8
        localparam[localparam.length] = actday.isTartalekNap();//tartalek   //9
        localparam[localparam.length] = sc.getId();//sc                     //10
        modal.style.display = "block";

        editscheduleAJAXPROMISE(localparam)
                .then(data => {
                    setTimeout(function () {
                        editschedule(start + 1);
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });
    } else {
        modal.style.display = "none";
        //sc = null;
        //objects = null;
        //replacementdays = null;
        //clearUsedSelectChooseArrays();
        backtotheMenu();

    }
}
function editscheduleAJAXPROMISE(param) {

    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: param,
                muv: "edit_schedule"
            },

            success: function (data) {
                //console.log(data);

                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
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
    document.getElementById("replacementDays").style.display = "none";
}
function backLoadeditschedule() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    link("course_start_edit")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
                document.getElementById("form-row-name").value = sc.getBelsoAzonosito();
                document.getElementById("form-row-start").value = sc.getKezdes();
                document.getElementById("form-row-sign-date").value = sc.getVizsgaJelentkezes();
                document.getElementById("form-row-exam-date").value = sc.getVizsgaKezdes();
                document.getElementById("form-row-help-day").value = sc.getTartaleknapok();

                solveDaysAndWriteBack(sc);
                setTimeout(
                        function () {
                            document.getElementById("form-row-kepzes").value = sc.getKepzes().getId();
                            modulSelectorsMake();
                            setTimeout(
                                    function () {
                                        solveModulsAndOrderBack(sc);
                                        checkEnoughDay();
                                    }
                            , 1000);

                        }
                , 1000);


            })
            .catch(error => {
                ////console.log(error)
            });

}
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
function openDefultTab() {
    document.getElementById("defaultOpen").click();


}
//
function makeScFromSchema() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
     $.ajax({
                    url: "server.php",
                    type: 'POST',
                    data: {
                        param: id,
                        muv: "load_an_active_schedule"
                    },

                    success: function (data) {
                        //console.log(data);
                        makeScFormDataAdapter(data, id);

                    },
                    error: function (err) {

                    }
                });

    

}
function makeScFormDataAdapter(data, id) {
    document.getElementsByTagName("id")[0].innerHTML = id;
    var spNameAndDates = data.split("/;/")[0];
    var spModulNames = data.split("/;/")[1];
    makeScFromDataNAMES(spNameAndDates, id);
    var modulsArray = makeCorrectModulStringInArray(spModulNames);
    makeModul_ModelsfromData(modulsArray, sc);





}
function makeScFromDataNAMES(spNameAndDates, id) {

    var NameAndDates = spNameAndDates.split("//")[0].split(";,;");
    var kepzes = new Kepzes_Model(NameAndDates[9], NameAndDates[1], NameAndDates[2]);

    sc = new Aktiv_Kepzes_Model(id, NameAndDates[0], kepzes, NameAndDates[3], NameAndDates[8], NameAndDates[4], NameAndDates[7]);
    var doctrina_days = makeArrayFomString(NameAndDates[10]);
    var elearn_days = makeArrayFomString(NameAndDates[11]);
    var exercise_days = makeArrayFomString(NameAndDates[12]);
    //console.log(doctrina_days);
    //console.log(elearn_days);
    //console.log(exercise_days);
    makeWeekUtemterv_bejegyzes_ModelfromArray(doctrina_days, sc, 1);
    makeWeekUtemterv_bejegyzes_ModelfromArray(exercise_days, sc, 2);
    makeWeekUtemterv_bejegyzes_ModelfromArray(elearn_days, sc, 3);

    //console.log(spNameAndDates);
    
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var kiiras = "";
var sc = null;
var objects = null;
var replacementdays = null;
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
function gettingStart() {
    var formDataArray = new Array();
    //lockAllFieldsCourseStartForm(true);
    //lockAllModulSelector(true);
    collectDatainArray(formDataArray);

    // console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "course_start",
        param: formDataArray

    }, function (data, status) {
        // console.log(data);
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
        //console.log(schedule);
        var schedule = makeSchedule(formDataArray, spReplyData, course);
        makeTanegyseg_ModelFromData(spCurUnits, cur_unitArray);
        makeModul_ModelsfromData(spModuls, schedule);
        makeUnusableUtemterv_bejegyzes_ModelfromData(spDateInfos, schedule);
        connectCurUnitsForModuls(schedule, cur_unitArray);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[5], schedule, 1);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[6], schedule, 2);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[10], schedule, 3);
        
        makeDayUtemterv_bejegyzes_ModelfromData(spCaleInfos, schedule);
        //console.log(schedule);
        kiiras += '<table id="scTable" onload="loadTeacherselects(0)"><tr>' +
                '<th>dátum</th><th>Tanegység neve</th><th>Modul neve</th><th>Óraszám</th><th>Kezdő</th><th>Vég</th><th>Oktató</th></tr>';
        scanDates(schedule);
        console.log(schedule);
        kiiras += "</table>";
        showResult(schedule);
    });
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
                    //console.log(actdate);
                    //console.log(moduls);
                    //console.log(hourscanuse);

                    useFoundModulsAndHours(moduls, schedule, hourscanuse, actdate, dayno);
                }else{
                    schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno,actdate, true, 0, sumHoursCanUse(hourscanuse), 0, false, 0, 0, 0));
            
                }
            }
        }
        //console.log("_____nextday___");
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
        // console.log(foundCurUnit);
        //var helyiarray = new Array();
        var foundExam = null;
        if (foundCurUnit != null) {
            //console.log(actHour.getOra()-usedHoursAmmount);
            var hourAmmmountByHoursType = calchourAmmmountByHoursType(foundCurUnit, actHour, (actHour.getOra() - usedHoursAmmount));
            var modulstarthourAmmmountByHoursType = calcmodulstarthourAmmmountByHoursType(actModul, actHour);
            //  console.log(hourAmmmountByHoursType);
            // console.log(modulstarthourAmmmountByHoursType);
            kiiras += "<tr><td>" + actdate + "</td><td>" + foundCurUnit.getTanegyseg_neve() + "</td><td>" + actModul.getModul_neve() + " " + actModul.getModul_azon() + "</td><td>" + hourAmmmountByHoursType + "</td><td>" + modulstarthourAmmmountByHoursType + "</td><td>" + (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType) + '</td><td><select onchange="loadTeacher(\'' + actdate + '\',' + foundCurUnit.getId() + ',false)" ><option value="-1">Kérem válasszon oktatót!</option></select></td></tr>';
            schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno, actdate, false, foundCurUnit.getId(), hourAmmmountByHoursType, actHour.getTipus(), false, (modulstarthourAmmmountByHoursType), (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType), actModul.getId()))
            usedHoursAmmount += hourAmmmountByHoursType;
            calcAndSetFoundCurUnitUsedHourAmmountByHourType(actHour, foundCurUnit, hourAmmmountByHoursType);
            calcAndSetActModulUsedHourAmmountByHourType(actHour, actModul, hourAmmmountByHoursType);

        } else {
            foundExam = searchExam(actModul, actHour, (actHour.getOra() - usedHoursAmmount));
            if (foundExam != null) {
                var hourAmmmountByHoursType = (foundExam.getOraszam() * 1);
                var modulstarthourAmmmountByHoursType = calcmodulstarthourAmmmountByHoursType(actModul, actHour);
                kiiras += "<tr><td>" + actdate + "</td><td>" + foundExam.getTipus() + "</td><td>" + actModul.getModul_neve() + " " + actModul.getModul_azon() + "</td><td>" + hourAmmmountByHoursType + "</td><td>" + modulstarthourAmmmountByHoursType + "</td><td>" + (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType) + '</td><td>Vizsgához nem lehet oktatót választani!</td></tr></tr>';
                schedule.addUtemtervhez(new Utemterv_bejegyzes_Model(dayno, actdate, false, actModul.getId(), hourAmmmountByHoursType, foundExam.getTipus(), true, (modulstarthourAmmmountByHoursType), (modulstarthourAmmmountByHoursType + hourAmmmountByHoursType), actModul.getId()))
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
                loadTeacherselects(0, 0);
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
                            //console.log(error)
                        });

            })
            .catch(error => {
                //console.log(error)
            });

    //document.getElementById("resultTable").innerHTML= kiiras;
}


//,,,,,,,,,,,,,,,,,,,,,,,,,,,,calculation funtions,,,,,,,,,,,,,,,,,,,,,,,,,,
function  sumHoursCanUse(hourscanuse){
    var hour = 0;
    for (var i = 0, max = hourscanuse.length; i < max; i++) {
        hour+=hourscanuse[i].getOra();
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
    if (actHour.getTipus() == 1||actHour.getTipus() == 3) {
        actModul.setFelhasznaltElmeletiOraszam(actModul.getFelhasznaltElmeletiOraszam() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 2) {
        actModul.setFelhasznaltGyakorlatiOraszam(actModul.getFelhasznaltGyakorlatiOraszam() + hourAmmmountByHoursType);
    }

}
function calcmodulstarthourAmmmountByHoursType(actModul, actHour) {
    var returnValue = 0;
    if (actHour.getTipus() == 1||actHour.getTipus() == 3) {
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
        if (dataArray[i] != "") {
            var spCurUnitData = dataArray[i].split(";");
            var curUnit = new Tananyagegyseg_Model(spCurUnitData[1], spCurUnitData[0], spCurUnitData[2], spCurUnitData[3], spCurUnitData[4], spCurUnitData[5]);
            targetArray[targetArray.length] = curUnit;
        }
    }
}
function makeModul_ModelsfromData(dataArray, schedule) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (dataArray[i] != "" && dataArray[i] != " ") {
            var spModulData = dataArray[i].split(";");
            let modul = new Modul_Model(spModulData[1], spModulData[0], spModulData[2], spModulData[3], spModulData[4]);
            makeExamForModul_Models(modul, "verbal", spModulData[5]);
            makeExamForModul_Models(modul, "writting", spModulData[6]);
            makeExamForModul_Models(modul, "practice", spModulData[7]);

            schedule.getKepzes().addModul(modul);
        }
    }
}
function makeUnusableUtemterv_bejegyzes_ModelfromData(dataArray, schedule) {
    for (var i = 0, max = dataArray.length; i < max; i++) {
        if (dataArray[i] != "" && dataArray[i] != " ") {
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
        if (dataArray[i] != "" && dataArray[i] != " ") {
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
    // console.log(modul);
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
            if (modul.getVizsga(i).getTipus() == "verbal" || modul.getVizsga(i).getTipus() == "writting") {
                if (hourammount >= (modul.getVizsga(i).getOraszam() * 1) && !modul.getVizsga(i).getUsed()) {
                    return actExam;
                }
            }
        } else if (hour.getTipus() == 2) {
            if (modul.getVizsga(i).getTipus() == "practice") {
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
        if (hourscanuse[i].getTipus() == 1||hourscanuse[i].getTipus() == 3) {
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
            if (modul.getVizsga(i).getTipus() == "verbal" || modul.getVizsga(i).getTipus() == "writting") {
                if (day.getOra() >= modul.getVizsga(i).getOraszam() && !modul.getVizsga(i).getUsed()) {
                    return true;
                }
            }
        } else if (day.getTipus() == 2) {
            if (modul.getVizsga(i).getTipus() == "practice") {
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
        if (sc.getUtemtervNap(i).isTartalekNap()) {
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
        console.log(data);
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
                if(sum==(remain_curunit*1)){
                replacementdays[i].setKezd(0);
                }else{
                replacementdays[i].setKezd(sum-(remain_curunit*1));
                }
                console.log(sum-(remain_curunit*1));
                
                objects[curunit]["used"]=objects[curunit]["used"]+replacementdays[i].getOra();
                calcUseableHour();
                remain_curunit = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML;
                replacementdays[i].setVeg(replacementdays[i].getKezd()+replacementdays[i].getOra());
                replacementdays[i].setTanegyseg(selected_cur_unit);
                insertInTable(replacementdays[i]);
                removeDay(selected_day);
                if((remain_curunit*1)<1){
                  removeCuruint(selected_cur_unit);  
                }
                document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = ((remain_replacementdays_ammount * 1) - 1)
            }
        }
    }
}
function insertInTable(utemterv) {
    var tartalom = document.getElementById("scTable").innerHTML;
    var sorokszama= document.getElementById("scTable").getElementsByTagName("tr");
    document.getElementById("scTable").innerHTML = tartalom + '<tr><td>' + utemterv.getdatum() + '</td><td>' + objects[whichcurunit(utemterv.getTanegysegVizsgaid())]["name"] + '</td><td>Pótnap</td><td>' + utemterv.getOra() + '</td><td>' + utemterv.getKezd() + '</td><td>' + utemterv.getVeg() + '</td><td><select onchange="loadTeacher(\'' + utemterv.getdatum() + '\',' + utemterv.getTanegysegVizsgaid() + ',true)" ><option value="-1">Kérem válasszon oktatót!</option></select></td></td></tr>'
    searchTeacher(utemterv.getTanegysegVizsgaid())
                .then(data => {
                    setTimeout(function () {
                        
                            var options = makeOptionsForteacherselect(data);
                            loadOptions(sorokszama.length-1, options);

                          
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
function editschedule() {
    link("course_start")
            .then(data => {
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
                //console.log(error)
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
function loadTeacherselects(start, kulonbseg) {
    var modal = document.getElementById("loadModal");
    console.log(start);
    if (start < sc.getUtemterv().length) {
        var actday = sc.getUtemtervNap(start);
        console.log(sc.getUtemtervNap(start));
        console.log(document.getElementById("scTable").getElementsByTagName("tr")[start + 1 - kulonbseg]);

        modal.style.display = "block";

        searchTeacher(actday.getTanegysegVizsgaid())
                .then(data => {
                    setTimeout(function () {
                        if (!actday.isVizsga() && !actday.isTartalekNap()) {

                            var options = makeOptionsForteacherselect(data);
                            loadOptions(start + 1 - kulonbseg, options);

                            loadTeacherselects(start + 1, kulonbseg);
                        } else {
                            if (!actday.isTartalekNap()) {
                                loadTeacherselects(start + 1, kulonbseg);
                            } else {
                                loadTeacherselects(start + 1, kulonbseg + 1);
                            }

                        }
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });


    } else {
        modal.style.display = "none";

    }

}
function loadOptions(rowno, options) {
    var myTable = document.getElementById("scTable");
    var rows = myTable.getElementsByTagName("tr");
    var select = rows[rowno].getElementsByTagName("td")[6].getElementsByTagName("select")[0];
    select.innerHTML = select.innerHTML + options;
}
function loadTeacher(actdate, curUnitId,isReplacement) {
    var kulonbseg =0;
    for (var i = 0, max = sc.getUtemterv().length; i < max; i++) {
        var actday = sc.getUtemtervNap(i);
        if(actday.isTartalekNap()){
            kulonbseg++;
        
        }
        
        if (actday.getdatum() == actdate && actday.getTanegysegVizsgaid() == curUnitId && !actday.isVizsga()) {
            var oktatoid =0;
            if(!isReplacement){
             oktatoid = solveTeacherselectValue(i + 1-kulonbseg);
            }else{
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
        if (spData[i] != "") {
            var spDataPiece = spData[i].split(";,;,;");
            var helyiArray = new Array();
            helyiArray["id"] = spDataPiece[0];
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
        if (spData[i] != "" && spData[i] != " ") {
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
                // console.log(data);
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
                console.log(data);
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
    var table =document.getElementById("scTable").getElementsByTagName("tr");
    for (var i = table.length-1, max = 0; i > max; i--) {
        var date= table[i].getElementsByTagName("td")[0].innerHTML;
        if(date==actDate){
           return  table[i].getElementsByTagName("td")[6].getElementsByTagName("select")[0].value;
        }
    }
 }
function solveTeacherselectValue(rowno) {
    return  document.getElementById("scTable").getElementsByTagName("tr")[rowno].getElementsByTagName("td")[6].getElementsByTagName("select")[0].value;
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
        sc= null;
        objects=null;
        replacementdays=null;
        clearUsedSelectChooseArrays();
        link("course_start");

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
                console.log(data);

                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}

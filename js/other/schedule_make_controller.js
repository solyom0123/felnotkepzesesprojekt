/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function gettingStart() {
    var formDataArray = new Array();
    lockAllFieldsCourseStartForm(true);
    lockAllModulSelector(true);
    checkEnoughDay();
    if (hiba == false) {
        collectDatainArray(formDataArray);

        // //console.log(formDataArray);
        var slink = 'server.php';
        $.post(slink, {
            muv: "course_start",
            param: formDataArray

        }, function (data, status) {
            //console.log(data);
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
    } else {
        lockAllFieldsCourseStartForm(false);
        lockAllModulSelector(false);
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
        }  else {
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

                searchForCurUnits(sc.getKepzes().getId())
                        .then(data => {
                            replacementdays = collectSCReplacmentDays(sc);
                            var options = makeOptionsFromReplacemetnDays(replacementdays);
                            document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = options;
                            document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = sc.getTartaleknapok();
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
function backLoadschedule(needName, again) {
    link("course_start")
            .then(data => {
                if (needName) {
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
                                        if (again) {
                                            setTimeout(function () {
                                                backLoadschedule(needName, false);
                                            }, 2000);
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
function saveSchedule() {
    var formDataArray = new Array();
    lockAllFieldsCourseStartForm(true);
    lockAllModulSelector(true);
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
                      if(document.getElementById("scTable").getElementsByTagName("tr").length>start+1){
                         document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.backgroundColor = "green";
                         document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.color = "white";
                     }else{
                        document.getElementById("bonustable").getElementsByTagName("tr")[start+1-(document.getElementById("scTable").getElementsByTagName("tr").length)].style.backgroundColor = "green";
                         document.getElementById("bonustable").getElementsByTagName("tr")[start+1-(document.getElementById("scTable").getElementsByTagName("tr").length)].style.color = "white";
                     
                     }
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

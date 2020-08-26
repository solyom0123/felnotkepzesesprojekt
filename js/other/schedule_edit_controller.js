/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function setTeacherOptionsValue(index, kulonbsegteacher) {
    var modal = document.getElementById("loadModal");

    if (index < sc.getUtemterv().length) {
        var actday = sc.getUtemtervNap(index);
        ////console.log(sc.getUtemtervNap(index));
        ////console.log(document.getElementById("scTable").getElementsByTagName("tr")[index + 1 - kulonbsegteacher]);

        modal.style.display = "block";


        if (!actday.isTartalekNap()) {
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
        //openDefultTab();
       
        modal.style.display = "none";

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
                          if(document.getElementById("scTable").getElementsByTagName("tr").length>start+1){
                         document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.backgroundColor = "green";
                         document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.color = "white";
                     }else{
                        document.getElementById("bonustable").getElementsByTagName("tr")[start+1-(document.getElementById("scTable").getElementsByTagName("tr").length)].style.backgroundColor = "green";
                         document.getElementById("bonustable").getElementsByTagName("tr")[start+1-(document.getElementById("scTable").getElementsByTagName("tr").length)].style.color = "white";
                     
                     }
                        passUpdateschedule(start + 1);
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
                document.getElementById("form-row-pract-ban-start-date").value = sc.getBanStart();
                document.getElementById("form-row-pract-ban-end-date").value = sc.getBanEnd();

                solveDaysAndWriteBack(sc);
                setTimeout(
                        function () {
                            document.getElementById("form-row-kepzes").value = sc.getKepzes().getId();
                            modulSelectorsMake();
                            setTimeout(
                                    function () {
                                        solveModulsAndOrderBack(sc);
                                        solveFinishedModulsAndOrderBack(sc);
                                        checkEnoughDay();
                                    }
                            , 1000);

                        }
                , 1000);


            })
            .catch(error => {
                //////console.log(error)
            });

}

function deleteEditedSchedule() {
    var slink = 'server.php';
    $.post(slink, {
        muv: "delete_edited_sc",
        param: sc.getId()

    }, function (data, status) {
        ////console.log(data);
    });
}
function updateSchedule() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    var formDataArray = new Array();
    lockAllFieldsCourseStartForm(true);
    lockAllModulSelector(true);
    collectDatainArray(formDataArray);
    formDataArray[formDataArray.length] = id;
    ////console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "update_schedule",
        param: formDataArray

    }, function (data, status) {
      //  console.log(data);
        backtotheMenu();
    });
}
function gettingupdateStart() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    var formDataArray = new Array();
    lockAllFieldsCourseStartForm(true);
    lockAllModulSelector(true);
    collectDatainArray(formDataArray);
    formDataArray[formDataArray.length] = id;

    // ////console.log(formDataArray);
    var slink = 'server.php';
    $.post(slink, {
        muv: "course_start_update",
        param: formDataArray

    }, function (data, status) {
        // ////console.log(data);
        kiiras = "";
        sc = null;
        objects = null;
        var spReplyData = data.split("//");
        var spModuls = spReplyData[2].split("/;/");
        var spCurUnits = spReplyData[3].split("/;/");
        var spDateInfos = spReplyData[4].split("/;/");
        var spCaleInfos = spReplyData[5].split("/;/");
        var spFinisHedModuls = spReplyData[6].split("/;/");
        var spCourse = spReplyData[1].split(";");
        var course = new Kepzes_Model(spCourse[1], spCourse[0], spCourse[2]);
        var cur_unitArray = new Array();
        //////console.log(schedule);
        var schedule = makeSchedule(formDataArray, spReplyData, course,formDataArray[13],formDataArray[14]);
        makeTanegyseg_ModelFromData(spCurUnits, cur_unitArray);
        makeFinishedModul_ModelsfromData(spFinisHedModuls, schedule);
           
        makeModul_ModelsfromData(spModuls, schedule);
        makeUnusableUtemterv_bejegyzes_ModelfromData(spDateInfos, schedule);
        connectCurUnitsForModuls(schedule, cur_unitArray);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[5], schedule, 1);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[6], schedule, 2);
        makeWeekUtemterv_bejegyzes_ModelfromArray(formDataArray[10], schedule, 3);
        makeTableForShow(1, null);
        makeDayUtemterv_bejegyzes_ModelfromData(spCaleInfos, schedule);
        //////console.log(schedule);
        scanDates(schedule);
        makeTableForShow(4, null);
        ////console.log(schedule);
        showResultUpdate(schedule);
    });
}
function showResultUpdate(schedule) {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    link("resultpageedit")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
                document.getElementById("resultTable").innerHTML = kiiras;
                sc = schedule;
                var notwork =checkSc(sc);
                if(notwork.length>0){
                    document.getElementById("pass-btn").style.display="none";
                    document.getElementById("pass-btn-b").style.display="none";
                    document.getElementById("alert").innerHTML = alertMessageMake(notwork);
                }else {
                    loadTeacherselects(0, 0, false);

                    searchForCurUnits(sc.getKepzes().getId())
                        .then(data => {
                            objects = makeObjectFromReturnValue(data);
                            options = makeOptionsFromObjects(objects);
                            document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].innerHTML = options;
                            replacementdays = collectSCReplacmentDays(sc);
                            var options = makeOptionsFromReplacemetnDays(replacementdays);
                            document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = options;
                            document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = sc.getTartaleknapok();

                        })
                        .catch(error => {
                            //////console.log(error)
                        });
                }
            })
            .catch(error => {
                //////console.log(error)
            });

    //document.getElementById("resultTable").innerHTML= kiiras;
}
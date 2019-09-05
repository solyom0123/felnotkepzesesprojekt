/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
                          if(document.getElementById("scTable").getElementsByTagName("tr").length>start+1){
                         document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.backgroundColor = "green";
                         document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.color = "white";
                     }else{
                        document.getElementById("bonustable").getElementsByTagName("tr")[start+1-(document.getElementById("scTable").getElementsByTagName("tr").length)].style.backgroundColor = "green";
                         document.getElementById("bonustable").getElementsByTagName("tr")[start+1-(document.getElementById("scTable").getElementsByTagName("tr").length)].style.color = "white";
                     
                     }
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
                                        solveFinishedModulsAndOrderBack(sc);
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
    var spfModulNames = data.split("/;/")[5];
    makeScFromDataNAMES(spNameAndDates, id);
    var modulsArray = makeCorrectModulStringInArray(spModulNames);
    makeModul_ModelsfromData(modulsArray, sc);
    var fmodulsArray = makeCorrectModulStringInArray(spfModulNames);
    makeFinishedModul_ModelsfromData(fmodulsArray, sc);
  }
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
                        console.log(data);
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
    var spUnusable = data.split("/;/")[3].split("//");
    var spDates = data.split("/;/")[4].split("//");
    var spfmodul = data.split("/;/")[5];
    loadNameAndDatesInputs(spNameAndDates, id);
    loadModulNames(spModulNames,"modul-order-place");
    loadModulNames(spfmodul,"finished-modul-order-place");
    var modulsArray = makeCorrectModulStringInArray(spModulNames);
    makeModul_ModelsfromData(modulsArray, sc);
    var fmodulsArray = makeCorrectModulStringInArray(spfmodul);
    makeFinishedModul_ModelsfromData(fmodulsArray, sc);
    makeUnusableUtemterv_bejegyzes_ModelfromData(spUnusable, sc);
    makeDayUtemterv_bejegyzes_ModelfromData(spDates, sc);
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
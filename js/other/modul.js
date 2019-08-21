

function modulSend() {
    var name = document.getElementById("form-row-name").value;
    var azon = document.getElementById("form-row-number").value;
    var kepzes = document.getElementById("form-row-kepzes").value;
    var elm = document.getElementById("form-row-elm").value;
    var gyak = document.getElementById("form-row-gyak").value;
    var irasbeli_ora = document.getElementById("form-row-irasbeli-ora").value;
    var szobeli_ora = document.getElementById("form-row-szobeli-ora").value;
    var gyakorlati_ora = document.getElementById("form-row-gyak-ora").value;


    var value = new Array(name, azon, kepzes, elm, gyak, irasbeli_ora, szobeli_ora, gyakorlati_ora);
    var slink = 'server.php';
    $.post(slink, {
        muv: "modulSend",
        param: value

    }, function (data, status) {
        //////console.log(data);
        var value;
        if (data != "error") {

            value = '<div class="alert alert-success">Sikeres felvitel!</div>';


        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

        }
        linkWithData("modul_in_form", value, "load", 'tartalom-wrapper');


    });
}
function modulGet() {
    var value = $("#modul-list").val();

    if (value != "undefined") {
        setElozo('modul_r_list');

        var slink = 'server.php';
        linkWithData("modul_in_form", value, "edit", 'tartalom-wrapper');

        $.post(slink, {
            muv: "modulget",
            param: value

        }, function (data, status) {
            //  //////console.log(data);
            if (data != "none/;/") {
                var spData = data.split("/;/");
                document.getElementById("form-row-name").value = spData[0];
                ;
                document.getElementById("form-row-number").value = spData[1];
                ;
                document.getElementById("form-row-elm").value = spData[3];
                ;
                document.getElementById("form-row-gyak").value = spData[4];
                document.getElementById("form-row-irasbeli-ora").value = spData[5];
                document.getElementById("form-row-szobeli-ora").value = spData[6];
                document.getElementById("form-row-gyak-ora").value = spData[7];
                setTimeout(function () {
                    document.getElementById("form-row-kepzes").value = spData[2];
                    ;
                }, 1000);


            } else {
                link("modul_in_form");
            }


        });
    }
}
function modulGetWithParam(returnErrorInfoDataArray) {
    var slink = 'server.php';
    linkWithData("modul_in_form", returnErrorInfoDataArray, "editafter", 'tartalom-wrapper');

    $.post(slink, {
        muv: "modulget",
        param: returnErrorInfoDataArray[1]

    }, function (data, status) {
        // //////console.log(data);
        if (data != "none/;/") {
            var spData = data.split("/;/");
            document.getElementById("form-row-name").value = spData[0];
            ;
            document.getElementById("form-row-number").value = spData[1];
            ;

            document.getElementById("form-row-elm").value = spData[3];
            ;
            document.getElementById("form-row-gyak").value = spData[4];
            ;
            document.getElementById("form-row-irasbeli-ora").value = spData[5];
            ;
            document.getElementById("form-row-szobeli-ora").value = spData[6];
            ;
            document.getElementById("form-row-gyak-ora").value = spData[7];
            ;
            setTimeout(function () {
                document.getElementById("form-row-kepzes").value = spData[2];
                ;
            }, 1000);


        } else {
            link("modul_in_form");
        }


    });
}

function modulEdit(id) {
    var name = document.getElementById("form-row-name").value;
    var innerModulNO = document.getElementById("form-row-number").value;
    var courseId = document.getElementById("form-row-kepzes").value;
    var doctrineClassNumber = document.getElementById("form-row-elm").value;
    var exerciseClassNumber = document.getElementById("form-row-gyak").value;
    var writtingTestClassNumber = document.getElementById("form-row-irasbeli-ora").value;
    var speakingTestClassNumber = document.getElementById("form-row-szobeli-ora").value;
    var practiseTestClassNumber = document.getElementById("form-row-gyak-ora").value;


    var sendModulDataArray = new Array(name, innerModulNO, courseId, doctrineClassNumber, exerciseClassNumber, writtingTestClassNumber, speakingTestClassNumber, practiseTestClassNumber, id);
    var slink = 'server.php';
    $.post(slink, {
        muv: "modulEdit",
        param: sendModulDataArray

    }, function (data, status) {
        //  //////console.log(data);
        var returnErrorTextMessage;
        if (data != "error") {
            returnErrorTextMessage = '<div class="alert alert-success">Sikeres módosítás!</div>';


        } else {
            returnErrorTextMessage = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

        }
        var returnErrorInfoArray = new Array(returnErrorTextMessage, id);
        modulGetWithParam(returnErrorInfoArray);

    });

}
function modulList(targetDiv) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_course",
        param: "value"

    }, function (data, status) {
        //////console.log(data);
        var returnSelectorOptions = '<option value="-1">Nincs képzéshez rendelve</option>';
        if (data != "none;//") {
            var spReturnDataList = data.split("//");
            for (var i = 0; i < spReturnDataList.length; i++) {
                if (!checkEmptyString(spReturnDataList[i])) {
                    var spStudent = spReturnDataList[i].split(";");

                    returnSelectorOptions += '<option value="' + spStudent[2] + '">' + spStudent[0] + '</option>';
                }
            }
            linkWithData(targetDiv, returnSelectorOptions, "load", 'tartalom-wrapper');




        } else {
            var returnSelectorOptions = '<option value="-1" ><p class="col-md-6">Nincs még oktátas felvive!</p></li>';
            linkWithData(targetDiv, returnSelectorOptions, "load", 'tartalom-wrapper');

        }


    });
}
function modulEducation(list) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_course",
        param: "value"

    }, function (data, status) {
        //////console.log(data);
        var returnSelectorOptions = '<option value="-1">Kérem válasszon a listából!</option>';
        if (list) {
            returnSelectorOptions = '<option value="-1">Nincs képzéshez rendelve</option>';
        }

        if (data != "none;//") {
            var spReturnDataList = data.split("//");
            for (var i = 0; i < spReturnDataList.length; i++) {
                if (!checkEmptyString(spReturnDataList[i])) {
                    var spStudent = spReturnDataList[i].split(";");

                    returnSelectorOptions += '<option value="' + spStudent[2] + '">' + spStudent[0] + '</option>';
                }
            }

        }

        document.getElementById('form-row-kepzes').innerHTML = returnSelectorOptions;
    });
}

function modulRefesh(id, targetDiv) {
    var slink = 'server.php';
    if (id != -2) {
        id = document.getElementById("form-row-kepzes").value;
    } else {
        id = -1;
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: id,
                muv: "list_modul_filter"
            },
            success: function (mid) {
                if (id != -1) {
                    var returnSelectorOptions = "";
                } else {
                    var returnSelectorOptions = '<option value="-1">Nincs modulhoz rendelve</option>';
                }
                var spReturnDataList = mid.split("//");
                for (var i = 0; i < spReturnDataList.length; i++) {
                    if (!checkEmptyString(spReturnDataList[i])) {
                        var spReturnDataItem = spReturnDataList[i].split(";");

                        returnSelectorOptions += '<option value="' + spReturnDataItem[2] + '">' + spReturnDataItem[0] + '</option>';
                    }
                }
                document.getElementById(targetDiv).innerHTML = "";
                document.getElementById(targetDiv).innerHTML = returnSelectorOptions;

                resolve(mid);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });


}
function getAccessForModul() {
    var value = document.getElementById("modul-list").value;


    if (value != -1) {
        hiba = false;
        document.getElementById("alertdiv").innerHTML = "";
        var modul_data = null;
        var calc_data = null;
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: value,
                muv: "modulgetCalc"
            },

            success: function (moduls) {
                console.log(moduls);
                var spmoduls = moduls.split(";,;,;");
                modul_data = spmoduls[0];
                calc_data = spmoduls[1];
                resolveAccessData(modul_data, calc_data);
            },
            error: function (err) {
            }
        });
    }
}
function modulAccessPass() {
    var value = document.getElementById("modul-list").value;


    if (value != -1) {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: value,
                muv: "modulAccessPass"
            },

            success: function (moduls) {
                getAccessForModul();
            },
            error: function (err) {
            }
        });
    }
}
function resolveAccessData(modul_data, calc_data) {
    var hibatext = '<div class="alert alert-warning">Következő hibák léptek fel:';
    hibatext += rewriteModul(modul_data);
    hibatext += rewriteCalcData(calc_data);
    hibatext += calcDiff(modul_data, calc_data);
    if (hiba) {
        document.getElementById("sendBtnCalc").style.display = "none";
        hibatext += '</div>';
        document.getElementById("alertdiv").innerHTML = hibatext;
    } else {
        document.getElementById("sendBtnCalc").style.display = "block";
    }

}
function calcDiff(modul_data, calc_data) {
    var lochibatext = '';
    var spModul_data = modul_data.split('/;/');
    var spCalc_data = calc_data.split('/;/');
    if (((spCalc_data[0] * 1) + (spCalc_data[1] * 1) + (spCalc_data[2] * 1)) != ((spModul_data[3] * 1) + (spModul_data[4] * 1))) {
        hiba = true;
        lochibatext += "nincs elég/túl sok tananyagegység van hozzárendelve a modulhoz"
    }
    return lochibatext;
}
function  rewriteModul(modul_data) {
    var lochibatext = '';
    var spModul_data = modul_data.split('/;/');
    if (spModul_data[10] == "true" && spModul_data[9] != "0000-00-00") {
        document.getElementById("form-row-state").value = "Engedélyezett";
        document.getElementById("form-row-state-date").value = spModul_data[9];
        hiba = true;
        lochibatext += "már engedélyezett modul,";

    } else {
        document.getElementById("form-row-state").value = "Nem engedélyezett";
        document.getElementById("form-row-state-date").value = spModul_data[8];
    }
    var hourText = '<input type="text" value="Elmélet: ' + spModul_data[3] + '" readonly><br><input type="text" value="Gyakorlat: ' + spModul_data[4] + '" readonly>';
    document.getElementById("ahour").innerHTML = hourText;

    if (((spModul_data[3] * 1) + (spModul_data[4] * 1)) == 0) {
        hiba = true;
        lochibatext += "nincs megadva semmien óraszám a modulhoz,";
    }
    var examText = '';
    if (spModul_data[5] != "-1") {
        examText += '<input type="text" value="Írásbeli vizsga: ' + spModul_data[5] + '" readonly><br>';
    }
    if (spModul_data[6] != "-1") {
        examText += '<input type="text" value="Szóbeli vizsga: ' + spModul_data[6] + '" readonly><br>';
    }
    if (spModul_data[7] != "-1") {
        examText += '<input type="text" value="Gyakorlati vizsga: ' + spModul_data[7] + '" readonly><br>';
    }
    if (examText != '') {
        document.getElementById("exams").innerHTML = examText;

    } else {
        hiba = true;
        lochibatext += "nincs vizsga felvíve a modulhoz,";
    }

    return lochibatext;
}
function  rewriteCalcData(calc_data) {
    var lochibatext = '';
    var spModul_data = calc_data.split('/;/');

    var hourText = '<input type="text" value="Elmélet: ' + ((spModul_data[0] * 1) + (spModul_data[1] * 1)) + '" readonly><br><input type="text" value="Gyakorlat: ' + spModul_data[2] + '" readonly>';
    document.getElementById("dbdata").innerHTML = hourText;

    if (((spModul_data[0] * 1) + (spModul_data[1] * 1) + (spModul_data[2] * 1)) == 0) {
        hiba = true;
        lochibatext += "nincs semmien tananyagegység hozzárendelve a modulhoz,"
    }
    return lochibatext;
}
function modulRefeshwithParametersAJAXCALL(id, nonorderd) {
    var slink = 'server.php';
    var muv = "list_modul_filter";
    if (id != -2) {
        id = document.getElementById("form-row-kepzes").value;
    } else {
        id = -1;
    }
    if (nonorderd) {
        muv = "list_modul_filter_with_education_ordeless";
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: slink,
            type: 'POST',
            data: {
                param: id,
                muv: muv
            },

            success: function (moduls) {
                resolve(moduls)
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });

}
function modulRefeshwithParametersSELECTION(modullist, id, targetDiv, unusableSelectorListValue, unusableSelectorListId) {
    var spTargetDiv = targetDiv.split("-");
    var selectedSelectorListId = spTargetDiv[spTargetDiv.length - 1];

    //////console.log("status:" + status);
    ////console.log(modullist);
    ////console.log("\n"+targetDiv);
    if (id != -1) {
        var returnSelectorOptions = '<option value="-1">Kérem válaszon modult!</option>';
    } else {
        var returnSelectorOptions = '<option value="-1">Nincs modulhoz rendelve</option>';
    }
    var spModulList = modullist.split("//");
    for (var i = 0, outerforMaximum = spModulList.length; i < outerforMaximum; i++) {
        if (!checkEmptyString(spModulList[i])) {
            var spModulListItemsData = spModulList[i].split(";");
            var matchWithUnusableSelectorListValue = checkMatchWithListItemsWhenNotInSameSelectorList(unusableSelectorListId, selectedSelectorListId, spModulListItemsData[2], unusableSelectorListValue);
            if (!matchWithUnusableSelectorListValue) {
                returnSelectorOptions += '<option value="' + spModulListItemsData[2] + '">' + spModulListItemsData[0] + '</option>';
            }
        }
    }
    document.getElementById(targetDiv).innerHTML = "";
    document.getElementById(targetDiv).innerHTML = returnSelectorOptions;
    // set value back the targetDiv to selected value;
    for (var i = 0, max = unusableSelectorListId.length; i < max; i++) {
        if (unusableSelectorListId[i] == selectedSelectorListId) {
            document.getElementById(targetDiv).value = unusableSelectorListValue[i];
        }
    }

}
function checkMatchWithListItemsWhenNotInSameSelectorList(placeList, samePlace, matchingItem, matchingvalueList) {
    for (var j = 0, innerforMaximum = placeList.length; j < innerforMaximum; j++) {
        if (placeList[j] != samePlace) {
            //  //////console.log("tiltoot: "+tiltott[j]);
            // //////console.log("jelenlegi: "+spStudent[2]);
            if (matchingvalueList[j] == matchingItem) {
                return true;
            }
        }
    }
    return false

}
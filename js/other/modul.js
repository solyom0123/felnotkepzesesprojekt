

function modulSend() {
    var name = document.getElementById("form-row-name").value;
    var azon = document.getElementById("form-row-number").value;
    var kepzes = document.getElementById("form-row-kepzes").value;
    var elm = document.getElementById("form-row-elm").value;
    var gyak = document.getElementById("form-row-gyak").value;
    var irasbeli_ora = document.getElementById("form-row-irasbeli-ora").value;
    var szobeli_ora = document.getElementById("form-row-szobeli-ora").value;
    var gyakorlati_ora = document.getElementById("form-row-gyak-ora").value;

    if (!document.getElementById('form-row-szobeli').checked) {
        szobeli_ora = -1;
    }
    if (!document.getElementById('form-row-gyakorlati').checked) {
        gyakorlati_ora = -1;
    }
    if (!document.getElementById('form-row-irasbeli').checked) {
        irasbeli_ora = -1;
    }
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
                if (spData[5] != -1) {
                    document.getElementById("form-row-irasbeli-ora").value = spData[5];
                    document.getElementById("form-row-irasbeli").checked = true;
                    ;
                }
                if (spData[6] != -1) {
                    document.getElementById("form-row-szobeli-ora").value = spData[6];
                    document.getElementById("form-row-szobeli").checked = true;
                }
                if (spData[7] != -1) {
                    document.getElementById("form-row-gyak-ora").value = spData[7];
                    document.getElementById("form-row-gyakorlati").checked = true;
                }
                     setTimeout(function (){
                document.getElementById("form-row-kepzes").value = spData[2];
                ;
            },1000);
           

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
                setTimeout(function (){
                document.getElementById("form-row-kepzes").value = spData[2];
                ;
            },1000);


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

    if (!document.getElementById('form-row-szobeli').checked) {
        speakingTestClassNumber = -1;
    }
    if (!document.getElementById('form-row-gyakorlati').checked) {
        practiseTestClassNumber = -1;
    }
    if (!document.getElementById('form-row-irasbeli').checked) {
        writtingTestClassNumber = -1;
    }
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

                        returnSelectorOptions += '<option value="' + spReturnDataItem[2] + '">' + spReturnDataItem[0] + '|| ' + spReturnDataItem[1] + '</option>';
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
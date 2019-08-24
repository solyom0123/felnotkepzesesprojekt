function bonusunitSend() {
    var name = document.getElementById("form-row-name").value;
    var tartalom = document.getElementById("form-row-con").value;
    var modul = -1;
    var elm = document.getElementById("form-row-elm").value;
    var gyak = 0;
    var elearn = 0;

    var value = new Array(name, tartalom, modul, elm, gyak, elearn);
    var slink = 'server.php';
    $.post(slink, {
        muv: "bonusunitSend",
        param: value

    }, function (data, status) {
        ////console.log(data);
        var value;
        if (data != "error") {

            value = '<div class="alert alert-success">Sikeres felvitel!</div>';


        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

        }
        linkWithData("bonus_unit_in_form", value, "load", 'tartalom-wrapper');


    });
}
function bonusunitEdit(id) {
    var name = document.getElementById("form-row-name").value;
    var tartalom = document.getElementById("form-row-con").value;
    var modul = -1;
    var elm = document.getElementById("form-row-elm").value;
    var gyak = 0;
    var elearn = 0;

    var value = new Array(name, tartalom, modul, elm, gyak, elearn, id);
    var slink = 'server.php';
    $.post(slink, {
        muv: "curunitEdit",
        param: value

    }, function (data, status) {
        ////console.log(data);
        var text;
        if (data != "error") {
            text = '<div class="alert alert-success">Sikeres módosítás!</div>';


        } else {
            text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

        }
        var value = new Array(text, id);
        bonusunitGetWithParam(value);

    });

}
function bonusunitGet() {
    var value = $("#form-row-cur-unit").val();

    if (value != "undefined") {
        setElozo('bonus_unit_list');

        var slink = 'server.php';
        linkWithData("bonus_unit_in_form", value, "edit", 'tartalom-wrapper')
                .then(data => {
                    setTimeout(
                            function () {
                                $.post(slink, {
                                    muv: "curunitget",
                                    param: value

                                }, function (data, status) {
                                    console.log(data);
                                    if (data != "none/;/") {
                                        var spData = data.split("/;/");
                                        document.getElementById("form-row-name").value = spData[0];
                                        document.getElementById("form-row-con").value = spData[1];
                                        document.getElementById("form-row-elm").value = spData[3];
                                         cur_unit_teacher_get(1,1,1,1);
                                    } else {
                                        link("bonus_unit_in_form");
                                    }


                                });

                            }
                    , 1000);


                })
                .catch(error => {
                    ////console.log(error)
                });

    }
}
function bonusunitGetWithParam(value) {

    var slink = 'server.php';
    linkWithData("bonus_unit_in_form", value, "editafter", 'tartalom-wrapper')
                .then(data => {
                    setTimeout(
                            function () {
                                $.post(slink, {
                                    muv: "curunitget",
                                    param: value[1]

                                }, function (data, status) {
                                    console.log(data);
                                    if (data != "none/;/") {
                                        var spData = data.split("/;/");
                                        document.getElementById("form-row-name").value = spData[0];
                                        document.getElementById("form-row-con").value = spData[1];
                                        document.getElementById("form-row-elm").value = spData[3];
                                       cur_unit_teacher_get(1,1,1,1);
                                    
                                    } else {
                                        link("bonus_unit_in_form");
                                   }


                                });

                            }
                    , 1000);


                })
                .catch(error => {
                    ////console.log(error)
                });
}


function bonusunitList(targetDiv) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_bonus",
        param: "value"

    }, function (data, status) {
        //////console.log(data);
        var returnSelectorOptions = '';
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
            var returnSelectorOptions = '<option value="-1" ><p class="col-md-6">Nincs még bónusz egység felvive!</p></li>';
            linkWithData(targetDiv, returnSelectorOptions, "load", 'tartalom-wrapper');

        }


    });
}
function curunitSend() {
    var name = document.getElementById("form-row-name").value;
    var tartalom = document.getElementById("form-row-con").value;
    var modul = document.getElementById("form-row-mod").value;
    var elm = document.getElementById("form-row-elm").value;
    var gyak = document.getElementById("form-row-gyak").value;
    var elearn = document.getElementById("form-row-elearn").value;

    var value = new Array(name, tartalom, modul, elm, gyak, elearn);
    var slink = 'server.php';
    $.post(slink, {
        muv: "curunitSend",
        param: value

    }, function (data, status) {
        ////console.log(data);
        var value;
        if (data != "error") {

            value = '<div class="alert alert-success">Sikeres felvitel!</div>';


        } else {
            value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

        }
        linkWithData("cur_unit_in_form", value, "load", 'tartalom-wrapper');


    });
}
function curunitEdit(id) {
    var name = document.getElementById("form-row-name").value;
    var tartalom = document.getElementById("form-row-con").value;
    var modul = document.getElementById("form-row-mod").value;
    var elm = document.getElementById("form-row-elm").value;
    var gyak = document.getElementById("form-row-gyak").value;
    var elearn = document.getElementById("form-row-elearn").value;


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
        curunitGetWithParam(value);

    });

}
function curunitGet() {
    var value = $("#tanegyseg-list").val();

    if (value != "undefined") {
        setElozo('cur_unit_list');

        var slink = 'server.php';
        linkWithData("cur_unit_in_form", value, "edit", 'tartalom-wrapper')
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
                                        ;
                                        document.getElementById("form-row-con").value = spData[1];
                                        ;
                                        searchForCurUnitCourseId(spData[2])
                                                .then(id => {
                                                    console.log(id);

                                                    if (id != "none") {
                                                        id = (id * 1);
                                                    } else {
                                                        id = -1;
                                                    }
                                                    document.getElementById("form-row-kepzes").value = (id);
                                                    modulRefesh(0, 'form-row-mod')
                                                            .then(mid => {
                                                                document.getElementById("form-row-mod").value = (spData[2] * 1);
                                                            })
                                                            .catch(error => {
                                                                ////console.log(error)
                                                            });
                                                })
                                                .catch(error => {
                                                    ////console.log(error)
                                                });
                                        document.getElementById("form-row-elm").value = spData[3];
                                        ;
                                        document.getElementById("form-row-gyak").value = spData[4];
                                        document.getElementById("form-row-elearn").value = spData[5];


                                    } else {
                                        link("cur_unit_in_form");
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
function searchForCurUnitCourseId(modId) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: modId,
                muv: "search-for-curunitcourse"
            },
            success: function (id) {
                resolve(id);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
function curunitGetWithParam(value) {

    var slink = 'server.php';
    linkWithData("cur_unit_in_form", value, "edit", 'tartalom-wrapper')
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
                                        ;
                                        document.getElementById("form-row-con").value = spData[1];
                                        ;
                                        searchForCurUnitCourseId(spData[2])
                                                .then(id => {
                                                    console.log(id);

                                                    if (id != "none") {
                                                        id = (id * 1);
                                                    } else {
                                                        id = -1;
                                                    }
                                                    document.getElementById("form-row-kepzes").value = (id);
                                                    modulRefesh(0, 'form-row-mod')
                                                            .then(mid => {
                                                                document.getElementById("form-row-mod").value = (spData[2] * 1);
                                                            })
                                                            .catch(error => {
                                                                ////console.log(error)
                                                            });
                                                })
                                                .catch(error => {
                                                    ////console.log(error)
                                                });
                                        document.getElementById("form-row-elm").value = spData[3];
                                        ;
                                        document.getElementById("form-row-gyak").value = spData[4];
                                        document.getElementById("form-row-elearn").value = spData[5];


                                    } else {
                                        link("cur_unit_in_form");
                                    }


                                });

                            }
                    , 1000);


                })
                .catch(error => {
                    ////console.log(error)
                });
}

function tanegysegfrissit(id, hova) {

    var slink = 'server.php';

    if (id != -2) {
        id = document.getElementById("modul-list").value;
    } else {
        id = -1;
    }
    if (id != 'undefined') {

        ////console.log(id);
        $.post(slink, {
            muv: "list_cur_unit_filter",
            param: id

        }, function (data, status) {
            ////console.log(data);
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var spStudent = spStudents[i].split(";");

                    value += '<option value="' + spStudent[2] + '">' + spStudent[0] + '|| ' + spStudent[1] + '</option>';
                }
            }
            document.getElementById(hova).innerHTML = "";
            document.getElementById(hova).innerHTML = value;

        });

    }
}
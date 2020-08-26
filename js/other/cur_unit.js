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
        //////console.log(data);
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
        //console.log(data);
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
                                    //console.log(data);
                                    if (data != "none/;/") {
                                        var spData = data.split("/;/");
                                        document.getElementById("form-row-name").value = spData[0];
                                        ;
                                        document.getElementById("form-row-con").value = spData[1];
                                        ;
                                        searchForCurUnitCourseId(spData[2])
                                                .then(id => {
                                                    //console.log(id);

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
                                                                //////console.log(error)
                                                            });
                                                })
                                                .catch(error => {
                                                    //////console.log(error)
                                                });
                                        document.getElementById("form-row-elm").value = spData[3];
                                        ;
                                        document.getElementById("form-row-gyak").value = spData[4];
                                        document.getElementById("form-row-elearn").value = spData[5];
                                         listUploadedFile(1,value,1,1);
                                        otherfilemodal(1,value,spData[0]);

                                    } else {
                                        link("cur_unit_in_form");
                                    }


                                });

                            }
                    , 1000);


                })
                .catch(error => {
                    //////console.log(error)
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
    linkWithData("cur_unit_in_form", value, "editafter", 'tartalom-wrapper')
                .then(data => {
                    setTimeout(
                            function () {
                                $.post(slink, {
                                    muv: "curunitget",
                                    param: value[1]

                                }, function (data, status) {
                                    //console.log(data);
                                    if (data != "none/;/") {
                                        var spData = data.split("/;/");
                                        document.getElementById("form-row-name").value = spData[0];
                                        ;
                                        document.getElementById("form-row-con").value = spData[1];
                                        ;
                                        searchForCurUnitCourseId(spData[2])
                                                .then(id => {
                                                    //console.log(id);

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
                                                                //////console.log(error)
                                                            });
                                                })
                                                .catch(error => {
                                                    //////console.log(error)
                                                });
                                        document.getElementById("form-row-elm").value = spData[3];
                                        ;
                                        document.getElementById("form-row-gyak").value = spData[4];
                                        document.getElementById("form-row-elearn").value = spData[5];
                                        listUploadedFile(1,value[1],1,1);
                                        otherfilemodal(1,value[1],spData[0]);
                                    } else {
                                        link("cur_unit_in_form");
                                    }


                                });

                            }
                    , 1000);


                })
                .catch(error => {
                    //////console.log(error)
                });
}
function listUploadedFile(type,id,order,ordertype) {
    var slink = 'server.php';
    
    $.post(slink, {
        muv: "file_list_get",
        param: new Array(type,id,order,ordertype)

    }, function (data, status) {
       //console.log(data);
            var spData = data.split("/;/");
            document.getElementById("form-row-file-list").innerHTML = makefiletable(type,id,spData);

    });
}
function  makefiletable(type,id,spCurunits) {
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="listUploadedFile('+type+","+id+",";
    var down_arrow_end = ',1)"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="listUploadedFile('+type+","+id+",";
    var up_arrow_end = ',2)"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "File név " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "feltöltés ideje" +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            tr_end;

    if (spCurunits[0] != "none;") {
        for (var i = 0; i < spCurunits.length; i++) {

            if (!checkEmptyString(spCurunits[i])) {

                var spStudent = spCurunits[i].split(";");

                tr = '<tr style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        spStudent[0] +
                        td_end +
                        td +
                        spStudent[1] +
                        td_end +
                        tr_end;

            }
        }

    } else {
        value += tr +
                td +
                'Nincs' +
                td_end +
                td +
                'Nincs' +
                td_end +
                tr_end;

    }

    ////console.log(value);
    return value;
}
function tanegysegfrissit(id, hova) {

    var slink = 'server.php';

    if (id != -2) {
        id = document.getElementById("modul-list").value;
    } else {
        id = -1;
    }
    if (id != 'undefined') {

        //////console.log(id);
        $.post(slink, {
            muv: "list_cur_unit_filter",
            param: id

        }, function (data, status) {
            //////console.log(data);
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var spStudent = spStudents[i].split(";");

                    value += '<option value="' + spStudent[2] + '">' + spStudent[0] + '|| ' + spStudent[3] + '</option>';
                }
            }
            document.getElementById(hova).innerHTML = "";
            document.getElementById(hova).innerHTML = value;

        });

    }
}
function otherfilemodal(type,id,name) {
    document.getElementById("form-row-file-id").value =id;
    document.getElementById("form-row-file-type").value = type;
    document.getElementById("form-row-main-name").value = name;
    var filemodal = document.getElementById("fileModal");

    var sendbtn = document.getElementById("filesub");

    var btn = document.getElementById("fileBtn");

    var span = document.getElementById("fileclose");

    btn.onclick = function () {
        filemodal.style.display = "block";
    };
    span.onclick = function () {
        filemodal.style.display = "none";
    };
    sendbtn.onclick = function () {
        //var sEleresiUt = document.getElementById("form-row-alk").value.split("\\")
        //document.getElementById("form-row-alk-name").value = sEleresiUt[sEleresiUt.length - 1];
        setTimeout(function (){
        listUploadedFile(type,id,1,1);
            
        },2000);
        filemodal.style.display = "none";
        
    };

}
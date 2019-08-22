/*
 <td>
 <div class="span-half-corner-wrapper">
 <div onclick="loadActiveCourse();setElozo('actually_course')">
 <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
 <div class="span-half-corner">
 <span></span>
 </div>
 </div>
 </div>
 </td>
 */

function activeCourseSend() {
    var id = document.getElementsByTagName("id")[0].innerHTML;
    //var azon = document.getElementById("form-row-student").value;

    var checkedValue = collectCbData('studentNew_cb');
    if (!checkEmptyString(checkedValue)) {
        var value = new Array(id, checkedValue);
        var slink = 'server.php';
        $.post(slink, {
            muv: "activeCourseSend",
            param: value

        }, function (data, status) {
            //console.log(data);
            activeCourseGet(1, 1, 1, 1);

        });
    }
}
function collectCbData(type) {
    var checkedValue = '';
    var inputElements = document.getElementsByClassName(type);
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue += inputElements[i].value + "_";

        }
    }
    return checkedValue;
}
function deleteStudentConnect() {
    var id = document.getElementsByTagName("id")[0].innerHTML * 1;
    var checkedValue = collectCbData('studentDelete_cb');
    if (!checkEmptyString(checkedValue)) {
        var value = new Array(id, checkedValue);
        var slink = 'server.php';
        $.post(slink, {

            muv: "activeCourseDelete",
            param: value

        }, function (data, status) {
            //console.log(data);
            activeCourseGet();

        });
    }
}

function activeCourseGet(ordernew, ordertypenew, orderold, ordertypeold) {
    var value = document.getElementsByTagName("id")[0].innerHTML;
    var slink = 'server.php';

    $.post(slink, {
        muv: "active_course_get",
        param: value + "_" + ordernew + "_" + ordertypenew + "_" + orderold + "_" + ordertypeold

    }, function (date, status) {
        //console.log(date);
        link("user_con_form")
                .then(data => {
                    document.getElementsByTagName("id")[0].innerHTML = value;
                    var spData = date.split("/:/:/");
                    var spCourseInfo = spData[0].split("/;/")[0].split(";");
                    var spUsedStudentsInfo = spData[1].split("/;/");
                    var spNewStudentsInfo = spData[2].split("/;/");
                    var tableRowsOfUsedStudent = makeRowsFromDataStudent(spUsedStudentsInfo);
                    var tableOfNewStudents = makeTableFromDataNewStudent(spNewStudentsInfo);
                    document.getElementById("form-row-cid").value = spCourseInfo[0];
                    document.getElementById("form-row-cname").value = spCourseInfo[1];
                    document.getElementById("form-row-student").innerHTML = tableOfNewStudents;
                    document.getElementById("studentTable").innerHTML = tableRowsOfUsedStudent;
                })
                .catch(error => {
                    ////console.log(error)
                });




    });
}
function  makeRowsFromDataStudent(spUsedStudentsInfo) {
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="activeCourseGet(1,1';
    var down_arrow_end = ',1)"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="activeCourseGet(1,1,';
    var up_arrow_end = ',2)"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';
    var checkbox_start = '<input type="checkbox" class="studentDelete_cb" value="';
    var checkbox_end = '">';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Név " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "Születési Dátum " +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            tr_end;

    if (spUsedStudentsInfo[0] != "none") {
        for (var i = 0; i < spUsedStudentsInfo.length; i++) {

            if (!checkEmptyString(spUsedStudentsInfo[i])) {

                var spStudent = spUsedStudentsInfo[i].split(";");

                tr = '<tr style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        checkbox_start + spStudent[0] + checkbox_end +
                        spStudent[1] +
                        td_end +
                        td +
                        spStudent[2] +
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

    //console.log(value);
    return value;
}
function  makeOptionFromData(InArray) {
    var option_head = '<option value="';
    var option_middle = '">';
    var option_end = "</option>";
    var options = '<option value="-1">Kérem válasszon egyet!</option>';
    for (var i = 0; i < InArray.length; i++) {

        if (!checkEmptyString(InArray[i])) {

            var spStudent = InArray[i].split(";");

            options += option_head + spStudent[0] + option_middle + spStudent[1] + option_end;


        }
    }


    //console.log(value);
    return options;
}
function backtotheMenu() {
    var value = document.getElementsByTagName("id")[0].innerHTML
    link("act-course-page")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = value;
                $.ajax({
                    url: "./php/elozmeny.php",
                    type: 'POST',
                    data: {
                        ker: 1
                    },

                    success: function (data) {

                    },
                    error: function (err) {
                    }
                });
            })
            .catch(error => {
                ////console.log(error)
            });
}
function  makeTableFromDataNewStudent(spNewStudentsInfo) {

    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="activeCourseGet(';
    var down_arrow_end = ',1,1,1)"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="activeCourseGet(';
    var up_arrow_end = ',2,1,1)"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';
    var checkbox_start = '<input type="checkbox" class="studentNew_cb" value="';
    var checkbox_end = '">';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Név " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "Születési Dátum " +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            tr_end;

    if (spNewStudentsInfo[0] != "none") {
        for (var i = 0; i < spNewStudentsInfo.length; i++) {

            if (!checkEmptyString(spNewStudentsInfo[i])) {

                var spStudent = spNewStudentsInfo[i].split(";");

                tr = '<tr style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        checkbox_start + spStudent[0] + checkbox_end +
                        spStudent[1] +
                        td_end +
                        td +
                        spStudent[2] +
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

    //console.log(value);
    return value;
}

function loadActiveMenu(id) {
    link("act-course-page")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
            })
            .catch(error => {
                ////console.log(error)
            });
}

function activeCourseList(order, type) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_active_course",
        param: order + "_" + type

    }, function (data, status) {
        //console.log(data);
        var value = makeTableFromActiveCourses(data);
        document.getElementById('active_courses').innerHTML = value;



    });
}
function activeCourseListOptions(type, target) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_active_course",
        param: "1" + "_" + "1"

    }, function (data, status) {
        //console.log(data);
        var value = makeOptionFromData(data.split("//"));
        document.getElementById(target).innerHTML = value;



    });
}
function getMissingTable(type, target, sourceCourse, sourceItem) {
    var item = document.getElementById(sourceItem).value;

    var course = document.getElementById(sourceCourse).value;
    var value = new Array(course, item);
    console.log(value);
    if (item != "-1" && course != "-1") {
        var muv = '';
        if (type == 0) {
            muv = "table_dates";
        } else {
            muv = "table_student";
        }
        var slink = 'server.php';
        $.post(slink, {
            muv: muv,
            param: value

        }, function (data, status) {
            console.log(data);
            var value = "";
            if (type == 0) {
                value = makeTablefromDataDate(data.split("//"));
                 document.getElementById(target).innerHTML = value;
                  missingget(1, 1);
                 document.getElementById("buttonSend").style.display = "block";
                
            } else {
                value = makeTablefromDataStudent(data.split("//"));
                 document.getElementById(target).innerHTML = value;
       
            }
            
        });
    }else{
            document.getElementById(target).innerHTML = "";
         document.getElementById("buttonSend").style.display = "none";
    }
}
function  missingsend(i, j) {
    var rows = document.getElementById("mhour").getElementsByTagName("tr");
    var columns = rows[i].getElementsByTagName("td");
    var inputs = columns[j].getElementsByTagName("input");
    if (inputs[0].value != 0) {
        var hour = inputs[0].value;
        var mod = inputs[0].getAttribute("data-mod");
        var exa = inputs[0].getAttribute("data-exa");
        var rep = inputs[0].getAttribute("data-rep");
        var cur = inputs[0].getAttribute("data-cur");
        var stu = inputs[0].getAttribute("data-stu");
        var type = inputs[0].getAttribute("data-type");
        var act = inputs[0].getAttribute("data-act");
        var date = inputs[0].getAttribute("data-date");
        var value = new Array(date, hour, mod, cur, act, stu, rep, exa, type);
        $.post("server.php", {
            muv: "insertMissing",
            param: value

        }, function (data, status) {
        inputs[0].style.backgroundColor = "green";
        inputs[0].style.color = "white";
            setTimeout(function () {
                if ((j + 1) < columns.length) {
                    missingsend(i, j + 1);
                } else {
                    if ((i + 1) < rows.length) {
                        missingsend(i + 1, 1);
                    }

                }
            }, 50);
        });
    }else{
        setTimeout(function () {
             inputs[0].style.backgroundColor = "green";
             inputs[0].style.color = "white";
                if ((j + 1) < columns.length) {
                    missingsend(i, j + 1);
                } else {
                    if ((i + 1) < rows.length) {
                        missingsend(i + 1, 1);
                    }

                }
            }, 50);

    }
}



function  missingget(i, j) {
    var rows = document.getElementById("mhour").getElementsByTagName("tr");
    var columns = rows[i].getElementsByTagName("td");
    var inputs = columns[j].getElementsByTagName("input");
    
      
    var hour = inputs[0].value;
    var mod = inputs[0].getAttribute("data-mod");
    var exa = inputs[0].getAttribute("data-exa");
    var rep = inputs[0].getAttribute("data-rep");
    var cur = inputs[0].getAttribute("data-cur");
    var stu = inputs[0].getAttribute("data-stu");
    var type = inputs[0].getAttribute("data-type");
    var act = inputs[0].getAttribute("data-act");
    var date = inputs[0].getAttribute("data-date");
    var value = new Array(date, hour, mod, cur, act, stu, rep, exa, type);
    $.post("server.php", {
        muv: "getMissing",
        param: value

    }, function (data, status) {
      inputs[0].style.backgroundColor = "yellow";
      inputs[0].style.color = "black";
      
        inputs[0].value = data;
        setTimeout(function () {
            if ((j + 1) < columns.length) {
                missingget(i, j + 1);
            } else {
                if ((i + 1) < rows.length) {
                    missingget(i + 1, 1);
                }

            }
        }, 50);
    });



}
function listOptionsWithTargetAndSource(type, target, source) {
    var value = document.getElementById(source).value;
    var muv = '';
    if (type == 0) {
        muv = "list_dates_for_active";
    } else {
        muv = "list_students_for_active";
    }
    var slink = 'server.php';
    $.post(slink, {
        muv: muv,
        param: value

    }, function (data, status) {
        //console.log(data);
        var value = makeOptionFromData(data.split("//"));
        document.getElementById(target).innerHTML = value;



    });
}
function makeTablefromDataDate(data) {
    var spdatafirstrow = data[0].split(";");
    var td = "<td>";
    var data_mod_head = 'data-mod="';
    var data_mod_end = '" ';
    var data_cur_head = 'data-cur="';
    var data_cur_end = '" ';
    var data_rep_head = 'data-rep="';
    var data_rep_end = '" ';
    var data_exa_head = 'data-exa="';
    var data_exa_end = '" ';
    var data_stu_head = 'data-stu="';
    var data_stu_end = '" ';
    var data_type_head = 'data-type="';
    var data_type_end = '" ';
    var data_act_head = 'data-act="';
    var data_act_end = '" ';
    var data_date_head = 'data-date="';
    var data_date_end = '" ';
    var max_tag = 'max="';
    var max_tag_end = '" ';
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var input_head = '<input type="number" min="0" ';
    var input_end = '>';
    var th_end = '</th>';
    var value = tr +
            th_head +
            spdatafirstrow[0] +
            th_end;
    for (var i = 1, max = spdatafirstrow.length; i < max; i++) {
        if (!checkEmptyString(spdatafirstrow[i])) {
            value += th_head +
                    spdatafirstrow[i] +
                    th_end;
        }
    }
    value += tr_end;


    for (var i = 1; i < data.length; i++) {
        if (!checkEmptyString(data[i])) {
            var spStudent = data[i].split(";");
            value += tr +
                    td +
                    spStudent[0] +
                    td_end;
            for (var j = 1, max1 = spStudent.length; j < max1; j++) {
                if (!checkEmptyString(spStudent[j])) {
                    var spStudentRow = spStudent[j].split("_,_");

                    value += td +
                            input_head +
                            max_tag + spStudentRow[3] + max_tag_end +
                            data_stu_head + spStudentRow[0] + data_stu_end +
                            data_mod_head + spStudentRow[1] + data_mod_end +
                            data_cur_head + spStudentRow[2] + data_cur_end +
                            data_rep_head + spStudentRow[4] + data_rep_end +
                            data_exa_head + spStudentRow[5] + data_exa_end +
                            data_type_head + spStudentRow[6] + data_type_end +
                            data_act_head + spStudentRow[7] + data_act_end +
                            data_date_head + spStudentRow[8] + data_date_end +
                            input_end +
                            td_end;
                }
            }
            value += tr_end;

        }
    }

    return value;
}
function makeTablefromDataStudent(data){
   var sum=0;
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Dátum" +
            th_end+
            th_head +
            "hiányzott óraszáma" +
            th_end+
            th_head +
            "modul" +
            th_end+
            th_head +
            "Tananyagegység" +
            th_end+
            tr_end;
    for (var i = 0, max = data.length; i < max; i++) {
     
       if (!checkEmptyString(data[i])) {
            var spStudent = data[i].split(";");
        value += tr +
                        td +
                        spStudent[1] +
                        td_end +
                        td +
                        spStudent[2] +
                        td_end +
                        td +
                        spStudent[3] +
                        td_end +
                        td +
                        spStudent[4] +
                        td_end +
                        tr_end;
                sum+=(spStudent[2]*1);
        }
    
    }
   
         value += tr +
                        th_head +
                        "Összesen:" +
                        th_end +
                        th_head +
                        sum;
                        th_end +
                        th_head +
                        th_end +
                        th_head +
                        th_end +
                        tr_end;
    
   
    
    return value;

}
function makeTableFromActiveCourses(data) {
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="activeCourseList(';
    var down_arrow_end = ',1)"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="activeCourseList(';
    var up_arrow_end = ',2)"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';

    var th_end = '</th>';
    var value = tr +
            th_head +
            "Belső azonosító " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "Képzés neve " +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            "Kezdés dátuma " +
            down_arrow_start + 3 + down_arrow_end +
            up_arrow_start + 3 + up_arrow_end +
            th_end +
            th_head +
            "Vizsgajelentkezés dátuma " +
            down_arrow_start + 4 + down_arrow_end +
            up_arrow_start + 4 + up_arrow_end +
            th_end +
            tr_end;

    if (data != "none;//") {
        var spStudents = data.split("//");

        for (var i = 0; i < spStudents.length; i++) {
            if (!checkEmptyString(spStudents[i])) {
                var spStudent = spStudents[i].split(";");
                tr = '<tr onclick="loadActiveMenu(' + spStudent[0] + ');setElozo(\'actually_course\')" style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        spStudent[1] +
                        td_end +
                        td +
                        spStudent[2] +
                        td_end +
                        td +
                        spStudent[3] +
                        td_end +
                        td +
                        spStudent[4] +
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
                td +
                'Nincs' +
                td_end +
                td +
                'Nincs' +
                td_end +
                tr_end;

    }
    return value;
}
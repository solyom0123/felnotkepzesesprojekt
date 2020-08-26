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
            //////console.log(data);
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
            ////console.log(data);
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
        ////console.log(date);
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
                    //////console.log(error)
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

    ////console.log(value);
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


    ////console.log(value);
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
                //////console.log(error)
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

    ////console.log(value);
    return value;
}

function loadActiveMenu(id) {
    link("act-course-page")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
            })
            .catch(error => {
                //////console.log(error)
            });
}

function activeCourseList(order, type) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_active_course",
        param: order + "_" + type

    }, function (data, status) {
        ////console.log(data);
        var value = makeTableFromActiveCourses(data);
        document.getElementById('active_courses').innerHTML = value;



    });
}
function pushNoticeList(order, type) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_push_notice",
        param: order + "_" + type

    }, function (data, status) {
        ////console.log(data);
        var value = makeTableForPushNotice(data);
        document.getElementById('push').innerHTML = value;



    });
}

function activeCourseListOptions(type, target) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_active_course",
        param: "1" + "_" + "1"

    }, function (data, status) {
        ////console.log(data);
        var value = makeOptionFromData(data.split("//"));
        document.getElementById(target).innerHTML = value;



    });
}
function getMissingTable(type, target, sourceCourse, sourceItem) {
    if (type != 6) {
        var item = document.getElementById(sourceItem).value;
    } else {
        var item = "0";

    }
    var course = document.getElementById(sourceCourse).value;
    var value = new Array(course, item);
    //console.log(value);
    if (item != "-1" && course != "-1") {
        var muv = '';
        if (type == 0) {
            muv = "table_dates";
        } else if (type == 1) {
            muv = "table_student";
        } else if (type == 2) {
            muv = "table_dates_exam";

        } else if (type == 3) {
            muv = "table_student_exam";
        } else if (type == 4) {
            muv = "table_dates_final_exam";
        } else if (type == 5) {
            muv = "table_student_final_exam";
        } else if (type == 6) {
            muv = "table_dates_exam_sum";
        } else if(type==7){
			muv= "table_modul_exams";
		}
        var slink = 'server.php';
        $.post(slink, {
            muv: muv,
            param: value

        }, function (data, status) {
            //console.log(data);
            var value = "";
            if (type == 0) {
                value = makeTablefromDataDate(data.split("//"), false);
                document.getElementById(target).innerHTML = value;

                missingget(1, 1, 0);
                document.getElementById("buttonSend").style.display = "block";

            } else if (type == 1) {
                value = makeTablefromDataStudent(data.split("//"));
                document.getElementById(target).innerHTML = value;

            } else if (type == 2) {
                value = makeTablefromDataDateForExam(data.split("//"));
                document.getElementById(target).innerHTML = value;

                missingget(1, 1, 1);
                document.getElementById("buttonSend").style.display = "block";

            } else if (type == 3) {
                value = makeTablefromDataStudentExam(data.split("//"));
                document.getElementById(target).innerHTML = value;


            } else if (type == 4) {

                value = makeTablefromDataDateFinalExam(data.split("//"));
                document.getElementById(target).innerHTML = value;
                missingget(1, 1, 2);
                document.getElementById("buttonSend").style.display = "block";

            } else if (type == 6) {

                value = makeTablefromDataDateExamSum(data.split("//"));
                document.getElementById(target).innerHTML = value;

            } else if(type == 7){
				value = makeTablefromDataStudentFinalExam(data.split("//"));
                document.getElementById(target).innerHTML = value;
				
			}else {
                value = makeTablefromDataStudentFinalExam(data.split("//"));
                document.getElementById(target).innerHTML = value;


            }

        });
    } else {
        document.getElementById(target).innerHTML = "";
        document.getElementById("buttonSend").style.display = "none";
    }
}
function  missingsend(i, j, type) {
    document.getElementById("loadModal").style.display = "block";
    var muv = "insertMissing";
    if (type == 1) {
        muv = "insertExam"
    } else if (type == 2) {
        muv = "insertFinalExam"
    }
    var rows = document.getElementById("mhour").getElementsByTagName("tr");
    var timer = setInterval(function () {
        if (rows.length > 1) {
            var columns = rows[i].getElementsByTagName("td");
            var inputs = null
            if(type==1){
             inputs= columns[j].getElementsByTagName("select");
            }else{
              inputs= columns[j].getElementsByTagName("input");
           
            }   
            var value = null;
                if (type != 2) {
                    var hour = inputs[0].value;
                    var mod = inputs[0].getAttribute("data-scprid");
                    var stu = inputs[0].getAttribute("data-stu");
                    var act = inputs[0].getAttribute("data-act");
                    var date = inputs[0].getAttribute("data-date");
                    value = new Array(date, hour, mod, act, stu);
                } else {
                    var grade = inputs[0].value;
                    var no = columns[2].getElementsByTagName("input")[0].value;
                    var cdate = columns[3].getElementsByTagName("input")[0].value;
                    var stu = inputs[0].getAttribute("data-stu");
                    var act = inputs[0].getAttribute("data-act");
                    var date = inputs[0].getAttribute("data-date");

                    value = new Array(date, act, stu, grade, no, cdate);

                }
                $.post("server.php", {
                    muv: muv,
                    param: value

                }, function (data, status) {
                    //console.log(data);
                    if (type != 2) {
                        inputs[0].style.backgroundColor = "green";
                        inputs[0].style.color = "white";
                    } else {
                        inputs[0].style.backgroundColor = "green";
                        inputs[0].style.color = "white";
                        columns[2].getElementsByTagName("input")[0].style.backgroundColor = "green";
                        columns[2].getElementsByTagName("input")[0].style.color = "white";
                        columns[3].getElementsByTagName("input")[0].style.backgroundColor = "green";
                        columns[3].getElementsByTagName("input")[0].style.color = "white";

                    }
                });
            if ((j + 1) < columns.length && type != 2) {
                j++;

            } else {
                i++;
                j = 1;
                if (!(i < rows.length)) {

                    document.getElementById("loadModal").style.display = "none";
                    clearInterval(timer);
                }

            }
        } else {
            document.getElementById("loadModal").style.display = "none";
            clearInterval(timer);
        }
    }, 300);

}



function  missingget(i, j, type) {

    document.getElementById("loadModal").style.display = "block";
    var muv = "getMissing";
    if (type == 1) {
        muv = "getExam";
    } else if (type == 2) {
        muv = "getFinalExam";
    }

    var rows = document.getElementById("mhour").getElementsByTagName("tr");
    var timer = setInterval(function () {
        if (rows.length > 1) {
            var inputs = null;
            var columns = rows[i].getElementsByTagName("td");
            if(type==1){
            inputs = columns[j].getElementsByTagName("select");
            
            }else{
                inputs =columns[j].getElementsByTagName("input");
            }
                var value = null;
            if (type != 2) {
                var hour = inputs[0].value;
                var mod = inputs[0].getAttribute("data-scprid");
                var stu = inputs[0].getAttribute("data-stu");
                var act = inputs[0].getAttribute("data-act");
                var date = inputs[0].getAttribute("data-date");
                value = new Array(date, hour, mod, act, stu);
            } else {

                var stu = inputs[0].getAttribute("data-stu");
                var act = inputs[0].getAttribute("data-act");
                var date = inputs[0].getAttribute("data-date");

                value = new Array(date, act, stu);

            }

            $.post("server.php", {
                muv: muv,
                param: value

            }, function (data, status) {
                if (type != 2) {
                    inputs[0].style.backgroundColor = "yellow";
                    inputs[0].style.color = "black";

                    inputs[0].value = data;
                } else {
                    var spdata = data.split("_;_");
                    inputs[0].style.backgroundColor = "yellow";
                    inputs[0].style.color = "black";
                    columns[2].getElementsByTagName("input")[0].style.backgroundColor = "yellow";
                    columns[2].getElementsByTagName("input")[0].style.color = "black";
                    columns[3].getElementsByTagName("input")[0].style.backgroundColor = "yellow";
                    columns[3].getElementsByTagName("input")[0].style.color = "whiblack";

                    inputs[0].value = spdata[0];
                    columns[2].getElementsByTagName("input")[0].value = spdata[1];
                    columns[3].getElementsByTagName("input")[0].value = spdata[2];

                }
            });

            if ((j + 1) < columns.length && type != 2) {
                j++;

            } else {
                i++;
                j = 1;
                if (!(i < rows.length)) {
                    document.getElementById("loadModal").style.display = "none";
                    clearInterval(timer);
                }

            }
        } else {
            document.getElementById("loadModal").style.display = "none";
            clearInterval(timer);
        }
    }, 250);



}
function listOptionsWithTargetAndSource(type, target, source) {
    var value = document.getElementById(source).value;
    var muv = '';
    if (type == 0) {
        muv = "list_dates_for_active";
    } else if (type == 1) {
        muv = "list_students_for_active";
    } else if (type == 2) {
        muv = "list_dates_for_active_exam";
    } else if (type == 3) {
        muv = "list_dates_for_active_final_exam";
    }
    var slink = 'server.php';
    $.post(slink, {
        muv: muv,
        param: value

    }, function (data, status) {
        ////console.log(data);
        var value = makeOptionFromData(data.split("//"));
        document.getElementById(target).innerHTML = value;



    });
}
function makeTablefromDataDateForExam(data) {
    var spdatafirstrow = data[0].split(";");
    var td = "<td width='100px'>";
    var data_mod_head = 'data-scprid="';
    var data_mod_end = '" ';
    var data_stu_head = 'data-stu="';
    var data_stu_end = '" ';
    var data_act_head = 'data-act="';
    var data_act_end = '" ';
    var data_date_head = 'data-date="';
    var data_date_end = '" ';
    
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var select_head_begin = '<select  ';
    var select_head_end = '><option  value="0">Sikertelen</OPTION><option  value="1">SIKERES</OPTION></select>';
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
                            select_head_begin;
                    value += data_stu_head + spStudentRow[0] + data_stu_end +
                            data_mod_head + spStudentRow[1] + data_mod_end +
                            data_act_head + spStudentRow[3] + data_act_end +
                            data_date_head + spStudentRow[4] + data_date_end +
                            select_head_end +
                            td_end;
                }
            }
            value += tr_end;

        }
    }

    return value;
}

function makeTablefromDataDate(data, grade) {
    var spdatafirstrow = data[0].split(";");
    var td = "<td>";
    var data_mod_head = 'data-scprid="';
    var data_mod_end = '" ';
    var data_stu_head = 'data-stu="';
    var data_stu_end = '" ';
    var data_act_head = 'data-act="';
    var data_act_end = '" ';
    var data_date_head = 'data-date="';
    var data_date_end = '" ';
    var max_tag = 'max="';
    var max_tag_end = '" ';
    var min_tag = 'min="';
    var min_tag_end = '" ';
    
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
                            input_head;
                    if (!grade) {
                        value += max_tag + spStudentRow[2] + max_tag_end;
                    } else {
                        value += min_tag + "0" +min_tag_end+" "+max_tag + "1" + max_tag_end;

                    }
                    value += data_stu_head + spStudentRow[0] + data_stu_end +
                            data_mod_head + spStudentRow[1] + data_mod_end +
                            data_act_head + spStudentRow[3] + data_act_end +
                            data_date_head + spStudentRow[4] + data_date_end +
                            input_end +
                            td_end;
                }
            }
            value += tr_end;

        }
    }

    return value;
}
function makeTablefromDataDateExamSum(data) {
    var spdatafirstrow = data[0].split(";");
    var td = "<td>";
    var data_mod_head = 'data-scprid="';
    var data_mod_end = '" ';
    var data_stu_head = 'data-stu="';
    var data_stu_end = '" ';
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
                    for (var x = 0, max2 = spStudentRow.length; x < max2; x++) {
                        value += td +
                                spStudentRow[x]
                                +
                                td_end;
                    }
                }
            }
            value += tr_end;

        }
    }

    return value;
}

function makeTablefromDataDateFinalExam(data) {
    var spdatafirstrow = data[0].split(";");
    var td = "<td>";
    var data_stu_head = 'data-stu="';
    var data_stu_end = '" ';
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
    var txt_input_head = '<input type="text"  ';
    var date_input_head = '<input type="date"  ';

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
                            max_tag + "100" + max_tag_end +
                            data_stu_head + spStudentRow[0] + data_stu_end +
                            data_act_head + spStudentRow[1] + data_act_end +
                            data_date_head + spStudentRow[2] + data_date_end +
                            input_end +
                            td_end +
                            td +
                            txt_input_head +
                            input_end +
                            td_end +
                            td +
                            date_input_head +
                            input_end +
                            td_end;
                }
            }
            value += tr_end;

        }
    }

    return value;
}
function makeTablefromDataStudent(data) {
    var sum = 0;
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Dátum" +
            th_end +
            th_head +
            "hiányzott óraszáma" +
            th_end +
            th_head +
            "modul" +
            th_end +
            th_head +
            "Tananyagegység" +
            th_end +
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
            sum += (spStudent[2] * 1);
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
function makeTablefromDataStudentFinalExam(data) {
    var sum = 0;
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Vizsga dátum" +
            th_end +
            th_head +
            "osztályzat" +
            th_end +
            th_head +
            "Bizonyitvány azonosító" +
            th_end +
            th_head +
            "Kiállítás dátuma" +
            th_end +
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

        }

    }




    return value;

}
function makeTablefromDataStudentExam(data) {
    var sum = 0;
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var th_end = '</th>';
    var value = tr +
            th_head +
            "Dátum" +
            th_end +
            th_head +
            "Modul" +
            th_end +
            th_head +
            "VizsgaTípus" +
            th_end +
            th_head +
            "Érdemjegy" +
            th_end +
            tr_end;
    for (var i = 0, max = data.length; i < max; i++) {

        if (!checkEmptyString(data[i])) {
            var spStudent = data[i].split(";");
            value += tr +
                    td +
                    spStudent[1] +
                    td_end +
                    td +
                    spStudent[3] +
                    td_end +
                    td +
                    spStudent[4] +
                    td_end +
                    td +
                    spStudent[2] +
                    td_end +
                    tr_end;

        }

    }




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
function makeTableForPushNotice(data) {
    var td = "<td>";
    var tr_end = "</tr>";
    var td_end = "</td>";
    var tr = '<tr>';
    var th_head = '<th  >';
    var down_arrow_start = '<span style="cursor: pointer;"  onclick="pushNoticeList(';
    var down_arrow_end = ',1)"><img src="./img/down_arrow.png" width="20px" height="20px"></span>';
    var up_arrow_start = '<span   style="cursor: pointer;" onclick="pushNoticeList(';
    var up_arrow_end = ',2)"><img src="./img/up_arrow.png" width="20px" height="20px"></span>';

    var th_end = '</th>';
    var value = tr +
            th_head +
            "dátum " +
            down_arrow_start + 1 + down_arrow_end +
            up_arrow_start + 1 + up_arrow_end +
            th_end +
            th_head +
            "Képzés neve " +
            down_arrow_start + 2 + down_arrow_end +
            up_arrow_start + 2 + up_arrow_end +
            th_end +
            th_head +
            "Üzenet " +
            down_arrow_start + 3 + down_arrow_end +
            up_arrow_start + 3 + up_arrow_end +
            th_end +
            tr_end;

    if (data != "none;//") {
        var spStudents = data.split("//");

        for (var i = 0; i < spStudents.length; i++) {
            if (!checkEmptyString(spStudents[i])) {
                var spStudent = spStudents[i].split(";");
                tr = '<tr style="cursor: pointer;" onMouseOver="this.style.color=\'red\'" onMouseOut="this.style.color=\'black\'" >';
                value += tr +
                        td +
                        spStudent[0] +
                        td_end +
                        td +
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
                td +
                'Nincs' +
                td_end +
                tr_end;

    }
    return value;
}
function deleteDataWithOneParam(param) {
    var value = collectDataFromCorrectFormForDelete(param);
    //console.log(value);
    $.post("server.php", {
                muv: "delete",
                param: value

            }, function (data, status) {
               // console.log(data);
                callCorrectFormAgainForDelete(param);
            });

}
function deleteData(param,id) {
    if(id != undefined) {
        var value = new Array(param, id);
       // console.log(value);
        $.post("server.php", {
            muv: "delete",
            param: value

        }, function (data, status) {
          //  console.log(data);
            callCorrectFormAgainForDelete(param);
        });
    }else {
        deleteDataWithOneParam(param);
    }
}
function collectDataFromCorrectFormForDelete(param) {
    var returnArray = new Array();
    returnArray[0]=param;

            returnArray[1]=document.getElementsByTagName("id")[0].innerHTML;
           // console.log(returnArray);

    return returnArray;
}
function   callCorrectFormAgainForDelete(param){
    switch (param) {
        case 0:
        {
            link("actually_course");
            break;
        }
        case 1:
        {
            loadAnActiveSchedule();
            break;
        }
        case 2:
        {
            link("course_basic_datas");
            break;
        }
        case 3:
        {
            link("modul_r_list");
            break;
        }
        case 4:
        {
            link("cur_unit_list");
            break;
        }
        case 5:
        {
            link("bonus_unit_list");
            break;
        }
        case 6:
        {
            link("student_r_list") ;
            break;
        }
        case 7:
        {
            link("teacher_list") ;
            break;
        }
        case 8:
        {
            link("bonus_teacher_list");


            break;
        }
    }
}
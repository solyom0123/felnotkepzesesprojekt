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
      if(!checkEmptyString(checkedValue)){
        var value = new Array(id, checkedValue);
        var slink = 'server.php';
        $.post(slink, {
            muv: "activeCourseSend",
            param: value

        }, function (data, status) {
            console.log(data);
            activeCourseGet(1,1,1,1);

        });
      }
}
function collectCbData(type){
    var checkedValue = ''; 
    var inputElements = document.getElementsByClassName(type);
    for(var i=0; inputElements[i]; ++i){
      if(inputElements[i].checked){
           checkedValue += inputElements[i].value+"_";
           
      }
    }
    return checkedValue;
}
function deleteStudentConnect() {
    var id = document.getElementsByTagName("id")[0].innerHTML * 1;
     var checkedValue = collectCbData('studentDelete_cb');
      if(!checkEmptyString(checkedValue)){
        var value = new Array(id, checkedValue);
    var slink = 'server.php';
   $.post(slink, {

        muv: "activeCourseDelete",
        param: value

    }, function (data, status) {
        console.log(data);
        activeCourseGet();

    });}
}

function activeCourseGet(ordernew, ordertypenew,orderold,ordertypeold) {
    var value = document.getElementsByTagName("id")[0].innerHTML;
    var slink = 'server.php';

    $.post(slink, {
        muv: "active_course_get",
        param: value + "_" + ordernew + "_" + ordertypenew+"_"+ orderold + "_" + ordertypeold

    }, function (date, status) {
        console.log(date);
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
                    //console.log(error)
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

    console.log(value);
    return value;
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
                //console.log(error)
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

    console.log(value);
    return value;
}

function loadActiveMenu(id) {
    link("act-course-page")
            .then(data => {
                document.getElementsByTagName("id")[0].innerHTML = id;
            })
            .catch(error => {
                //console.log(error)
            });
}

function activeCourseList(order, type) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_active_course",
        param: order + "_" + type

    }, function (data, status) {
        console.log(data);
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
        document.getElementById('active_courses').innerHTML = value;



    });
}


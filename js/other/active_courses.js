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
   var id =document.getElementsByTagName("id")[0].innerHTML;
    var azon = document.getElementById("form-row-student").value;
    if(azon!=-1){
    var value = new Array(id, azon);
    var slink = 'server.php';
    $.post(slink, {
        muv: "activeCourseSend",
        param: value

    }, function (data, status) {
       console.log(data);
        activeCourseGet();

    });
       }
}
function deleteStudentConnect(sid) {
   var id =document.getElementsByTagName("id")[0].innerHTML*1;
    var value = new Array(id,sid);
    var slink = 'server.php';
    $.post(slink, {
        
        muv: "activeCourseDelete",
        param: value

    }, function (data, status) {
       console.log(data);
        activeCourseGet();

    });
       }

function activeCourseGet() {
   var value =document.getElementsByTagName("id")[0].innerHTML
        console.log(value);
    var slink = 'server.php';
    
    $.post(slink, {
        muv: "active_course_get",
        param: value

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
            var optionsOfNewStudents = makeoptionsFromDataStudent(spNewStudentsInfo);
            document.getElementById("form-row-cid").value = spCourseInfo[0];
            document.getElementById("form-row-cname").value = spCourseInfo[1];
            document.getElementById("form-row-student").innerHTML =  optionsOfNewStudents;
            document.getElementById("studentTable").innerHTML = tableRowsOfUsedStudent;
                })
            .catch(error => {
                //console.log(error)
            });
            

      

    });
}function  makeRowsFromDataStudent(spUsedStudentsInfo){
    var returnValue= "<tr><th>Név</th><th>Születési dátum</th><th>Törlés</th></tr>";
    if (spUsedStudentsInfo[0]!="none") {
        for (var i = 0, max = spUsedStudentsInfo.length; i < max; i++) {
            if(spUsedStudentsInfo[i]!=" "&&spUsedStudentsInfo[i]!=""){
            var student = spUsedStudentsInfo[i].split(";");
            var deletebutton ='<td><button onclick="deleteStudentConnect('+student[0]+')">X</button></td>';
            var studentrow = '<td>'+student[1]+'</td><td>'+student[2]+'</td>'
            returnValue +="<tr>"+studentrow+deletebutton+"</tr>";
        }
        }
    }
    return returnValue; 
}
function backtotheMenu(){
 var value =document.getElementsByTagName("id")[0].innerHTML
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
function  makeoptionsFromDataStudent(spNewStudentsInfo){
    var returnValue= "<option>Kérem válasszon egy diákot!</option>";
    console.log(spNewStudentsInfo[0]);
    if (spNewStudentsInfo[0]!="none") {
        for (var i = 0, max = spNewStudentsInfo.length; i < max; i++) {
            if(spNewStudentsInfo[i]!=""&&spNewStudentsInfo[i]!=" "){
            var studentdata = spNewStudentsInfo[i].split(";");
            var student = ''+studentdata[1]+' - '+studentdata[2]+''
            returnValue +="<option value=\""+studentdata[0]+"\">"+student+"</option>";
        }
        }
    }
    return returnValue; 
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

function activeCourseList() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_active_course",
        param: "value"

    }, function (data, status) {
        //console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (spStudents[i] != "") {
                    if (i % 5 == 0 && i != 0) {
                        value += "</tr><tr>";
                    } else if (i == 0) {
                        value = "<tr>";
                    }
                    var spStudent = spStudents[i].split(";");

                    value += '<td>' +
                            '<div class="span-half-corner-wrapper-large">' +
                            '<div onclick="loadActiveMenu(' + spStudent[0] + ');setElozo(\'actually_course\')">' +
                            '<img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="200" height="200">' +
                            '<div class="span-half-corner-large">' +
                            '<span>' + spStudent[1] + " - " + spStudent[2] + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</td>';
                }
            }

        } else {
            var value = '<td>' +
                    '<div class="span-half-corner-wrapper-large">' +
                    '<div >' +
                    '<img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="200" height="200">' +
                    '<div class="span-half-corner-large">' +
                    '<span>Nincs elérhető</br> aktuális képzés</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>';
        }
        document.getElementById('active_courses').innerHTML = value;



    });
}


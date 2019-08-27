/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function startPrinting() {
    var date = document.getElementById("form-row-date").value;
    var course = document.getElementById("form-row-aktiv-kepzes").value;
    if (course != -1 && date != -1) {
        var value = new Array('1', new Array(course, date))
        var slink = 'server.php';
        $.post(slink, {
            muv: "print",
            param: value

        }, function (data, status) {
            console.log(data);
            var mainhead_array = new Array();
            var date = '';
            var courses_datas = new Array();
            var maintable_array = new Array();
            var spData = data.split("/;/");
            mainhead_array = spData[0].split(";");
            mainhead_array[mainhead_array.length] = "";
            courses_datas = spData[1].split("//");
            var spStudents = spData[2].split("//");
            for (var i = 0, max = spStudents.length; i < max; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var loac_array = spStudents[i].split(";");
                    maintable_array[maintable_array.length] = loac_array;
                }
            }
            date = spData[3];
            var link = spData[4];
            var i=0;
            var timer = setInterval (function(){
            if(i<courses_datas.length){
                if (!checkEmptyString(courses_datas[i])) {
                    var spCourses = courses_datas[i].split(";");
                    mainhead_array[4] = spCourses[0];
                    mainhead_array[5] = spCourses[1];

                    makeformForsend(date, mainhead_array, maintable_array, link);
                }
                i++;
            }else{
                clearInterval(timer);
            }
            
            },300
            )
        });
    }

}
function  makeformForsend(date, mainhead_array, maintable_array, link) {
    var form = '<form target="_blank" method="POST" action="./php/forms/' + link + '">';
    form += '<input type="hidden" name="date" value="' + date + '">';
    for (var i = 0, max = mainhead_array.length; i < max; i++) {
        form += '<input type="hidden" name="head[]" value="' + mainhead_array[i] + '">';
    }

    for (var i = 0, max = maintable_array.length; i < max; i++) {

        form += '<input type="hidden" name="main[' + i + '][0]" value="' + maintable_array[i][0] + '">';
        form += '<input type="hidden" name="main[' + i + '][1]" value="' + maintable_array[i][1] + '">';
    }
    form+='<input type="submit" id="passToPrint" ></form>';
    document.getElementById("help_div").innerHTML = form;
    document.getElementById("passToPrint").click();
}
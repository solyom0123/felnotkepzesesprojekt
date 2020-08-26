/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function dateEdit(date) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "dateEdit",
        param: date

    }, function (data, status) {
        //////console.log(data);
        var spdate = data.split("-");
        monthGet(spdate[0] + "-" + (spdate[1] * 1) + "-01");
    });
}
function checkmonth(date) {


    var slink = 'server.php';
    $.post(slink, {
        muv: "checkmonth",
        param: date

    }, function (data, status) {
        //////console.log(data);
        var inputText= "";
          if (data=="true") {
              inputText ='<div style="float: right; display: inline-block" onclick="editcheckDate(\''+date+'\')"><img src="./img/green-check.jpg" width="40px" height="40px"></div>'; 
        }else{
              inputText ='<div style="float: right; display: inline-block" onclick="editcheckDate(\''+date+'\')"><img src="./img/red-check.jpeg" width="40px" height="40px"></div>'; 
        }
              
        document.getElementById("calendar_capation_okay_button").innerHTML = inputText;
      
    });
}

function editcheckDate(date){
      var slink = 'server.php';
    $.post(slink, {
        muv: "editcheckmonth",
        param: date

    }, function (data, status) {
        //console.log(date);
        checkmonth(date);
    });
}
function monthGet(date) {


    var slink = 'server.php';
    $.post(slink, {
        muv: "monthGet",
        param: date

    }, function (data, status) {
        //////console.log(data);

        var spStudents = data.split("//");
        //////console.log(spStudents);
        var datesFromServer = spStudents[2].split("/-/");
        var spLastDateOfMonth = spStudents[0].split("-");
        var end = ((spLastDateOfMonth[2] * 1) + 1);
        var spdate = spStudents[1].split("-");
        var honapKezdNapsorszam = getMonthStartWeekDaysNo(spStudents[1]);

        var value = '<tr>';

        if (honapKezdNapsorszam > 1) {
            for (var j = 1; j < honapKezdNapsorszam; j++) {
                value += '<td class="calendar__day__cell" >' + ' </td>';
            }
        }
        for (var i = 1; i < end; i++) {
            var aktnap = '';
            if (i < 10) {
                aktnap = spdate[0] + "-" + spLastDateOfMonth[1] + "-0" + i
            } else {
                aktnap = spdate[0] + "-" + spLastDateOfMonth[1] + "-" + i
            }

            if (benneVan(aktnap, datesFromServer)) {

                    value += '<td class="calendar__day__cell" data-bank-holiday="tiltott" onclick="dateEdit(' + "'" + aktnap + "'" + ')" style="cursor: pointer">' + i + ' </td>';
               

            } else {
                value += '<td class="calendar__day__cell" onclick="dateEdit(' + "'" + aktnap + "'" + ')" style="cursor: pointer">' + i + ' </td>';
            }
            if (honapKezdNapsorszam % 7 == 0) {
                value += '</tr><tr>';
                honapKezdNapsorszam = 1;
            } else {
                honapKezdNapsorszam++;
            }

        }
        value += '</tr>';

        document.getElementById("calendar_capation_h1").innerHTML = getMonthName(spStudents[1]);
        document.getElementById("calendar_body").innerHTML = value;
        document.getElementById("form-row-akthonap").value = spStudents[1];
        checkmonth(spStudents[0]);
    });
}
function monthBefore() {
    var date = document.getElementById("form-row-akthonap").value;
    var spdate = date.split("-");
    var ev = (spdate[0] * 1);
    var honap = 0;
    var nap = "01";
    if (spdate[1] == "01") {
        honap = 12
        ev = (spdate[0] * 1) - 1;
    } else {
        honap = (spdate[1] * 1) - 1;

    }
    monthGet(ev + "-" + honap + "-" + nap);
}
function monthNext() {
    var date = document.getElementById("form-row-akthonap").value;
    var spdate = date.split("-");
    var ev = (spdate[0] * 1);
    var honap = 0;
    var nap = "01";
    if (spdate[1] == 12) {
        honap = 1
        ev = (spdate[0] * 1) + 1;
    } else {
        honap = (spdate[1] * 1) + 1;
    }
    monthGet(ev + "-" + honap + "-" + nap);
}
function getMonthStartWeekDaysNo(date) {
    var day = new Date(date);
    var n = day.getDay();
    if (n == 0) {
        return 7;
    } else {
        return n;
    }
}
function getMonthName(date) {
    var spdate = date.split("-");
    switch (spdate[1]) {
        case "1":
        {
            return spdate[0] + ".Január";
            break;
        }
        case "2":
        {
            return spdate[0] + ".Február";
            break;
        }
        case "3":
        {
            return spdate[0] + ".Március";
            break;
        }
        case "4":
        {
            return spdate[0] + ".Április";
            break;
        }
        case "5":
        {
            return spdate[0] + ".Május";
            break;
        }
        case "6":
        {
            return spdate[0] + ".Június";
            break;
        }
        case "7":
        {
            return spdate[0] + ".Július";
            break;
        }
        case "8":
        {
            return spdate[0] + ".Augusztus";
            break;
        }
        case "9":
        {
            return spdate[0] + ".Szeptember";
            break;
        }
        case "10":
        {
            return spdate[0] + ".Október";
            break;
        }
        case "11":
        {
            return spdate[0] + ".November";
            break;
        }
        case "12":
        {
            return spdate[0] + ".December";
            break;
        }
    }
}
function benneVan(date, datearray) {

    for (var i = 0, max = datearray.length; i < max; i++) {
        if (date == datearray[i]) {
            return true;

        }
    }
    return false;
}
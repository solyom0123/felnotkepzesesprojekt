/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addReplacementDay() {
    var selected_day = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].value;
    var selected_cur_unit = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].value;
    var inserted_hour_ammount = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[0].getElementsByTagName("input")[0].value;
    var remain_replacementdays_ammount = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML;
    var remain_curunit = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML;

    if (selected_cur_unit != -1 && selected_day != -1 &&inserted_hour_ammount > 0) {
        for (var i = 0, max = replacementdays.length; i < max; i++) {

            if (replacementdays[i].getdatum() == selected_day) {
                var curunit = whichcurunit(selected_cur_unit);
                var loc_rep_day = null;
                if ((inserted_hour_ammount*1) < replacementdays[i].getOra() && (inserted_hour_ammount*1) <= remain_curunit ) {
                    loc_rep_day = new Utemterv_bejegyzes_Model(0, selected_day, true, selected_cur_unit, (inserted_hour_ammount*1), 0, false, (objects[curunit]["used"] * 1), (objects[curunit]["used"] * 1) + (inserted_hour_ammount*1), 0);
                    objects[curunit]["used"] = (objects[curunit]["used"] * 1) + (inserted_hour_ammount*1);
                    replacementdays[i].setOra(replacementdays[i].getOra() - (inserted_hour_ammount*1));
                    refeshlist(selected_day,replacementdays[i].getOra());
                } else if ((inserted_hour_ammount*1) == replacementdays[i].getOra() && (inserted_hour_ammount*1)<= remain_curunit) {
                    loc_rep_day = new Utemterv_bejegyzes_Model(0, selected_day, true, selected_cur_unit, (inserted_hour_ammount*1), 0, false, (objects[curunit]["used"] * 1), (objects[curunit]["used"] * 1) + (inserted_hour_ammount*1), 0);
                    objects[curunit]["used"] = (objects[curunit]["used"] * 1) + (inserted_hour_ammount*1);
                    removeDay(selected_day);
                } 
                calcUseableHour();
                remain_curunit = document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML;
                if (loc_rep_day != null) {
                    insertInTable(loc_rep_day,calcTableLength("bonustable"));
                    sc.addUtemtervhez(loc_rep_day);
                    if ((remain_curunit * 1) < 1) {
                        removeCuruint(selected_cur_unit);
                    }
                    document.getElementById("replacementDays_datarow").getElementsByTagName("div")[2].innerHTML = ((remain_replacementdays_ammount * 1) - 1)
                }
            }
        }
    }
}

function insertInTable(utemterv,i) {
    var data = new Array(utemterv.getdatum(), objects[whichcurunit(utemterv.getTanegysegVizsgaid())]["name"], utemterv.getOra(), utemterv.getKezd(), utemterv.getVeg(), solveUtemTerv_ModelTypeForHuman(utemterv.getTipus()), utemterv.getdatum(), utemterv.getTanegysegVizsgaid());


    var tr = document.createElement("tr");
    var td_0 = document.createElement("td");
    var td_0_textnode = document.createTextNode(data[0]);
    td_0.appendChild(td_0_textnode);
    tr.appendChild(td_0);
    var td_1 = document.createElement("td");
    var td_1_textnode = document.createTextNode(data[1]);
    td_1.appendChild(td_1_textnode);
    tr.appendChild(td_1);
    var td_2 = document.createElement("td");
    var td_2_textnode = document.createTextNode("");
    td_2.appendChild(td_2_textnode);
    tr.appendChild(td_2);
    var td_3 = document.createElement("td");
    var td_3_textnode = document.createTextNode(data[2]);
    td_3.appendChild(td_3_textnode);
    tr.appendChild(td_3);
    var td_4 = document.createElement("td");
    var td_4_textnode = document.createTextNode(data[3]);
    td_4.appendChild(td_4_textnode);
    tr.appendChild(td_4);
    var td_5 = document.createElement("td");
    var td_5_textnode = document.createTextNode(data[4]);
    td_5.appendChild(td_5_textnode);
    tr.appendChild(td_5);
    var td_6 = document.createElement("td");
    var td_6_textnode = document.createTextNode(data[5]);
    td_6.appendChild(td_6_textnode);
    tr.appendChild(td_6);
    var td_7 = document.createElement("td");
    var td_7_select = document.createElement("select");
    var td_7_select_option = document.createElement("option");
    td_7_select.setAttribute("onClick", 'loadTeacher(\'' + data[6] + '\',' + data[7] + ',true,'+(calcTableLength("bonustable"))+',\''+data[1]+'\',\''+data[2]+'\',\''+data[3]+'\')');
    td_7_select_option.setAttribute("value", "-1");

    var td_7_select_optiontextnode = document.createTextNode("Kérem válasszon oktatót!");
    td_7_select_option.appendChild(td_7_select_optiontextnode);
    td_7_select.appendChild(td_7_select_option);
    td_7.appendChild(td_7_select);
    tr.appendChild(td_7);
    document.getElementById("bonustable").appendChild(tr);
    var sdata = data;
    searchTeacher(utemterv.getTanegysegVizsgaid())
            .then(data => {
                setTimeout(function () {
                    
    
                    console.log(data);
                    var options = makeOptionsForteacherselect(data);
                    
                     document.getElementById("bonustable").getElementsByTagName("tr")[searchforOptions(sdata[0],sdata[1],sdata[2],sdata[3])].style.backgroundColor = "yellow";
                    document.getElementById("bonustable").getElementsByTagName("tr")[searchforOptions(sdata[0],sdata[1],sdata[2],sdata[3])].style.color = "black";
                    loadOptions(searchforOptions(sdata[0],sdata[1],sdata[2],sdata[3]), options,"bonustable");


                }, 300);
            })
            .catch(error => {


            });


}
function removeDay(date) {
    var newselect = "";
    var select = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].getElementsByTagName("option");
    for (var i = 0; i < select.length; i++) {

        if (select[i].value != date) {
            newselect += '<option value="' + select[i].value + '">' + select[i].innerHTML + '</option>';

        }

    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = newselect;

}
function refeshlist(date,value){
    var newselect = "";
    var select = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].getElementsByTagName("option");
    
    for (var i = 0; i < select.length; i++) {

        if (select[i].value != date) {
            newselect += '<option value="' + select[i].value + '">' + select[i].innerHTML + '</option>';

        }else{
            var selectText = select[i].innerHTML.split(",");
            newselect += '<option value="' + select[i].value + '">' + selectText[0]+", " +value+" óra"+ '</option>';

        }

    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].innerHTML = newselect;

}

function removeCuruint(cur_unit) {
    var newselect = "";
    var select = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].getElementsByTagName("option");
    for (var i = 0; i < select.length; i++) {

        if (select[i].value != cur_unit) {
            newselect += '<option value="' + select[i].value + '">' + select[i].innerHTML + '</option>';

        }

    }
    document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].innerHTML = newselect;

}
function solveDaysAndWriteBack(sc) {
    for (var i = 0, max = sc.getHet(); i < max; i++) {
        var actWeekday = sc.getWeekDay(i);
        var dayname = "";
        var typename = "";
        switch (actWeekday.getNap()) {
            case 1:
                dayname = "mon";
                break;
            case 2:
                dayname = "tue";
                break;
            case 3:
                dayname = "wed";
                break;
            case 4:
                dayname = "thu";
                break;
            case 5:
                dayname = "fri";
                break;
            case 6:
                dayname = "sat";
                break;
            case 7:
                dayname = "sun";
                break;
        }
        switch (actWeekday.getTipus()) {
            case 1:
                typename = "plan_dec";
                break;
            case 2:
                typename = "plan_exe";
                break;
            case 3:
                typename = "el_dec";
                break;
        }
        document.getElementById(dayname + "_" + typename).value = actWeekday.getOra();
    }
}
function solveModulsAndOrderBack(sc) {
    for (var i = 0, max = sc.getKepzes().getModulok().length; i < max; i++) {
        var actmodul = sc.getKepzes().getModul(i);
        document.getElementById("form-row-modul-" + (i + 1)).value = actmodul.getId();
    }
}
function solveFinishedModulsAndOrderBack(sc) {
    for (var i = 0, max = sc.getBefejezettModuls(); i < max; i++) {
        var actmodul = sc.getBefejezettModul(i);
        document.getElementById("form-row-finished-modul-" + (i + 1)).value = actmodul.getId();
    }
}
function solveUtemTerv_ModelTypeForHuman(type) {
    var returnValue = '';
    var numbertype = type * 1;
    switch (numbertype) {
        case 1:
            returnValue = "elméleti";
            break;
        case 2:
            returnValue = "gyakorlati";
            break;
        case 3:
            returnValue = "elearn";
            break;
        case 0:
            returnValue = "pótnap";
            break;
        default:

            break;
    }
    return returnValue;
}
function solveUtemTerv_ModelExamTypeForHuman(type) {
    var returnValue = '';
    var numbertype = type * 1;
    switch (numbertype) {
        case 1:
            returnValue = "szóbeli";
            break;
        case 2:
            returnValue = "írásbeli";
            break;
        case 3:
            returnValue = "gyakorlati";
            break;

        default:

            break;
    }
    return returnValue;
}
function loadTeacherselects(start, kulonbseg, load) {
    var modal = document.getElementById("loadModal");
    //console.log(start);
    if (start < sc.getUtemterv().length) {
        var actday = sc.getUtemtervNap(start);
        //console.log(sc.getUtemtervNap(start));
        //console.log(document.getElementById("scTable").getElementsByTagName("tr")[start + 1 - kulonbseg]);

        modal.style.display = "block";
        if(!actday.isVizsga()){
             console.log("normal");
        
        console.log(sc.getUtemtervNap(start));
        searchTeacher(actday.getTanegysegVizsgaid())
                .then(data => {
                     console.log(data);
                    setTimeout(function () {
                        
                        if(document.getElementById("scTable").getElementsByTagName("tr").length>start+1){
                        document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.backgroundColor = "yellow";
                        document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.color = "black";
                        }   if (!actday.isVizsga()&&!actday.isTartalekNap() ) {
                            
                            var options = makeOptionsForteacherselect(data);
                            loadOptions(start + 1 - kulonbseg, options,"scTable");


                            loadTeacherselects(start + 1, kulonbseg, load);

                        } else {
                            
                                loadTeacherselects(start + 1, kulonbseg, load);
                            

                        }
                       
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });

        }else{
             console.log("vizsga");
        
        console.log(sc.getUtemtervNap(start));
            searchTeacherExam(actday.getModul())
                .then(data => {
                     console.log(data);
                    setTimeout(function () {
                        if(document.getElementById("scTable").getElementsByTagName("tr").length>start+1){
                        document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.backgroundColor = "yellow";
                        document.getElementById("scTable").getElementsByTagName("tr")[start+1].style.color = "black";
                        } 
                            var options = makeOptionsForteacherselect(data);
                            loadOptions(start + 1 - kulonbseg, options,"scTable");

                            
                            loadTeacherselects(start + 1, kulonbseg, load);

                         
                       
                    }, 300);
                })
                .catch(error => {

                    modal.style.display = "none";

                });

        }
    } else {

        modal.style.display = "none";
         var notwork =checkSc(sc);
                if(notwork.length>0){
                    document.getElementById("pass-btn").style.display="none";
                      document.getElementById("pass-btn-b").style.display="none";
                    document.getElementById("alert").innerHTML = alertMessageMake(notwork);
                }
        if (load) {
            loadBackSecondHalf();
        }
    }

}
function loadOptions(rowno, options,table) {
    var myTable = document.getElementById(table);
    var rows = myTable.getElementsByTagName("tr");
    var select = rows[rowno].getElementsByTagName("td")[7].getElementsByTagName("select")[0];
    select.innerHTML = select.innerHTML + options;
}
function loadTeacher(actdate, curUnitId, isReplacement,indexReplacement,anyagname,oraszam,start) {
    var kulonbseg = 0;
    
    if(!(""+curUnitId).includes("_")){
    for (var i = 0, max = sc.getUtemterv().length; i < max; i++) {
        var actday = sc.getUtemtervNap(i);
        if (actday.isTartalekNap()) {
            kulonbseg++;

        }

        if (actday.getdatum() == actdate && actday.getTanegysegVizsgaid() == curUnitId && !actday.isVizsga()) {
            var oktatoid = 0;
            if (!isReplacement) {
                oktatoid = solveTeacherselectValue(i + 1 - kulonbseg);
            } else {
                oktatoid = solveTeacherselectValueReplacementDay(actdate,indexReplacement,anyagname,oraszam,start);
            }
            actday.setOktato(oktatoid);
        }
    }
    }else{
        var spcurunitid = curUnitId.split("_");
    
       for (var i = 0, max = sc.getUtemterv().length; i < max; i++) {
        var actday = sc.getUtemtervNap(i);
        if (actday.isTartalekNap()) {
            kulonbseg++;

        }

        if (actday.getdatum() == actdate && actday.getModul() == spcurunitid[0] && actday.isVizsga()&&actday.getTanegysegVizsgaid()==spcurunitid[1]) {
            var oktatoid = 0;
             oktatoid = solveTeacherselectValue(i + 1 - kulonbseg);
            actday.setOktato(oktatoid);
        }
    }  
    }
}
function makeOptionsFromObjects(objects) {
    var returnValue = '<option value="-1">Kérem válasszon egy tanegységet!</option>';
    for (var i = 0, max = objects.length; i < max; i++) {

        returnValue += '<option value="' + objects[i]['id'] + '">' + objects[i]['name'] + '</option>'

    }
    return  returnValue;
}
function makeObjectFromReturnValue(data) {
    var spData = data.split("/;/");
    var returnArray = new Array();
    for (var i = 0, max = spData.length; i < max; i++) {
        if (!checkEmptyString(spData[i])) {
            var spDataPiece = spData[i].split(";,;,;");
            var helyiArray = new Array();
            helyiArray["id"] = spDataPiece[0].trim();
            helyiArray["name"] = spDataPiece[1];
            helyiArray["d"] = spDataPiece[2];
            helyiArray["el"] = spDataPiece[3];
            helyiArray["ex"] = spDataPiece[4];
            helyiArray["used"] = 0;
            returnArray[returnArray.length] = helyiArray;
        }
    }
    return returnArray;
}
function makeOptionsFromReplacemetnDays(replacementdays) {
    var returnValue = "";
    if (replacementdays.length > 0) {
        returnValue += '<option value="-1">Kérem válasszon egy dátumot!</option>';

        for (var i = 0, max = replacementdays.length; i < max; i++) {
            returnValue += '<option value="' + replacementdays[i].getdatum() + '">' + replacementdays[i].getdatum() + ", " + replacementdays[i].getOra() + ' óra </option>';

        }
    } else {
        returnValue += '<option value="-1">Nincs hozzáadható tartaléknap!</option>';
    }
    return returnValue;
}
function makeOptionsForteacherselect(data) {
    var returnValue = "";
    var spData = data.split("/;/");
    for (var i = 0, max = spData.length; i < max; i++) {
        var spActrow = spData[i].split(";,;,;");
        if (!checkEmptyString(spData[i])) {
            returnValue += "<option value=\"" + spActrow[0] + "\">" + spActrow[1] + "</options>";
        }
    }
    return returnValue;
}
function collectSCReplacmentDays(sc) {
    var replacmentDays = new Array();
    for (var i = 0; i < sc.getNaptar(); i++)
    {
        var day =sc.getNapNaptarhoz(i).getdatum();
        var unusable =tiltottnap(sc, day);
        var used = isUsedDayInSc(sc, day);
        if (!unusable && !used) {
            replacmentDays.push(new Utemterv_bejegyzes_Model(0, sc.getNapNaptarhoz(i).getdatum(), true, 0, 10, 0, false, 0, 0, 0));
        }
    }
    return replacmentDays;
}
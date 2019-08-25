/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function calcReplacementDayHours() {
    var selected = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[0].value;
    if (selected != -1) {
        for (var i = 0, max = replacementdays.length; i < max; i++) {
            if (replacementdays[i].getdatum() == selected) {
                document.getElementById("replacementDays_datarow").getElementsByTagName("div")[0].getElementsByTagName("input")[0].value = replacementdays[i].getOra();
            }
        }
    }

}
function calcUseableHour() {
    var selected = document.getElementById("replacementDays_datarow").getElementsByTagName("select")[1].value;
    if (selected != -1) {
        var curunit = whichcurunit(selected);
        var sum = (objects[curunit]["el"] * 1) + (objects[curunit]["ex"] * 1) + (objects[curunit]["d"] * 1) - objects[curunit]["used"];
        document.getElementById("replacementDays_datarow").getElementsByTagName("div")[1].innerHTML = sum;

    }

}
function calcTableLength(table) {
    var selected = document.getElementById(table).getElementsByTagName("tr");
    return selected.length;
}
function solveTeacherselectValueReplacementDay(actDate,index,anyag,ora,start) {
    var table = document.getElementById("bonustable").getElementsByTagName("tr");
    for (var i = 1, max = table.length; i < max; i++) {
        if(table[i].getElementsByTagName("td")[0].innerHTML==actDate&&table[i].getElementsByTagName("td")[1].innerHTML==anyag&&table[i].getElementsByTagName("td")[3].innerHTML==ora&&table[i].getElementsByTagName("td")[4].innerHTML==start){
            return  table[i].getElementsByTagName("td")[7].getElementsByTagName("select")[0].value;
        }
    }      
    
        
    
}
function searchforOptions(actDate,anyag,ora,start){
    var table = document.getElementById("bonustable").getElementsByTagName("tr");
    for (var i = 1, max = table.length; i < max; i++) {
        if(table[i].getElementsByTagName("td")[0].innerHTML==actDate&&table[i].getElementsByTagName("td")[1].innerHTML==anyag&&table[i].getElementsByTagName("td")[3].innerHTML==ora&&table[i].getElementsByTagName("td")[4].innerHTML==start){
            return  i;
        }
    }
}
function solveTeacherselectValue(rowno) {
    return  document.getElementById("scTable").getElementsByTagName("tr")[rowno].getElementsByTagName("td")[7].getElementsByTagName("select")[0].value;
}

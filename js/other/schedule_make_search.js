/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function searchCurUnit(modul, hour) {
    var returnCurUnit = null;
    // //console.log(modul);
    for (var i = 0, max = modul.getTananyagegysegek().length; i < max; i++) {
        var actCurUnit = modul.getTanegyseg(i);
        if (hour.getTipus() == 1) {
            if ((actCurUnit.getElmeleti_oraszam() - actCurUnit.getFelhasznalt_elmelet()) > 0) {
                return actCurUnit;
            }

        } else if (hour.getTipus() == 2) {
            if ((actCurUnit.getGyakorlati_oraszam() - actCurUnit.getFelhasznalt_gyakorlat()) > 0) {
                return actCurUnit;
            }
        } else if (hour.getTipus() == 3) {
            if ((actCurUnit.getElearn_oraszam() - actCurUnit.getFelhasznalt_elearn()) > 0) {
                return actCurUnit;
            }
        }
    }
    return returnCurUnit;
}
function searchExam(modul, hour, hourammount) {
    var returnExam = null;
    if(modulclosed(modul)){
    for (var i = 0, max = modul.getVizsgak().length; i < max; i++) {
        var actExam = modul.getVizsga(i);
        if (hour.getTipus() == 1) {
            if (modul.getVizsga(i).getTipus() == 1 || modul.getVizsga(i).getTipus() == 2) {
                if (hourammount >= (modul.getVizsga(i).getOraszam() * 1) && !modul.getVizsga(i).getUsed()) {
                    return actExam;
                }
            }
        } else if (hour.getTipus() == 2) {
            if (modul.getVizsga(i).getTipus() == 3) {
                if (hourammount >= (modul.getVizsga(i).getOraszam() * 1) && !modul.getVizsga(i).getUsed()) {
                    return actExam;
                }
            }
        }
        }
    }
    return returnExam;
}
function modulclosed(modul){
    var returnValue =true;
    if(modul.getFelhasznaltElmeletiOraszam()<modul.getElmeleti_oraszam()){
        returnValue =false;
    }
    if(modul.getFelhasznaltGyakorlatiOraszam()<modul.getGyakorlati_oraszam()){
        returnValue =false;
    }
    return returnValue;
}
function searchModul(schedule, hourscanuse) {
    var returnArray = new Array();
    for (var i = 0, max = schedule.getKepzes().getModulok().length; i < max; i++) {
        if (canUseModul(schedule.getKepzes().getModul(i), hourscanuse)) {
            returnArray[returnArray.length] = schedule.getKepzes().getModul(i);
        }
    }
    return returnArray;
}
function canUseModul(modul, hourscanuse) {
    for (var i = 0, max = hourscanuse.length; i < max; i++) {
        if (hourscanuse[i].getTipus() == 1 || hourscanuse[i].getTipus() == 3) {
            if ((modul.getElmeleti_oraszam() - modul.getFelhasznaltElmeletiOraszam()) > 0 || haveUnusedExamWithEnoughHour(modul, hourscanuse[i])) {
                return true;
            }

        } else if (hourscanuse[i].getTipus() == 2) {
            if ((modul.getGyakorlati_oraszam() - modul.getFelhasznaltGyakorlatiOraszam()) > 0 || haveUnusedExamWithEnoughHour(modul, hourscanuse[i])) {
                return true;
            }
        }
    }

    return false;
}
function haveUnusedExamWithEnoughHour(modul, day) {
    for (var i = 0, max = modul.getVizsgak().length; i < max; i++) {
        if (day.getTipus() == 1) {
            if (modul.getVizsga(i).getTipus() == 1 || modul.getVizsga(i).getTipus() == 2) {
                if (day.getOra() >= modul.getVizsga(i).getOraszam() && !modul.getVizsga(i).getUsed()) {
                    return true;
                }
            }
        } else if (day.getTipus() == 2) {
            if (modul.getVizsga(i).getTipus() == 3) {
                if (day.getOra() >= modul.getVizsga(i).getOraszam() && !modul.getVizsga(i).getUsed()) {
                    return true;
                }
            }
        }

    }
    return false;
}
function checkEnableHoursAtDate(schedule, dayno) {
    var returnArray = new Array();
    for (var i = 0, max = schedule.getHet(); i < max; i++) {
        if (schedule.getWeekDay(i).getNap() == dayno) {
            returnArray[returnArray.length] = schedule.getWeekDay(i);
        }
    }
    return returnArray;
}
function tiltottnap(schedule, actdate) {
    for (var i = 0, max = schedule.getKizartnapok(); i < max; i++) {

        if (schedule.getKizartnap(i).getdatum() == actdate) {
            return true;
        }

    }
    return false;
}
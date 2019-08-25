/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function  sumHoursCanUse(hourscanuse) {
    var hour = 0;
    for (var i = 0, max = hourscanuse.length; i < max; i++) {
        hour += hourscanuse[i].getOra();
    }
    return hour;
}
function  calcAndSetFoundCurUnitUsedHourAmmountByHourType(actHour, foundCurUnit, hourAmmmountByHoursType) {
    if (actHour.getTipus() == 1) {
        foundCurUnit.setFelhasznalt_elmelet(foundCurUnit.getFelhasznalt_elmelet() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 2) {
        foundCurUnit.setFelhasznalt_gyakorlat(foundCurUnit.getFelhasznalt_gyakorlat() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 3) {
        foundCurUnit.setFelhasznalt_elearn(foundCurUnit.getFelhasznalt_elearn() + hourAmmmountByHoursType);
    }

}
function calcAndSetActModulUsedHourAmmountByHourType(actHour, actModul, hourAmmmountByHoursType) {
    if (actHour.getTipus() == 1 || actHour.getTipus() == 3) {
        actModul.setFelhasznaltElmeletiOraszam(actModul.getFelhasznaltElmeletiOraszam() + hourAmmmountByHoursType);
    } else if (actHour.getTipus() == 2) {
        actModul.setFelhasznaltGyakorlatiOraszam(actModul.getFelhasznaltGyakorlatiOraszam() + hourAmmmountByHoursType);
    }

}
function calcmodulstarthourAmmmountByHoursType(actModul, actHour) {
    var returnValue = 0;
    if (actHour.getTipus() == 1 || actHour.getTipus() == 3) {
        returnValue = actModul.getFelhasznaltElmeletiOraszam();
    } else if (actHour.getTipus() == 2) {
        returnValue = actModul.getFelhasznaltGyakorlatiOraszam();
    }
    return returnValue;

}
function calchourAmmmountByHoursType(foundCurUnit, actHour, hourAmmount) {
    var returnValue = 0;
    if (actHour.getTipus() == 1) {
        var elmHour = foundCurUnit.getElmeleti_oraszam() - foundCurUnit.getFelhasznalt_elmelet();
        if ((elmHour) <= hourAmmount) {
            returnValue = elmHour;
        } else {
            returnValue = hourAmmount;
        }

    } else if (actHour.getTipus() == 2) {
        var gyakHour = foundCurUnit.getGyakorlati_oraszam() - foundCurUnit.getFelhasznalt_gyakorlat();
        if ((gyakHour) <= hourAmmount) {
            returnValue = gyakHour;
        } else {
            returnValue = hourAmmount;
        }
    } else if (actHour.getTipus() == 3) {
        var elHour = foundCurUnit.getElearn_oraszam() - foundCurUnit.getFelhasznalt_elearn();
        if ((elHour) <= hourAmmount) {
            returnValue = elHour;
        } else {
            returnValue = hourAmmount;
        }
    }
    return returnValue;
}

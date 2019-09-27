/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var param = null;
var setParam = false;
function megsem() {

    
     return new Promise((resolve, reject) => {
        $.ajax({
            url: "./php/elozmeny.php",
            type: 'POST',
            data: {
                ker: 1
            },

            success: function (data) {
                link(data);
                loadingModuls(data);
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
function giveParam(sparam){
    param = sparam;
    setParam=true;
}
function loadingModuls(linkfr) {
    if (linkfr == "course_page" ) {
        courseList()
    }
    if (linkfr == "student_page" ) {
        if(setParam){
        studentListSign(param);
        }
    }
    if (linkfr == "canvas_page" ) {
        if(setParam){
            loadCanvas(param);
        }
    }
    
}
function checkEmptyString(string){
    if(string==""||string==" "){
        return true;
    }
    else{
        return false;
    }
}
/**
 * 
 * @param {type} elozo
 * @returns {undefined}
 */
function setElozo(elozo) {
    ////console.log("elozo: " + elozo);
    $.post("./php/elozmeny.php", {
        preva: elozo
    }, function (data, status) {
        //  ////console.log(data);
    });
}
/**
 * 
 * @param {type} link
 * @returns {undefined}
 */
function link(link) {
    var slink = './php/' + link + '.php';
    console.log(link);
    return new Promise((resolve, reject) => {
        $.ajax({
            url: slink,
            type: 'GET',

            success: function (data) {
                document.getElementsByClassName('tartalom-wrapper')[0].innerHTML = "";
                $(".tartalom-wrapper").append(data);

                loadingModuls(link);
                setParam =false;
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
/**
 * 
 * @param {type} linkfr
 * @param {type} value
 * @param {type} muv
 * @param {type} target
 * @returns {undefined}
 */
function serverdata(linkfr, value, muv, target) {
    //////console.log(value);
    //////console.log(target);
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
                param: value,
                muv: muv
            },

            success: function (data) {
                if (!checkEmptyString(target)) {
                    document.getElementsByClassName(target)[0].innerHTML = data;
                }
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });
}
/**
 * 
 * @param {type} linkfr
 * @param {type} value
 * @param {type} muv
 * @param {type} target
 * @returns {undefined}
 */
function linkWithData(linkfr, value, muv, target) {
    //////console.log(value);
    //////console.log(target);
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "./php/" + linkfr + ".php",
            type: 'POST',
            data: {
                param: value,
                muv: muv
            },

            success: function (data) {
                if (!checkEmptyString(target)) {
                    document.getElementsByClassName(target)[0].innerHTML = data;
                }
                loadingModuls(linkfr);
                resolve(data);
            },
            error: function (err) {
                reject(["rejected", err])
            }
        });
    });

}

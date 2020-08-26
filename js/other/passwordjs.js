/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sendPassword(id,type){
    var uid = document.getElementById("form-row-uid").value;
    //var ps = document.getElementById("form-row-ps").value;
   // var ps2 = document.getElementById("form-row-ps-ag").value;
    var slink = 'email.php';
    /*if (ps != ps2) {
        var value = '<div class="alert alert-warning">A két jelszó nem egyezik!</div>';
        var data = new Array(value, aid);
         if (type == 2) {
                teacherGetWithParam(data);
            } else {
                studentGetWithParam(data);
            }
    } else {*/
        if(checkEmptyString(uid)){
           uid=0; 
        }
        var data = new Array(id, type,uid);
 
        $.post(slink, {
            muv: "passSend",
            param: data

        }, function (dataa, status) {
            //console.log(dataa);
            var value = "";
            if(dataa=="ok"){
            value ='<div class="alert alert-success">Sikeres küldés</div>';
           
        }else if(dataa=="error:data"){
            value = '<div class="alert alert-danger">Nem sikerült az email küldés. Ellenőrízze, hogy be van-e állítva az email cím!</div>';
           
        }else if(dataa=="error:send"){
            value = '<div class="alert alert-danger">Nem sikerült az email küldés. Kérem jelezze a fejlesztőknek a hibát!</div>';
           
        }
         var data = new Array(value, id);
            if (type == 2) {
                teacherGetWithParam(data);
            } else {
                studentGetWithParam(data);
            }
        });
//}
}

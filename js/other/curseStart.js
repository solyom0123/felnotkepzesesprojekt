/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*  <div class="form-group row">
 <label for="form-row-name" class="col-md-4 col-form-label">xy.</label>
 <div class="col-md-4">
 <select  class="form-control" id="form-row-modul-1" onclick="modulChange(1)">
 
 </select>
 </div>
 <div class="col-md-4 ">
 <a href="#" data-toggle="tooltip" title="Válassza ki a xy. modult modult!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
 </div>                            
 </div>
 */
var tiltotta = new Array();
var hasznalt = new Array(); 
function modulSelectorsMake() {

    var slink = 'server.php';
    var id = document.getElementById("form-row-kepzes").value;
    if (id != -1) {
        $.post(slink, {
            muv: "list_modul_selector_piece",
            param: id

        }, function (data, status) {
            //console.log(data);
            var value = "";
            var spStudents = data.split("//");
            document.getElementById("modul_length_of_course").value = spStudents[0];

            for (var i = 1; i < spStudents.length; i++) {
                if(spStudents[i]!=""){
            value += '<div class="form-group row"><label for="form-row-name" class="col-md-4 col-form-label">' + i + '.</label>' +
                        '<div class="col-md-4"><select  class="form-control" id="form-row-modul-' + i + '" onclick="modulChange(1)">' +
                        '</select></div><div class="col-md-4 "><a href="#" data-toggle="tooltip" title="Válassza ki a ' + i + '. modult modult!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a> ' +
                        ' </div></div>';
                }
            }
            document.getElementById("modul-order-place").innerHTML = value;
            for (var i = 1; i < spStudents.length; i++) {
           if(spStudents[i]!=""){
                let atadandotiltott =  Object.assign(new Array(), tiltotta);
                let atadandohely= Object.assign(new Array(), hasznalt);
                modulfrissitParameterrel(id, "form-row-modul-" + i, atadandotiltott, atadandohely);
                //tiltotta[tiltotta.length] = spStudents[i];
            }
             }

        });

    }



}
function modulChange(hely){
    var osszesdb= (document.getElementById("modul_length_of_course").value*1)+1;
    tiltotta= new Array();
    hasznalt = new Array();
    for (var i = 1, max = osszesdb; i < max; i++) {
        var ertek = document.getElementById("form-row-modul-"+i).value;
        if(ertek!=-1){
            hasznalt[hasznalt.length] = i;
            tiltotta[tiltotta.length] =ertek;
        }
    }
    modulSelectorsMake();
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 function modulSend() {
                var name = document.getElementById("form-row-name").value;
                var azon = document.getElementById("form-row-number").value;
                var kepzes = document.getElementById("form-row-kepzes").value;
                var elm = document.getElementById("form-row-elm").value;
                var gyak = document.getElementById("form-row-gyak").value;
                var irasbeli_ora = document.getElementById("form-row-irasbeli-ora").value;
                var szobeli_ora = document.getElementById("form-row-szobeli-ora").value;
                var gyakorlati_ora = document.getElementById("form-row-gyak-ora").value;

                if (!document.getElementById('form-row-szobeli').checked) {
                    szobeli_ora = -1;
                }
                if (!document.getElementById('form-row-gyakorlati').checked) {
                    gyakorlati_ora = -1;
                }
                if (!document.getElementById('form-row-irasbeli').checked) {
                    irasbeli_ora = -1;
                }
                var value = new Array(name, azon, kepzes, elm, gyak, irasbeli_ora, szobeli_ora, gyakorlati_ora);
                var slink = 'server.php';
                $.post(slink, {
                    muv: "modulSend",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var value;
                    if (data != "error") {

                        value = '<div class="alert alert-success">Sikeres felvitel!</div>';


                    } else {
                        value = '<div class="alert alert-danger">Sikertelen felvitel!</div>';

                    }
                    linkWithData("modul_in_form", value, "load", 'tartalom-wrapper');


                });
            }
            function modulGet() {
                 var value = $("#modul-list").val();
               
                 if(value!="undefined"){
                 setElozo('modul_r_list');
                
                var slink = 'server.php';
                linkWithData("modul_in_form", value, "edit", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "modulget",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                        document.getElementById("form-row-name").value = spData[0];
                        ;
                        document.getElementById("form-row-number").value = spData[1];
                        ;
                        document.getElementById("form-row-kepzes").value = spData[2];
                        ;
                        document.getElementById("form-row-elm").value = spData[3];
                        ;
                        document.getElementById("form-row-gyak").value = spData[4];
                        if(spData[5]!=-1){
                        document.getElementById("form-row-irasbeli-ora").value = spData[5];
                        document.getElementById("form-row-irasbeli").checked = true; ;
                        }
                        if(spData[6]!=-1){
                        document.getElementById("form-row-szobeli-ora").value = spData[6];
                         document.getElementById("form-row-szobeli").checked = true;
                        }
                        if(spData[7]!=-1){
                        document.getElementById("form-row-gyak-ora").value = spData[7];
                         document.getElementById("form-row-gyakorlati").checked = true;
                        }


                    } else {
                        link("modul_in_form");
                    }


                });
                }
            }
            function modulGetWithParam(value) {
                var slink = 'server.php';
                linkWithData("modul_in_form", value, "editafter", 'tartalom-wrapper');

                $.post(slink, {
                    muv: "modulget",
                    param: value[1]

                }, function (data, status) {
                    console.log(data);
                    if (data != "none/;/") {
                        var spData = data.split("/;/");
                        document.getElementById("form-row-name").value = spData[0];
                        ;
                        document.getElementById("form-row-number").value = spData[1];
                        ;
                        document.getElementById("form-row-kepzes").value = spData[2];
                        ;
                        document.getElementById("form-row-elm").value = spData[3];
                        ;
                        document.getElementById("form-row-gyak").value = spData[4];
                        ;
                        document.getElementById("form-row-irasbeli-ora").value = spData[5];
                        ;
                        document.getElementById("form-row-szobeli-ora").value = spData[6];
                        ;
                        document.getElementById("form-row-gyak-ora").value = spData[7];
                        ;



                    } else {
                        link("modul_in_form");
                    }


                });
            }
            function modulEdit(id) {
                var name = document.getElementById("form-row-name").value;
                var azon = document.getElementById("form-row-number").value;
                var kepzes = document.getElementById("form-row-kepzes").value;
                var elm = document.getElementById("form-row-elm").value;
                var gyak = document.getElementById("form-row-gyak").value;
                var irasbeli_ora = document.getElementById("form-row-irasbeli-ora").value;
                var szobeli_ora = document.getElementById("form-row-szobeli-ora").value;
                var gyakorlati_ora = document.getElementById("form-row-gyak-ora").value;

                if (!document.getElementById('form-row-szobeli').checked) {
                    szobeli_ora = -1;
                }
                if (!document.getElementById('form-row-gyakorlati').checked) {
                    gyakorlati_ora = -1;
                }
                if (!document.getElementById('form-row-irasbeli').checked) {
                    irasbeli_ora = -1;
                }
                var value = new Array(name, azon, kepzes, elm, gyak, irasbeli_ora, szobeli_ora, gyakorlati_ora,id);
                var slink = 'server.php';
                $.post(slink, {
                    muv: "modulEdit",
                    param: value

                }, function (data, status) {
                    console.log(data);
                    var text;
                    if (data != "error") {
                        text = '<div class="alert alert-success">Sikeres módosítás!</div>';


                    } else {
                        text = '<div class="alert alert-danger">Sikertelen módosítás!</div>';

                    }
                    var value = new Array(text, id);
                    modulGetWithParam(value);

                });

            }
            function modulList(hova) {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "list_course",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                    var value = '<option value="-1">Nincs képzéshez rendelve</option>';
                    if (data != "none;//") {
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");

                                value += '<option value="' + spStudent[2] + '">' + spStudent[0] + '</option>';
                            }
                        }
                        linkWithData(hova, value, "load", 'tartalom-wrapper');

                    

                    
                    } else {
                        var value = '<option value="-1" ><p class="col-md-6">Nincs még oktátas felvive!</p></li>';
                        linkWithData(hova, value, "load", 'tartalom-wrapper');

                    }


                });
            }
            function modulEducation() {

                var slink = 'server.php';
                $.post(slink, {
                    muv: "list_course",
                    param: "value"

                }, function (data, status) {
                    console.log(data);
                    var value = '<option value="-1">Nincs képzéshez rendelve</option>';
                    if (data != "none;//") {
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");

                                value += '<option value="' + spStudent[2] + '">' + spStudent[0] + '</option>';
                            }
                        }

                    }

                    document.getElementById('form-row-kepzes').innerHTML = value;
                });
            }
            
            function modulfrissit(id,hova){
                 var slink = 'server.php';
                 if(id!=-2){
                     id=document.getElementById("form-row-kepzes").value;
                 }else{
                     id=-1;
                 }
                $.post(slink, {
                    muv: "list_modul_filter",
                    param: id

                }, function (data, status) {
                    console.log(data);
                    if(id!=-1){
                    var value = "";
                }else{
                    var value = '<option value="-1">Nincs modulhoz rendelve</option>';
                }
                        var spStudents = data.split("//");
                        for (var i = 0; i < spStudents.length; i++) {
                            if (spStudents[i] != "") {
                                var spStudent = spStudents[i].split(";");

                                value += '<option value="' + spStudent[2] + '">' + spStudent[0] + '|| ' + spStudent[1] + '</option>';
                            }
                        }
                             document.getElementById(hova).innerHTML = "";
                          document.getElementById(hova).innerHTML = value;
                
                    });

                 }
           
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function elkuldmodul(){
        var adatok = new Array(
                document.getElementById("form-row-name").value,
                document.getElementById("form-row-number").value,
                document.getElementById("form-row-kepzes").value,
                document.getElementById("form-row-elm").value,
                document.getElementById("form-row-gyak").value,
                document.getElementById("form-row-irasbeli").value,
                document.getElementById("form-row-szobeli").value,
                document.getElementById("form-row-gyakorlati").value,
                );
       linka('modul_in_form',adatok,'new_modul');    
    
    }


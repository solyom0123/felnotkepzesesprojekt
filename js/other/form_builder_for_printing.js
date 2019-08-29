/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function form_head(target,blank,method){
    if (blank) {
        return '<form target="_blank" method="'+method+'" action="'+target+'">';
    } else {
         return '<form method="'+method+'" action="'+target+'">';
    }
}
function form_end(){
    return '</form>';
}
function one_variable_input(name,value){
    return '<input type="hidden" name="'+name+'" value="' + value+ '">'
}
function one_dimension_input(name,array){
    var inputs='';
    for (var i = 0, max = array.length; i < max; i++) {
        inputs += '<input type="hidden" name="'+name+'[]" value="' + array[i] + '">';
    }
    return inputs;
}
function two_dimension_input(name,array){
    var inputs='';
    console.log(array);
    for (var rows = 0, max = array.length; rows < max; rows++) {
        for (var cells = 0, max_1 = array[rows].length; cells < max_1; cells++) {
        inputs += '<input type="hidden" name="'+name+'[' + rows + ']['+cells+']" value="' + array[rows][cells] + '">';
        }
    }
    return inputs;
}
function submit_button(id){
    return '<input type="submit" id="'+id+'" >';
}
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row "><h2 class=" row col-md-12 h2-default">Tanulók listája</h2></div>
<form >
    <div class="row col-md-12 list-wrapper">
        <ul>
            <li ><div class="row"><input name="kepzes" type="checkbox" checked class="col-md-6"><p class="col-md-6">Minden tanuló</p></div></li>
            <li ><div class="row"><input name="kepzes" type="checkbox"  class="col-md-6"><p class="col-md-6">1. TANULÓ</p></div></li>
            <li> <div class=" row"><input name="kepzes" type="checkbox" class="col-md-6"><p class="col-md-6">2. TANULÓ</p></div></li>
        </ul>






    </div>
    <div class="row col-md-12 list-wrapper ">
        <div onclick="link('administrativ')" ><div class="col-md-4 option-button">Hallgatói igazolás kiállítása</div></div>
        <div class="col-md-2"></div>
        <div onclick="megsem()" ><div class="col-md-4 option-button">Mégse</div></div>


    </div>
</form>
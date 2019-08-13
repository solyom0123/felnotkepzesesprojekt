<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h2 class="h2-default">Aktuális képzés menuje</h2>
<id style="display: none"></id>

<table class="col-md-12">
    <tbody>
        <tr>
            <td>
                <div class="span-half-corner-wrapper-large">
                    <div onclick="activeCourseGet();setElozo('act-course-page')">
                        <img  src="img/cour_edit.png" class="img-circle img-circle-zindex-0" alt="bell" width="200" height="200">

                        <div class="span-half-corner-large">
                            <span>Tanulók képzéshez kapcsolása</span>
                        </div>
                    </div></div></td>
            <td><div class="span-half-corner-wrapper-large">
                    <div onclick="link('utemterv_in_form');setElozo('act-course-page')">
                        <img src="img/hal_ig.png" class="img-circle img-circle-zindex-0" alt="bell" width="200" height="200">
                        <div class="span-half-corner-large">
                            <span>ütemterv módosítás(Nem generál új ütemtervet)</span>
                        </div></div></div></td>

        </tr>
    </tbody>
</table>

<div class="form-group row">


    <div onclick="megsem()"><input type="button" class="btn col-md-12 option-button" value="Mégsem"></div>




</div>

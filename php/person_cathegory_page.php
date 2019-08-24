<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


                    <div class="row "><h2 class="col-md-9 h2-default">Alapadatok</h2>
</div>

                    <div class="table-wrapper">
                        
                        <table class="table-default">
                            <tbody>
                                <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="studentList();link('student_r_list');setElozo('person_cathegory_page')" ><img src="img/szemely2.png" class="img-circle img-circle-zindex-0" alt="szemelyek" width="100" height="100">
                                           </div>
                                        </div><span>Tanulók</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="teacherList();link('teacher_list');setElozo('person_cathegory_page')" ><img src="img/szemely2.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                           </div>
                                        </div><span>Oktatók</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="bonusteacherList();link('bonus_teacher_list');setElozo('person_cathegory_page')" ><img src="img/szemely2.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                           </div>
                                        </div><span>Alkalmi<br>Oktatók</span></td>
                                        <td><div class="span-half-corner-wrapper">
                                            <div onclick="link('teacher_connect_in_form');setElozo('person_cathegory_page')" ><img src="img/szemely2.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            </div></div><span>Tananyagegység oktatóhoz rendelése</span>
                                        </td>
                                        
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                        <div class="form-group row">

        <div class="col-md-6"></div>
        <div onclick="megsem()"><input type="button" class="btn col-md-3 option-button" value="Mégsem"></div>

        <div class="col-md-1"></div>
       


    </div>

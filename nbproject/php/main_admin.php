<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
                    <h2 class="h2-default">Irányítópult</h2>

                    <div class="table-wrapper">
                        
                        <table class="table-default">
                            <tbody>
                                <tr>
									
								
								
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="link('basic_datas_course_items')" ><img src="img/kepzes.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            </div>
                                        </div><span>Képzés adatok</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="studentList();link('student_r_list')"><img src="img/team.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            </div>
                                        </div> <span>Résztvevők kezelése</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="link('teacher_r_list')"><img src="img/szemely.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            </div>
                                        </div><span>Oktatók kezelése</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="link('modul_r_list')" ><img src="img/modul.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                           </div>
                                        </div><span>Modulok kezelése</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="link('course_start')" ><img src="img/uj.jpg" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                         </div>
                                        </div><span>Tanfolyamok indítása</span></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <div onclick="link('administrativ')" ><img src="img/adminisztracio.jpg" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                           </div>
                                        </div><span>Adminisztratív feladatok</span>
                                            </td>
                                </tr>
                              <!--  <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <a href="datum.html"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100"></a>
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>alma</span>
                                            </div>
                                        </div></td>
                                </tr>-->
                            </tbody>
                        </table>
                        
                    </div>
                   <!-- <div class="lapozo-whapper container-fluid">
                        <div class="lapozo-button-active">1</div>
                        <div class="lapozo-button">2</div>
                        <div class="lapozo-button">3</div>
                        <div class="lapozo-button">4</div>
                        <div class="lapozo-button">5</div>
                        <div class="lapozo-button">6</div>
                        <div class="lapozo-button">7</div>
                        <div class="lapozo-button">8</div>
                        <div class="lapozo-button">9</div>
                        <div class="lapozo-button">10</div>
                    </div>-->
<!--                     <div class="option-button-wrapper">
                <div class="option-button">Funkcio1</div>
                <div class="option-button">Funkcio2</div>
                        
                
                 </div>-->
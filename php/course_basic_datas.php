
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


                    <h2 class="h2-default">Képzések alapadatai</h2>

                    <div class="table-wrapper">
                        
                        <table class="table-default">
                            <tbody>
							<tr id="courselist">
					
							</tr>
                                <tr>
									<td><div class="span-half-corner-wrapper">
                                            <div onclick="link('course_in_form');setElozo('course_basic_datas')"><img src="img/plusz1.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            </div>
                                        </div> <span>Új képzés hozzáadása </span></td>
								
								
                                    <!--<td><div class="span-half-corner-wrapper">
                                            <a href="index.php?page=course_in_form"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>Képzések </span>
                                            </div></a>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <a href="index.php?page=modul_in_form"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>Modul </span>
                                            </div></a>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <a href="index.php?page=cur_unit_in_form"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>Tananyag- egység </span>
                                            </div></a>
                                        </div></td>-->
<!--                                    <td><div class="span-half-corner-wrapper">
                                            <a href="index.php?page=modul_treat"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>Modulok kezelése</span>
                                            </div></a>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <a href="index.php?page=course_start"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>Képzések indítása</span>
                                            </div></a>
                                        </div></td>
                                    <td><div class="span-half-corner-wrapper">
                                            <a href="index.php?page=checking"><img src="img/bell.png" class="img-circle img-circle-zindex-0" alt="bell" width="100" height="100">
                                            <div class="span-half-corner">
                                                <span>Ellenőrzések</span>
                                            </div></a>
                                        </div></td>-->
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
                    
                        <div class="form-group row">

        <div class="col-md-1"></div>
        <div onclick="megsem()"><input type="button" class="btn col-md-10 option-button" value="Mégsem"></div>

        <div class="col-md-1"></div>
       


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
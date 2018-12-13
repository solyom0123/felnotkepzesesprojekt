<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);
if(isset($_POST["log-form"])){
    session_start();
    $_SESSION['uid']= 1 ;
    $_SESSION['uname']=$_POST["log-form-email"];
    header("Location: ../index.php?page=main_admin");
  }else{
?>
<h2 class="h2-default">Bejelentkezés</h2>
<form class="form-wrapper" method="POST" action="./php/login.php" >
                       <div class="felirat-wrapper">
                            <div class="label-default-s">E-mail:</div>
                            <div class="label-default-s">Jelszó:</div>
                            <div class="label-default-s">Nem vagyok robot</div>
                            
                        </div>

                        <div class="input-wrapper">
                            <input class="input-default" name="log-form-email" type="email"  value="pl@freemail.hu">
                            <input class="input-default" name="log-form-ps" type="password"  value="példajelszó">
                            <input class="input-default" name="log-form-r"type="checkbox"  value="">
                            </div>
                        <div class="tooltip-wrapper">
                            <div class="tooltip-s">?
                                <span class="tooltiptext">Segédlet</span>
                            </div>
                            <div class="tooltip-s">?
                                <span class="tooltiptext">Segédlet</span>
                            </div>
                            <div class="tooltip-s">?
                                <span class="tooltiptext">Segédlet</span>
                            </div>
                            

                        </div>    
                        <div class="option-button-wrapper">
                            <input type="submit" name="log-form" class="option-button" value="Belépés">
                        <div class="option-button">Elfelejtettem jelszavam</div>


                    </div>

                    </form>
  <?php } ?>                    
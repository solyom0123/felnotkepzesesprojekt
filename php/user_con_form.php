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


<div class="row "><h2 class="col-md-12 h2-default">Tanuló hozzáadása</h2></div>
    <id style="display: none"></id>
  
        <div class="form-group row">
            <label for="form-row-cname" class="col-md-4 col-form-label">Képzés neve:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-cname" id="form-row-cname" type="text"  placeholder="Név" readonly>
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Képzés neve!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-cid" class="col-md-4 col-form-label">Képzés belső azonosító:</label>
            <div class="col-md-4">
                <input class="form-control-plaintext" name="form-row-name" id="form-row-cid" type="text"  placeholder="Név" readonly>
            </div> 

            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Képzés belső neve!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-student" class="col-md-4 col-form-label">Tanulók:</label>
            <div class="col-md-4">
                <select class="form-control" id="form-row-student" onchange="activeCourseSend()">
                </select>
            </div> 
            <div class="col-md-4 ">
                <a href="#" data-toggle="tooltip" title="Válassza ki, mely diákot szeretné rendelni!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>                            
        </div>
        <div class="form-group row">
            <label for="form-row-student" class="col-md-12 col-form-label"> Hozzárendelt tanulók:</label>
             
        </div>
         <div class="form-group row">
            <div class="col-md-12">
                <table  class="col-md-12" id="studentTable">
                    
                </table>
            </div>              
       
        </div>
         <div class="form-group row">
        
             <div onclick="backtotheMenu()"><input type="button" class="btn col-md-12 option-button" value="Mégsem"></div>



        </div>


                    
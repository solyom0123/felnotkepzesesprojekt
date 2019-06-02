<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);
?>

<html>
<head>
	<style type="text/css">
	.login-form {
		width: 450px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
<h2 class="center">Bejelentkezés</h2>

    <form  >
        <div class="form-group">
            <!--<label for="log-form-email" class="col-md-3 col-form-label">E-mail:</label>-->
            <!--<div class="col-md-6">-->
                <input class="form-control" id="name" type="text"  placeholder="user123">
            <!--</div> -->

           <!-- <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div> -->                           
        </div>

        <div class="form-group">
            <!--<label for="log-form-ps" class="col-md-3 col-form-label">Jelszó:</label>-->
            <!--<div class="col-md-6">-->
                <input class="form-control"  id="pass" type="password"  placeholder="Jelszó">
            <!--</div> -->

        <!--    <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>  -->
 </div>
<!--        <div class="form-group row">
            <label for="log-form-r" class="col-sm-3 col-form-label">Nem vagyok robot:</label>
            <div class="col-md-3">
                <input class="form-control-plaintext" name="log-form-r" id="log-form-r" type="checkbox"  >
            </div> 

            <div class="col-md-3 ">
                  <a href="#" data-toggle="tooltip" title="Hooray!"><img src="img/help.png" class="img-circle " alt="Súgó" width="15" height="15"></a>
            </div>  
        </div>-->
        <div class="form-group">
        
            <button type="button" onclick="login('login')" name="log-form"class="btn btn-primary btn-block">Belépés</button>
            <!--<div onclick="login('login')" name="log-form" class="btn btn-primary btn-block" >Belépés</div>-->
            <!--<div class="col-md-1"> </div>-->
			<div class="clearfix">
			<a href="#" class="pull-right">Elfelejtettem a jelszavam...</a>
			<!--<input type="button" class="btn col-md-4 option-button" value="Elfelejtettem a jelszavam">-->
			</div>

        </div>
    </form>
	</div>
	</body>
  </html>               
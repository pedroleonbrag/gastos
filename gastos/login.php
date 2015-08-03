<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gastos</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/datepicker.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-select-min.css">
<link rel="stylesheet" href="css/scrollYou.css">
<link rel="stylesheet" href="css/bootstrap-table.css">
<link rel="stylesheet" href="css/bulletin.css">
<link rel="stylesheet" href="css/default.min.css">
<link rel="stylesheet" href="css/docs.css">                  

<script src="js/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select-min.js"></script>
<script src="js/scrollYou.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.bulletin.js"></script>
<script src="js/examples.js"></script>

</head>

<style>
/*
 * Specific styles of signin component
 */
/*
 * General styles
 */
body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
}

label{
	cursor: default;
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
	padding-bottom: 3px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: pointer;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
	border-radius: 4px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    
}

.form-signin .form-control:focus {
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.forgot-password{
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
</style>

<script>
$( document ).ready(function() {
	//document.getElementById('err_login').style.visibility = "visible";
});

function verificaEmail(email){
	if(jQuery.trim(email) == 'pedroleonbrag@gmail.com' && $('#profile-img').attr("src") != "img/pedro.jpeg"){
		$('#profile-img').fadeOut(500, function() {
	        $('#profile-img').attr("src","img/pedro.jpeg");
	        $('#profile-img').fadeIn(600);
	    });
	}else if($('#profile-img').attr("src") != "img/avatar.png"){
		$('#profile-img').fadeOut(500, function() {
	        $('#profile-img').attr("src","img/avatar.png");
	        $('#profile-img').fadeIn(600);
	    });
	}
}

function emailValido(valor){
    return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor));
}

function loguear(){
	email = document.getElementById('inputEmail2').value;
	pass = document.getElementById('inputPassword2').value;
	if(!emailValido(jQuery.trim(email)))
		return;
	if(jQuery.trim(pass) == "")
		return;	

	document.getElementById('accion').value = "login";
}

</script>

<body>

    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="img/avatar.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" action="login.php">
            	<input type="hidden" id="accion" name="accion" />
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail2" name="email" placeholder="Email address" required autofocus onblur="verificaEmail(this.value);">
                <input type="password" id="inputPassword2" name="password" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Recordarme
                    </label>
                </div>
                <button class="btn" onclick="loguear();">Ingresar</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                &iquest;Olvid&oacute; su contrase&ntilde;a&#63;
            </a>
			<label id="err_login" style="visibility:hidden; color: red; margin-top: 10px;">
            	Login incorrecto
			</label>            
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>

<?php 

	session_start();
	
	require_once "gastosModelo.php";
	
	$accion = isset($_POST['accion']) ? $_POST['accion'] : "";
	
	if($accion == "login"){
		
		$user = trim($_POST['email']);
		$pass = trim($_POST['password']);
		$passEnc = hash("sha256", $pass);
		
		$gastosModel = new gastosModelo();
    	$id_usuario = $gastosModel->login($user, $passEnc);
		
    	if($id_usuario != ""){
    	    $_SESSION['userid'] = $id_usuario;
    		echo "<script>location.href = 'gastos.php';</script>";
    		//die();
    	}else{
    		echo "<script>document.getElementById('err_login').style.visibility = 'visible';</script>";
    	}
		
	}
	
?>

</html>
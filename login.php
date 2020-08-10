<?php

session_start();
if(isset($_SESSION['logado'])){
	header("location: redirect.php");
}
	
?>
<!DOCTYPE html>
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<link rel='icon' type="icon" href='img/logo.png'>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<!--script src="js/main.js"></script-->
	
	<script src="js/bootstrap.js"></script>
	<script>
		function fadd(){
			$('#erro').hide().fadeIn(1000);
			$('#erro').delay(4300).slideUp();
		}

	</script>
	<style>
		.alert-danger{
			background-color: #e65865;
			color: #fff4f5;
		}
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-04.jpg'); transition: 2s ease-in" id='background'>
			<div class="wrap-login100" style="box-shadow: 0em 0em 20px 10px #0597ff; transition: 2s ease-in; padding:0" id="log">
				<div class="wrap-login100" style="box-shadow: inset 0em 0em 10px 6px #0597ff; transition: 2s ease-in" id="log1">	
					<form class="login100-form validate-form" action="valida.php" method="POST">
						<span class="login100-form-logo" style="background-color: transparent;border-bottom: 2px #02ff0a solid;  border-radius: 0px;">
							<img src='img/vip-white.png' width="190px">
						</span>
						
						<div class="wrap-input100 validate-input" data-validate = "Enter username">
							<input class="input100" type="text" name="username" placeholder="Usuário" required autofocus>
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate="Enter password">
							<input class="input100" type="password" name="password" placeholder="Senha" required>
							<span class="focus-input100" data-placeholder="&#xf191;"></span>
						</div>
						<center>
							<div class="g-recaptcha" data-theme='dark' data-sitekey="6Lcve6cUAAAAAMF9wF0iVA0kjJyYBExugG_BtvEN" ></div>
						</center>
						<br>
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Login
							</button>
						</div>
	<?php
		if(isset($_SESSION['alert'])){
			if($_SESSION['alert']==1){
				echo "
				<div class='alert alert-".$_SESSION['classe']."' role='alert' style='position: fixed; bottom: 10px; left: 15px;' id='erro'>
					".$_SESSION['msg']."
				</div>";
				echo "<script>fadd();</script>";
				$_SESSION['alert'] = 0;
			}
		}	
	?>
					</form>
				</div>
			</div>
	<div style="position: fixed; bottom: 10px; right: 15px; color: #0b12379e;">
		BY BRUNO VASCONCELLOS
	</div>
		</div>
	</div>
	<script>
		
		
		var op = 0;

		function mudaCor(){
			if(op == 0){
				document.getElementById('log').style.boxShadow = "0em 0em 20px 10px #05e8ff";
				document.getElementById('log1').style.boxShadow = "inset 0em 0em 10px 6px #05e8ff";
			}
			if(op == 1){
				document.getElementById('log').style.boxShadow = "0em 0em 20px 10px #05ff97";
				document.getElementById('log1').style.boxShadow = "inset 0em 0em 10px 6px #05ff97";
			}
			if(op == 2){
				document.getElementById('log').style.boxShadow = "0em 0em 20px 10px #05ff46";
				document.getElementById('log1').style.boxShadow = "inset 0em 0em 10px 6px #05ff46";
			}
			if(op == 3){
				document.getElementById('log').style.boxShadow = "0em 0em 20px 10px #4eff05";
				document.getElementById('log1').style.boxShadow = "inset 0em 0em 10px 6px #4eff05";
			}
			if(op == 4){
				document.getElementById('log').style.boxShadow = "0em 0em 20px 10px #aaff05";
				document.getElementById('log1').style.boxShadow = "inset 0em 0em 10px 6px #aaff05";
			}
			if(op == 5){
				document.getElementById('log').style.boxShadow = "0em 0em 20px 10px #ffec05";
				document.getElementById('log1').style.boxShadow = "inset 0em 0em 10px 6px #ffec05";
				op=0;
			}			
			op++;
		}
		setInterval("mudaCor()", 2500);


		function trocaBack(){
			var atual = document.getElementById('background').style.backgroundImage;
			if(atual == 'url("images/bg-04.jpg")'){
				document.getElementById('background').style.backgroundImage = 'url("images/bg-05.jpg")';
			}else if(atual == 'url("images/bg-02.jpg")'){
				document.getElementById('background').style.backgroundImage = 'url("images/bg-04.jpg")';
			}else{
				document.getElementById('background').style.backgroundImage = 'url("images/bg-02.jpg")';
			}
		}
		setInterval("trocaBack()", 10000);
	</script>
</body>
</html>
<?php
	session_start();
	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
<html>
<head>
	<title>Geovendas</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/favicon.png">
	
	<style>
		.op{
			width: auto;
			height: auto;
			background-color: #002060;
			margin: 50px;
		}
		.op1{
			width: auto;
			height: auto;
			background-color: #00b050;
			margin: 50px;	
		}
	</style>
</head>
<body>
	<table align="center" width="100%" style="background-color: #150a50" border="0">
		<tr>
			<td align="right" style="width: 46%">
				<a href="redirect.php">
					<img src="img/vip-white.png" width="100%" style="max-width: 200px">
				</a>
			</td>
			<td>
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Viabilidade</font>
			</td>
		</tr>
	</table>
	<div style="position: absolute; right: 2px; top: 2px;" onclick="sair()">
		<img src="img/sairr.png" width="60px" title='Sair'>
	</div>
	<script>
		function sair(){
			var op = confirm("Deseja realmente sair?");
			if(op){
				location.href = 'logout.php';
			}
		}
	</script>
	<div class="container">
		<table align="center">
			<tr>
				<td>
					<div class="op">
						<a href="consulta_casa.php?t=casa">
							<img src="img/casa.png" title="Casa">
						</a>
					</div>
				</td>
				<td align="center">
					<label style="font-weight: bold; font-size: 30px; font-family: Arial black">OU</label>
				</td>
				<td>
					<div class="op1">
						<a href="consulta_geo.php">
							<img src="img/predio.png" title="Prédio">
						</a>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
</body>
</html>

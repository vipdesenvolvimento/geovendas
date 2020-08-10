<?php

	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}
	require 'connect.php';

?>
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
<!DOCTYPE html>
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
<html>
<head>
	<title>Exportar</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/favicon.png">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <style>
    	.del{
			border-radius: 100%;
			background-color: #ff0000a8;
			padding-top: 3px;
			color: white;
			font-weight: bold;
			font-family: Arial;
			width: 30px;
		}
		.del:hover{
			background-color: red;
		}
    </style>
    
</head>
<body>
	<table align="center" width="100%" style="background-color: #150a50" border="0">
		<tr>
			<td align="right" style="width: 46%">
				<a href="index2.php">
					<img src="img/vip-white.png" width="100%" style="max-width: 200px">
				</a>
			</td>
			<td>
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Exportar</font>
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
	<div class="container" style="padding-top: 50px">
		<center>
			<h3>Exportar para CSV</h3>
		</center>
		<form action="cvs_down.php" method="GET">
			<table align="center" class="table" style="width: 400px">
				<tr>
					<td>
						<label>Tipo:</label>
					</td>
					<td>
						<select name="tipo" class="form-control" id='tipo' required>
							<option value=''>------</option>
							<option value='casa'>Casa</option>
							<option value='predio'>Predio</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>Cidade:</label>
					</td>
					<td>
						<select name="cidade" class="form-control" id="cidade" required>
							<option value="">Selecione um tipo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button type="submit" class="btn btn-success">Exportar</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
 	
		<?php
			if(isset($_SESSION['alert'])){
				if($_SESSION['alert']==1){
					$_SESSION['alert']=0;
					$msg = $_SESSION['msg'];
					$tipo = $_SESSION['classe'];
					echo '
					<div class="alert bg-'.$tipo.' text-white"  role="alert" style="position: fixed; bottom: 20px; left: 20px">
						'.$msg.'
					</div>';
				}
			}

		?>
	<script src="js/jquery.js"></script>
	<script>
		
		$(document).ready(function(){
            $('#tipo').change(function(){
                $('#cidade').load('cidade.php?cidade='+$('#tipo').val() );

            });
        });
	</script>
</body>
</html>

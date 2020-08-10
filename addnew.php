<?php

	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}
?>
<html>
<head>
	<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
	<title>Novo</title>
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/jquery.mask.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/favicon.png">
    <style>
    	label{
    		font-weight: bold;
    	}
    	body{
			background-color: #eee;
		}
		option{
			font-weight: bold;
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
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Adicionar</font>
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
<div class="container" style="margin-top: 50px">
	<form method="POST" action="insertinto.php">
		<table class="table">
			<tr>
				<header style="font-weight: bold; font-size: 30px; text-align: center">Adicionar Nova Localidade</header>
				<td>
					<label>Tipo</label>
					<select name="tipoR"  class="form-control">
						<option value="casa" selected>Casa</option>
						<option value="predio">Predio</option>
					</select>
				</td>
				<td>
					<label>CEP</label>
					<input type="text" name="cep" maxlength="9" onkeypress="$(this).mask('00000-000')" class="form-control" placeholder="ex 99999-999" required>
				</td>
				<td>
					<label>Rua</label>
					<input type="text" name="logradouro" class="form-control" placeholder="Rua de exemplo" required>
				</td>
			</tr>
			<tr>
				<td>
					<label>Cidade</label>
					<input type="text" name="cidade" class="form-control" placeholder="Cidade" required>
				</td>
				<td>
					<label>Bairro</label>
					<input type="text" name="bairro" class="form-control" placeholder="Bairro" required>
				</td>
				<td>
					<label>Base</label>
					<input type="text" name="base" class="form-control" placeholder="Base" required>
				</td>
			</tr>
			<tr>
				<td>
					<label>Técnologia</label>
					<input type="text" name="tecnologia" class="form-control" placeholder="FTTH / FTTC" required>
				</td>
				<td>
					<label>Velocidade</label>
					<input type="text" name="velocidade" class="form-control" placeholder=" 8 / 12 MB" required>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<button type="submit" class="btn btn-secondary" style="font-size: 20px">Salvar</button>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
<?php
	session_start();
	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}
	if($_SESSION['permissao']==1){
		header("location: redirect.php");
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
			width: 300px;
			height: auto;
			background-color: #499a53;
			padding: 10px;
			margin-bottom: 10px;
			font-size: 20px;
			color: white;
			margin-top: 10px;
		}
		.op:hover{
			opacity: 0.8;
		}
		a{
			text-decoration: none;
			cursor: pointer;
		}

	</style>
</head>
<body>
	<table align="center" width="100%" style="background-color: #150a50" border="0">
		<tr>
			<td align="right" style="width: 46%">
				<img src="img/vip-white.png" width="100%" style="max-width: 200px">
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
				<td align="center">
					<a href="index.php">
						<label class="op">Consultar CEP</label>
					</a>
				</td>
			</tr>
			<tr>
				<td align="center">
					<a href="attlista.php">
						<label class="op">Atualizar lista</label>
					</a>
				</td>
			</tr>
			<tr>	
				<td align="center">
					<a href="addnew.php">
						<label class="op">Adicionar Novo</label>
					</a>
				</td>
			</tr>
			<tr>	
				<td align="center">
					<a href="import_csv.php">
						<label class="op">Importar CSV</label>
					</a>
				</td>
			</tr>
			<tr>	
				<td align="center">
					<a href="usuario.php">
						<label class="op">Usuarios</label>
					</a>
				</td>
			</tr>
			<tr>	
				<td align="center">
					<a href="compararua.php">
						<label class="op">Comparar</label>
					</a>
				</td>
			</tr>
			<tr>	
				<td align="center">
					<a href="export_page.php">
						<label class="op">Exportar</label>
					</a>
				</td>
			</tr>
			<tr>	
				<td align="center">
					<a href="promocao.php">
						<label class="op">Promoções</label>
					</a>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
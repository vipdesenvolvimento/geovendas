<?php
	$tipo = $_GET['tipo'];
	$ident = $_GET['id'];


	require 'connect.php';

	$query = "SELECT * FROM ".$tipo." where id = '".$ident."' ";
	
	$result = mysqli_query($connection, $query);
	$result->data_seek(0);
	$row = $result->fetch_assoc();

?>
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
	<title>Editar</title>
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
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Editar</font>
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
		<form method="POST" action="">
			<table class="table">
				<tr>
					<input type="hidden" name="tipos" value="<?php echo $tipo; ?>">
					<input type="hidden" name="ident" value="<?php echo $ident; ?>">
					<td>
						<label>CEP</label>
						<input type="text" name="CEP" value="<?php echo $row['cep']; ?>" maxlength="9" onkeypress="$(this).mask('00000-000')" class="form-control" placeholder="ex: 99999-999">
					</td>
					<td>
						<label>Endereço</label>
						<input type="text" name="logradouro" value="<?php echo $row['logradouro']; ?>" class="form-control">
					</td>
					<td>
						<label>Bairro</label>
						<input type="text" name="bairro" value="<?php echo $row['bairro']; ?>" class="form-control">
					</td>
				</tr>
				<tr>
					<td>
						<label>Cidade</label>
						<input type="text" name="cidade" value="<?php echo $row['cidade']; ?>" class="form-control"> 
					</td>
					<td>
						<label>Base</label>
						<input type="text" name="base" value="<?php echo $row['base']; ?>" class="form-control">
					</td>
					<td>
						<label>Técnologia</label>
						<input type="text" name="tecnologia" value="<?php echo $row['tecnologia']; ?>" class="form-control">
					</td>
				</tr>
				<tr>
					<td>
						<label>Velocidade</label>
						<input type="text" name="velocidade" value="<?php echo $row['velocidade']; ?>" class="form-control">
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<button type="submit" class="btn btn-secondary" style="font-size: 20px" name="submit">Salvar</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit'])){
		$cep = $_POST['CEP'];
		$logradouro = $_POST['logradouro'];
		$cidade = $_POST['cidade'];
		$bairro = $_POST['bairro'];
		$base = $_POST['base'];
		$tecnologia = $_POST['tecnologia'];
		$velocidade = $_POST['velocidade'];
		$ident = $_POST['ident'];
		$tipos = $_POST['tipos'];


		$query = "UPDATE ".$tipos." SET cep ='".$cep."', logradouro = '".$logradouro."', cidade='".$cidade."', bairro='".$bairro."', base='".$base."', tecnologia='".$tecnologia."', velocidade='".$velocidade."' where id = '".$ident."' ";
		$result = mysqli_query($connection, $query);
		echo "<script>alert('Dados Atualizados!'); location.href = 'attlista.php';</script>";
	}
?>
<?php
	if(!isset($_GET['t'])){
		header("Location: index.php");
	}

	$tipo = $_GET['t'];


?>
<html>
<head>

	<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
	<title><?php echo $tipo; ?></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/favicon.png">
	
	<style>
		.wher{
		    text-decoration: none;
		    color: red;
		}
		.wher:hover{
			color: #12345678;
		}
	</style>

</head>

<body>


	<table align="center" width="100%" style="background-color: #ccc" border="0">
		<tr>
			<td align="right" style="width: 46%">
				<a href="index.php"><img src="img/vip-white.png" width="100%" style="max-width: 200px"></a>
			</td>
			<td>
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Viabilidade</font>
			</td>
		</tr>
		<tr>
			<td align="right">
				<a href="index.php" class="wher">Inicio-></a><?php echo $tipo; ?>->
			</td>
		</tr>
	</table>



	<center>
		<div style="width: 300px;">
				<?php
					if($tipo == 'casa'){
						echo '<form action="consulta_casa.php" method="GET">
							<header style="margin-top: 20px; font-weight: bold">Selecione a Cidade</header>';
						$query = "SELECT * FROM casa group by cidade";
					}else if($tipo == 'predio'){
						echo '<form action="consulta_geo.php" method="GET">
							<header style="margin-top: 20px; font-weight: bold">Selecione a Cidade</header>';
						$query = "SELECT * FROM predio group by cidade";
					}else{
						header("Location: index.php");	
					}
					require 'connect.php';
					$result = mysqli_query($connection, $query);
					$result->data_seek(0);
					echo "<select name='cidade' class='form-control'>";
					while($row = $result->fetch_assoc()){
						echo "<option value='".$row['cidade']."'>".$row['cidade']."</option>";
					}
					echo "</select>";
				?>
				<button class="btn btn-success" style="margin-top: 20px">Validar</button>
			</form>
		</div>
	</center>


</body>


</html>
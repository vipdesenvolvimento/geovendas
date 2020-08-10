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
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
	<head>
		<title>Gerenciar</title>
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	    <link rel="icon" type="icon" href="img/favicon.png">
	    <style>
	    	.sele{
	    		border: 0;
	    		padding: 5px;
	    	}
	    	.sele:hover{
	    		background-color: black;
	    		color: #ccc;
	    	}
	    </style>
	</head>
	<style>
		body{
			background-color: #eee;
		}
		.del{
			border-radius: 100%;
			background-color: #ff0000a8;
			padding-top: 3px;
			color: white;
			font-weight: bold;
			font-family: Arial;
		}
		.del:hover{
			background-color: red;
		}
		.edit{
			border: 0;
			background-color: #999;
			color: white;
			padding: 5px 10px 5px 10px;
		}
		.edit:hover{
			background-color: #333333;
		}
	</style>

	<script>
		function deleter(id, tipo){
			var esc = confirm("Deseja realmente deletar?");
			if(esc){
				location.href = "delete.php?id="+id+"&tipo="+tipo;
			}
		}
		function edit(id, tipo){
			location.href = "edit.php?id="+id+"&tipo="+tipo;
		}
	</script>

	<body>
		<div style="width: 100%; background-color: #150a50">
			<table align="center" width="60%" style="background-color: #150a50" border="0">
				<tr>
					<td align="center">
						<a href="index2.php">
							<img src="img/vip-white.png" width="100%" style="max-width: 200px">
						</a>
					</td>
					<td>
						<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Lista de endereço</font>
					</td>
				</tr>
			</table>
		</div>
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
			<form method="GET" >
				<table class="table" style="width: 50%" align="center">
					<tr>
						<td>
							<label>CEP:</label>
							<?php
								if(isset($_GET['cep']) and ($_GET['cep'])!= ""){
							?>
									<input type="text" name="cep" value="<?php echo $_GET['cep']; ?>" autofocus maxlength="9" onkeypress="$(this).mask('00000-000')" class="form-control" placeholder="ex: 99999-999">
							<?php
								}else{
							?>
									<input type="text" name="cep" placeholder="ex: 99999-999" autofocus maxlength="9" onkeypress="$(this).mask('00000-000')" class="form-control">
							<?php	
								}
							?>
						</td>
						<td>
							<label>Endereço:</label>
							<?php
								if(isset($_GET['cep'])){
							?>
									<input type="text" name="logradouro" class="form-control" value="<?php echo $_GET['logradouro']; ?>">
							<?php
								}else{
							?>
									<input type="text" name="logradouro" class="form-control">
							<?php	
								}
							?>
						</td>
						<td>
							<label>Tipo</label>
							<select name="tipo" class="form-control">
								<option value="predio">Predio</option>
								<option value="casa" selected>Casa</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button type="submit" name="submit" class="btn btn-secondary">Consultar</button>
						</td>
					</tr>
				</table>
			</form>
			<?php
				if(isset($_GET['submit'])){
					require 'connect.php';
					$cep = $_GET['cep'];
					$logradouro = $_GET['logradouro'];
					$tipo = $_GET['tipo'];
					
					if(($cep =="") and ($logradouro == "")){
					}else{
						$query = "SELECT * FROM ".$tipo." where cep like '%".$cep."%' and logradouro like '%".$logradouro."%' LIMIT 100 ";
						$result = mysqli_query($connection, $query);
						$cont = mysqli_num_rows($result);
						$result->data_seek(0);		
						echo "<table class='table table-hover'>";
						echo "
						<th colspan='2'>Ação</th>
						<th>CEP</th>
						<th>Rua</th>
						<th>Cidade</th>
						<th>Bairro</th>
						<th>Base</th>
						<th>Técnologia</th>
						<th>Velocidades</th>
						";
						if($cont==0){

							echo "<tr><td colspan='7' align='center'><b>Endereço ainda não foi cadastrado!</b></td></tr>";
						}
						while($row = $result->fetch_assoc()){
							echo "
							<tr>
								<td>
									<button onclick='deleter(".$row['id'].", ".'"'.$tipo.'"'.")' class='del'>X</button>
								</td>
								<td>
									<button onclick='edit(".$row['id'].", ".'"'.$tipo.'"'.")' class='edit'>Editar</button>
								</td>
								<td>
									".$row['cep']."
								</td>
								<td>
									".$row['logradouro']."
								</td>
								<td>
									".$row['cidade']."
								</td>
								<td>
									".$row['bairro']."
								</td>
								<td>
									".$row['base']."
								</td>
								<td>
									".$row['tecnologia']."
								</td>
								<td>
									".$row['velocidade']."
								</td>
							</tr>
							";
						}
						echo "</table>";
					}
				}
			?>
		</div>
		<div id="tes"></div>
	</body>
</html>
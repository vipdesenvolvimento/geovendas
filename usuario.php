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
	<title>Usuario</title>
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
    <script>
    	function deletarUser(tx){
    		var opp = confirm("Deseja realmente deletar Usuario?");
    		if(opp){
    			location.href = "deluser.php?ident="+tx;
    		}
    	}
    </script>
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
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Usuario</font>
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
		<center>
			<button class="btn btn-success" style="margin: 20px;" data-toggle='modal' data-target='#novo'>Adicionar Novo</button>
			<button class="btn btn-success" style="margin: 20px;" data-toggle='modal' data-target='#self'>Trocar senha</button>
		</center>
		<?php
			$query = "SELECT * FROM usuarios where id != '1' ";
			$result = mysqli_query($connection, $query);
			$result->data_seek(0);
			echo "<table class='table'>";
			echo "<th>Nome</th> <th>Usuario</th> <th>Tipo</th>";
			while($row = $result->fetch_assoc()){
				$tipo = $row['tipo'];
				if($tipo == 0){
					$tipo = "Administrador";
				}else{
					$tipo = "Agente";
				}
				echo "
				<tr>
					<td>
						".$row['name']."
					</td>
					<td>
						".$row['username']."
					</td>
					<td>
						".$tipo."
					</td>
					<td>
						<button class='del' onclick='deletarUser(".$row['id'].")'>X</button>
					</td>
				</tr>
				";
			}
			echo "</table>";

		?>		

	</div>



	<div class='modal fade' id='novo' tabindex='-1' role='dialog' aria-labelledby='novo' aria-hidden='true'>
		  <div class='modal-dialog' role='document'>
		    <div class='modal-content'>
		      <div class='modal-header'>
		        <h5 class='modal-title' id='Novo'>Novo Usuario</h5>
		        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
		          <span aria-hidden='true'>&times;</span>
		        </button>
		      </div>
		      <form action='addnewuser.php' method='POST'>
			      	<div class='modal-body'>
			        
					<table>
						<tr>
							<td align="right">
								<label>Nome Completo:</label>
							</td>
							<td>
								<input type="text" name="nome" class="form-control" minlength="3" required autofocus>
							</td>
						</tr>
						<tr>
							<td align="right">
								<label>Usuario:</label>
							</td>
							<td>
								<input type="text" name="user_name" class="form-control" minlength="3" required>
							</td>
						</tr>
						<tr>
							<td align="right">
								<label>Senha:</label>
							</td>
							<td>
								<input type="password" name="password" class="form-control" minlength="3" required>
							</td>
						</tr>
						<tr>
							<td align="right">
								<label>Tipo:</label>
							</td>
							<td>
								<select name='tipo' class="form-control">
									<option value="1">Agente</option>
									<option value="0">Administrador</option>
								</select>
							</td>
						</tr>
					</table>

		
			      </div>
			      <div class='modal-footer'>
			        <button type='button' class='btn btn-outline-danger' data-dismiss='modal'>Cancelar</button>
			        <button type='submit' class='btn btn-primary'>Adicionar</button>
			      </div>
			    </form>
		    </div>
		  </div>
		</div>



		<div class='modal fade' id='self' tabindex='-1' role='dialog' aria-labelledby='self' aria-hidden='true'>
		  <div class='modal-dialog' role='document'>
		    <div class='modal-content'>
		      <div class='modal-header'>
		        <h5 class='modal-title' id='self'>Atualizar</h5>
		        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
		          <span aria-hidden='true'>&times;</span>
		        </button>
		      </div>
		      <form action='ttsstt.php' method='POST'>
			      	<div class='modal-body'>
			        
					<table>
						<tr>
							<td align="right">
								<label>Usuario:</label>
							</td>
							<td>
								<input type="text" name="user_name" class="form-control" minlength="3" value="<?= $_SESSION['userr']; ?>" required>
							</td>
						</tr>
						<tr>
							<td align="right">
								<label>Senha:</label>
							</td>
							<td>
								<input type="password" name="password" class="form-control" minlength="3" required>
							</td>
						</tr>
					</table>

		
			      </div>
			      <div class='modal-footer'>
			        <button type='button' class='btn btn-outline-danger' data-dismiss='modal'>Cancelar</button>
			        <button type='submit' name="submit" class='btn btn-primary'>Atualizar</button>
			      </div>
			    </form>
		    </div>
		  </div>
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
</body>
</html>

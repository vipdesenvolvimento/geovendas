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
	<title>Promoção</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/favicon.png">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/jquery.mask.min.js"></script>
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
				<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Promoção</font>
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

		function deletar(tx){
			if(confirm("Deseja realmente deletar?")){
				location.href = 'delete.php?tipo=rules&id='+tx;
			}
		}
	</script>
	<div class="container" style="padding-top: 50px">

		<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Adicione sua condição de promoção</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="startTime();">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table  class="table" style="width: 400px">
								<form action="addrule.php" method="POST">
									<tr>
										<td>
											<label>Tipo:</label>
										</td>
										<td>
											<select name="tipo" class="form-control" id='tipo' required>
												<option value='TODAS'>Todos</option>
												<option value='casa'>Casa</option>
												<option value='predio'>Prédio</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<label>Tecnologia:</label>
										</td>
										<td>
											<select name="tecnologia" class="form-control" id='tecnologia' required>
												<option value='TODAS'>Todas</option>
												<option value='FTTH'>FTTH</option>
												<option value='FTTC'>FTTC</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<label>Cidade:</label>
										</td>
										<td>
											<select name="cidade" class="form-control" id="cidade" required>
												<option value='TODAS'>Todas</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<label>Bairro:</label>
										</td>
										<td>
											<select name="bairro" class="form-control" id="bairro" required>
												<option value="TODAS">Todos</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<label>Rua:</label>
										</td>
										<td>
											<input type="text" name="rua" class="form-control" id="rua">
										</td>
									</tr>
									<tr>
										<td>
											<label>Descrição da promoção:</label>
										</td>
										<td>
											<textarea name="promocao" rows="5" cols="60" class="form-control"></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary">Adicionar</button>
											
										</td>
									</tr>
								</form>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
		<center>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addnew" style="margin-bottom: 20px;">
		  		Nova Promoção
			</button>
		</center>
	
		<table  class="table table-hover" style="width: 800px" align="center">
			<tr>
				<td align="center" colspan="2">
					<h3>Lista de Promoções</h3>
				</td>
			</tr>

				<?php
					$query = "SELECT * FROM rules";
					$result = mysqli_query($connection, $query);
					$result->data_seek(0);
					while($row = $result->fetch_assoc()){
						echo "<tr>";
						echo "	<td>";
						echo "<b>TIPO</b> ".$row['tipo0']." ".$row['param0'].",  <b>Técnologia</b> ".$row['tipo1']." ".$row['param1'].",  <b>Cidade</b> ".$row['tipo2']." ".$row['param2'].",  <b>Bairro</b> ".$row['tipo3']." ".$row['param3'].",  <b>Rua</b> ".$row['tipo4']." ".$row['param4']."<br> <b>Descrição:</b> ".$row['promocao'];

						echo "	</td>";
						echo "	<td>";
						echo "<button class='del' onclick='deletar(".$row['id'].")'>X</button>";
						echo "</tr>";
					}

				?>
		</table>
					
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
                $('#cidade').load('cidade1.php?tipo='+$('#tipo').val()+'&tec='+$('#tecnologia').val() );

            });
        });
        $(document).ready(function(){
            $('#tecnologia').change(function(){
                $('#cidade').load('cidade1.php?tipo='+$('#tipo').val()+'&tec='+$('#tecnologia').val() );

            });
        });

        $(document).ready(function(){
            $('#cidade').change(function(){
                $('#bairro').load('bairros.php?tipo='+$('#tipo').val()+'&tec='+$('#tecnologia').val()+'&cidade='+$('#cidade').val() );
                


            });
        });
	</script>

</body>
</html>

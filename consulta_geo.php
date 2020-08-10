<?php

	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

?>
<html>	
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
<head>
	<title>Geovendas</title>
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/jquery.mask.min.js"></script>
	<script src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/favicon.png">

</head>
	
<style>
	
	body{
		background-color: #eee;
	}
	.sele{
		border: 0;
		padding: 5px;
		border-radius: 5px;
		width: 150px;
	}
	.sele:hover{
		background-color: black;
		color: #ccc;
	}
	.wher{
	    text-decoration: none;
	    color: red;
	}
	.wher:hover{
		color: #12345678;
	}
	.titulo{
		font-weight: bold;
	}
	.conteudo{
		font-size: 15px;
		margin: 5px;
		padding: 9px;
		border-radius: 5px;
		background-color: #fff;
		color: black;
		border:0;
		
		font-weight: regular;
	}
	.modal-lg, .modal-xl{
		max-width: 850px;

	}
	.modal-content{
		background-color: #F0F0F0;
	}
	.modal-header{
		background-color: #004E88;
		color: #FFF;
		padding: 0px;
	}
	.close1{
		height: 60px;
		width: 80px;
		background-color: #AFCA0B;
		color: white;
		border: 0;
		border-top-right-radius: 6px;
		font-size: 30px;
	}
	.close1:hover{
		opacity: 0.9;
	}
	.algv{
		font-size: 50px;
		color: #AFCA0B;
		margin-top: -40px;
		margin-bottom: -5px;
	}
	.FTTH{
		background-color: #AFCA0B;
		border-radius: 8px;
		width: 90px;
		height: 40px;
		color: white;
		border: 0px;
		font-weight: bold;
	}
	.FTTC{
		background-color: #004E88;
		border-radius: 8px;
		width: 90px;
		height: 40px;
		color: white;
		border: 0px;
		font-weight: bold;
	}
	.headerr{
		font-weight: bold;
		font-size: 25px;
		padding-left: 10px;
	}

</style>
	
<body>
	<div style="width: 100%; background-color: #150a50">
		<table align="center" width="60%" style="background-color: #150a50" border="0">
			<tr>
				<td>
					<a href="consulta_casa.php"><button class="sele btn btn-success">Casa? clique aqui</button></a>
				</td>
				<td align="center">
					<a href="index.php">
						<img src="img/vip-white.png" width="100%" style="max-width: 200px">
					</a>
				</td>
				<td style="width: 230px">
					<font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">Pesquisar Predio</font>
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="left" style=" color: white">
					Você está em: <b><a href="index.php" class="wher">Inicio-></a>Predio</b>
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
			
			<table class="table" style="width: 40%" align="center">
				<tr>
					<td>
						<label>CEP:</label>
						<?php
							if(isset($_GET['cep']) and ($_GET['cep'])!= ""){
						?>
								<input type="text" name="cep" value="<?php echo $_GET['cep']; ?>" autofocus maxlength="9" minlength="3" onkeypress="$(this).mask('00000-000')" class="form-control" placeholder="ex: 99999-999">
						<?php
							}else{
						?>
								<input type="text" name="cep" placeholder="ex: 99999-999" autofocus maxlength="9" minlength="3" onkeypress="$(this).mask('00000-000')" class="form-control">
						<?php	
							}
						?>
					</td>
					<td>
						<label>Endereço:</label>
						<?php
							if(isset($_GET['cep'])){
						?>
								<input type="text" name="logradouro" class="form-control" value="<?php echo $_GET['logradouro']; ?>" minlength="4">
						<?php
							}else{
						?>
								<input type="text" name="logradouro" class="form-control" minlength="4">
						<?php	
							}
						?>
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
				
				if(($cep =="") and ($logradouro == "")){

				}else{
					$logradouro = str_replace("'", '', $logradouro);
					
					$query = "SELECT * FROM predio where cep like '%".$cep."%' and logradouro like '%".$logradouro."%' LIMIT 100 ";
				
					$result = mysqli_query($connection, $query);
					$cont = mysqli_num_rows($result);
					
					$result->data_seek(0);
					if($cont==0){

						echo "<tr><td colspan='7' align='center'><b>Este endereço ainda não possui a cobertura Vip Fibra!</b></td></tr>";
					}else if($cont==1){
						$row = $result->fetch_assoc();
						$planos = $row['velocidade'];
						$planos = explode('/', $planos);
						echo '
<div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        	<div  style="padding: 10px;" class="headerr">
        	<h4 class="headerr"> Legal! Temos viabilidade.</h4>
        	</div>
            <button type="button" class="close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="background-color:#AFCA0B">&times;</span></button>
            
        </div>
        <div class="modal-body">';
						echo '
			<table style="width: 100%">
				<!--tr><td>.</td><td style="width:25%">.</td><td style="width:25%">.</td><td style="width:25%">.</td></tr-->
				<tr>
					<td colspan="1" style="width:170px">
						<b><label class="algv">__</label></b>
					</td>
					<td colspan="1" style="width:170px">
						<b><label class="algv">__</label></b>
					</td>
				</tr>
				<tr>
					<td colspan="1" style="width:170px">
						<label class="titulo">CEP</label><br>
						<input type="text" value="'.$row['cep'].'" class="conteudo" readonly style="width:170px">
					</td>
					<td colspan="3">
						<label class="titulo">Endereço</label><br>
						<textarea  class="conteudo" style="width:580px" readonly>'.$row["logradouro"].'</textarea>
					</td>
				</tr>
				<tr style="width:170px; height: 30px;">
					<td colspan="1" style="width:170px; height: 30px;">
						<b><label class="algv">__</label></b>
					</td>
					<td style="width:170px; height: 30px;"></td>
					<td colspan="1" style="width:170px; height: 30px;">
						<b><label class="algv">__</label></b>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label class="titulo">Bairro</label><br>
						<input type="text" value="'.$row["bairro"].'" class="conteudo" readonly style="width:376px">
					</td>
					<td colspan="2">
						<label class="titulo">Cidade</label><br>
						<input type="text" value="'.$row["cidade"].'" class="conteudo" readonly style="width:376px">
					</td>
				</tr>
				<tr style="width:170px; height: 30px;">
					<td colspan="1" style="width:170px; height: 30px;">
						<b><label class="algv">__</label></b>
					</td>
					<td style="width:170px; height: 30px;"></td>
					<td colspan="1" style="width:170px; height: 30px;">
						<b><label class="algv">__</label></b>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label class="titulo">Base</label><br>
						<input type="text" value="'.$row["base"].'" class="conteudo" readonly style="width:376px">
					</td>
					<td colspan="2">
						<label class="titulo">Técnologia</label><br>
						<input type="text" value="'.$row["tecnologia"].'" class="conteudo" readonly style="width:376px">
					</td>
				</tr>';
				$query1 = "SELECT * from rules";
			$result1 = mysqli_query($connection, $query1);
			$result1->data_seek(0);
			$promocao = "";
			$ruaaa = 0;
			$bairroo = 0;
			$cidadee = 0;
			$tecnologiaa = 0;
			$tipoo = 0;

			while($row1 = $result1->fetch_assoc()){

				
				if( ($row1['tipo4']== '=') and ($ruaaa == 0) and ('casa' != $row1['param0']) ){
					if($row['logradouro'] == $row1['param4']){
						$promocao = $row1['promocao'];
						$ruaaa = 1;
					}
				}else{
					if( ($row1['tipo3']== '=') and ($bairroo==0)  and ($ruaaa == 0) and ('casa' != $row1['param0']) ){
						if($row['bairro'] == $row1['param3']){
							$promocao = $row1['promocao'];
							$bairroo = 1;
						}
					}else{
						if( ($row1['tipo2']== '=') and ($cidadee==0) and ($bairroo==0)  and ($ruaaa == 0) and ('casa' != $row1['param0']) ){
							if($row['cidade'] == $row1['param2']){
								$promocao = $row1['promocao'];
								$cidadee = 1;
							}
						}else{
							if( ($row1['tipo1']== '=') and ($tecnologiaa==0)  and ($cidadee==0) and ($bairroo==0)  and ($ruaaa == 0) and ('casa' != $row1['param0']) ){
								if($row['tecnologia'] == $row1['param1']){
									$promocao = $row1['promocao'];
									$tecnologiaa = 1;
								}
							}else{
								if( ($row1['tipo0']== '=') and ($tipoo==0)  and ($tecnologiaa==0)  and ($cidadee==0) and ($bairroo==0)  and ($ruaaa == 0) and ('casa' != $row1['param0']) ){
									if('casa' != $row1['param0']){
										$promocao = $row1['promocao'];
										$tipoo=1;
									}
								}else if( ($tipoo ==0)  and ($tecnologiaa==0)  and ($cidadee==0) and ($bairroo==0)  and ($ruaaa == 0) and ('casa' != $row1['param0']) ){
									$promocao = $row1['promocao'];
								}

							}

						}

					}
					
				}
			
			}

			if($promocao!=""){
				echo '
					<tr style="width:170px; height: 30px;">
						<td colspan="1" style="width:170px; height: 30px;">
							<b><label class="algv">__</label></b>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<label class="titulo">Promoção</label>
							<input type="text" value="'.$promocao.'" class="conteudo" readonly style="width:95%; background-color: #afca0b; padding: 10px; color: white; font-weight: bold">
						</td>
					';


				echo "<br>";
					
			}



				echo '
				<tr style="width:170px; height: 30px;">
					<td colspan="1" style="width:170px; height: 30px;">
						<b><label class="algv">__</label></b>
					</td>
				</tr>
				<tr>
					<td>
						<b>Velocidades Disponiveis</b>
					</td> 
				</tr>
			</table>';
			echo '<br>
				<table>
					<tr>
			';
			if($row['tecnologia'] == "FTTH"){
				$classe = "FTTH";
			}else{
				$classe = "FTTC";
			}
			$final = count($planos);
			$final --;
			for($i = 0; $i<$final ; $i++){
				echo "<td style='width: 100px'><button class='".$classe."'>".$planos[$i]."MB</button></td>";
			}

			echo "<td style='width: 100px'><button class='".$classe."'>".$planos[$final]."</button></td>";

			echo '</tr></table></div>
        
    </div>
</div>';
echo "<script>

$(document).ready(function() {
    $('#exemplomodal').modal('show');
})
</script>";
					}else{
						echo "<table class='table table-hover'>";
					echo "
					<th>CEP</th>
					<th>Rua</th>
					<th>Cidade</th>
					<th>Bairro</th>
					<th>Base</th>
					<th>Técnologia</th>
					<th>Velocidades</th>
					";
						while($row = $result->fetch_assoc()){

							echo "
							<tr>
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
			}

		?>
	</div>

</body>
	
</html>

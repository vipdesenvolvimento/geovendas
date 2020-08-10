<?php


	header("Content-Type: application/json; charset=utf-8");
	header("Access-Control-Allow-Origin: *");

	require "connect.php";
	if(!isset($_GET['cep'])){
		$return = array('variables'=> array('status' => 404, 'return' => false, 'message' => 'Vazio'));
	}else{
		
		$cep = $_GET['cep'];
		$dataHora = date('Y-m-d H:i:s');
		$cep = str_replace('-', '', $cep);
		$cep = str_replace('-', ' ', $cep);
		$tam = strlen($cep);
		if($tam !=8){
			$return = array('variables'=> array('status' => 402, 'return' => false, 'message' => 'Cep incompleto'));
		}else{
			$cep = $cep[0].$cep[1].$cep[2].$cep[3].$cep[4].'-'.$cep[5].$cep[6].$cep[7];

			$query = "SELECT * FROM casa where cep = '".$cep."' ";
			$result = mysqli_query($connection, $query);
			$result->data_seek(0);
			$count = mysqli_num_rows($result);
			if($count==1){
				$return = array('variables'=> array('status' => 200, 'return' => true, 'message' => 'temos viabilidade'));
			}else{
				$query = "SELECT * FROM predio where cep = '".$cep."' ";
				$result = mysqli_query($connection, $query);
				$result->data_seek(0);
				$count = mysqli_num_rows($result);
				if($count ==1){
					$return = array('variables'=> array('status' => 200, 'return' => true, 'message' => 'temos viabilidade'));
				}else{
					### Guardar CEP###
					$query = "INSERT INTO pedidos_cep(cep, dataHora) VALUES('".$cep."', '".$dataHora."') ";
					$result = mysqli_query($connection, $query);
					$return = array('variables'=> array('status' => 300, 'return' => false, 'message' => 'Sem viabilidade'));
				}
			}

		}

	}
	echo json_encode($return);

?>
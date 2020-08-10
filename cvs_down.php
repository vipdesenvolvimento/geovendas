<?php

	$saida = fopen('php://output', 'w');
	$tipo = $_GET['tipo'];
	$cidade = $_GET['cidade'];


	#$datainicio = $_POST['data1'];
	#$datafim = $_POST['data2'];
	
	$nome = date("Y-m-d-H-i-s");
	$arquivo = "file/Geovendas.csv";
	$dados ='';
	require 'connect.php';
	
	$dados = "Logradouro; Bairro; Cidade; Base; Tecnologia; CEP; Velocidade \n";
	header('Content-Type: text/csv; charset=ISO-8859-1');
	header('Content-Disposition: attachment; filename= Geovendas_'.$cidade.'.csv');
	
	$query = "SELECT * FROM ".$tipo." where cidade = '$cidade' ";
	mysqli_SET_charset($connection, 'utf-8');
	$result = mysqli_query($connection, $query);
	$result->data_seek(0);
	while ($row = $result->fetch_assoc()) {
		
		$dados .= "".$row['logradouro']."";
		$dados .= ";".$row['bairro']."";
		$dados .= ";".$row['cidade']."";
		$dados .= ";".$row['base']."";
		$dados .= ";".$row['tecnologia']."";
		$dados .= ";".$row['cep']."";
		$dados .= ";".$row['velocidade']."";
		$dados .= "\n";
	}

	if(fwrite($file = fopen($arquivo,'w+'), $dados)){
		fclose($file);
	}
	echo $dados;


?>
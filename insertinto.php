<?php

	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}


	require 'connect.php';

	$tipo = $_POST['tipoR'];
	$cep = $_POST['cep'];
	$logradouro = $_POST['logradouro'];
	$cidade = $_POST['cidade'];
	$bairro = $_POST['bairro'];
	$base = $_POST['base'];
	$tecnologia = $_POST['tecnologia'];
	$velocidade = $_POST['velocidade'];

	$logradouro = str_replace("'", '', $logradouro);
	$logradouro = str_replace('"', '', $logradouro);

	$cidade = str_replace("'", '', $cidade);
	$cidade = str_replace('"', '', $cidade);

	$bairro = str_replace("'", '', $bairro);
	$bairro = str_replace('"', '', $bairro);

	$base = str_replace("'", '', $base);
	$base = str_replace('"', '', $base);

	$tecnologia = str_replace("'", '', $tecnologia);
	$tecnologia = str_replace('"', '', $tecnologia);

	$velocidade = str_replace("'", '', $velocidade);
	$velocidade = str_replace('"', '', $velocidade);

	$query = "INSERT INTO ".$tipo."(cep, logradouro, cidade, bairro, base, tecnologia, velocidade) VALUES('$cep', '$logradouro', '$cidade', '$bairro', '$base', '$tecnologia', '$velocidade')";
	$result = mysqli_query($connection, $query);
	echo "<script>alert('Adicionado com sucesso!');</script>";
	echo "<script>location.href = 'index2.php';</script>";
	//header("Location: addnew.php");
?>


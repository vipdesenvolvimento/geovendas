<?php

	
	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}
	require 'connect.php';

	$tipo0 = $_POST['tipo'];
	$tipo1 = $_POST['tecnologia'];
	$tipo2 = $_POST['cidade'];
	$tipo3 = $_POST['bairro'];
	$tipo4 = $_POST['rua'];
	$promocao = $_POST['promocao'];

	$tipo0 = str_replace('%20', ' ', $tipo0);
	$tipo1 = str_replace('%20', ' ', $tipo1);
	$tipo2 = str_replace('%20', ' ', $tipo2);
	$tipo3 = str_replace('%20', ' ', $tipo3);
	$tipo4 = str_replace('%20', ' ', $tipo4);


	if($tipo0 == "TODAS"){
		$param0 = "";
	}else{
		$param0 = $tipo0;
		$tipo0 = "=";
	}


	if($tipo1 == "TODAS"){
		$param1 = "";
	}else{
		$param1 = $tipo1;
		$tipo1 = "=";
	}

	if($tipo2 == "TODAS"){
		$param2 = "";
	}else{
		$param2 = $tipo2;
		$tipo2 = "=";
	}

	if($tipo3 == "TODAS"){
		$param3 = "";
	}else{
		$param3 = $tipo3;
		$tipo3 = "=";
	}

	if($tipo4 == ""){
		$tipo4 = "TODAS";
	}else{
		$param4 = $tipo4;
		$tipo4 = "=";
	}


	$query = "INSERT INTO rules (tipo0, param0, tipo1, param1, tipo2, param2, tipo3, param3, tipo4, param4, promocao) VALUES ('".$tipo0."', '".$param0."', '".$tipo1."', '".$param1."', '".$tipo2."', '".$param2."', '".$tipo3."', '".$param3."', '".$tipo4."', '".$param4."', '".$promocao."') ";
	$result = mysqli_query($connection, $query);

	if($result){
		session_start();
		$_SESSION['alert']=1;
		$_SESSION['msg'] = "Promoção Adicionada";
		$_SESSION['classe'] = "success";
	}else{
		$_SESSION['alert']=1;
		$_SESSION['msg'] = "Erro ao Adicionar";
		$_SESSION['classe'] = "danger";
	}
	header("location: promocao.php");

?>
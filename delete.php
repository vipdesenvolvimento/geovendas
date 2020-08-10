<?php


	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}


	$tipo = $_GET['tipo'];
	$ident = $_GET['id'];


	require 'connect.php';

	$query = "DELETE FROM ".$tipo." where id = '".$ident."' ";
	
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	echo "<script>window.history.back();</script>";
	// header("Location: attlista.php");

?>

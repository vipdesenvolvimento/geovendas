<?php
	
	session_start();

	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}

	require 'connect.php';


	$usuario = $_POST['user_name'];
	$nomeU = $_POST['nome'];
	$senha = md5($_POST['password']);
	$tipo = $_POST['tipo'];

	$usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
	$nomeU = filter_var($nomeU, FILTER_SANITIZE_STRING);
	$tipo = filter_var($tipo, FILTER_SANITIZE_NUMBER_INT);

	$query = "INSERT INTO usuarios(name, username, password, tipo) VALUES('".$nomeU."', '".$usuario."', '".$senha."', '".$tipo."')";

	$result = mysqli_query($connection, $query);

	header("location: usuario.php");

?>
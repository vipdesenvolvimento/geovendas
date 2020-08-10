<?php
	
	session_start();
	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}


	require 'connect.php';
	$ident = $_GET['ident'];
	$query = "delete from usuarios where id = ".$ident." ";

	$result = mysqli_query($connection, $query);

	if($result){
		$_SESSION['alert'] = 1;
		$_SESSION['msg'] = "Usuario Deletado";
		$_SESSION['classe'] = "success";
	}else{
		$_SESSION['alert'] = 1;
		$_SESSION['msg'] = "Erro ao deletar usuario!";
		$_SESSION['classe'] = "danger";
	}


	header("location: usuario.php");
	

?>
<?php
	
	session_start();
	if(!isset($_SESSION['logado'])){
		header("location: login.php");
	}

	if($_SESSION['permissao']==1){
		header("location: redirect.php");
	}


	if(isset($_POST['submit'])){

		require 'connect.php';
		$nome_user = $_POST['user_name'];
		$senha = md5($_POST['password']);
		$nome_user = filter_var($nome_user, FILTER_SANITIZE_STRING);

		$query = "UPDATE usuarios set username = '$nome_user', password = '$senha' where id = '".$_SESSION['identt']."' ";

		$result = mysqli_query($connection, $query);

		if($result){
			$_SESSION['alert'] = 1;
			$_SESSION['msg'] = "Dados Atualizados!";
			$_SESSION['classe'] = "success";
		}else{
			$_SESSION['alert'] = 1;
			$_SESSION['msg'] = "Erro ao atualizar dados!";
			$_SESSION['classe'] = "danger";
		}


		header("location: usuario.php");
	}	

?>
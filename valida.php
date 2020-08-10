<?php

	require 'connect.php';	
	session_start();

	if((!isset($_POST['username'])) || (!isset($_POST['password']))) {	
		$_SESSION['alert'] = 1;
		$_SESSION['msg'] = "Preencha todos os campos";
		$_SESSION['classe'] = "danger";
		header("location: login.php");
 	}


 	$secret_key = '6Lcve6cUAAAAAElKzX2l0C6F1oZohlLIMpy_i--C';
	$recaptcha_response = $_POST['g-recaptcha-response'];
	if(isset($recaptcha_response)){	
		$answer = 
			json_decode(
				file_get_contents(
					'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.
					'&response='.$_POST['g-recaptcha-response']
				)
			);
		if($answer->success) {

		 	$usuario = $_POST['username'];
		 	$senha = $_POST['password'];

		 	$usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
		 	$senha = filter_var($senha, FILTER_SANITIZE_STRING);

		 	$senha = md5($senha);

		 	$query = "SELECT * FROM usuarios where username = '".$usuario."' and password = '".$senha."'  ";
		 	$result = mysqli_query($connection, $query);
		 	$total = mysqli_num_rows($result);
		 	if($total == 0){
		 		$_SESSION['alert'] = 1;
				$_SESSION['msg'] = "Erro de Nome de Usuario ou senha";
				$_SESSION['classe'] = "danger";
				header("location: login.php");
		 	}else{

		 		$result->data_seek(0);
		 		$row = $result->fetch_assoc();
		 		$_SESSION['permissao']= $row['tipo'];
		 		$_SESSION['nome_C']= $row['name'];
		 		$_SESSION['logado'] = '1';
		 		$_SESSION['userr'] = $row['username'];
		 		$_SESSION['identt'] = $row['id'];
		 		header("location: redirect.php");
		 	}
		}else{
			$_SESSION['alert'] = 1;
			$_SESSION['msg'] = "Erro ao validar o reCAPTCHA";
			$_SESSION['classe'] = "danger";
			echo "<script>history.back();</script>";
		}
	}else{
		$_SESSION['alert'] = 1;
		$_SESSION['msg'] = "Confirme o reCAPTCHA";
		$_SESSION['classe'] = "danger";
		echo "<script>history.back();</script>";
	}

?>
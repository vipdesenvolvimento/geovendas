<?php

	session_start();

	unset($_SESSION['logado']);
	unset($_SESSION['nome_C']);
	unset($_SESSION['permissao']);
	header("location: login.php");

?>
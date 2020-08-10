<?php
	session_start();

	$perm = $_SESSION['permissao'];

	if($perm == 0){
		header("location: index2.php");
	}else{
		header("location: index.php");
	}

?>
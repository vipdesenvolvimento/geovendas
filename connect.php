<?php
	
	$host = "localhost";
	$user = "geovendas";
	$pass = "P6yI5zT8";

	$connection = mysqli_connect($host,$user,$pass);
	mysqli_set_charset($connection,"utf8");
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	$select_db = mysqli_select_db($connection, 'geovendas');
	if (!$select_db){
	    die("Database Selection Failed" . mysqli_error($connection));
	}

?>
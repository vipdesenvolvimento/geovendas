<?php

    $tipo = $_GET['tipo'];
    $tecnologia = $_GET['tec'];
    require 'connect.php';
    if($tecnologia=="TODAS"){
    	$qtec = "";
    }else{
    	$qtec = "where tecnologia = '".$tecnologia."'";
    }
    if($tipo == "TODAS"){
	   	echo "<option value='TODAS'>Todas</option>";

    }else{
	    $query = "SELECT * FROM ".$tipo." ".$qtec." group by cidade ";
	   	$result = mysqli_query($connection, $query);
	   	$result->data_seek(0);
	   		echo "<option value='TODAS'>Todas</option>";
	   	while($row = $result->fetch_assoc() ){
            $vauee = $row['cidade'];
            $vauee = str_replace(' ', '%20', $vauee);
	        echo "<option value='".$vauee."'>".$row['cidade']."</option>";

	   }
    	
    }

?>
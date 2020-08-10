<?php

    $tipo = $_GET['tipo'];
    $tecnologia = $_GET['tec'];
    $cidade = $_GET['cidade'];
    require 'connect.php';
    $aux = 0;
    if( ($tecnologia=="TODAS") || ($tecnologia =="todas") ){
    	$qtec = "";
        $tecnologia = "";
    }else{
    	$qtec = "where tecnologia like '".$tecnologia."'";
        $aux ++;
    }

    if($cidade=="TODAS"){
        $qcidade = "";
    }else{
        if($aux == 0){
            $qcidade = "where cidade like '".$cidade."'";

        }else{
            $qcidade = "and cidade like '".$cidade."'";
        }
    }

    if($tipo == "TODAS"){
	   	echo "<option value='TODAS'>Todas</option>";

    }else{
	    $query = "SELECT * FROM ".$tipo." ".$qtec." ".$qcidade." group by bairro ";
	   	$result = mysqli_query($connection, $query);
	   	$result->data_seek(0);
	   	echo "<option value='TODAS'>Todas</option>";
	   	while($row = $result->fetch_assoc() ){
	        echo "<option value='".$row['bairro']."'>".$row['bairro']."</option>";

	   }
    	
    }

?>
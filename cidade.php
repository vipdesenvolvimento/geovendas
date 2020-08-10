<?php

    $cidade = $_GET['cidade'];
    require 'connect.php';
    $query = "SELECT * FROM ".$cidade." group by cidade ";
   	$result = mysqli_query($connection, $query);
   	$result->data_seek(0);
   		echo "<option value=''></option>";
   	while($row = $result->fetch_assoc() ){
        echo "<option value='".$row['cidade']."'>".$row['cidade']."</option>";

   }

?>